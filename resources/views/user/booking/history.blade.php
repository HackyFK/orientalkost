@extends('user.layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 py-10 min-h-[80vh]">

    {{-- ── Page Header ── --}}
    <div class="flex items-center justify-between mb-7 pt-6 mt-10">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-800">History Booking</h1>
            <p class="text-sm text-slate-400 mt-1">Riwayat seluruh pemesanan kos yang pernah kamu lakukan.</p>
        </div>

        {{-- Filter Status --}}
        <form method="GET">
            <div class="relative">
                <i class="fa-solid fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-slate-300 text-[10px] pointer-events-none"></i>
                <select name="status" onchange="this.form.submit()"
                    class="appearance-none pl-4 pr-8 py-2.5 text-sm border border-slate-200 rounded-xl bg-white text-slate-600 font-medium focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-sm cursor-pointer">
                    <option value="">Semua Status</option>
                    @foreach (['pending', 'paid', 'confirmed', 'cancelled', 'expired'] as $status)
                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>

    {{-- ── Stats Bar ── --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6">
        @php
            $statuses = [
                ['label' => 'Total Booking', 'value' => $bookings->total(), 'color' => 'bg-slate-100 text-slate-600', 'icon' => 'fa-list text-slate-400'],
                ['label' => 'Aktif',         'value' => $bookings->getCollection()->where('status', 'confirmed')->count(), 'color' => 'bg-green-50 text-green-600',  'icon' => 'fa-circle-check text-green-400'],
                ['label' => 'Menunggu',      'value' => $bookings->getCollection()->where('status', 'pending')->count(),   'color' => 'bg-amber-50 text-amber-600',  'icon' => 'fa-hourglass-half text-amber-400'],
                ['label' => 'Dibatalkan',    'value' => $bookings->getCollection()->where('status', 'cancelled')->count(), 'color' => 'bg-red-50 text-red-500',      'icon' => 'fa-circle-xmark text-red-400'],
            ];
        @endphp
        @foreach ($statuses as $stat)
            <div class="bg-white rounded-2xl border border-slate-100 shadow-sm px-5 py-4 flex items-center gap-3">
                <div class="w-9 h-9 rounded-xl {{ $stat['color'] }} flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid {{ $stat['icon'] }} text-sm"></i>
                </div>
                <div>
                    <p class="text-xl font-extrabold text-slate-800">{{ $stat['value'] }}</p>
                    <p class="text-xs text-slate-400">{{ $stat['label'] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    {{-- ── Table Card ── --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">

        {{-- Card Header --}}
        <div class="flex items-center gap-3 px-6 py-4 border-b border-slate-100">
            <div class="w-8 h-8 rounded-xl bg-blue-50 flex items-center justify-center">
                <i class="fa-solid fa-calendar-check text-blue-400 text-xs"></i>
            </div>
            <span class="text-sm font-bold text-slate-700">Semua Booking</span>
            <span class="text-xs font-bold bg-slate-100 text-slate-500 px-2.5 py-1 rounded-full">
                {{ $bookings->total() }}
            </span>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 text-left text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                        <th class="px-6 py-3.5">Tanggal</th>
                        <th class="px-6 py-3.5">Kos & Kamar</th>
                        <th class="px-6 py-3.5 text-center">Durasi</th>
                        <th class="px-6 py-3.5 text-right">Total</th>
                        <th class="px-6 py-3.5 text-center">Status</th>
                        <th class="px-6 py-3.5 text-center">Metode</th>
                        <th class="px-6 py-3.5 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-50">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-slate-50/70 transition-colors group">

                            {{-- Tanggal --}}
                            <td class="px-6 py-4">
                                <p class="text-sm font-semibold text-slate-700">{{ $booking->created_at->format('d M Y') }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">{{ $booking->created_at->format('H:i') }} WIB</p>
                            </td>

                            {{-- Kos & Kamar (merged) --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-house text-blue-400 text-[10px]"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800 text-sm">{{ $booking->kamar->kos->nama_kos ?? '-' }}</p>
                                        <p class="text-xs text-slate-400 mt-0.5">{{ $booking->kamar->nama_kamar ?? '-' }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Durasi --}}
                            <td class="px-6 py-4 text-center">
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-slate-100 text-slate-600 text-xs font-semibold rounded-lg">
                                    <i class="fa-regular fa-clock text-slate-400 text-[10px]"></i>
                                    {{ $booking->durasi }} bln
                                </span>
                            </td>

                            {{-- Total --}}
                            <td class="px-6 py-4 text-right">
                                <p class="text-sm font-extrabold text-slate-800">
                                    Rp {{ number_format($booking->total_bayar, 0, ',', '.') }}
                                </p>
                            </td>

                            {{-- Status --}}
                            <td class="px-6 py-4 text-center">
                                @php
                                    $statusStyle = match($booking->status) {
                                        'paid'      => 'bg-green-50 text-green-600 border-green-100',
                                        'pending'   => 'bg-amber-50 text-amber-600 border-amber-100',
                                        'confirmed' => 'bg-blue-50 text-blue-600 border-blue-100',
                                        'cancelled',
                                        'expired'   => 'bg-red-50 text-red-500 border-red-100',
                                        default     => 'bg-slate-100 text-slate-500 border-slate-200',
                                    };
                                    $statusDot = match($booking->status) {
                                        'paid'      => 'bg-green-400',
                                        'pending'   => 'bg-amber-400',
                                        'confirmed' => 'bg-blue-400',
                                        'cancelled',
                                        'expired'   => 'bg-red-400',
                                        default     => 'bg-slate-400',
                                    };
                                @endphp
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-semibold border {{ $statusStyle }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $statusDot }}"></span>
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>

                            {{-- Metode --}}
                            <td class="px-6 py-4 text-center">
                                <span class="text-xs text-slate-500 font-medium">
                                    {{ $booking->payment_method ?? '-' }}
                                </span>
                            </td>

                            {{-- Aksi --}}
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('user.booking.struk', $booking) }}" target="_blank"
                                        title="Cetak Struk"
                                        class="w-8 h-8 inline-flex items-center justify-center bg-slate-100 hover:bg-blue-50 text-slate-400 hover:text-blue-500 rounded-lg border border-slate-200 hover:border-blue-100 transition-colors">
                                        <i class="fa-solid fa-print text-xs"></i>
                                    </a>
                                    <a href="{{ route('user.booking.show', $booking->id) }}"
                                        title="Lihat Detail"
                                        class="w-8 h-8 inline-flex items-center justify-center bg-blue-50 hover:bg-blue-100 text-blue-500 rounded-lg border border-blue-100 transition-colors">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-20 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center">
                                        <i class="fa-solid fa-calendar-xmark text-slate-300 text-2xl"></i>
                                    </div>
                                    <p class="text-sm font-semibold text-slate-400">Belum ada history booking</p>
                                    <p class="text-xs text-slate-300">Booking pertamamu akan muncul di sini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($bookings->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $bookings->withQueryString()->links() }}
            </div>
        @endif

    </div>

</div>

@endsection