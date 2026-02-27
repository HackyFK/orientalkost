<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use App\Models\Kamar;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Review;
use Illuminate\Http\Request;
use DB;

class AdminDashboardController extends Controller
{
    public function index(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun ?? date('Y');

        // Query dasar payment yang sudah lunas
        $paymentQuery = Payment::where('status', 'paid');

        // Filter tahun
        if ($tahun) {
            $paymentQuery->whereYear('paid_at', $tahun);
        }

        // Filter bulan
        if ($bulan) {
            $paymentQuery->whereMonth('paid_at', $bulan);
        }

        // Total pemasukan sesuai filter
        $totalPemasukan = $paymentQuery->sum('amount');

        // Pemasukan bulan ini (otomatis)
        $pemasukanBulanIni = Payment::where('status', 'paid')
            ->whereMonth('paid_at', now()->month)
            ->whereYear('paid_at', now()->year)
            ->sum('amount');

        // Pemasukan tahun ini (otomatis)
        $pemasukanTahunIni = Payment::where('status', 'paid')
            ->whereYear('paid_at', now()->year)
            ->sum('amount');

        // Statistik lain
        $totalKos = Kos::count();
        $totalKamar = Kamar::count();
        $kamarTerisi = Kamar::where('status', 'terisi')->count();
        $totalBooking = Booking::count();
        $reviewApprove = Review::where('status', 'approved')->count();

        // Chart pemasukan per bulan (tahun filter aktif)
        $chart = Payment::select(
                DB::raw('MONTH(paid_at) as bulan'),
                DB::raw('SUM(amount) as total')
            )
            ->where('status', 'paid')
            ->when($tahun, fn($q) => $q->whereYear('paid_at', $tahun))
            ->groupBy('bulan')
            ->orderBy('bulan')
            ->get();

        return view('admin.dashboard.index', compact(
            'totalPemasukan',
            'pemasukanBulanIni',
            'pemasukanTahunIni',
            'totalKos',
            'totalKamar',
            'kamarTerisi',
            'totalBooking',
            'reviewApprove',
            'chart',
            'bulan',
            'tahun'
        ));
    }
}