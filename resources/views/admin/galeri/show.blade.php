@extends('admin.layouts.app')

@section('page-title', 'Detail Galeri')

@section('content')

    {{-- BREADCRUMB --}}
    <div class="flex items-center gap-2 text-xs text-slate-400 mb-5">
        <a href="{{ route('admin.galeri.index') }}" class="hover:text-blue-500 transition-colors">Galeri</a>
        <i class="fa-solid fa-chevron-right text-[9px]"></i>
        <span class="text-slate-600 font-medium">{{ $galeri->judul }}</span>
    </div>

    {{-- PAGE HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-bold text-slate-800">{{ $galeri->judul }}</h1>
            <p class="text-sm text-slate-400 mt-0.5">Detail informasi galeri</p>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.galeri.edit', $galeri) }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-amber-50 hover:bg-amber-100 text-amber-600 text-sm font-semibold rounded-lg border border-amber-100 transition-colors">
                <i class="fa-solid fa-pen text-xs"></i>
                Edit
            </a>
            <form action="{{ route('admin.galeri.destroy', $galeri) }}" method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus galeri ini?')">
                @csrf @method('DELETE')
                <button type="submit"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-red-50 hover:bg-red-100 text-red-500 text-sm font-semibold rounded-lg border border-red-100 transition-colors">
                    <i class="fa-solid fa-trash text-xs"></i>
                    Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">

        {{-- ═══════════════ LEFT (2/3) ═══════════════ --}}
        <div class="xl:col-span-2 space-y-5">

            {{-- Card: Informasi --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-purple-50 flex items-center justify-center">
                        <i class="fa-solid fa-images text-purple-500 text-xs"></i>
                    </div>
                    <h2 class="font-bold text-slate-700 text-sm">Informasi Galeri</h2>
                </div>
                <div class="divide-y divide-slate-50">

                    {{-- Judul --}}
                    <div class="flex items-start gap-4 px-5 py-4">
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider w-28 flex-shrink-0 mt-0.5">Judul</span>
                        <span class="text-sm font-semibold text-slate-800">{{ $galeri->judul }}</span>
                    </div>

                    {{-- Slug --}}
                    <div class="flex items-start gap-4 px-5 py-4">
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider w-28 flex-shrink-0 mt-0.5">Slug</span>
                        <span class="text-xs font-mono bg-slate-100 text-slate-500 px-2 py-1 rounded-md">/{{ $galeri->slug }}</span>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="flex items-start gap-4 px-5 py-4">
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider w-28 flex-shrink-0 mt-0.5">Deskripsi</span>
                        <p class="text-sm text-slate-600 leading-relaxed">
                            {{ $galeri->deskripsi_singkat ?: '—' }}
                        </p>
                    </div>

                    {{-- Jumlah Foto --}}
                    <div class="flex items-start gap-4 px-5 py-4">
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider w-28 flex-shrink-0 mt-0.5">Jumlah Foto</span>
                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold bg-blue-50 text-blue-600 border border-blue-100 px-2.5 py-1 rounded-md">
                            <i class="fa-solid fa-image text-[10px]"></i>
                            {{ $galeri->gambar ? 1 : 0 }} foto
                        </span>
                    </div>

                    {{-- Dibuat --}}
                    <div class="flex items-start gap-4 px-5 py-4">
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider w-28 flex-shrink-0 mt-0.5">Dibuat</span>
                        <span class="text-sm text-slate-500">
                            <i class="fa-regular fa-calendar mr-1.5 text-slate-300"></i>
                            {{ $galeri->created_at->format('d M Y, H:i') }}
                        </span>
                    </div>

                    {{-- Diperbarui --}}
                    <div class="flex items-start gap-4 px-5 py-4">
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider w-28 flex-shrink-0 mt-0.5">Diperbarui</span>
                        <span class="text-sm text-slate-500">
                            <i class="fa-regular fa-clock mr-1.5 text-slate-300"></i>
                            {{ $galeri->updated_at->format('d M Y, H:i') }}
                        </span>
                    </div>

                </div>
            </div>

        </div>

        {{-- ═══════════════ RIGHT (1/3) ═══════════════ --}}
        <div class="space-y-5">

            {{-- Card: Gambar --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                        <i class="fa-solid fa-image text-blue-500 text-xs"></i>
                    </div>
                    <h2 class="font-bold text-slate-700 text-sm">Gambar</h2>
                </div>
                <div class="p-4">
                    @if ($galeri->gambar)
                        <img src="{{ asset('storage/' . $galeri->gambar) }}"
                             alt="{{ $galeri->judul }}"
                             class="w-full rounded-xl border border-slate-100 shadow-sm object-cover">
                    @else
                        <div class="w-full h-36 rounded-xl bg-slate-50 border border-dashed border-slate-200 flex flex-col items-center justify-center gap-2">
                            <i class="fa-regular fa-image text-2xl text-slate-300"></i>
                            <span class="text-xs text-slate-400">Belum ada gambar</span>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Card: Navigasi --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="p-4 space-y-2">
                    <a href="{{ route('admin.galeri.edit', $galeri) }}"
                       class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-amber-50 hover:bg-amber-100 text-amber-600 text-sm font-semibold rounded-lg border border-amber-100 transition-colors">
                        <i class="fa-solid fa-pen text-xs"></i>
                        Edit Galeri
                    </a>
                    <a href="{{ route('admin.galeri.index') }}"
                       class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 border border-slate-200 text-slate-600 hover:bg-slate-100 text-sm font-semibold rounded-lg transition-colors">
                        <i class="fa-solid fa-arrow-left text-xs"></i>
                        Kembali ke Daftar
                    </a>
                </div>
            </div>

        </div>
    </div>

@endsection