@extends('admin.layouts.app')

@section('page-title', 'Data Booking')

@section('content')

    {{-- SUCCESS MESSAGE --}}
    @if (session('success'))
        <div
            class="mb-5 flex items-center gap-3 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm font-medium">
            <i class="fa-solid fa-circle-check text-green-500"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- PAGE HEADER + SEARCH --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

        {{-- LEFT: Title --}}
        <div>
            <h1 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                <i class="fa-solid fa-calendar-check text-blue-500"></i>
                Data Booking
            </h1>
            <p class="text-sm text-slate-400 mt-0.5">
                Kelola semua transaksi pemesanan kamar
            </p>
        </div>

        {{-- RIGHT: Search --}}
        <form method="GET" action="{{ route('admin.booking.index') }}" class="relative w-full sm:w-auto">

            {{-- keep status filter --}}
            @if (request('status'))
                <input type="hidden" name="status" value="{{ request('status') }}">
            @endif

            <div class="relative">

                {{-- icon search --}}
                <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari kode, penyewa, kamar..."
                    class="w-full sm:w-64 lg:w-72
                          pl-10 pr-10 py-2.5
                          text-sm font-medium
                          border border-slate-200
                          rounded-xl
                          bg-white
                          shadow-sm
                          focus:outline-none
                          focus:ring-2 focus:ring-blue-500
                          focus:border-blue-500
                          transition">

                {{-- clear button --}}
                @if (request('search'))
                    <a href="{{ route('admin.booking.index') }}"
                        class="absolute right-3 top-1/2 -translate-y-1/2
                          text-slate-400 hover:text-red-500 transition">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                @endif

            </div>

        </form>

    </div>

    {{-- TABLE CARD --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">

        {{-- Toolbar --}}
        <div
            class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 px-5 py-3.5 border-b border-slate-100">
            <span class="text-sm font-semibold text-slate-600">
                Semua Booking
                <span class="ml-2 text-xs font-bold bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full">
                    {{ $items->total() }}
                </span>
            </span>

            <div class="flex items-center gap-3">




            </div>

            {{-- Status filter pills --}}
            <div class="hidden sm:flex items-center gap-1.5">
                @foreach (['all' => 'Semua', 'pending' => 'Pending', 'paid' => 'Paid', 'confirmed' => 'Confirmed', 'cancelled' => 'Cancelled'] as $val => $label)
                    <a href="{{ $val === 'all' ? route('admin.booking.index') : route('admin.booking.index', ['status' => $val]) }}"
                        class="px-2.5 py-1 text-xs font-semibold rounded-md transition-colors
                              {{ request('status', 'all') === $val
                                  ? 'bg-blue-600 text-white'
                                  : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">
                        <th class="px-4 py-3">Kode</th>
                        <th class="px-4 py-3">Penyewa</th>
                        <th class="px-4 py-3">Kamar</th>
                        <th class="px-4 py-3">Durasi</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse ($items as $booking)
                        <tr class="hover:bg-slate-50/60 transition-colors">

                            {{-- Kode --}}
                            <td class="px-4 py-4">
                                <span class="text-xs font-mono font-bold text-slate-500 bg-slate-100 px-2 py-1 rounded-md">
                                    #{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>

                            {{-- Penyewa --}}
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-2.5">
                                    <div
                                        class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-400 to-blue-500 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                        {{ strtoupper(substr($booking->nama_penyewa, 0, 1)) }}
                                    </div>
                                    <div class="min-w-0">
                                        <p class="font-semibold text-slate-700 text-xs truncate">
                                            {{ $booking->nama_penyewa }}</p>
                                        <p class="text-[11px] text-slate-400 truncate">{{ $booking->email }}</p>
                                        <p class="text-[11px] text-slate-400">{{ $booking->phone }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Kamar --}}
                            <td class="px-4 py-4">
                                <div class="flex items-start gap-2">

                                    {{-- ICON --}}
                                    <div
                                        class="w-6 h-6 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                                        <i class="fa-solid fa-door-open text-blue-400 text-[9px]"></i>
                                    </div>

                                    {{-- TEXT --}}
                                    <div class="flex flex-col">

                                        {{-- Nama kamar --}}
                                        <span class="text-xs font-semibold text-slate-700">
                                            {{ $booking->kamar->nama_kamar ?? '-' }}
                                        </span>

                                        {{-- Nama kos (baru ditambahkan) --}}
                                        <span class="text-[11px] text-slate-400">
                                            {{ $booking->kamar->kos->nama_kos ?? '-' }}
                                        </span>

                                    </div>

                                </div>
                            </td>

                            {{-- Durasi --}}
                            <td class="px-4 py-4">
                                <p class="text-xs font-semibold text-slate-700">
                                    {{ $booking->durasi }} bulan
                                </p>
                                <p class="text-[11px] text-slate-400 mt-0.5">
                                    {{ \Carbon\Carbon::parse($booking->tanggal_mulai)->format('d M Y') }}
                                </p>
                                <p class="text-[11px] text-slate-400">
                                    {{ \Carbon\Carbon::parse($booking->tanggal_selesai)->format('d M Y') }}
                                </p>
                            </td>

                            {{-- Total --}}
                            <td class="px-4 py-4">
                                <p class="text-xs font-bold text-slate-800">
                                    Rp {{ number_format($booking->total_bayar, 0, ',', '.') }}
                                </p>
                            </td>

                            {{-- Status Badge --}}
                            <td class="px-4 py-4 text-center">
                                @php
                                    $statusStyle = match ($booking->status) {
                                        'confirmed' => 'bg-green-50 text-green-600 border-green-100 dot-green',
                                        'paid' => 'bg-blue-50 text-blue-600 border-blue-100 dot-blue',
                                        'pending' => 'bg-amber-50 text-amber-600 border-amber-100 dot-amber',
                                        'cancelled' => 'bg-red-50 text-red-500 border-red-100 dot-red',
                                        'expired' => 'bg-slate-100 text-slate-500 border-slate-200 dot-slate',
                                        default => 'bg-slate-100 text-slate-500 border-slate-200 dot-slate',
                                    };
                                    $dotColor = match ($booking->status) {
                                        'confirmed' => 'bg-green-500',
                                        'paid' => 'bg-blue-500',
                                        'pending' => 'bg-amber-400',
                                        'cancelled' => 'bg-red-400',
                                        default => 'bg-slate-400',
                                    };
                                @endphp
                                <span
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold border {{ $statusStyle }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $dotColor }}"></span>
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>

                            {{-- Tanggal --}}
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-1.5 text-xs text-slate-400">
                                    <i class="fa-regular fa-calendar text-[10px]"></i>
                                    {{ $booking->created_at->format('d M Y') }}
                                </div>
                            </td>

                            {{-- Aksi --}}
                            <td class="px-4 py-4">
                                <div class="flex items-center justify-center gap-2">

                                    {{-- Detail --}}
                                    <a href="{{ route('admin.booking.show', $booking) }}" title="Detail"
                                        class="w-7 h-7 flex items-center justify-center rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-500 transition-colors border border-blue-100">
                                        <i class="fa-solid fa-eye text-[11px]"></i>
                                    </a>

                                    {{-- Update Status --}}
                                    <form method="POST" action="{{ route('admin.booking.updateStatus', $booking) }}">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()"
                                            class="text-xs border border-slate-200 rounded-lg px-2 py-1.5 bg-slate-50 text-slate-600 focus:outline-none focus:ring-2 focus:ring-blue-400 cursor-pointer transition">
                                            @foreach (['draft', 'pending', 'paid', 'confirmed', 'cancelled', 'expired'] as $status)
                                                <option value="{{ $status }}"
                                                    {{ $booking->status == $status ? 'selected' : '' }}>
                                                    {{ ucfirst($status) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </form>

                                    {{-- Hapus --}}
                                    <form method="POST" action="{{ route('admin.booking.destroy', $booking) }}"
                                        onsubmit="return confirm('Yakin ingin menghapus booking ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus"
                                            class="w-7 h-7 flex items-center justify-center rounded-lg bg-red-50 hover:bg-red-100 text-red-500 transition-colors border border-red-100">
                                            <i class="fa-solid fa-trash text-[11px]"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-5 py-16 text-center">
                                <div class="flex flex-col items-center gap-3 text-slate-300">
                                    <i class="fa-solid fa-calendar-xmark text-4xl"></i>
                                    <p class="text-sm font-medium text-slate-400">Belum ada data booking</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

       {{-- Pagination --}}
         
        @if ($items->hasPages())
            <div class="px-5 py-4 border-t border-slate-100">
                {{ $items->links() }}
            </div>
        @endif

    </div>

@endsection
