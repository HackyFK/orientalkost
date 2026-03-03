<?php

namespace App\Exports;

use App\Models\PendapatanOwner;
use Maatwebsite\Excel\Concerns\{
    FromCollection,
    WithHeadings,
    WithMapping,
    ShouldAutoSize,
    WithStyles,
    WithEvents
};
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Events\AfterSheet;

class KeuanganOwnerExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    ShouldAutoSize,
    WithStyles,
    WithEvents
{
    protected $ownerId;
    private $no = 1;

    public function __construct($ownerId)
    {
        $this->ownerId = $ownerId;
    }

    /**
     * Ambil data
     */
    public function collection()
    {
        return PendapatanOwner::with([
                'owner',
                'booking.kamar.kos'
            ])
            ->where('owner_id', $this->ownerId)
            ->where('status', 'terkirim')
            ->latest()
            ->get();
    }

    /**
     * Mapping isi tabel
     */
    public function map($item): array
    {
        return [

            $this->no++,

            optional($item->created_at)->format('d M Y'),

            optional($item->owner)->name ?? '-',

            optional($item->booking->kamar->kos)->nama_kos ?? '-',

            optional($item->booking->kamar)->nama_kamar ?? '-',

            'Rp ' . number_format($item->pendapatan_owner ?? 0, 0, ',', '.'),

            $item->metode_transfer ?? 'Transfer Bank',

            ucfirst($item->status),
        ];
    }

    /**
     * Heading tabel
     */
    public function headings(): array
    {
        return [
            'No',
            'Tanggal',
            'Owner',
            'Kos',
            'Kamar',
            'Pendapatan Owner',
            'Metode Transfer',
            'Status'
        ];
    }

    /**
     * Style heading
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold' => true
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ]
            ]
        ];
    }

    /**
     * Tambah border dan rapikan
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function($event) {

                $sheet = $event->sheet->getDelegate();

                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                $range = "A1:{$highestColumn}{$highestRow}";

                // Border semua tabel
                $sheet->getStyle($range)
                    ->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN);

                // Center kolom tertentu
                $sheet->getStyle("A2:A{$highestRow}")
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->getStyle("B2:B{$highestRow}")
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->getStyle("H2:H{$highestRow}")
                    ->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Background heading
                $sheet->getStyle('A1:H1')->applyFromArray([
                    'fill' => [
                        'fillType' => 'solid',
                        'color' => ['rgb' => 'E7F3FF']
                    ]
                ]);
            }
        ];
    }
}