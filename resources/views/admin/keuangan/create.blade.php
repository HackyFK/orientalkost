@extends('admin.layouts.app')

@section('page-title', 'Tambah Pengeluaran')

@section('content')

    {{-- BREADCRUMB --}}
    <div class="flex items-center gap-2 text-xs text-slate-400 mb-5">
        <a href="{{ route('admin.keuangan.index') }}" class="hover:text-blue-500 transition-colors">Data Keuangan</a>
        <i class="fa-solid fa-chevron-right text-[9px]"></i>
        <span class="text-slate-600 font-medium">Tambah Pengeluaran</span>
    </div>

    {{-- VALIDATION ERRORS --}}
    @if ($errors->any())
        <div class="mb-5 p-4 bg-red-50 border border-red-200 rounded-lg">
            <div class="flex items-center gap-2 mb-2">
                <i class="fa-solid fa-circle-exclamation text-red-500 text-sm"></i>
                <p class="text-sm font-semibold text-red-600">Terdapat kesalahan input:</p>
            </div>
            <ul class="list-disc pl-5 space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li class="text-xs text-red-500">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.keuangan.store') }}">
        @csrf

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- ═══════════════ LEFT — Form ═══════════════ --}}
            <div class="xl:col-span-2 space-y-5">

                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-red-50 flex items-center justify-center">
                            <i class="fa-solid fa-arrow-trend-down text-red-500 text-xs"></i>
                        </div>
                        <h2 class="font-bold text-slate-700 text-sm">Detail Pengeluaran</h2>
                    </div>
                    <div class="p-5 space-y-4">

                        {{-- Diinput Oleh --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
                                Diinput Oleh
                            </label>
                            <div class="flex items-center gap-3 px-3 py-2.5 bg-slate-50 border border-slate-200 rounded-lg">
                                <div class="w-7 h-7 rounded-full bg-gradient-to-br from-indigo-400 to-blue-500 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                                <span class="text-sm font-semibold text-slate-700">{{ auth()->user()->name }}</span>
                                <span class="ml-auto text-[10px] font-semibold bg-slate-200 text-slate-500 px-2 py-0.5 rounded-md">Admin</span>
                            </div>
                            <input type="hidden" name="user_name" value="{{ auth()->user()->name }}">
                        </div>

                        {{-- Jumlah Pengeluaran --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
                                Jumlah Pengeluaran
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-bold text-slate-400">Rp</span>
                                <input type="number" name="pengeluaran" value="{{ old('pengeluaran') }}"
                                    placeholder="0"
                                    min="1"
                                    required
                                    class="w-full border border-slate-200 rounded-lg pl-9 pr-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition @error('pengeluaran') border-red-300 bg-red-50 @enderror">
                            </div>
                            @error('pengeluaran')
                                <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Keterangan --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
                                Keterangan
                            </label>
                            <input type="text" name="keterangan" value="{{ old('keterangan') }}"
                                placeholder="Contoh: Bayar listrik, beli ATK, dll..."
                                required
                                class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition @error('keterangan') border-red-300 bg-red-50 @enderror">
                            @error('keterangan')
                                <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>
                </div>

            </div>

            {{-- ═══════════════ RIGHT — Sidebar ═══════════════ --}}
            <div class="space-y-5">

                {{-- Saldo Saat Ini --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                            <i class="fa-solid fa-wallet text-blue-500 text-xs"></i>
                        </div>
                        <h2 class="font-bold text-slate-700 text-sm">Saldo Saat Ini</h2>
                    </div>
                    <div class="p-5">
                        @php $saldoSekarang = \App\Models\Keuangan::latest()->value('saldo') ?? 0; @endphp
                        <p class="text-2xl font-bold text-blue-600">
                            Rp {{ number_format($saldoSekarang, 0, ',', '.') }}
                        </p>
                        <p class="text-xs text-slate-400 mt-1.5 flex items-center gap-1">
                            <i class="fa-solid fa-circle-info text-[10px]"></i>
                            Saldo akan berkurang setelah disimpan
                        </p>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex gap-3">
                    <a href="{{ route('admin.keuangan.index') }}"
                       class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 border border-slate-200 text-slate-600 hover:bg-slate-100 text-sm font-semibold rounded-lg transition-colors">
                        <i class="fa-solid fa-xmark text-xs"></i>
                        Batal
                    </a>
                    <button type="submit"
                        class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm shadow-red-200">
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        Simpan
                    </button>
                </div>

            </div>
        </div>
    </form>

@endsection