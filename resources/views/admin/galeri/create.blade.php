@extends('admin.layouts.app')

@section('page-title', 'Tambah Galeri')

@section('content')

{{-- Page Header --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-xl font-bold text-slate-800">Tambah Galeri</h1>
        <p class="text-sm text-slate-400 mt-0.5">Isi form berikut untuk menambah galeri baru</p>
    </div>
    <a href="{{ route('admin.galeri.index') }}"
       class="inline-flex items-center gap-2 px-4 py-2.5 bg-white hover:bg-slate-50 text-slate-600 text-sm font-semibold rounded-lg border border-slate-200 transition-colors">
        <i class="fa-solid fa-arrow-left text-xs"></i>
        Kembali
    </a>
</div>

{{-- Form Layout --}}
<div class="grid xl:grid-cols-3 gap-6">

    {{-- Konten Utama (2/3) --}}
    <div class="xl:col-span-2 space-y-5">

        {{-- Card: Informasi Galeri --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm">
            <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                    <i class="fa-solid fa-image text-blue-500 text-xs"></i>
                </div>
                <h2 class="font-bold text-slate-700 text-sm">Informasi Galeri</h2>
            </div>

            <form id="form-galeri"
                  action="{{ route('admin.galeri.store') }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf

                <div class="p-5 space-y-5">

                    {{-- Judul --}}
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Judul Galeri</label>
                        <input type="text" name="judul"
                            value="{{ old('judul') }}"
                            class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition"
                            required>
                        @error('judul')
                            <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Slug --}}
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Slug <span class="normal-case font-normal">(opsional)</span></label>
                        <input type="text" name="slug"
                            value="{{ old('slug') }}"
                            class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                        <p class="text-[11px] text-slate-400 mt-1.5">Dikosongkan untuk generate otomatis dari judul.</p>
                        @error('slug')
                            <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Deskripsi Singkat --}}
                    <div>
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Deskripsi Singkat</label>
                        <textarea name="deskripsi_singkat" rows="4"
                            class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition resize-none"
                            required>{{ old('deskripsi_singkat') }}</textarea>
                        @error('deskripsi_singkat')
                            <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>
            </form>
        </div>

    </div>

    {{-- Sidebar (1/3) --}}
    <div class="space-y-5">

        {{-- Card: Upload Gambar --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm">
            <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-purple-50 flex items-center justify-center">
                    <i class="fa-solid fa-cloud-arrow-up text-purple-500 text-xs"></i>
                </div>
                <h2 class="font-bold text-slate-700 text-sm">Upload Gambar</h2>
            </div>
            <div class="p-5">
                <label class="flex flex-col items-center justify-center gap-2 border-2 border-dashed border-slate-200 hover:border-blue-300 rounded-xl px-4 py-6 cursor-pointer transition-colors group">
                    <i class="fa-solid fa-cloud-arrow-up text-2xl text-slate-300 group-hover:text-blue-400 transition-colors"></i>
                    <span class="text-xs font-medium text-slate-400 group-hover:text-blue-500">Klik untuk upload gambar</span>
                    <span class="text-[10px] text-slate-300">JPG, PNG, WEBP – maks 2MB</span>
                    <input type="file" name="gambar" form="form-galeri" class="hidden" accept="image/*">
                </label>
                @error('gambar')
                    <p class="text-xs text-red-500 mt-2 flex items-center gap-1">
                        <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                    </p>
                @enderror
            </div>
        </div>

        {{-- Card: Aksi --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm">
            <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-amber-50 flex items-center justify-center">
                    <i class="fa-solid fa-gear text-amber-500 text-xs"></i>
                </div>
                <h2 class="font-bold text-slate-700 text-sm">Aksi</h2>
            </div>
            <div class="p-5 flex flex-col gap-2.5">
                <button type="submit" form="form-galeri"
                    class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm shadow-blue-200">
                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                    Simpan Galeri
                </button>
                <a href="{{ route('admin.galeri.index') }}"
                   class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-white hover:bg-slate-50 text-slate-600 text-sm font-semibold rounded-lg border border-slate-200 transition-colors">
                    
                    Batal
                </a>
            </div>
        </div>

    </div>
</div>

@endsection