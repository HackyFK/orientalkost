<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @page { size: A4 portrait; margin: 0; }

        body {
            margin: 0;
            padding: 0;
            background: #e5e7eb;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }

        /* Ukuran kertas A4 */
        .a4 {
            width: 210mm;
            min-height: 297mm;
            margin: 16px auto;
            background: #fff;
            padding: 18mm 1mm 16mm;
            box-shadow: 0 4px 24px rgba(0,0,0,0.12);
        }

        @media print {
            body { background: #fff; }
            .a4  { margin: 0; box-shadow: none; padding: 14mm 15mm; }
        }

        /* Tabel data — fixed layout agar tidak meluap */
        .dt { width: 100%; border-collapse: collapse; table-layout: fixed; }

        .dt thead tr { background: #1e293b; }
        .dt thead th {
            color: #fff;
            font-size: 7px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 6px 0px;
            text-align: left;
            line-height: 1.2;
        }
        .dt thead th.r { text-align: right; }
        .dt thead th.c { text-align: center; }

        .dt tbody tr:nth-child(even) { background: #f8fafc; }
        .dt tbody tr { border-bottom: 1px solid #f1f5f9; }
        .dt tbody td {
            padding: 5px 4px;
            font-size: 7.5px;
            color: #334155;
            vertical-align: top;
            line-height: 1.4;
            word-break: break-word;
            overflow: hidden;
        }
        .dt tbody td.r { text-align: right; }
        .dt tbody td.c { text-align: center; }

        .sub { font-size: 6.5px; color: #94a3b8; margin-top: 1px; }
        .no  { color: #94a3b8; }
        .muted { color: #94a3b8; }

        .badge {
            display: inline-block;
            padding: 1px 4px;
            border-radius: 3px;
            font-size: 6.5px;
            font-weight: 700;
            text-transform: uppercase;
        }
        .badge-pending { background: #fef3c7; color: #92400e; }
        .badge-sent    { background: #dcfce7; color: #166534; }
        .badge-default { background: #f1f5f9; color: #475569; }
    </style>
</head>
<body>

<div class="a4">

    {{-- ── KOP SURAT ── --}}
<div class="border-b-2 border-gray-800 pb-4 mb-6">

    <div class="flex justify-between items-start">

        {{-- COMPANY --}}
        <div>
            <div class="text-2xl font-bold text-gray-800">
                @yield('title', setting('site_name', 'KosKu'))
            </div>

            <div class="text-sm text-gray-500 mt-1">
                {{ setting('site_tagline') }}
            </div>
        </div>

        {{-- META --}}
        <div class="text-sm text-gray-600 text-right space-y-1">

            <div>
                No. Laporan:
                <span class="font-semibold text-gray-800">
                    LPR/{{ now()->format('Y/m') }}/{{ str_pad(rand(1,999), 3, '0', STR_PAD_LEFT) }}
                </span>
            </div>

            <div>
                Tanggal Cetak:
                <span class="font-semibold text-gray-800">
                    {{ now()->format('d M Y') }}
                </span>
            </div>

            <div>
                Jam:
                <span class="font-semibold text-gray-800">
                    {{ now()->format('H:i') }} WIB
                </span>
            </div>

        </div>

    </div>

</div>


{{-- ── JUDUL LAPORAN ── --}}
<div class="mb-6">

    <div class="text-xl font-bold text-gray-800">
        Laporan Pendapatan Owner
    </div>

    <div class="text-sm text-gray-500 mt-1">

        @if ($ownerName)
            Owner:
            <span class="font-semibold text-gray-700">
                {{ $ownerName }}
            </span>
        @else
            Seluruh Owner
        @endif

        <span class="mx-2">•</span>

        Per
        <span class="font-semibold text-gray-700">
            {{ now()->format('d M Y') }}
        </span>

    </div>

</div>


{{-- ── INFO BLOCK ── --}}
<div class="bg-gray-50 border border-gray-200 rounded-lg p-4 mb-6">

    <div class="flex justify-between text-sm text-gray-700">

        <div class="space-y-1">

            <div>
                Periode Laporan:
                <span class="font-semibold">
                    {{ now()->format('M Y') }}
                </span>
            </div>

            <div>
                Total Transaksi:
                <span class="font-semibold">
                    {{ count($data) }} transaksi
                </span>
            </div>

        </div>

        <div class="space-y-1 text-right">

            <div>
                Dicetak oleh:
                <span class="font-semibold">
                    Admin
                </span>
            </div>

            <div>
                Status Data:
                <span class="font-semibold text-green-600">
                    Final
                </span>
            </div>

        </div>

    </div>

</div>


{{-- ── RINGKASAN ── --}}
<div class="border border-gray-200 rounded-lg p-4 mb-6">

    <div class="text-md font-semibold text-gray-800 mb-3">
        Ringkasan
    </div>

    <div class="space-y-2 text-sm">

        <div class="flex justify-between">
            <span class="text-gray-600">Total Booking Keseluruhan</span>
            <span class="font-semibold text-gray-800">
                Rp {{ number_format(collect($data)->sum('total_booking'), 0, ',', '.') }}
            </span>
        </div>

        <div class="flex justify-between">
            <span class="text-gray-600">Total Pendapatan Owner</span>
            <span class="font-semibold text-green-600">
                Rp {{ number_format(collect($data)->sum('pendapatan_owner'), 0, ',', '.') }}
            </span>
        </div>

        <div class="flex justify-between">
            <span class="text-gray-600">Total Pendapatan Platform</span>
            <span class="font-semibold text-blue-600">
                Rp {{ number_format(collect($data)->sum('pendapatan_platform'), 0, ',', '.') }}
            </span>
        </div>

        <hr class="my-2">

        <div class="flex justify-between">
            <span class="text-gray-600">Jumlah Data</span>
            <span class="font-semibold text-gray-800">
                {{ count($data) }} baris
            </span>
        </div>

    </div>

</div>

    {{-- ── TABEL DATA ── --}}
    <table class="dt">
        <colgroup>
            <col style="width:16px;">   {{-- No --}}
            <col style="width:48px;">   {{-- Tanggal --}}
            <col style="width:10px;">   {{-- Owner --}}
            <col style="width:auto;">   {{-- Kos & Kamar --}}
            <col style="width:auto;">   {{-- Alamat --}}
            <col style="width:68px;">   {{-- Total Booking --}}
            <col style="width:68px;">   {{-- Pend. Owner --}}
            <col style="width:70px;">   {{-- Pend. Platform --}}
            <col style="width:20px;">   {{-- Status --}}
        </colgroup>
        <thead>
            <tr>
                <th class="c">No</th>
                <th>Tanggal</th>
                <th>Owner</th>
                <th>Kos &amp; Kamar</th>
                <th>Alamat</th>
                <th class="r">Total Booking</th>
                <th class="r">Pend. Owner</th>
                <th class="r">Pend. Platform</th>
                <th class="c">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td class="c no">{{ $loop->iteration }}</td>

                    <td>
                        {{ $item->created_at->format('d M Y') }}
                        <div class="sub">{{ $item->created_at->format('H:i') }}</div>
                    </td>

                    <td style="font-weight:600;">{{ $item->owner->name ?? '-' }}</td>

                    <td>
                        <div style="font-weight:600;">{{ $item->booking->kamar->kos->nama_kos ?? '-' }}</div>
                        <div class="sub">{{ $item->booking->kamar->nama_kamar ?? '-' }}</div>
                    </td>

                    <td class="muted">{{ $item->booking->kamar->kos->alamat ?? '-' }}</td>

                    <td class="r" style="font-weight:700;">
                        Rp {{ number_format($item->total_booking, 0, ',', '.') }}
                    </td>

                    <td class="r" style="font-weight:700;">
                        Rp {{ number_format($item->pendapatan_owner, 0, ',', '.') }}
                    </td>

                    <td class="r" style="font-weight:700;">
                        Rp {{ number_format($item->pendapatan_platform, 0, ',', '.') }}
                    </td>

                    <td class="c">
                        @php
                            $badgeClass = match(strtolower($item->status)) {
                                'pending'           => 'badge-pending',
                                'terkirim', 'paid'  => 'badge-sent',
                                default             => 'badge-default',
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }}">{{ ucfirst($item->status) }}</span>
                        @if ($item->tanggal_kirim)
                            <div class="sub" style="text-align:center;">
                                {{ \Carbon\Carbon::parse($item->tanggal_kirim)->format('d/m/Y') }}
                            </div>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="c muted" style="padding:20px;">
                        Tidak ada data untuk ditampilkan
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>


    {{-- ── FOOTER ── --}}
    <div style="border-top:1px solid #e2e8f0; padding-top:7px; display:flex; justify-content:space-between;">
        <div style="font-size:7px; color:#94a3b8;">
            Dokumen ini digenerate secara otomatis oleh sistem &mdash; @yield('title', setting('site_name', 'KosKu'))
        </div>
        <div style="font-size:7px; color:#94a3b8;">
            {{ now()->format('d M Y') }} WIB
        </div>
    </div>

</div>

</body>
</html>