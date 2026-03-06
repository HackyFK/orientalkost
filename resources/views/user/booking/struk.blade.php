<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Booking #{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            background: #e2e8f0;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 32px 16px;
            min-height: 100vh;
        }

        /* ── Struk Container ── */
        .struk {
            width: 148mm;
            min-height: 210mm;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.13);
            display: flex;
            flex-direction: column;
        }

        /* ── Header ── */
        .header {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            padding: 20px 24px 18px;
            position: relative;
            overflow: hidden;
        }
        .header-circle-1 {
            position: absolute;
            top: -20px; right: -20px;
            width: 90px; height: 90px;
            border-radius: 50%;
            background: rgba(255,255,255,0.08);
        }
        .header-circle-2 {
            position: absolute;
            bottom: -30px; left: 30px;
            width: 110px; height: 110px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
        }
        .header-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }
        .brand-name {
            color: #ffffff;
            font-size: 18px;
            font-weight: 800;
            letter-spacing: -0.5px;
            line-height: 1;
        }
        .brand-tagline {
            color: rgba(255,255,255,0.65);
            font-size: 9px;
            margin-top: 3px;
        }
        .receipt-badge {
            background: rgba(255,255,255,0.15);
            border: 1px solid rgba(255,255,255,0.25);
            border-radius: 7px;
            padding: 4px 9px;
            color: #ffffff;
            font-size: 8px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            white-space: nowrap;
        }
        .booking-no {
            position: relative;
            z-index: 1;
            color: rgba(255,255,255,0.65);
            font-size: 10px;
        }
        .booking-no span {
            color: #ffffff;
            font-weight: 700;
        }

        /* ── Status Bar ── */
        .status-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 9px 24px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
        }
        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 9px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: 1px solid;
        }
        .status-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            display: inline-block;
        }
        /* status colors */
        .pill-paid      { background: #dcfce7; color: #15803d; border-color: #bbf7d0; }
        .dot-paid       { background: #16a34a; }
        .pill-pending   { background: #fef9c3; color: #a16207; border-color: #fde68a; }
        .dot-pending    { background: #ca8a04; }
        .pill-confirmed { background: #dbeafe; color: #1d4ed8; border-color: #bfdbfe; }
        .dot-confirmed  { background: #2563eb; }
        .pill-cancelled { background: #fee2e2; color: #dc2626; border-color: #fecaca; }
        .dot-cancelled  { background: #ef4444; }
        .pill-expired   { background: #f1f5f9; color: #64748b; border-color: #cbd5e1; }
        .dot-expired    { background: #94a3b8; }

        .print-date {
            color: #94a3b8;
            font-size: 9px;
        }

        /* ── Body ── */
        .body {
            flex: 1;
            padding: 16px 24px;
        }

        /* Section label */
        .section-label {
            font-size: 8px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #94a3b8;
            padding-bottom: 6px;
            border-bottom: 1px solid #f1f5f9;
            margin-bottom: 10px;
        }

        /* Section wrapper */
        .section { margin-bottom: 2px; }

        /* Penyewa */
        .penyewa-row {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #3b82f6);
            display: flex; align-items: center; justify-content: center;
            color: #fff;
            font-size: 15px;
            font-weight: 800;
            flex-shrink: 0;
        }
        .penyewa-name {
            font-size: 11px;
            font-weight: 700;
            color: #1e293b;
        }
        .penyewa-sub {
            font-size: 9px;
            color: #94a3b8;
            margin-top: 2px;
        }

        /* Info grid */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 6px;
        }
        .info-item {
            background: #f8fafc;
            border-radius: 8px;
            padding: 8px 10px;
        }
        .info-item.full { grid-column: 1 / -1; }
        .info-label {
            font-size: 8px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #94a3b8;
            margin-bottom: 2px;
        }
        .info-value {
            font-size: 10px;
            font-weight: 700;
            color: #1e293b;
        }

        /* Dashed divider */
        .divider {
            border: none;
            border-top: 1.5px dashed #cbd5e1;
            margin: 8px -24px;
            position: relative;
        }
        .divider::before, .divider::after {
            content: '';
            position: absolute;
            top: 50%; transform: translateY(-50%);
            width: 13px; height: 13px;
            background: #e2e8f0;
            border-radius: 50%;
        }
        .divider::before { left: -7px; }
        .divider::after  { right: -7px; }

        /* Price rows */
        .price-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 4px 0;
        }
        .price-label { font-size: 10px; color: #64748b; }
        .price-value { font-size: 10px; font-weight: 600; color: #334155; }
        .price-value.discount { color: #ef4444; }
        .price-subtotal-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 6px 0;
            margin-top: 4px;
            border-top: 1.5px dashed #e2e8f0;
        }

        /* Layanan tambahan */
        .layanan-title {
            font-size: 9px;
            font-weight: 600;
            color: #94a3b8;
            margin: 6px 0 3px;
        }
        .layanan-row {
            display: flex;
            justify-content: space-between;
            padding: 2px 0;
            font-size: 9px;
            color: #64748b;
        }

        /* Total box */
        .total-box {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            border-radius: 10px;
            padding: 11px 14px;
            margin-top: 10px;
        }
        .total-label { font-size: 10px; font-weight: 700; color: rgba(255,255,255,0.8); }
        .total-value { font-size: 15px; font-weight: 800; color: #ffffff; }

        /* ── Footer ── */
        .footer {
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            padding: 12px 24px;
            text-align: center;
        }
        .footer-thanks {
            font-size: 10px;
            font-weight: 700;
            color: #334155;
            margin-bottom: 2px;
        }
        .footer-sub {
            font-size: 8px;
            color: #94a3b8;
        }

        /* ── Print button ── */
        .print-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 20px;
            padding: 11px 28px;
            background: #1d4ed8;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(29,78,216,0.3);
            font-family: 'Inter', sans-serif;
        }
        .print-btn:hover { background: #1e40af; }

        /* ── Print media ── */
        @media print {
            body { background: #fff; padding: 0; display: block; }
            .struk { box-shadow: none; border-radius: 0; width: 148mm; min-height: 210mm; }
            .print-btn { display: none; }
            @page { size: A5 portrait; margin: 0; }
        }
    </style>
</head>

<body>

@php
    $statusKey  = $booking->status;
    $statusText = ['paid' => 'Lunas', 'pending' => 'Menunggu', 'confirmed' => 'Dikonfirmasi', 'cancelled' => 'Dibatalkan', 'expired' => 'Selesai'][$statusKey] ?? ucfirst($statusKey);
@endphp

<div class="struk">

    {{-- ── Body ── --}}
    <div class="body">

        {{-- Penyewa --}}
        <div class="section">
            <div class="section-label">Identitas Penyewa</div>
            <div class="penyewa-row">
                <div class="avatar">{{ strtoupper(substr($booking->nama_penyewa, 0, 1)) }}</div>
                <div>
                    <div class="penyewa-name">{{ $booking->nama_penyewa }}</div>
                    <div class="penyewa-sub">{{ $booking->email }} &bull; {{ $booking->phone }}</div>
                    @if($booking->alamat)
                        <div class="penyewa-sub">{{ $booking->alamat }}</div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Detail Booking --}}
        <div class="section">
            <div class="section-label">Detail Booking</div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Kos</div>
                    <div class="info-value">{{ $booking->kamar->kos->nama_kos ?? '-' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Kamar</div>
                    <div class="info-value">{{ $booking->kamar->nama_kamar ?? '-' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Jenis Sewa</div>
                    <div class="info-value">{{ ucfirst($booking->jenis_sewa) }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Durasi</div>
                    <div class="info-value">{{ $booking->durasi }} Bulan</div>
                </div>
                <div class="info-item full">
                    <div class="info-label">Periode Sewa</div>
                    <div class="info-value">
                        {{ \Carbon\Carbon::parse($booking->tanggal_mulai)->format('d M Y') }}
                        &rarr;
                        {{ \Carbon\Carbon::parse($booking->tanggal_selesai)->format('d M Y') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="divider " ></div>

        {{-- Rincian Biaya --}}
        <div class="section" >
            <div class="section-label">Rincian Biaya</div>

            <div class="price-row">
                <span class="price-label">Harga per Bulan</span>
                <span class="price-value">Rp {{ number_format($booking->harga_per_bulan, 0, ',', '.') }}</span>
            </div>
            <div class="price-row">
                <span class="price-label">Diskon Kamar</span>
                <span class="price-value discount">- Rp {{ number_format($booking->kos_diskon, 0, ',', '.') }}</span>
            </div>
            <div class="price-subtotal-row">
                <span class="price-label">Subtotal</span>
                <span class="price-value">Rp {{ number_format($booking->subtotal, 0, ',', '.') }}</span>
            </div>

            @if ($booking->kamar->kos->layanan->count())
                <div class="layanan-title">Layanan Tambahan</div>
                @foreach ($booking->kamar->kos->layanan as $index => $layanan)
                    <div class="layanan-row">
                        <span>{{ $index + 1 }}. {{ $layanan->nama_layanan }}</span>
                        <span>Rp {{ number_format($layanan->harga, 0, ',', '.') }}</span>
                    </div>
                @endforeach
            @endif

            <div class="total-box">
                <span class="total-label">Total Bayar</span>
                <span class="total-value">Rp {{ number_format($booking->total_bayar, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="divider"></div>

        {{-- Info Pembayaran --}}
        <div class="section"    >
            <div class="section-label">Info Pembayaran</div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">Metode</div>
                    <div class="info-value">{{ $booking->payment_method ?? '-' }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Tanggal Bayar</div>
                    <div class="info-value">
                        {{ $booking->paid_at ? \Carbon\Carbon::parse($booking->paid_at)->format('d M Y') : '-' }}
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- ── Footer ── --}}
    <div class="footer">
        <div class="footer-thanks">Terima kasih telah booking di @yield('title', setting('site_name', 'KosKu'))!</div>
        <div class="footer-sub">Simpan struk ini sebagai bukti pemesanan yang sah.</div>
    </div>

</div>

</body>
</html>