@extends('user.layouts.app')

@section('content')

<div class="max-w-7xl mx-auto py-10 min-h-[80vh]">

    {{-- PAGE HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-bold text-slate-800 pt-10">
                History Booking Saya
            </h1>
            <p class="text-sm text-slate-400 mt-0.5">
                Riwayat seluruh pemesanan kos yang pernah Anda lakukan
            </p>
        </div>
    </div>

    {{-- TABLE CARD --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">

        {{-- CARD HEADER --}}
        <div class="flex items-center justify-between px-5 py-3.5 border-b border-slate-100">

            <span class="text-sm font-semibold text-slate-600">
                Semua Booking
                <span
                    class="ml-2 text-xs font-bold bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full">
                    {{ $bookings->total() }}
                </span>
            </span>

            {{-- FILTER STATUS --}}
            <form method="GET">
                <select name="status"
                    onchange="this.form.submit()"
                    class="px-3 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    <option value="">Semua Status</option>
                    @foreach(['draft','pending','paid','confirmed','cancelled','expired'] as $status)
                        <option value="{{ $status }}"
                            {{ request('status') == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </form>

        </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">
                        <th class="px-5 py-3">Tanggal</th>
                        <th class="px-5 py-3">Kos</th>
                        <th class="px-5 py-3">Kamar</th>
                        <th class="px-5 py-3 text-center">Durasi</th>
                        <th class="px-5 py-3 text-right">Total</th>
                        <th class="px-5 py-3 text-center">Status</th>
                        <th class="px-5 py-3 text-center">Metode</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($bookings as $booking)
                        <tr class="hover:bg-slate-50/60 transition-colors">

                            {{-- Tanggal --}}
                            <td class="px-5 py-3.5 text-slate-600">
                                {{ $booking->created_at->format('d M Y') }}
                            </td>

                            {{-- Kos --}}
                            <td class="px-5 py-3.5 font-semibold text-slate-800">
                                {{ $booking->kamar->kos->nama_kos ?? '-' }}
                            </td>

                            {{-- Kamar --}}
                            <td class="px-5 py-3.5 text-slate-600">
                                {{ $booking->kamar->nama_kamar ?? '-' }}
                            </td>

                            {{-- Durasi --}}
                            <td class="px-5 py-3.5 text-center text-slate-600">
                                {{ $booking->durasi }} bln
                            </td>

                            {{-- Total --}}
                            <td class="px-5 py-3.5 text-right font-semibold text-slate-800">
                                Rp {{ number_format($booking->total_bayar, 0, ',', '.') }}
                            </td>

                            {{-- Status --}}
                            <td class="px-5 py-3.5 text-center">
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold
                                    @if($booking->status === 'paid')
                                        bg-green-50 text-green-600 border border-green-100
                                    @elseif($booking->status === 'pending')
                                        bg-yellow-50 text-yellow-600 border border-yellow-100
                                    @elseif($booking->status === 'confirmed')
                                        bg-blue-50 text-blue-600 border border-blue-100
                                    @elseif($booking->status === 'cancelled' || $booking->status === 'expired')
                                        bg-red-50 text-red-600 border border-red-100
                                    @else
                                        bg-slate-100 text-slate-600 border border-slate-200
                                    @endif">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>

                            {{-- Payment Method --}}
                            <td class="px-5 py-3.5 text-center text-slate-600">
                                {{ $booking->payment_method ?? '-' }}
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-16 text-center">
                                <div class="flex flex-col items-center gap-3 text-slate-300">
                                    <i class="fa-solid fa-calendar-xmark text-4xl"></i>
                                    <p class="text-sm font-medium text-slate-400">
                                        Belum ada history booking
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        @if ($bookings->hasPages())
            <div class="px-5 py-4 border-t border-slate-100">
                {{ $bookings->withQueryString()->links() }}
            </div>
        @endif

    </div>

</div>

@endsection
