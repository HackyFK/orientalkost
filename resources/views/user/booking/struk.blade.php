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
            justify-content: center;
            min-height: 100vh;
            padding: 24px;
        }

        /* A4 Portrait = 210mm × 297mm */
        .struk {
            width: 210mm;
            height: 297mm;
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 12px 48px rgba(0,0,0,.15);
            display: flex;
            flex-direction: column;
        }

        /* ════════════════════════
           HEADER
        ════════════════════════ */
        .header {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            padding: 22px 28px 18px;
            position: relative;
            overflow: hidden;
            flex-shrink: 0;
        }
        .hc1 {
            position: absolute; top: -24px; right: -24px;
            width: 110px; height: 110px; border-radius: 50%;
            background: rgba(255,255,255,.08);
        }
        .hc2 {
            position: absolute; bottom: -36px; left: 36px;
            width: 140px; height: 140px; border-radius: 50%;
            background: rgba(255,255,255,.05);
        }
        .header-inner {
            display: flex; align-items: center;
            justify-content: space-between;
            position: relative; z-index: 1;
        }
        .brand-name {
            color: #fff; font-size: 26px; font-weight: 800;
            letter-spacing: -.6px; line-height: 1;
        }
        .brand-tagline { color: rgba(255,255,255,.6); font-size: 11px; margin-top: 4px; }
        .header-right { display: flex; flex-direction: column; align-items: flex-end; gap: 6px; }
        .receipt-badge {
            background: rgba(255,255,255,.15);
            border: 1px solid rgba(255,255,255,.3);
            border-radius: 8px; padding: 5px 12px;
            color: #fff; font-size: 10px; font-weight: 700;
            text-transform: uppercase; letter-spacing: .6px;
        }
        .booking-no { color: rgba(255,255,255,.65); font-size: 12px; }
        .booking-no span { color: #fff; font-weight: 700; }

        /* ════════════════════════
           STATUS BAR
        ════════════════════════ */
        .status-bar {
            display: flex; align-items: center; justify-content: space-between;
            padding: 10px 28px;
            background: #f8fafc;
            border-bottom: 1px solid #e2e8f0;
            flex-shrink: 0;
        }
        .status-pill {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 4px 12px; border-radius: 999px;
            font-size: 10px; font-weight: 700;
            text-transform: uppercase; letter-spacing: .5px;
            border: 1px solid;
        }
        .status-dot { width: 7px; height: 7px; border-radius: 50%; }

        .pill-paid      { background:#dcfce7; color:#15803d; border-color:#bbf7d0; }
        .dot-paid       { background:#16a34a; }
        .pill-pending   { background:#fef9c3; color:#a16207; border-color:#fde68a; }
        .dot-pending    { background:#ca8a04; }
        .pill-confirmed { background:#dbeafe; color:#1d4ed8; border-color:#bfdbfe; }
        .dot-confirmed  { background:#2563eb; }
        .pill-cancelled { background:#fee2e2; color:#dc2626; border-color:#fecaca; }
        .dot-cancelled  { background:#ef4444; }
        .pill-expired   { background:#f1f5f9; color:#64748b; border-color:#cbd5e1; }
        .dot-expired    { background:#94a3b8; }
        .print-date { color: #94a3b8; font-size: 11px; }

        /* ════════════════════════
           BODY — 2 KOLOM
        ════════════════════════ */
        .body {
            flex: 1;
            display: grid;
            grid-template-columns: 1fr 1px 1fr;
            padding: 24px 28px;
            gap: 0;
            overflow: hidden;
            min-height: 0;
        }

        /* Garis putus-putus vertikal */
        .col-sep {
            background: repeating-linear-gradient(
                to bottom,
                #cbd5e1 0, #cbd5e1 6px,
                transparent 6px, transparent 13px
            );
            margin: 0 20px;
        }

        .col {
            display: flex;
            flex-direction: column;
            gap: 20px;
            overflow: hidden;
        }

        /* ── Section label ── */
        .section-label {
            font-size: 9px; font-weight: 700;
            text-transform: uppercase; letter-spacing: .8px;
            color: #94a3b8;
            padding-bottom: 6px;
            border-bottom: 1.5px solid #f1f5f9;
            margin-bottom: 10px;
        }

        /* ── Penyewa ── */
        .penyewa-row { display: flex; align-items: center; gap: 12px; }
        .avatar {
            width: 44px; height: 44px; border-radius: 50%;
            background: linear-gradient(135deg, #6366f1, #3b82f6);
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 19px; font-weight: 800; flex-shrink: 0;
        }
        .penyewa-name { font-size: 14px; font-weight: 700; color: #1e293b; }
        .penyewa-sub  { font-size: 11px; color: #94a3b8; margin-top: 2px; }

        /* ── Info grid ── */
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 8px; }
        .info-item { background: #f8fafc; border-radius: 8px; padding: 10px 12px; }
        .info-item.full { grid-column: 1/-1; }
        .info-label {
            font-size: 9px; font-weight: 600; text-transform: uppercase;
            letter-spacing: .5px; color: #94a3b8; margin-bottom: 3px;
        }
        .info-value { font-size: 12px; font-weight: 700; color: #1e293b; }

        /* ── Biaya ── */
        .price-row {
            display: flex; justify-content: space-between;
            align-items: center; padding: 6px 0;
        }
        .price-label { font-size: 12px; color: #64748b; }
        .price-value { font-size: 12px; font-weight: 600; color: #334155; }
        .price-value.discount { color: #ef4444; }
        .price-subtotal-row {
            display: flex; justify-content: space-between;
            align-items: center; padding: 7px 0;
            border-top: 1.5px dashed #e2e8f0; margin-top: 4px;
        }

        /* Layanan */
        .layanan-title { font-size: 10px; font-weight: 600; color: #94a3b8; margin: 8px 0 4px; }
        .layanan-row {
            display: flex; justify-content: space-between;
            padding: 3px 0; font-size: 11px; color: #64748b;
        }

        /* Total */
        .total-box {
            display: flex; align-items: center; justify-content: space-between;
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            border-radius: 10px; padding: 14px 16px; margin-top: 10px;
        }
        .total-label { font-size: 12px; font-weight: 700; color: rgba(255,255,255,.8); }
        .total-value { font-size: 18px; font-weight: 800; color: #fff; }

        /* ════════════════════════
           FOOTER
        ════════════════════════ */
        .footer {
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            padding: 14px 28px;
            text-align: center;
            flex-shrink: 0;
        }
        .footer-thanks { font-size: 12px; font-weight: 700; color: #334155; }
        .footer-sub    { font-size: 10px; color: #94a3b8; margin-top: 2px; }

        /* ── Print button (screen only) ── */
        .print-btn {
            display: inline-flex; align-items: center; gap: 8px;
            margin-top: 20px; padding: 12px 30px;
            background: #1d4ed8; color: #fff; border: none;
            border-radius: 10px; font-size: 14px; font-weight: 700;
            cursor: pointer; box-shadow: 0 4px 14px rgba(29,78,216,.3);
            font-family: 'Inter', sans-serif;
        }
        .print-btn:hover { background: #1e40af; }

        /* ════════════════════════
           PRINT
        ════════════════════════ */
        @media print {
            @page {
                size: A4 portrait;
                margin: 0;
            }
            body {
                background: #fff;
                padding: 0; margin: 0;
                display: block;
            }
            .struk {
                box-shadow: none;
                border-radius: 0;
                width: 210mm;
                height: 297mm;
            }
            .print-btn { display: none; }
        }
    </style>
</head>
<body>

@php
    $statusKey = $booking->status;
    $statusText = [
        'paid'      => 'Lunas',
        'pending'   => 'Menunggu',
        'confirmed' => 'Dikonfirmasi',
        'cancelled' => 'Dibatalkan',
        'expired'   => 'Selesai',
    ][$statusKey] ?? ucfirst($statusKey);
@endphp

<div class="struk">

    {{-- ── HEADER ── --}}
    <div class="header">
        <div class="hc1"></div>
        <div class="hc2"></div>
        <div class="header-inner">
            <div>
                <div class="brand-name">KosKu</div>
                <div class="brand-tagline">Sistem Manajemen Kos</div>
            </div>
            <div class="header-right">
                <div class="receipt-badge">Struk Booking</div>
                <div class="booking-no">No: <span>#{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</span></div>
            </div>
        </div>
    </div>

    {{-- ── STATUS BAR ── --}}
    <div class="status-bar">
        <span class="status-pill pill-{{ $statusKey }}">
            <span class="status-dot dot-{{ $statusKey }}"></span>
            {{ $statusText }}
        </span>
        <span class="print-date">Dicetak: {{ now()->format('d M Y, H:i') }}</span>
    </div>

    {{-- ── BODY 2 KOLOM ── --}}
    <div class="body">

        {{-- KOLOM KIRI --}}
        <div class="col">

            {{-- Identitas Penyewa --}}
            <div>
                <div class="section-label">Identitas Penyewa</div>
                <div class="penyewa-row">
                    <div class="avatar">{{ strtoupper(substr($booking->nama_penyewa, 0, 1)) }}</div>
                    <div>
                        <div class="penyewa-name">{{ $booking->nama_penyewa }}</div>
                        <div class="penyewa-sub">{{ $booking->email }}</div>
                        <div class="penyewa-sub">{{ $booking->phone }}</div>
                        @if($booking->alamat)
                            <div class="penyewa-sub">{{ $booking->alamat }}</div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Detail Booking --}}
            <div>
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

        </div>

        {{-- PEMISAH VERTIKAL --}}
        <div class="col-sep"></div>

        {{-- KOLOM KANAN --}}
        <div class="col">

            {{-- Rincian Biaya --}}
            <div>
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

                @if($booking->layanans->count())
                    <div class="layanan-title">Layanan Tambahan</div>
                    @foreach($booking->layanans as $i => $layanan)
                        <div class="layanan-row">
                            <span>{{ $i+1 }}. {{ $layanan->nama_layanan }}</span>
                            <span>Rp {{ number_format($layanan->harga, 0, ',', '.') }}</span>
                        </div>
                    @endforeach
                @endif

                <div class="price-row">
                    <span class="price-label">Total Layanan</span>
                    <span class="price-value">Rp {{ number_format($booking->layanans->sum('harga'), 0, ',', '.') }}</span>
                </div>

                <div class="total-box">
                    <span class="total-label">Total Bayar</span>
                    <span class="total-value">Rp {{ number_format($booking->total_bayar, 0, ',', '.') }}</span>
                </div>
            </div>

            {{-- Info Pembayaran --}}
            <div>
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
    </div>

    {{-- ── FOOTER ── --}}
    <div class="footer">
        <div class="footer-thanks">Terima kasih telah mempercayai KosKu!</div>
        <div class="footer-sub">Simpan struk ini sebagai bukti pembayaran yang sah.</div>
    </div>

</div>

</body>
</html>