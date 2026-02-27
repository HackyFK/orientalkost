@extends('admin.layouts.app')

@section('page-title', 'Data Keuangan')

@section('content')

    {{-- SUCCESS MESSAGE --}}
    @if (session('success'))
        <div
            class="mb-5 flex items-center gap-3 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm font-medium">
            <i class="fa-solid fa-circle-check text-green-500"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- PAGE HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-bold text-slate-800">Data Keuangan</h1>
            <p class="text-sm text-slate-400 mt-0.5">Riwayat pemasukan dan pengeluaran</p>
        </div>
        <div class="flex items-center gap-2">
            {{-- Export Excel --}}
            <a href="{{ route('admin.keuangan.export', request()->only('bulan', 'tahun')) }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-green-50 hover:bg-green-100 text-green-600 text-sm font-semibold rounded-lg border border-green-100 transition-colors">
                <i class="fa-solid fa-file-excel text-xs"></i>
                Export Semua
            </a>
            {{-- Tambah Pengeluaran --}}
            <a href="{{ route('admin.keuangan.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm shadow-red-200">
                <i class="fa-solid fa-minus text-xs"></i>
                Tambah Pengeluaran
            </a>
        </div>
    </div>

    {{-- FILTER BAR --}}
    <form method="GET" action="{{ route('admin.keuangan.index') }}"
        class="bg-white rounded-xl border border-slate-200 shadow-sm px-5 py-4 mb-5 flex flex-wrap items-end gap-4">

        {{-- Bulan --}}
        <div class="flex-1 min-w-[140px]">
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Bulan</label>
            <select name="bulan"
                class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                <option value="">Semua Bulan</option>
                @foreach ([1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April', 5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus', 9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'] as $num => $nama)
                    <option value="{{ $num }}" @selected(request('bulan') == $num)>{{ $nama }}</option>
                @endforeach
            </select>
        </div>

        {{-- Tahun --}}
        <div class="flex-1 min-w-[120px]">
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Tahun</label>
            <select name="tahun"
                class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                @foreach (range(now()->year, now()->year - 4) as $y)
                    <option value="{{ $y }}" @selected(request('tahun', now()->year) == $y)>{{ $y }}</option>
                @endforeach
            </select>
        </div>

        {{-- Kategori --}}
        <div class="flex-1 min-w-[140px]">
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Kategori</label>
            <select name="kategori"
                class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                <option value="">Semua</option>
                <option value="pemasukan" @selected(request('kategori') == 'pemasukan')>Pemasukan</option>
                <option value="pengeluaran" @selected(request('kategori') == 'pengeluaran')>Pengeluaran</option>
            </select>
        </div>

        {{-- Tombol --}}
        <div class="flex gap-2">
            <button type="submit"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm shadow-blue-200">
                <i class="fa-solid fa-filter text-xs"></i>
                Filter
            </button>
            @if (request()->hasAny(['bulan', 'tahun', 'kategori']))
                <a href="{{ route('admin.keuangan.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2.5 border border-slate-200 text-slate-600 hover:bg-slate-100 text-sm font-semibold rounded-lg transition-colors">
                    <i class="fa-solid fa-xmark text-xs"></i>
                    Reset
                </a>
            @endif
        </div>

        {{-- Label filter aktif --}}
        @if (request()->hasAny(['bulan', 'tahun', 'kategori']))
            <div class="w-full flex items-center gap-1.5 flex-wrap pt-1">
                <span class="text-[11px] text-slate-400">Filter aktif:</span>
                @if (request('bulan'))
                    <span
                        class="text-[11px] font-semibold bg-blue-50 text-blue-500 border border-blue-100 px-2 py-0.5 rounded-md">
                        {{ [1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mei', 6 => 'Jun', 7 => 'Jul', 8 => 'Agu', 9 => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des'][request('bulan')] }}
                    </span>
                @endif
                @if (request('tahun'))
                    <span
                        class="text-[11px] font-semibold bg-blue-50 text-blue-500 border border-blue-100 px-2 py-0.5 rounded-md">{{ request('tahun') }}</span>
                @endif
                @if (request('kategori'))
                    <span
                        class="text-[11px] font-semibold bg-blue-50 text-blue-500 border border-blue-100 px-2 py-0.5 rounded-md">{{ ucfirst(request('kategori')) }}</span>
                @endif
            </div>
        @endif

    </form>

    {{-- SUMMARY CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-5">

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 flex items-center gap-4">
            <div
                class="w-11 h-11 rounded-xl bg-blue-600 flex items-center justify-center flex-shrink-0 shadow-sm shadow-blue-200">
                <i class="fa-solid fa-wallet text-white text-base"></i>
            </div>
            <div class="min-w-0">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Saldo</p>
                <p class="text-lg font-bold text-blue-600 truncate">
                    Rp {{ number_format($data->first()?->saldo ?? 0, 0, ',', '.') }}
                </p>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 flex items-center gap-4">
            <div
                class="w-11 h-11 rounded-xl bg-green-500 flex items-center justify-center flex-shrink-0 shadow-sm shadow-green-200">
                <i class="fa-solid fa-arrow-trend-up text-white text-base"></i>
            </div>
            <div class="min-w-0">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Pemasukan</p>
                <p class="text-lg font-bold text-green-600 truncate">
                    Rp {{ number_format($data->sum('pemasukan'), 0, ',', '.') }}
                </p>
                @if (request()->hasAny(['bulan', 'tahun']))
                    <p class="text-[10px] text-slate-400">periode terpilih</p>
                @endif
            </div>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 flex items-center gap-4">
            <div
                class="w-11 h-11 rounded-xl bg-red-500 flex items-center justify-center flex-shrink-0 shadow-sm shadow-red-200">
                <i class="fa-solid fa-arrow-trend-down text-white text-base"></i>
            </div>
            <div class="min-w-0">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Pengeluaran</p>
                <p class="text-lg font-bold text-red-500 truncate">
                    Rp {{ number_format($data->sum('pengeluaran'), 0, ',', '.') }}
                </p>
                @if (request()->hasAny(['bulan', 'tahun']))
                    <p class="text-[10px] text-slate-400">periode terpilih</p>
                @endif
            </div>
        </div>

    </div>

    {{-- TABLE CARD --}}
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">

        {{-- Toolbar --}}
        <div class="flex items-center justify-between px-5 py-3.5 border-b border-slate-100">
            <span class="text-sm font-semibold text-slate-600">
                {{ request()->hasAny(['bulan', 'tahun']) ? 'Transaksi (Terfilter)' : 'Semua Transaksi' }}
                <span class="ml-2 text-xs font-bold bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full">
                    {{ $data->total() }}
                </span>
            </span>
            {{-- Quick export inline --}}
            <a href="{{ route('admin.keuangan.export', request()->only('bulan', 'tahun', 'kategori')) }}"
                class="inline-flex items-center gap-2 px-3 py-1.5 bg-green-50 hover:bg-green-100 text-green-600 text-xs font-semibold rounded-lg border border-green-100 transition-colors">
                <i class="fa-solid fa-file-excel text-[10px]"></i>
                Export {{ request()->hasAny(['bulan', 'tahun']) ? 'Periode Ini' : 'Semua Data' }}
                @if (!request()->hasAny(['bulan', 'tahun']))
                    <span class="hidden sm:inline text-[10px] font-normal text-green-400">· gunakan filter untuk
                        memisah</span>
                @endif
            </a>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Reference</th>
                        <th class="px-4 py-3">Admin</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Metode</th>
                        <th class="px-4 py-3">Keterangan</th>
                        <th class="px-4 py-3 text-right">Pemasukan</th>
                        <th class="px-4 py-3 text-right">Pengeluaran</th>
                        <th class="px-4 py-3 text-right">Saldo</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse ($data as $item)
                        <tr class="hover:bg-slate-50/60 transition-colors">

                            <td class="px-4 py-3.5">
                                <p class="text-xs font-semibold text-slate-700">{{ $item->created_at->format('d M Y') }}
                                </p>
                                <p class="text-[11px] text-slate-400">{{ $item->created_at->format('H:i') }}</p>
                            </td>

                            <td class="px-4 py-3.5">
                                <span class="text-xs font-mono bg-slate-100 text-slate-500 px-2 py-1 rounded-md">
                                    {{ $item->reference }}
                                </span>
                            </td>

                            <td class="px-4 py-3.5">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-6 h-6 rounded-full bg-gradient-to-br from-indigo-400 to-blue-500 flex items-center justify-center text-white text-[9px] font-bold flex-shrink-0">
                                        {{ strtoupper(substr($item->admin->name ?? '?', 0, 1)) }}
                                    </div>
                                    <span class="text-xs font-medium text-slate-700">{{ $item->admin->name ?? '-' }}</span>
                                </div>
                            </td>

                            <td class="px-4 py-3.5">
                                @if ($item->kategori == 'pemasukan')
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-green-50 text-green-600 border border-green-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                        Pemasukan
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-red-50 text-red-500 border border-red-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>
                                        Pengeluaran
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-3.5">
                                <div class="flex items-center gap-1.5">
                                    <i class="fa-solid fa-wallet text-slate-300 text-[10px]"></i>
                                    <span class="text-xs text-slate-600">{{ $item->payment_method ?? '-' }}</span>
                                </div>
                            </td>

                            <td class="px-4 py-3.5">
                                <p class="text-xs text-slate-500 max-w-[160px] truncate" title="{{ $item->keterangan }}">
                                    {{ $item->keterangan ?: '—' }}
                                </p>
                            </td>

                            <td class="px-4 py-3.5 text-right">
                                @if ($item->pemasukan > 0)
                                    <span class="text-xs font-bold text-green-600">
                                        + Rp {{ number_format($item->pemasukan, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span class="text-xs text-slate-300">—</span>
                                @endif
                            </td>

                            <td class="px-4 py-3.5 text-right">
                                @if ($item->pengeluaran > 0)
                                    <span class="text-xs font-bold text-red-500">
                                        - Rp {{ number_format($item->pengeluaran, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span class="text-xs text-slate-300">—</span>
                                @endif
                            </td>

                            <td class="px-4 py-3.5 text-right">
                                <span class="text-xs font-bold text-blue-600">
                                    Rp {{ number_format($item->saldo, 0, ',', '.') }}
                                </span>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-5 py-16 text-center">
                                <div class="flex flex-col items-center gap-3 text-slate-300">
                                    <i class="fa-solid fa-wallet text-4xl"></i>
                                    <p class="text-sm font-medium text-slate-400">Belum ada data keuangan</p>
                                    @if (request()->hasAny(['bulan', 'tahun', 'kategori']))
                                        <a href="{{ route('admin.keuangan.index') }}"
                                            class="text-xs text-blue-500 hover:underline font-semibold">
                                            Reset filter
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>



        {{-- Footer --}}
        @if ($data->hasPages() || $data->total() > 0)
            <div
                class="px-5 py-4 border-t   border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-3">
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

    <div class="mt-4">
        {{ $data->links() }} {{-- pagination --}}
    </div>
@endsection
