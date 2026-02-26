<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Kamar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment;

class BookingController extends Controller
{
    private function isKamarLocked(Kamar $kamar, $mulai, $selesai): bool
    {
        return Booking::where('kamar_id', $kamar->id)
            ->whereIn('status', ['pending', 'paid', 'confirmed'])
            ->where(function ($q) use ($mulai, $selesai) {
                $q->whereBetween('tanggal_mulai', [$mulai, $selesai])
                    ->orWhereBetween('tanggal_selesai', [$mulai, $selesai])
                    ->orWhere(function ($q) use ($mulai, $selesai) {
                        $q->where('tanggal_mulai', '<=', $mulai)
                            ->where('tanggal_selesai', '>=', $selesai);
                    });
            })
            ->exists();
    }

    public function create(Kamar $kamar)
    {
        return view('user.booking.create', compact('kamar'));
    }


    public function store(Request $request, Kamar $kamar)
    {
        $request->validate([
            'nama_penyewa'    => 'required|string|max:255',
            'email'           => 'required|email|max:255',
            'phone'           => 'required|string|max:20',
            'nomor_identitas' => 'required|string|max:20',
            'alamat'          => 'required|string|max:255',
            'jenis_sewa'      => 'required|in:bulanan,tahunan',
            'durasi'          => 'required|integer|min:1',
            'bulan_mulai'     => 'required|date_format:Y-m',
        ]);

        $durasiBulan = $request->jenis_sewa === 'tahunan'
            ? (int) $request->durasi * 12
            : (int) $request->durasi;

        // ✅ tanggal mulai selalu tanggal 1
        $tanggalMulai = Carbon::createFromFormat('Y-m', $request->bulan_mulai)
            ->startOfMonth();

        // ✅ tanggal selesai otomatis
        $tanggalSelesai = $tanggalMulai->copy()->addMonths($durasiBulan);

        $hargaPerBulan = $request->jenis_sewa === 'bulanan'
            ? $kamar->harga_bulanan
            : round($kamar->harga_tahunan / 12);

        $subtotal   = $hargaPerBulan * $durasiBulan;
        $dpNominal  = round($subtotal * $kamar->deposit / 100);
        $totalBayar = $subtotal - $dpNominal;

        $booking = Booking::create([
            'kamar_id'        => $kamar->id,
            'user_id'         => Auth::id(),
            'nama_penyewa'    => $request->nama_penyewa,
            'email'           => $request->email,
            'phone'           => $request->phone,
            'nomor_identitas' => $request->nomor_identitas,
            'alamat'          => $request->alamat,
            'jenis_sewa'      => $request->jenis_sewa,
            'durasi'          => $request->durasi,
            'tanggal_mulai'   => $tanggalMulai,
            'tanggal_selesai' => $tanggalSelesai,
            'harga_per_bulan' => $hargaPerBulan,
            'subtotal'        => $subtotal,
            'dp_nominal'      => $dpNominal,
            'total_bayar'     => $totalBayar,
            'status'          => 'pending',
        ]);

        $payment = Payment::create([
            'booking_id'     => $booking->id,
            'amount'         => $dpNominal,
            'payment_type'   => 'dp',
            'payment_method' => 'midtrans',
            'reference'      => null,
            'status'         => 'pending',
        ]);

        return redirect()->route('user.payment.show', $payment);
    }

    public function success(Booking $booking)
    {
        // optional: pastikan hanya pemilik booking yang bisa akses
        if ($booking->user_id !== auth::id()) {
            abort(403);
        }

        return view('user.booking.success', compact('booking'));
    }
}
