<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">

    <style>
        @page {
            size: A4 portrait;
            margin: 14mm 12mm;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #1e293b;
        }

        /* CONTAINER */
        .container {
            width: 100%;
        }

        /* HEADER */
        .header {
            border-bottom: 2px solid #0f172a;
            padding-bottom: 8px;
            margin-bottom: 14px;
        }

        .header-table {
            width: 100%;
        }

        .company {
            font-size: 18px;
            font-weight: bold;
        }

        .tagline {
            font-size: 10px;
            color: #64748b;
        }

        .meta {
            text-align: right;
            font-size: 10px;
        }

        /* TITLE */
        .title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 2px;
        }

        .subtitle {
            font-size: 10px;
            color: #64748b;
            margin-bottom: 12px;
        }

        /* INFO BOX */
        .box {
            border: 1px solid #e2e8f0;
            padding: 8px;
            margin-bottom: 12px;
        }

        .box-title {
            font-weight: bold;
            margin-bottom: 4px;
        }

        .box-row {
            display: flex;
            justify-content: space-between;
            margin: 2px 0;
        }

        /* TABLE */
        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th {
            background: #0f172a;
            color: white;
            padding: 6px 4px;
            font-size: 9px;
        }

        .table td {
            padding: 5px 4px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 9px;
        }

        .table tr:nth-child(even) {
            background: #f8fafc;
        }

        .right {
            text-align: right;
        }

        .center {
            text-align: center;
        }

        /* BADGE */
        .badge {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8px;
            font-weight: bold;
        }

        .pending {
            background: #fef3c7;
        }

        .sent {
            background: #dcfce7;
        }

        .default {
            background: #e2e8f0;
        }

        /* FOOTER */
        .footer {
            border-top: 1px solid #e2e8f0;
            margin-top: 10px;
            padding-top: 6px;
            font-size: 9px;
            display: flex;
            justify-content: space-between;
            color: #64748b;
        }
    </style>
</head>

<body>
    <div class="container">

        <!-- HEADER -->
        <table class="header-table header">
            <tr>
                <td>
                    <div class="company">
                        {{ setting('site_name', 'KosKu') }}
                    </div>
                    <div class="tagline">
                        {{ setting('site_tagline') }}
                    </div>
                </td>

                <td class="meta">
                    No: LPR/{{ now()->format('Y/m') }}/{{ str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT) }}<br>
                    Tanggal: {{ now()->format('d M Y') }}<br>
                    Jam: {{ now()->format('H:i') }} WIB
                </td>
            </tr>
        </table>


        <!-- TITLE -->
        <div class="title">
            Laporan Pendapatan Owner
        </div>

        <div class="subtitle">
            {{ $ownerName ? "Owner: $ownerName" : 'Semua Owner' }}
        </div>


        <!-- SUMMARY -->
        <div class="box">

            <div class="box-title">
                Ringkasan
            </div>

            <div class="box-row">
                <span>Total Booking</span>
                <span><b>Rp {{ number_format(collect($data)->sum('total_booking'), 0, ',', '.') }}</b></span>
            </div>

            <div class="box-row">
                <span>Pendapatan Owner</span>
                <span><b>Rp {{ number_format(collect($data)->sum('pendapatan_owner'), 0, ',', '.') }}</b></span>
            </div>

            <div class="box-row">
                <span>Pendapatan Platform</span>
                <span><b>Rp {{ number_format(collect($data)->sum('pendapatan_platform'), 0, ',', '.') }}</b></span>
            </div>

            <div class="box-row">
                <span>Total Transaksi</span>
                <span><b>{{ count($data) }}</b></span>
            </div>

        </div>


        <!-- TABLE -->
        <table class="table">

            <thead>
                <tr>
                    <th width="4%">No</th>
                    <th width="10%">Tanggal</th>
                    <th width="14%">Owner</th>
                    <th width="18%">Kos</th>
                    <th width="16%">Alamat</th>
                    <th width="12%">Booking</th>
                    <th width="12%">Owner</th>
                    <th width="12%">Platform</th>
                    <th width="8%">Status</th>
                </tr>
            </thead>

            <tbody>

                @forelse($data as $item)
                    <tr>

                        <td class="center">
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $item->created_at->format('d/m/Y') }}
                        </td>

                        <td>
                            {{ $item->owner->name ?? '-' }}
                        </td>

                        <td>
                            {{ $item->booking->kamar->kos->nama_kos ?? '-' }}
                        </td>

                        <td>
                            {{ $item->booking->kamar->kos->alamat ?? '-' }}
                        </td>

                        <td class="right">
                            Rp {{ number_format($item->total_booking, 0, ',', '.') }}
                        </td>

                        <td class="right">
                            Rp {{ number_format($item->pendapatan_owner, 0, ',', '.') }}
                        </td>

                        <td class="right">
                            Rp {{ number_format($item->pendapatan_platform, 0, ',', '.') }}
                        </td>

                        <td class="center">

                            @php
                                $class = match ($item->status) {
                                    'pending' => 'badge pending',
                                    'terkirim' => 'badge sent',
                                    default => 'badge default',
                                };
                            @endphp

                            <span class="{{ $class }}">
                                {{ ucfirst($item->status) }}
                            </span>

                            @if ($item->tanggal_kirim)
                                <br>
                                {{ \Carbon\Carbon::parse($item->tanggal_kirim)->format('d/m/Y') }}
                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="9" class="center">
                            Tidak ada data
                        </td>
                    </tr>
                @endforelse

            </tbody>

        </table>


        <!-- FOOTER -->
        <div class="footer">

            <div>
                Generated by {{ setting('site_name', 'KosKu') }}
            </div>

            <div>
                {{ now()->format('d M Y H:i') }}
            </div>

        </div>

    </div>
</body>

</html>
