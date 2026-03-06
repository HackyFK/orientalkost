@extends('admin.layouts.app')

@section('page-title', 'Tambah Layanan')

@section('content')

    {{-- BREADCRUMB --}}
    <div class="flex items-center gap-2 text-xs text-slate-400 mb-5">
        <a href="{{ route('admin.layanan.index') }}" class="hover:text-blue-500 transition-colors">Data Layanan</a>
        <i class="fa-solid fa-chevron-right text-[9px]"></i>
        <span class="text-slate-600 font-medium">Tambah Layanan</span>
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

    <form action="{{ route('admin.layanan.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- ═══════════════ LEFT ═══════════════ --}}
            <div class="xl:col-span-2 space-y-5">

                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                            <i class="fa-solid fa-layer-group text-blue-500 text-xs"></i>
                        </div>
                        <h2 class="font-bold text-slate-700 text-sm">Detail Layanan</h2>
                    </div>
                    <div class="p-5 space-y-4">

                        {{-- Pilih Kos --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
                                Pilih Kos
                            </label>
                            <select name="kos_id"
                                class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition @error('kos_id') border-red-300 bg-red-50 @enderror">
                                <option value="">-- Pilih Kos --</option>
                                @foreach ($kos as $k)
                                    <option value="{{ $k->id }}" @selected(old('kos_id') == $k->id)>
                                        {{ $k->nama_kos }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kos_id')
                                <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Nama Layanan --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
                                Nama Layanan
                            </label>
                            <input type="text" name="nama_layanan"
                                value="{{ old('nama_layanan') }}"
                                placeholder="Contoh: Laundry, Parkir Motor"
                                class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition @error('nama_layanan') border-red-300 bg-red-50 @enderror">
                            @error('nama_layanan')
                                <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
                                Deskripsi <span class="text-slate-300 font-normal normal-case">(opsional)</span>
                            </label>
                            <textarea name="deskripsi" rows="3"
                                placeholder="Deskripsi singkat tentang layanan ini..."
                                class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition resize-none">{{ old('deskripsi') }}</textarea>
                        </div>

                    </div>
                </div>

            </div>

            {{-- ═══════════════ RIGHT ═══════════════ --}}
            <div class="space-y-5">

                {{-- Harga --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-green-50 flex items-center justify-center">
                            <i class="fa-solid fa-tag text-green-500 text-xs"></i>
                        </div>
                        <h2 class="font-bold text-slate-700 text-sm">Harga</h2>
                    </div>
                    <div class="p-5">
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
                            Harga Layanan
                        </label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-bold text-slate-400">Rp</span>
                            <input type="number" name="harga"
                                value="{{ old('harga') }}"
                                placeholder="0"
                                min="0"
                                class="w-full border border-slate-200 rounded-lg pl-9 pr-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition @error('harga') border-red-300 bg-red-50 @enderror">
                        </div>
                        @error('harga')
                            <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex gap-3">
                    <a href="{{ route('admin.layanan.index') }}"
                       class="flex-1 text-center px-4 py-2.5 border border-slate-200 text-slate-600 hover:bg-slate-100 text-sm font-semibold rounded-lg transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm shadow-blue-200">
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        Simpan
                    </button>
                </div>

            </div>
        </div>
    </form>

@endsection