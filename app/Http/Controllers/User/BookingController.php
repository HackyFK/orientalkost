<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Kamar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // validasi sederhana
        $request->validate([
            'nama_penyewa'   => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'phone'          => 'required|string|max:20',
            'jenis_sewa'     => 'required|in:bulanan,tahunan',
            'durasi'         => 'required|integer|min:1',
            'tanggal_mulai'  => 'required|date',
        ]);

        // hitung durasi dalam bulan
        $durasiBulan = $request->jenis_sewa === 'tahunan'
            ? (int) $request->durasi * 12
            : (int) $request->durasi;

        // harga per bulan sesuai jenis sewa
        $hargaPerBulan = $request->jenis_sewa === 'bulanan'
            ? $kamar->harga_bulanan
            : round($kamar->harga_tahunan / 12);

        // subtotal
        $subtotal = $hargaPerBulan * $durasiBulan;

        // DP nominal
        $dpNominal = round($subtotal * $kamar->deposit / 100);

        // total bayar
        $totalBayar = $subtotal - $dpNominal;

        // tanggal mulai dan selesai
        $tanggalMulai = Carbon::parse($request->tanggal_mulai);
        $tanggalSelesai = $tanggalMulai->copy()->addMonths($durasiBulan);

        // simpan booking
        $booking = Booking::create([
            'kamar_id'      => $kamar->id,
            'user_id'       => Auth::id(), // pastikan user login
            'nama_penyewa'  => $request->nama_penyewa,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'jenis_sewa'    => $request->jenis_sewa,
            'durasi'        => $request->durasi,
            'tanggal_mulai' => $tanggalMulai,
            'tanggal_selesai' => $tanggalSelesai,
            'harga_per_bulan' => $hargaPerBulan,
            'subtotal'      => $subtotal,
            'dp_nominal'    => $dpNominal,
            'total_bayar'   => $totalBayar,
            'status'        => 'pending', // default
        ]);

        return redirect()->route('user.kamar.show', $booking->kamar)
            ->with('success', 'Booking berhasil dibuat!');
    }
}
