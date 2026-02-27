<?php

namespace App\Exports;

use App\Models\Keuangan;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KeuanganExport implements FromCollection, WithHeadings, WithMapping
{
    protected $bulan;
    protected $tahun;

    public function __construct($bulan, $tahun)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function collection()
    {
        return Keuangan::when($this->bulan, function ($q) {
                $q->whereMonth('created_at', $this->bulan);
            })
            ->when($this->tahun, function ($q) {
                $q->whereYear('created_at', $this->tahun);
            })
            ->with('admin')
            ->latest()
            ->get();
    }

    public function headings(): array
    {
        return [
            'Reference',
            'Admin',
            'Kategori',
            'Metode',
            'Pemasukan',
            'Pengeluaran',
            'Saldo',
            'Keterangan',
            'Tanggal',
        ];
    }

    public function map($item): array
    {
        return [
            $item->reference,
            $item->admin->name ?? '-',
            ucfirst($item->kategori),
            $item->payment_method,
            $item->pemasukan,
            $item->pengeluaran,
            $item->saldo,
            $item->keterangan,
            $item->created_at->format('Y-m-d H:i'),
        ];
    }
}