<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Kamar;
use App\Models\Layanan;
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

        // Booking kamar yang masih aktif
        $bookings = Booking::where('kamar_id', $kamar->id)
            ->whereIn('status', ['pending', 'paid', 'confirmed'])
            ->get(['tanggal_mulai', 'tanggal_selesai']);

        // Layanan sesuai kos kamar
        $layanan = Layanan::where('kos_id', $kamar->kos_id)->get();

        // Discount kos
        $discounts = \App\Models\KosDiscount::where('kos_id', $kamar->kos_id)
            ->where('is_active', true)
            ->get();

        return view('user.booking.create', compact('kamar', 'bookings', 'layanan', 'discounts'));
    }



    public function store(Request $request, Kamar $kamar)
    {
        $request->validate([
            'nama_penyewa'    => 'required|string|max:255',
            'email'           => 'required|email|max:255',
            'phone'           => 'required|string|max:20',
            'nomor_identitas' => 'required|string|max:20',
            'alamat'          => 'required|string|max:255',
            'jenis_sewa'      => 'required|in:bulanan,tahunan,harian',
            'durasi'          => 'required|integer|min:1',
            'bulan_mulai'     => 'required_if:jenis_sewa,bulanan,tahunan|date_format:Y-m',
            'tanggal_mulai' => 'required_if:jenis_sewa,harian|date_format:Y-m-d',
        ]);

        $discount = null;
        $discountAmount = 0;
        // =========================
        // HITUNG TANGGAL
        // =========================
        if ($request->jenis_sewa === 'harian') {

            $durasi = (int) $request->durasi;

            $tanggalMulai = Carbon::parse($request->tanggal_mulai);
            $tanggalSelesai = $tanggalMulai->copy()->addDays($durasi)->subDay();

            $hargaPerUnit = $kamar->harga_harian;
            $subtotal = $hargaPerUnit * $durasi;
        } else {

            $durasi = (int) $request->durasi;

            $durasiBulan = $request->jenis_sewa === 'tahunan'
                ? $durasi * 12
                : $durasi;

            $tanggalMulai = Carbon::createFromFormat('Y-m', $request->bulan_mulai)
                ->startOfMonth();

            $tanggalSelesai = $tanggalMulai->copy()->addMonths($durasiBulan)->subDay();

            $hargaPerUnit = $request->jenis_sewa === 'bulanan'
                ? $kamar->harga_bulanan
                : round($kamar->harga_tahunan / 12);

            $subtotal = $hargaPerUnit * $durasiBulan;

            // DISKON
            $discount = \App\Models\KosDiscount::where('kos_id', $kamar->kos_id)
                ->where('is_active', true)
                ->get()
                ->first(function ($promo) use ($subtotal, $request, $durasi, $tanggalMulai) {

                    // cek jenis sewa
                    if ($promo->jenis_sewa && $promo->jenis_sewa != $request->jenis_sewa) {
                        return false;
                    }

                    // cek minimal durasi
                    if ($promo->min_durasi && $durasi < $promo->min_durasi) {
                        return false;
                    }

                    // cek minimal total
                    if ($promo->min_total && $subtotal < $promo->min_total) {
                        return false;
                    }

                    // =====================
                    // CEK RANGE TANGGAL
                    // =====================
                    if ($promo->start_date && $tanggalMulai->lt($promo->start_date)) {
                        return false;
                    }

                    if ($promo->end_date && $tanggalMulai->gt($promo->end_date)) {
                        return false;
                    }

                    // =====================
                    // CEK HARI AKTIF
                    // =====================
                    if ($promo->days && count($promo->days)) {

                        $day = strtolower($tanggalMulai->format('D'));

                        $map = [
                            'mon' => 'mon',
                            'tue' => 'tue',
                            'wed' => 'wed',
                            'thu' => 'thu',
                            'fri' => 'fri',
                            'sat' => 'sat',
                            'sun' => 'sun',
                        ];

                        $day = $map[$day] ?? null;

                        if (!in_array($day, $promo->days)) {
                            return false;
                        }
                    }

                    return true;
                });

                
            if ($discount) {

                if ($discount->type == 'percent') {

                    $discountAmount = ($subtotal * $discount->value) / 100;
                } else {

                    $discountAmount = $discount->value;
                }

                if ($discount->max_discount) {
                    $discountAmount = min($discountAmount, $discount->max_discount);
                }
            }
        }

        $layananTotal = 0;

        if ($request->filled('layanan')) {
            $layananTotal = Layanan::whereIn('id', $request->layanan)->sum('harga');
        }

        // =========================
        // CEK BENTROK (WAJIB)
        // =========================
        $bentrok = Booking::where('kamar_id', $kamar->id)
            ->whereIn('status', ['pending', 'paid', 'confirmed'])
            ->where(function ($q) use ($tanggalMulai, $tanggalSelesai) {
                $q->where('tanggal_mulai', '<', $tanggalSelesai)
                    ->where('tanggal_selesai', '>', $tanggalMulai);
            })
            ->exists();

        if ($bentrok) {
            return back()->withErrors(['Tanggal sudah dibooking'])->withInput();
        }

        // =========================
        // HITUNG DP
        // =========================

        $totalBayar = $subtotal + $layananTotal - $discountAmount;

        // =========================
        // SIMPAN BOOKING
        // =========================
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

            'harga_per_bulan' => $hargaPerUnit,

            'subtotal' => $subtotal,
            'discount_amount' => $discountAmount,
            'total_bayar' => $totalBayar,
            'discount_id' => $discount?->id,

            'status'          => 'pending',
        ]);

        if ($request->filled('layanan')) {
            $booking->layanans()->sync($request->layanan);
        }
        $payment = Payment::create([
            'booking_id'     => $booking->id,
            'amount'         => $totalBayar,   // bayar full
            'payment_type'   => 'pelunasan',
            'payment_method' => 'midtrans',
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
