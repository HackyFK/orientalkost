@extends('admin.layouts.app')

@section('page-title', 'Laporan Keuangan')

@section('content')

    {{-- BREADCRUMB --}}
    <div class="flex items-center gap-2 text-xs text-slate-400 mb-5">
        <a href="{{ route('admin.keuangan.index') }}" class="hover:text-blue-500 transition-colors">Data Keuangan</a>
        <i class="fa-solid fa-chevron-right text-[9px]"></i>
        <span class="text-slate-600 font-medium">Laporan</span>
    </div>

    {{-- PAGE HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-bold text-slate-800">Laporan Keuangan</h1>
            <p class="text-sm text-slate-400 mt-0.5">
                Ringkasan keuangan
                @if(request('bulan') && request('tahun'))
                    periode {{ [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'][request('bulan')] }} {{ request('tahun') }}
                @elseif(request('tahun'))
                    tahun {{ request('tahun') }}
                @else
                    semua periode
                @endif
            </p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.keuangan.export', request()->only('bulan', 'tahun')) }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-green-50 hover:bg-green-100 text-green-600 text-sm font-semibold rounded-lg border border-green-100 transition-colors">
                <i class="fa-solid fa-file-excel text-xs"></i>
                Export Excel
            </a>
            <a href="{{ route('admin.keuangan.index', request()->only('bulan', 'tahun')) }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 border border-slate-200 text-slate-600 hover:bg-slate-100 text-sm font-semibold rounded-lg transition-colors">
                <i class="fa-solid fa-arrow-left text-xs"></i>
                Kembali
            </a>
        </div>
    </div>

    {{-- FILTER BAR --}}
    <form method="GET" action="{{ route('admin.keuangan.laporan') }}"
          class="bg-white rounded-xl border border-slate-200 shadow-sm px-5 py-4 mb-5 flex flex-wrap items-end gap-4">
        <div class="flex-1 min-w-[140px]">
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Bulan</label>
            <select name="bulan" class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                <option value="">Semua Bulan</option>
                @foreach([1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'] as $num => $nama)
                    <option value="{{ $num }}" @selected(request('bulan') == $num)>{{ $nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex-1 min-w-[120px]">
            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Tahun</label>
            <select name="tahun" class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                @foreach(range(now()->year, now()->year - 4) as $y)
                    <option value="{{ $y }}" @selected(request('tahun', now()->year) == $y)>{{ $y }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm shadow-blue-200">
                <i class="fa-solid fa-filter text-xs"></i>
                Tampilkan
            </button>
        </div>
    </form>

    {{-- SUMMARY CARDS --}}
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-5">

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <div class="w-9 h-9 rounded-xl bg-blue-600 flex items-center justify-center mb-3 shadow-sm shadow-blue-200">
                <i class="fa-solid fa-wallet text-white text-sm"></i>
            </div>
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Saldo Akhir</p>
            <p class="text-base font-bold text-blue-600 mt-0.5">Rp {{ number_format($saldoAkhir ?? 0, 0, ',', '.') }}</p>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <div class="w-9 h-9 rounded-xl bg-green-500 flex items-center justify-center mb-3 shadow-sm shadow-green-200">
                <i class="fa-solid fa-arrow-trend-up text-white text-sm"></i>
            </div>
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Pemasukan</p>
            <p class="text-base font-bold text-green-600 mt-0.5">Rp {{ number_format($totalPemasukan ?? 0, 0, ',', '.') }}</p>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <div class="w-9 h-9 rounded-xl bg-red-500 flex items-center justify-center mb-3 shadow-sm shadow-red-200">
                <i class="fa-solid fa-arrow-trend-down text-white text-sm"></i>
            </div>
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Pengeluaran</p>
            <p class="text-base font-bold text-red-500 mt-0.5">Rp {{ number_format($totalPengeluaran ?? 0, 0, ',', '.') }}</p>
        </div>

        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <div class="w-9 h-9 rounded-xl bg-amber-500 flex items-center justify-center mb-3 shadow-sm shadow-amber-200">
                <i class="fa-solid fa-receipt text-white text-sm"></i>
            </div>
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Jumlah Transaksi</p>
            <p class="text-base font-bold text-amber-600 mt-0.5">{{ $totalTransaksi ?? 0 }} transaksi</p>
        </div>

    </div>

    {{-- REKAP PER BULAN --}}
    @isset($rekapBulanan)
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden mb-5">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
            <div class="w-7 h-7 rounded-lg bg-indigo-50 flex items-center justify-center">
                <i class="fa-solid fa-chart-bar text-indigo-500 text-xs"></i>
            </div>
            <h2 class="font-bold text-slate-700 text-sm">Rekap Per Bulan — {{ request('tahun', now()->year) }}</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 text-xs font-bold text-slate-400 uppercase tracking-wider text-left">
                        <th class="px-5 py-3">Bulan</th>
                        <th class="px-5 py-3 text-right">Pemasukan</th>
                        <th class="px-5 py-3 text-right">Pengeluaran</th>
                        <th class="px-5 py-3 text-right">Selisih</th>
                        <th class="px-5 py-3 text-right">Transaksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($rekapBulanan as $rekap)
                        @php $selisih = $rekap->total_pemasukan - $rekap->total_pengeluaran; @endphp
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="px-5 py-3.5 text-sm font-semibold text-slate-700">
                                {{ [1=>'Januari',2=>'Februari',3=>'Maret',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Agustus',9=>'September',10=>'Oktober',11=>'November',12=>'Desember'][$rekap->bulan] }}
                            </td>
                            <td class="px-5 py-3.5 text-right">
                                <span class="text-xs font-bold text-green-600">
                                    Rp {{ number_format($rekap->total_pemasukan, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5 text-right">
                                <span class="text-xs font-bold text-red-500">
                                    Rp {{ number_format($rekap->total_pengeluaran, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5 text-right">
                                <span class="text-xs font-bold {{ $selisih >= 0 ? 'text-blue-600' : 'text-red-500' }}">
                                    {{ $selisih >= 0 ? '+' : '' }}Rp {{ number_format($selisih, 0, ',', '.') }}
                                </span>
                            </td>
                            <td class="px-5 py-3.5 text-right">
                                <span class="text-xs font-semibold text-slate-500">{{ $rekap->jumlah }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endisset

    {{-- TABEL TRANSAKSI --}}
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-5 py-3.5 border-b border-slate-100 flex items-center justify-between">
            <span class="text-sm font-semibold text-slate-600">
                Detail Transaksi
                <span class="ml-2 text-xs font-bold bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full">
                    {{ $data->total() }}
                </span>
            </span>
            <a href="{{ route('admin.keuangan.export', request()->only('bulan', 'tahun')) }}"
               class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-green-50 hover:bg-green-100 text-green-600 text-xs font-semibold rounded-lg border border-green-100 transition-colors">
                <i class="fa-solid fa-file-excel text-[10px]"></i>
                Export Excel
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">
                        <th class="px-4 py-3">Tanggal</th>
                        <th class="px-4 py-3">Reference</th>
                        <th class="px-4 py-3">Kategori</th>
                        <th class="px-4 py-3">Keterangan</th>
                        <th class="px-4 py-3 text-right">Pemasukan</th>
                        <th class="px-4 py-3 text-right">Pengeluaran</th>
                        <th class="px-4 py-3 text-right">Saldo</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($data as $item)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <td class="px-4 py-3.5">
                                <p class="text-xs font-semibold text-slate-700">{{ $item->created_at->format('d M Y') }}</p>
                                <p class="text-[11px] text-slate-400">{{ $item->created_at->format('H:i') }}</p>
                            </td>
                            <td class="px-4 py-3.5">
                                <span class="text-xs font-mono bg-slate-100 text-slate-500 px-2 py-1 rounded-md">{{ $item->reference }}</span>
                            </td>
                            <td class="px-4 py-3.5">
                                @if ($item->kategori == 'pemasukan')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-green-50 text-green-600 border border-green-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Pemasukan
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-red-50 text-red-500 border border-red-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span> Pengeluaran
                                    </span>
                                @endif
                            </td>
                            <td class="px-4 py-3.5">
                                <p class="text-xs text-slate-500 max-w-[180px] truncate">{{ $item->keterangan ?: '—' }}</p>
                            </td>
                            <td class="px-4 py-3.5 text-right">
                                @if($item->pemasukan > 0)
                                    <span class="text-xs font-bold text-green-600">+ Rp {{ number_format($item->pemasukan, 0, ',', '.') }}</span>
                                @else
                                    <span class="text-xs text-slate-300">—</span>
                                @endif
                            </td>
                            <td class="px-4 py-3.5 text-right">
                                @if($item->pengeluaran > 0)
                                    <span class="text-xs font-bold text-red-500">- Rp {{ number_format($item->pengeluaran, 0, ',', '.') }}</span>
                                @else
                                    <span class="text-xs text-slate-300">—</span>
                                @endif
                            </td>
                            <td class="px-4 py-3.5 text-right">
                                <span class="text-xs font-bold text-blue-600">Rp {{ number_format($item->saldo, 0, ',', '.') }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-16 text-center">
                                <div class="flex flex-col items-center gap-3">
                                    <i class="fa-solid fa-chart-bar text-4xl text-slate-300"></i>
                                    <p class="text-sm font-medium text-slate-400">Tidak ada transaksi pada periode ini</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($data->hasPages())
            <div class="px-5 py-4 border-t border-slate-100 flex items-center justify-between gap-3">
                <p class="text-xs text-slate-400">
                    Menampilkan <span class="font-semibold text-slate-600">{{ $data->firstItem() }}–{{ $data->lastItem() }}</span>
                    dari <span class="font-semibold text-slate-600">{{ $data->total() }}</span> transaksi
                </p>
                {{ $data->withQueryString()->links() }}
            </div>
        @endif
    </div>

@endsection