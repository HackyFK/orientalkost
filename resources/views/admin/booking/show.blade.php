@extends('admin.layouts.app')

@section('page-title', 'Detail Booking')

@section('content')

    {{-- BREADCRUMB --}}
    <div class="flex items-center gap-2 text-xs text-slate-400 mb-5">
        <a href="{{ route('admin.booking.index') }}" class="hover:text-blue-500 transition-colors">Data Booking</a>
        <i class="fa-solid fa-chevron-right text-[9px]"></i>
        <span class="text-slate-600 font-medium">#{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</span>
    </div>

    {{-- PAGE HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-bold text-slate-800">Detail Booking</h1>
            <p class="text-sm text-slate-400 mt-0.5">Informasi lengkap booking dan pembayaran</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.booking.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 border border-slate-200 text-slate-600 hover:bg-slate-100 text-sm font-semibold rounded-lg transition-colors">
                <i class="fa-solid fa-arrow-left text-xs"></i>
                Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">

        {{-- ═══════════════ LEFT (2/3) ═══════════════ --}}
        <div class="xl:col-span-2 space-y-5">

            {{-- ── Section 1: Data Booking ── --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                        <i class="fa-solid fa-calendar-check text-blue-500 text-xs"></i>
                    </div>
                    <h2 class="font-bold text-slate-700 text-sm">Data Booking</h2>
                    <span class="ml-auto text-xs font-mono font-bold text-slate-400">
                        #{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}
                    </span>
                </div>

                <div class="divide-y divide-slate-50">

                    {{-- Penyewa --}}
                    <div class="px-5 py-4">
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Identitas Penyewa</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-400 to-blue-500 flex items-center justify-center text-white text-sm font-bold flex-shrink-0">
                                {{ strtoupper(substr($booking->nama_penyewa, 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-800">{{ $booking->nama_penyewa }}</p>
                                <p class="text-xs text-slate-400">{{ $booking->email }}</p>
                                <p class="text-xs text-slate-400">{{ $booking->phone }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Kamar & Kos --}}
                    <div class="px-5 py-4">
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Detail Kamar</p>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-[11px] text-slate-400 mb-0.5">Kamar</p>
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-5 h-5 rounded-md bg-blue-50 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-door-open text-blue-400 text-[9px]"></i>
                                    </div>
                                    <span
                                        class="text-sm font-semibold text-slate-700">{{ $booking->kamar->nama_kamar ?? '-' }}</span>
                                </div>
                            </div>
                            <div>
                                <p class="text-[11px] text-slate-400 mb-0.5">Kos</p>
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-5 h-5 rounded-md bg-green-50 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-house text-green-400 text-[9px]"></i>
                                    </div>
                                    <span
                                        class="text-sm font-semibold text-slate-700">{{ $booking->kamar->kos->nama_kos ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Durasi & Tanggal --}}
                    <div class="px-5 py-4">
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Periode Sewa</p>
                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <p class="text-[11px] text-slate-400 mb-0.5">Durasi</p>
                                <p class="text-sm font-bold text-slate-700">{{ $booking->durasi }} bulan</p>
                            </div>
                            <div>
                                <p class="text-[11px] text-slate-400 mb-0.5">Mulai</p>
                                <p class="text-sm font-semibold text-slate-700">
                                    {{ \Carbon\Carbon::parse($booking->tanggal_mulai)->format('d M Y') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-[11px] text-slate-400 mb-0.5">Selesai</p>
                                <p class="text-sm font-semibold text-slate-700">
                                    {{ \Carbon\Carbon::parse($booking->tanggal_selesai)->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Total --}}
                    <div class="px-5 py-4 flex items-center justify-between">
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Bayar</span>
                        <span class="text-lg font-bold text-green-600">
                            Rp {{ number_format($booking->subtotal, 0, ',', '.') }}
                        </span>
                    </div>

                </div>
            </div>

            {{-- ── Section 2: Data Payment ── --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-green-50 flex items-center justify-center">
                        <i class="fa-solid fa-credit-card text-green-500 text-xs"></i>
                    </div>
                    <h2 class="font-bold text-slate-700 text-sm">Data Pembayaran</h2>
                    
                </div>

                @if ($booking->payments)
                    <div class="divide-y divide-slate-50">

                        <div class="grid grid-cols-2 divide-x divide-slate-50">
                            <div class="px-5 py-4">
                                <p class="text-[11px] text-slate-400 mb-1">Transaction ID</p>
                                <p class="text-xs font-mono font-semibold text-slate-700">
                                    {{ $booking->payments->booking_id }}</p>
                            </div>
                            <div class="px-5 py-4">
                                <p class="text-[11px] text-slate-400 mb-1">Reference</p>
                                <p class="text-xs font-mono font-semibold text-slate-700">
                                    {{ $booking->payments->reference ?? '-' }}</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 divide-x divide-slate-50">
                            <div class="px-5 py-4">
                                <p class="text-[11px] text-slate-400 mb-1">Metode Pembayaran</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <div class="w-5 h-5 rounded-md bg-indigo-50 flex items-center justify-center">
                                        <i class="fa-solid fa-wallet text-indigo-400 text-[9px]"></i>
                                    </div>
                                    <span
                                        class="text-sm font-semibold text-slate-700">{{ $booking->payments->payment_method ?? '-' }}</span>
                                </div>
                            </div>
                            <div class="px-5 py-4">
                                <p class="text-[11px] text-slate-400 mb-1">Dibayar Pada</p>
                                <div class="flex items-center gap-1.5 mt-1">
                                    <i class="fa-regular fa-clock text-slate-300 text-xs"></i>
                                    <span class="text-sm font-semibold text-slate-700">
                                        {{ $booking->payments->paid_at ? \Carbon\Carbon::parse($booking->payments->paid_at)->format('d M Y, H:i') : '-' }}
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                @else
                    <div class="px-5 py-12 flex flex-col items-center gap-3 text-center">
                        <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center">
                            <i class="fa-solid fa-credit-card text-slate-300 text-lg"></i>
                        </div>
                        <p class="text-sm font-medium text-slate-400">Belum ada data pembayaran</p>
                        <p class="text-xs text-slate-300">Pembayaran akan muncul setelah penyewa melakukan transaksi</p>
                    </div>
                @endif
            </div>

        </div>

        {{-- ═══════════════ RIGHT (1/3) ═══════════════ --}}
        <div class="space-y-5">

            {{-- Status Card --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-amber-50 flex items-center justify-center">
                        <i class="fa-solid fa-circle-dot text-amber-500 text-xs"></i>
                    </div>
                    <h2 class="font-bold text-slate-700 text-sm">Status Booking</h2>
                </div>
                <div class="p-5 space-y-3">
                    @php
                        $currentStatus = $booking->status;

                        $options = [];

                        switch ($currentStatus) {
                            case 'pending':
                                $options = ['paid' => 'Paid', 'cancelled' => 'Cancelled'];
                                break;

                            case 'paid':
                                $options = ['confirmed' => 'Confirmed', 'cancelled' => 'Cancelled'];
                                break;

                            case 'confirmed':
                                $options = ['expired' => 'Selesai'];
                                break;

                            case 'expired':
                            case 'cancelled':
                                $options = [];
                                break;
                        }

                        $statusLabel = [
                            'pending' => 'Pending',
                            'paid' => 'Paid',
                            'confirmed' => 'Confirmed',
                            'expired' => 'Selesai',
                            'cancelled' => 'Cancelled',
                        ];
                    @endphp
                    @php
                        $statusColor = [
                            'pending' => 'bg-yellow-100 text-yellow-700',
                            'paid' => 'bg-blue-100 text-blue-700',
                            'confirmed' => 'bg-green-100 text-green-700',
                            'expired' => 'bg-gray-300 text-gray-700',
                            'cancelled' => 'bg-red-100 text-red-700',
                        ];
                    @endphp

                    @php
                        $statusStyle = match ($booking->status) {
                            'pending' => [
                                'bg' => 'bg-yellow-50 border-yellow-200',
                                'text' => 'text-yellow-600',
                                'icon' => 'fa-hourglass-half text-yellow-500',
                            ],
                            'paid' => [
                                'bg' => 'bg-blue-50 border-blue-200',
                                'text' => 'text-blue-600',
                                'icon' => 'fa-credit-card text-blue-500',
                            ],
                            'confirmed' => [
                                'bg' => 'bg-green-50 border-green-200',
                                'text' => 'text-green-600',
                                'icon' => 'fa-circle-check text-green-500',
                            ],
                            'expired' => [
                                'bg' => 'bg-gray-100 border-gray-300',
                                'text' => 'text-gray-600',
                                'icon' => 'fa-clock text-gray-500',
                            ],
                            'cancelled' => [
                                'bg' => 'bg-red-50 border-red-200',
                                'text' => 'text-red-600',
                                'icon' => 'fa-circle-xmark text-red-500',
                            ],
                            default => [
                                'bg' => 'bg-slate-100 border-slate-200',
                                'text' => 'text-slate-600',
                                'icon' => 'fa-circle text-slate-500',
                            ],
                        };
                    @endphp

                    <div class="flex items-center justify-center gap-3 py-3 rounded-xl border {{ $statusStyle['bg'] }}">
                        <i class="fa-solid {{ $statusStyle['icon'] }} text-base"></i>
                        <span class="text-sm font-bold {{ $statusStyle['text'] }}">
                            {{ $statusLabel[$booking->status] ?? ucfirst($booking->status) }}</span>
                    </div>

                    {{-- Update Status --}}
                    {{-- Update Status --}}
<form action="{{ route('admin.booking.updateStatus', $booking->id) }}" method="POST">
    @csrf

    @if (count($options) > 0)

        <div class="space-y-3">

            {{-- Label status saat ini --}}
            <div class="flex items-center justify-between">
                <span class="text-xs text-slate-400">Status saat ini:</span>
                @php
                    $currentStyle = match($booking->status) {
                        'confirmed' => 'bg-green-50 text-green-600 border-green-100 dot-bg-green-500',
                        'paid'      => 'bg-blue-50 text-blue-600 border-blue-100',
                        'pending'   => 'bg-amber-50 text-amber-600 border-amber-100',
                        'cancelled' => 'bg-red-50 text-red-500 border-red-100',
                        'expired'   => 'bg-slate-100 text-slate-500 border-slate-200',
                        default     => 'bg-slate-100 text-slate-500 border-slate-200',
                    };
                    $currentDot = match($booking->status) {
                        'confirmed' => 'bg-green-500',
                        'paid'      => 'bg-blue-500',
                        'pending'   => 'bg-amber-400',
                        'cancelled' => 'bg-red-400',
                        default     => 'bg-slate-400',
                    };
                @endphp
                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold border {{ $currentStyle }}">
                    <span class="w-1.5 h-1.5 rounded-full {{ $currentDot }}"></span>
                    {{ $statusLabel[$booking->status] }}
                </span>
            </div>

            {{-- Dropdown --}}
            <div class="relative">
                <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-slate-300 text-[10px] pointer-events-none"></i>
                <select name="status"
                    class="w-full appearance-none border border-slate-200 rounded-lg px-3 py-2.5 pr-8 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition cursor-pointer">
                    <option value="" selected disabled>Pilih status baru...</option>
                    @foreach ($options as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Submit --}}
            <button type="submit"
                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm shadow-blue-200">
                <i class="fa-solid fa-rotate text-xs"></i>
                Update Status
            </button>

        </div>

    @else

        {{-- Status final --}}
        <div class="flex items-center gap-3 px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl">
            <div class="w-8 h-8 rounded-lg bg-slate-200 flex items-center justify-center flex-shrink-0">
                <i class="fa-solid fa-lock text-slate-400 text-xs"></i>
            </div>
            <div>
                <p class="text-xs font-semibold text-slate-600">Status sudah final</p>
                <p class="text-[11px] text-slate-400 mt-0.5">Booking ini tidak dapat diubah lagi</p>
            </div>
        </div>

    @endif

</form>
                </div>
            </div>

            {{-- Meta Info --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-slate-100 flex items-center justify-center">
                        <i class="fa-solid fa-circle-info text-slate-400 text-xs"></i>
                    </div>
                    <h2 class="font-bold text-slate-700 text-sm">Info</h2>
                </div>
                <div class="divide-y divide-slate-50">
                    <div class="px-5 py-3.5 flex items-center justify-between">
                        <span class="text-xs text-slate-400">Dibuat</span>
                        <span
                            class="text-xs font-medium text-slate-600">{{ $booking->created_at->format('d M Y') }}</span>
                    </div>
                    <div class="px-5 py-3.5 flex items-center justify-between">
                        <span class="text-xs text-slate-400">Diperbarui</span>
                        <span
                            class="text-xs font-medium text-slate-600">{{ $booking->updated_at->format('d M Y') }}</span>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection
