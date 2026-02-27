<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\KeuanganExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminKeuanganController extends Controller
{

     public function index(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $kategori = $request->kategori;

        // Mulai query builder
        $query = Keuangan::query();

        // Filter bulan dan tahun
        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }
        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        // Filter kategori
        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        // Ambil data terbaru, paginate 10 per halaman
        $data = $query->latest()->paginate(10)->withQueryString();

        // Hitung total pemasukan (filtered)
        $totalPemasukan = $query->where('kategori', 'pemasukan')->sum('pemasukan');

        return view('admin.keuangan.index', compact(
            'data',
            'bulan',
            'tahun',
            'kategori',
            'totalPemasukan'
        ));
    }


    public function create()
    {
        return view('admin.keuangan.create');
    }


    public function store(Request $request)
    {

        $request->validate([

            'pengeluaran' => 'required|numeric',
            'keterangan' => 'required'

        ]);

        $saldoTerakhir = Keuangan::latest()->value('saldo') ?? 0;

        Keuangan::create([

            'reference' => '-',

            'admin_id' => Auth::id(),

            'kategori' => 'pengeluaran',

            'payment_method' => '-',

            'pemasukan' => 0,

            'pengeluaran' => $request->pengeluaran,

            'saldo' => $saldoTerakhir - $request->pengeluaran,

            'keterangan' => $request->keterangan

        ]);

       return redirect()->route('admin.keuangan.laporan')
        ->with('success', 'Pengeluaran berhasil ditambahkan');

    }

    public function laporan()
{
    $data = \App\Models\Keuangan::latest()->paginate(10);

    $totalPemasukan = Keuangan::sum('pemasukan');
    $totalPengeluaran = Keuangan::sum('pengeluaran');
    $saldo = Keuangan::latest()->value('saldo') ?? 0;

    return view('admin.keuangan.laporan', compact(
        'data',
        'totalPemasukan',
        'totalPengeluaran',
        'saldo'
    ));
}

public function export(Request $request)
{
    return Excel::download(
        new KeuanganExport(
            $request->bulan,
            $request->tahun
        ),
        'laporan-keuangan.xlsx'
    );
}
    

}