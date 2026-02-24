<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Kamar;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminLaporanController extends Controller
{
    public function transaksi(Request $request)
    {
        $start = $request->start ?? now()->startOfMonth();
        $end   = $request->end ?? now()->endOfMonth();

        $payments = Payment::where('status', 'paid')
            ->whereBetween('paid_at', [$start, $end])
            ->with('booking.kamar')
            ->latest()
            ->get();

        $total = $payments->sum('amount');

        return view('admin.laporan.transaksi', compact(
            'payments',
            'total',
            'start',
            'end'
        ));
    }

    public function piutang()
    {
        $bookings = Booking::whereIn('status', ['pending', 'paid_dp'])
            ->with('payments')
            ->get();

        return view('admin.laporan.piutang', compact('bookings'));
    }

    public function okupansi()
    {
        $totalKamar = Kamar::count();

        $terisi = Booking::where('status', 'confirmed')
            ->whereDate('tanggal_mulai', '<=', now())
            ->whereDate('tanggal_selesai', '>=', now())
            ->count();

        $okupansi = $totalKamar > 0
            ? ($terisi / $totalKamar) * 100
            : 0;

        return view('admin.laporan.okupansi', compact(
            'totalKamar',
            'terisi',
            'okupansi'
        ));
    }
}
