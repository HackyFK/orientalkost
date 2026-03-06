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
    protected $tanggal;
    protected $dari;
    protected $sampai;

    public function __construct($filters = [])
    {
        $this->bulan = $filters['bulan'] ?? null;
        $this->tahun = $filters['tahun'] ?? null;
        $this->tanggal = $filters['tanggal'] ?? null;
        $this->dari = $filters['dari'] ?? null;
        $this->sampai = $filters['sampai'] ?? null;
    }

    public function collection()
    {
        return Keuangan::when($this->bulan, fn($q) => $q->whereMonth('created_at', $this->bulan))
                       ->when($this->tahun, fn($q) => $q->whereYear('created_at', $this->tahun))
                       ->when($this->tanggal, fn($q) => $q->whereDate('created_at', $this->tanggal))
                       ->when($this->dari && $this->sampai, fn($q) => $q->whereBetween('created_at', [$this->dari, $this->sampai]))
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

                // Header bold
                $sheet->getStyle('A1:I1')->getFont()->setBold(true);

                // Border seluruh tabel
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();
                $sheet->getStyle("A1:{$highestColumn}{$highestRow}")
                      ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                // Auto size kolom
                foreach (range('A', $highestColumn) as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }

                // Format kolom Pemasukan, Pengeluaran, Saldo sebagai angka ribuan
                $sheet->getStyle("G2:I{$highestRow}")
                      ->getNumberFormat()
                      ->setFormatCode('#,##0');
            },
        ];
    }
}