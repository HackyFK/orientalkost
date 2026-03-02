<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PendapatanOwner;
use Illuminate\Support\Facades\DB;


class LaporanController extends Controller
{

     public function index()
    {
        $laporan = PendapatanOwner::with([
            'owner',
            'booking.kamar.kos'
        ])
        ->latest()
        ->get();

        return view('admin.laporan.owner', compact('laporan'));
    }


    public function laporanKamar(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $query = PendapatanOwner::query()
            ->join('bookings', 'pendapatan_owner.booking_id', '=', 'bookings.id')
            ->join('kamars', 'bookings.kamar_id', '=', 'kamars.id')
            ->join('kos', 'kamars.kos_id', '=', 'kos.id')
            ->join('users as owner', 'pendapatan_owner.owner_id', '=', 'owner.id')
            ->select(
                'owner.name as nama_owner',
                'kos.nama_kos',
                'kamars.nama_kamar',

                DB::raw('COUNT(bookings.id) as total_booking'),

                DB::raw('SUM(pendapatan_owner.total_booking) as total_uang_masuk'),

                DB::raw('SUM(pendapatan_owner.pendapatan_owner) as total_pendapatan_owner'),

                DB::raw('SUM(pendapatan_owner.pendapatan_platform) as total_platform')
            )
            ->groupBy(
                'owner.id',
                'owner.name',
                'kos.id',
                'kos.nama_kos',
                'kamars.id',
                'kamars.nama_kamar'
            );

        // filter bulan
        if ($bulan) {
            $query->whereMonth('pendapatan_owner.tanggal', $bulan);
        }

        // filter tahun
        if ($tahun) {
            $query->whereYear('pendapatan_owner.tanggal', $tahun);
        }

        $data = $query->get();

        return view('admin.laporan.kamar', compact('data'));
    }
}
