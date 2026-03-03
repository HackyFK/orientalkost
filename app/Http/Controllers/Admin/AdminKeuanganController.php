<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\KeuanganExport;
use App\Exports\KeuanganOwnerExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\PendapatanOwner;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;



class AdminKeuanganController extends Controller
{

    public function index(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $kategori = $request->kategori;

        // Query dasar
        $query = Keuangan::query();

        // Filter bulan dan tahun
        if ($bulan) {
            $query->whereMonth('created_at', $bulan);
        }
        if ($tahun) {
            $query->whereYear('created_at', $tahun);
        }

        // Filter kategori (opsional)
        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        // Ambil data terbaru paling atas
        $data = Keuangan::query()
            ->when($bulan, fn($q) => $q->whereMonth('created_at', $bulan))
            ->when($tahun, fn($q) => $q->whereYear('created_at', $tahun))
            ->when($kategori, fn($q) => $q->where('kategori', $kategori))
            ->orderBy('created_at', 'desc') // <<< data terbaru paling atas
            ->paginate(10)
            ->withQueryString();

        // Hitung total pemasukan dan pengeluaran sesuai filter
        $totalPemasukan = Keuangan::query()
            ->when($bulan, fn($q) => $q->whereMonth('created_at', $bulan))
            ->when($tahun, fn($q) => $q->whereYear('created_at', $tahun))
            ->sum('pemasukan');

        $totalPengeluaran = Keuangan::query()
            ->when($bulan, fn($q) => $q->whereMonth('created_at', $bulan))
            ->when($tahun, fn($q) => $q->whereYear('created_at', $tahun))
            ->sum('pengeluaran');

        // Hitung saldo
        $saldo = $totalPemasukan - $totalPengeluaran;

        return view('admin.keuangan.index', compact(
            'data',
            'bulan',
            'tahun',
            'kategori',
            'totalPemasukan',
            'totalPengeluaran',
            'saldo'
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

        return redirect()->route('admin.keuangan.index')
            ->with('success', 'Pengeluaran berhasil ditambahkan');
    }




    public function laporan(Request $request)
    {
        $ownerId = $request->owner_id;

        $owners = User::where('role', 'owner')->get();

        $ownerName = null;

        if ($ownerId) {
            $owner = User::find($ownerId);
            $ownerName = $owner?->name;
        }

        $laporanOwner = PendapatanOwner::with([
            'owner',
            'booking.kamar.kos'
        ])
            ->when($ownerId, function ($query) use ($ownerId) {
                $query->where('owner_id', $ownerId);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.keuangan.laporan', compact(
            'laporanOwner',
            'owners',
            'ownerId',
            'ownerName'
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

    public function kirimOwner(Request $request)
    {
        $ids = $request->ids ?? [];

        if (count($ids) == 0) {
            return redirect()
                ->back()
                ->with('error', 'Pilih minimal 1 data');
        }

        // Ambil data pendapatan owner yang dipilih
        $pendapatanList = PendapatanOwner::with('owner')
            ->whereIn('id', $ids)
            ->where('status', 'pending')
            ->get();

        if ($pendapatanList->count() == 0) {
            return redirect()
                ->back()
                ->with('error', 'Tidak ada data pending yang dipilih');
        }

        // Ambil saldo terakhir
        $saldoTerakhir = Keuangan::latest()->value('saldo') ?? 0;

        foreach ($pendapatanList as $item) {

            // Kurangi saldo
            $saldoTerakhir -= $item->pendapatan_owner;

            // Simpan ke laporan keuangan sebagai pengeluaran
            Keuangan::create([

                'reference' => 'OWNER- ' . $item->owner->name,

                'admin_id' => Auth::id(),

                'kategori' => 'pengeluaran',

                'payment_method' => 'transfer',

                'pemasukan' => 0,

                'pengeluaran' => $item->pendapatan_owner,

                'saldo' => $saldoTerakhir,

                'keterangan' => 'pendapatan owner'

            ]);

            // Update status pendapatan owner
            $item->update([
                'status' => 'terkirim',
                'tanggal_kirim' => now()
            ]);
        }

        return redirect()
            ->back()
            ->with('success', $pendapatanList->count() . ' pendapatan berhasil dikirim & masuk ke laporan keuangan');
    }

    public function Pdf(Request $request)
    {
        $ownerId = $request->owner_id;

        $query = PendapatanOwner::with([
            'owner',
            'booking.kamar.kos'
        ]);

        if ($ownerId) {
            $query->where('owner_id', $ownerId);
        }

        $data = $query->latest()->get();

        $ownerName = null;

        if ($ownerId) {
            $ownerName = User::find($ownerId)?->name;
        }

        $pdf = Pdf::loadView('admin.keuangan.laporan_pdf', [
            'data' => $data,
            'ownerName' => $ownerName
        ])->setPaper('A4', 'potrait');

        return $pdf->stream('laporan-profit-owner.pdf');
    }

    public function owner(Request $request)
{
    $data = PendapatanOwner::with([
        'owner',
        'booking.kamar.kos'
    ])
    ->where('owner_id', Auth::id()) // ← hanya data owner login
    ->where('status', 'terkirim')   // ← hanya yang sudah terkirim
    ->latest()
    ->paginate(10);

    return view('admin.keuangan.owner', compact('data'));
}

public function exportOwner(Request $request)
{
    return Excel::download(
        new KeuanganOwnerExport(Auth::id()),
        'keuangan-owner.xlsx'
    );
}
}

