@extends('admin.layouts.app')

@section('page-title', 'Keuangan Owner')

@section('content')

    {{-- PAGE HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-bold text-slate-800">Keuangan Owner</h1>
            <p class="text-sm text-slate-400 mt-0.5">Riwayat pengiriman pendapatan ke owner</p>
        </div>

        <a href="{{ route('admin.keuangan.owner.export', request()->query()) }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-green-50 hover:bg-green-100 text-green-600 text-sm font-semibold rounded-lg border border-green-100 transition-colors">
            <i class="fa-solid fa-file-excel text-xs"></i>
            Export Excel
        </a>
    </div>

    {{-- TABLE CARD --}}
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">

        {{-- Toolbar --}}
        <div class="flex items-center justify-between px-5 py-3.5 border-b border-slate-100">
            <span class="text-sm font-semibold text-slate-600">
                Semua Transaksi
                <span class="ml-2 text-xs font-bold bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full">
                    {{ $data->total() }}
                </span>
            </span>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">
                        <th class="px-4 py-3 text-center w-10">No</th>
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Owner</th>
                        <th class="px-4 py-3">Kos & Kamar</th>
                        <th class="px-2 py-3 text-center">Metode Transfer</th>
                        <th class="px-4 py-3 text-center">Pendapatan Owner</th>
                        <th class="px-4 py-3 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($data as $item)
                        <tr class="hover:bg-slate-50/60 transition-colors">

                            {{-- No --}}
                            <td class="px-4 py-3.5 text-center text-xs text-slate-400">
                                {{ $data->firstItem() + $loop->index }}
                            </td>

                            {{-- Tanggal --}}
                            <td class="px-4 py-3.5">
                                <p class="text-xs font-semibold text-slate-700">{{ $item->created_at->format('d M Y') }}</p>
                                <p class="text-[11px] text-slate-400">{{ $item->created_at->format('H:i') }}</p>
                            </td>

                            {{-- Owner --}}
                            <td class="px-4 py-3.5">
                                <div class="flex items-center gap-2">
                                    <div class="w-7 h-7 rounded-full bg-gradient-to-br from-indigo-400 to-blue-500 flex items-center justify-center text-white text-[10px] font-bold flex-shrink-0">
                                        {{ strtoupper(substr($item->owner->name ?? '?', 0, 1)) }}
                                    </div>
                                    <span class="text-xs font-semibold text-slate-700">{{ $item->owner->name ?? '-' }}</span>
                                </div>
                            </td>

                            {{-- Kos & Kamar --}}
                            <td class="px-4 py-3.5">
                                <p class="text-xs font-semibold text-slate-700">{{ $item->booking->kamar->kos->nama_kos ?? '-' }}</p>
                                <p class="text-[11px] text-slate-400 mt-0.5">
                                    <i class="fa-solid fa-door-open mr-1 text-slate-300"></i>
                                    {{ $item->booking->kamar->nama_kamar ?? '-' }}
                                </p>
                            </td>

                            {{-- Metode Transfer --}}
                            <td class="px-4 py-3.5">
                                <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-blue-50 text-blue-600 border border-blue-100">
                                    <i class="fa-solid fa-building-columns text-[9px]"></i>
                                    {{ $item->metode_transfer ?? 'Transfer Bank' }}
                                </div>
                            </td>

                            {{-- Pendapatan --}}
                            <td class="px-4 py-3.5 text-center">
                                <span class="text-sm font-bold text-green-600 ">
                                    Rp {{ number_format($item->pendapatan_owner, 0, ',', '.') }}
                                </span>
                            </td>

                            {{-- Status --}}
                            <td class="px-4 py-3.5 text-center">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-green-50 text-green-600 border border-green-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                    Terkirim
                                </span>
                                @if ($item->tanggal_kirim)
                                    <p class="text-[10px] text-slate-400 mt-1">
                                        {{ $item->tanggal_kirim->format('d M Y') }}
                                    </p>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-16 text-center">
                                <div class="flex flex-col items-center gap-3 text-slate-300">
                                    <i class="fa-solid fa-money-bill-transfer text-4xl"></i>
                                    <p class="text-sm font-medium text-slate-400">Tidak ada data pendapatan owner</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Footer --}}
        @if ($data->hasPages() || $data->total() > 0)
            <div class="px-5 py-4 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3">
                <p class="text-xs text-slate-400">
                    Menampilkan
                    <span class="font-semibold text-slate-600">{{ $data->firstItem() }}–{{ $data->lastItem() }}</span>
                    dari
                    <span class="font-semibold text-slate-600">{{ $data->total() }}</span>
                    transaksi
                </p>
                {{ $data->withQueryString()->links() }}
            </div>
        @endif

    </div>

@endsection