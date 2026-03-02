<?php

namespace App\Exports;

use App\Models\Keuangan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class KeuanganExport implements FromCollection, WithHeadings, WithMapping, WithEvents
{
    protected $bulan;
    protected $tahun;

    public function __construct($bulan = null, $tahun = null)
    {
        $this->bulan = $bulan;
        $this->tahun = $tahun;
    }

    public function collection()
    {
        return Keuangan::when($this->bulan, fn($q) => $q->whereMonth('created_at', $this->bulan))
                       ->when($this->tahun, fn($q) => $q->whereYear('created_at', $this->tahun))
                       ->with('admin')
                       ->orderBy('created_at', 'desc')
                       ->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Reference',
            'Pengguna',
            'Kategori',
            'Metode',
            'Keterangan',
            'Pemasukan',
            'Pengeluaran',
            'Saldo',
        ];
    }

    public function map($item): array
    {
        return [
            $item->created_at->format('d-m-Y H:i'), // Tanggal
            $item->reference,
            $item->admin->name ?? '-',
            ucfirst($item->kategori),
            $item->payment_method ?? '-',
            $item->keterangan ?? '-',
            $item->pemasukan,
            $item->pengeluaran,
            $item->saldo,
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // Buat header bold
                $sheet->getStyle('A1:I1')->getFont()->setBold(true);

                // Tambahkan border ke seluruh tabel
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();
                $sheet->getStyle("A1:{$highestColumn}{$highestRow}")
                      ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                // Auto size kolom
                foreach (range('A', $highestColumn) as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }

                // Format kolom Pemasukan, Pengeluaran, Saldo sebagai angka dengan ribuan
                $sheet->getStyle("F2:H{$highestRow}")
                      ->getNumberFormat()
                      ->setFormatCode('#,##0');
            },
        ];
    }
}