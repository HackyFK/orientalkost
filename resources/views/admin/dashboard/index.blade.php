@extends('admin.layouts.app')

@section('page-title', 'Dashboard')

@section('content')

    {{-- PAGE HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-bold text-slate-800">Dashboard</h1>
            <p class="text-sm text-slate-400 mt-0.5">Selamat datang, {{ auth()->user()->name }} 👋</p>
        </div>

        {{-- Filter Bulan & Tahun --}}
        <form method="GET" class="flex items-center gap-2">
            <select name="bulan"
                class="border border-slate-200 rounded-lg px-3 py-2 text-sm text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                <option value="">Semua Bulan</option>
                @foreach (range(1, 12) as $b)
                    <option value="{{ $b }}" @selected($bulan == $b)>
                        {{ DateTime::createFromFormat('!m', $b)->format('F') }}
                    </option>
                @endforeach
            </select>

            <select name="tahun"
                class="border border-slate-200 rounded-lg px-3 py-2 text-sm text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                @foreach (range(date('Y'), date('Y') - 5) as $t)
                    <option value="{{ $t }}" @selected($tahun == $t)>{{ $t }}</option>
                @endforeach
            </select>

            <button type="submit"
                class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm shadow-blue-200">
                <i class="fa-solid fa-filter text-xs"></i>
                Filter Pemasukan
            </button>

            @if ($bulan || $tahun != date('Y'))
                <a href="{{ request()->url() }}"
                    class="inline-flex items-center gap-1.5 px-3 py-2 border border-slate-200 text-slate-500 hover:bg-slate-100 text-sm font-semibold rounded-lg transition-colors">
                    <i class="fa-solid fa-xmark text-xs"></i>
                    Reset
                </a>
            @endif
        </form>
    </div>

    {{-- ── STAT CARDS ROW 1: Properti & Booking ── --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4 mb-5">

        {{-- Total Kos --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <div class="flex items-center justify-between mb-3">
                <div class="w-9 h-9 rounded-xl bg-blue-600 flex items-center justify-center shadow-sm shadow-blue-200">
                    <i class="fa-solid fa-house text-white text-sm"></i>
                </div>
                <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Total</span>
            </div>
            <p class="text-2xl font-bold text-slate-800">{{ $totalKos }}</p>
            <p class="text-xs text-slate-400 mt-0.5">Kos Aktif</p>
        </div>

        {{-- Total Kamar --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <div class="flex items-center justify-between mb-3">
                <div class="w-9 h-9 rounded-xl bg-indigo-500 flex items-center justify-center shadow-sm shadow-indigo-200">
                    <i class="fa-solid fa-door-open text-white text-sm"></i>
                </div>
                <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Total</span>
            </div>
            <p class="text-2xl font-bold text-slate-800">{{ $totalKamar }}</p>
            <p class="text-xs text-slate-400 mt-0.5">Total Kamar</p>
        </div>

        {{-- Kamar Terisi --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <div class="flex items-center justify-between mb-3">
                <div class="w-9 h-9 rounded-xl bg-amber-500 flex items-center justify-center shadow-sm shadow-amber-200">
                    <i class="fa-solid fa-bed text-white text-sm"></i>
                </div>
                @php $pctTerisi = $totalKamar > 0 ? round($kamarTerisi / $totalKamar * 100) : 0; @endphp
                <span
                    class="text-[10px] font-semibold {{ $pctTerisi >= 80 ? 'text-red-400' : 'text-slate-400' }} uppercase tracking-wider">
                    {{ $pctTerisi }}%
                </span>
            </div>
            <p class="text-2xl font-bold text-slate-800">{{ $kamarTerisi }}</p>
            <p class="text-xs text-slate-400 mt-0.5">Kamar Terisi</p>
            {{-- Progress bar --}}
            <div class="mt-2.5 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                <div class="h-full rounded-full {{ $pctTerisi >= 80 ? 'bg-amber-400' : 'bg-green-400' }} transition-all"
                    style="width: {{ $pctTerisi }}%"></div>
            </div>
        </div>

        {{-- Total Booking --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <div class="flex items-center justify-between mb-3">
                <div class="w-9 h-9 rounded-xl bg-green-500 flex items-center justify-center shadow-sm shadow-green-200">
                    <i class="fa-solid fa-calendar-check text-white text-sm"></i>
                </div>
                <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Booking</span>
            </div>
            <p class="text-2xl font-bold text-slate-800">{{ $totalBooking }}</p>
            <p class="text-xs text-slate-400 mt-0.5">Total Booking</p>
        </div>

        {{-- Review Approve --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5">
            <div class="flex items-center justify-between mb-3">
                <div class="w-9 h-9 rounded-xl bg-yellow-400 flex items-center justify-center shadow-sm shadow-yellow-200">
                    <i class="fa-solid fa-star text-white text-sm"></i>
                </div>
                <span class="text-[10px] font-semibold text-slate-400 uppercase tracking-wider">Review</span>
            </div>
            <p class="text-2xl font-bold text-slate-800">{{ $reviewApprove }}</p>
            <p class="text-xs text-slate-400 mt-0.5">Review Disetujui</p>
        </div>

    </div>

    {{-- ── KEUANGAN ROW ── --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-5">

        {{-- Total Pemasukan --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 flex items-center gap-4">
            <div
                class="w-12 h-12 rounded-xl bg-green-500 flex items-center justify-center flex-shrink-0 shadow-sm shadow-green-200">
                <i class="fa-solid fa-arrow-trend-up text-white text-base"></i>
            </div>
            <div class="min-w-0">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Pemasukan</p>
                <p class="text-lg font-bold text-green-600 truncate mt-0.5">
                    Rp {{ number_format($totalPemasukan, 0, ',', '.') }}
                </p>
                <p class="text-[11px] text-slate-400">
                    {{ $bulan ? DateTime::createFromFormat('!m', $bulan)->format('F') : 'Semua Bulan' }}
                    {{ $tahun ?? date('Y') }}
                </p>
            </div>
        </div>

        {{-- Pemasukan Bulan Ini --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 flex items-center gap-4">
            <div
                class="w-12 h-12 rounded-xl bg-blue-500 flex items-center justify-center flex-shrink-0 shadow-sm shadow-blue-200">
                <i class="fa-solid fa-calendar-day text-white text-base"></i>
            </div>
            <div class="min-w-0">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Bulan Ini</p>
                <p class="text-lg font-bold text-blue-600 truncate mt-0.5">
                    Rp {{ number_format($pemasukanBulanIni, 0, ',', '.') }}
                </p>
                <p class="text-[11px] text-slate-400">{{ now()->format('F Y') }}</p>
            </div>
        </div>

        {{-- Pemasukan Tahun Ini --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 flex items-center gap-4">
            <div
                class="w-12 h-12 rounded-xl bg-purple-500 flex items-center justify-center flex-shrink-0 shadow-sm shadow-purple-200">
                <i class="fa-solid fa-calendar text-white text-base"></i>
            </div>
            <div class="min-w-0">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Tahun Ini</p>
                <p class="text-lg font-bold text-purple-600 truncate mt-0.5">
                    Rp {{ number_format($pemasukanTahunIni, 0, ',', '.') }}
                </p>
                <p class="text-[11px] text-slate-400">{{ now()->format('Y') }}</p>
            </div>
        </div>

    </div>

    {{-- ── CHART ── --}}
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
            <div class="flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                    <i class="fa-solid fa-chart-bar text-blue-500 text-xs"></i>
                </div>
                <h2 class="font-bold text-slate-700 text-sm">Grafik Pemasukan</h2>
            </div>
            <span class="text-xs font-semibold text-slate-400">
                {{ $bulan ? DateTime::createFromFormat('!m', $bulan)->format('F') . ' ' . $tahun : 'Tahun ' . $tahun }}
            </span>
        </div>
        <div class="p-5">
            <canvas id="chart" height="80"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartData = @json($chart);
        const namaBulan = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        new Chart(document.getElementById('chart'), {
            type: 'bar',
            data: {
                labels: chartData.map(d => namaBulan[d.bulan] ?? 'Bln ' + d.bulan),
                datasets: [{
                    label: 'Pemasukan',
                    data: chartData.map(d => d.total),
                    backgroundColor: 'rgba(59, 130, 246, 0.15)',
                    borderColor: 'rgba(59, 130, 246, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: ctx => ' Rp ' + ctx.raw.toLocaleString('id-ID')
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        border: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            },
                            color: '#94a3b8'
                        }
                    },
                    y: {
                        border: {
                            display: false,
                            dash: [4, 4]
                        },
                        grid: {
                            color: '#f1f5f9'
                        },
                        ticks: {
                            font: {
                                size: 11
                            },
                            color: '#94a3b8',
                            callback: val => 'Rp ' + (val >= 1000000 ?
                                (val / 1000000).toFixed(1) + 'jt' :
                                val.toLocaleString('id-ID'))
                        }
                    }
                }
            }
        });
    </script>

@endsection
