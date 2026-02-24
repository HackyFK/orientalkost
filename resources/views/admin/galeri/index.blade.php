@extends('admin.layouts.app')

@section('page-title', 'Galeri')

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
            <h1 class="text-xl font-bold text-slate-800">Galeri</h1>
            <p class="text-sm text-slate-400 mt-0.5">Kelola koleksi foto dan album galeri</p>
        </div>
        <a href="{{ route('admin.galeri.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm shadow-blue-200">
            <i class="fa-solid fa-plus text-xs"></i>
            Tambah Galeri
        </a>
    </div>

    {{-- TABLE CARD --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">

        {{-- Toolbar --}}
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 px-5 py-3.5 border-b border-slate-100">
            <span class="text-sm font-semibold text-slate-600">
                Semua Galeri
                <span class="ml-2 text-xs font-bold bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full">
                    {{ $galeris->total() }}
                </span>
            </span>
            <form method="GET">
                <div class="relative">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-300 text-xs"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari judul galeri..."
                        class="pl-8 pr-4 py-2 text-sm border border-slate-200 rounded-lg bg-slate-50 text-slate-600 placeholder-slate-300 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent w-56 transition">
                </div>
            </form>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">
                        <th class="px-4 py-3 w-10">#</th>
                        <th class="px-4 py-3">Galeri</th>
                        <th class="px-4 py-3">Slug</th>
                        <th class="px-4 py-3">Deskripsi</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse ($galeris as $galeri)
                        <tr class="hover:bg-slate-50/60 transition-colors">

                            {{-- No --}}
                            <td class="px-4 py-3.5 text-xs text-slate-400 font-medium">
                                {{ $galeris->firstItem() + $loop->index }}
                            </td>

                            {{-- Galeri (thumb + judul) --}}
                            <td class="px-4 py-3.5">
                                <div class="flex items-center gap-3">
                                    @if ($galeri->gambar)
                                        <img src="{{ asset('storage/' . $galeri->gambar) }}"
                                            class="w-16 h-12 object-cover rounded-lg border border-slate-100 shadow-sm flex-shrink-0">
                                    @else
                                        <div class="w-16 h-12 rounded-lg bg-slate-100 flex items-center justify-center flex-shrink-0">
                                            <i class="fa-regular fa-image text-slate-300 text-base"></i>
                                        </div>
                                    @endif
                                    <p class="font-semibold text-slate-800">{{ $galeri->judul }}</p>
                                </div>
                            </td>

                            {{-- Slug --}}
                            <td class="px-4 py-3.5">
                                <span class="text-xs font-mono text-slate-400 bg-slate-100 px-2 py-1 rounded-md">
                                    {{ $galeri->slug }}
                                </span>
                            </td>

                            {{-- Deskripsi --}}
                            <td class="px-4 py-3.5 text-slate-500 max-w-[240px]">
                                <p class="text-xs leading-relaxed line-clamp-2">{{ $galeri->deskripsi_singkat }}</p>
                            </td>

                            {{-- Aksi --}}
                            <td class="px-4 py-3.5">
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="{{ route('admin.galeri.show', $galeri) }}"
                                        title="Detail"
                                        class="w-7 h-7 flex items-center justify-center rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-500 transition-colors border border-blue-100">
                                        <i class="fa-solid fa-eye text-[11px]"></i>
                                    </a>
                                    <a href="{{ route('admin.galeri.edit', $galeri) }}"
                                        title="Edit"
                                        class="w-7 h-7 flex items-center justify-center rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-500 transition-colors border border-amber-100">
                                        <i class="fa-solid fa-pen text-[11px]"></i>
                                    </a>
                                    <form action="{{ route('admin.galeri.destroy', $galeri) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus galeri ini?')">
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
                            <td colspan="5" class="px-5 py-16 text-center">
                                <div class="flex flex-col items-center gap-3 text-slate-300">
                                    <i class="fa-solid fa-images text-4xl"></i>
                                    <p class="text-sm font-medium text-slate-400">Belum ada galeri</p>
                                    <a href="{{ route('admin.galeri.create') }}"
                                       class="mt-1 text-xs text-blue-500 hover:underline font-semibold">
                                        + Tambah galeri pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
         
        @if ($galeris->hasPages())
            <div class="px-5 py-4 border-t border-slate-100">
                {{ $galeris->links() }}
            </div>
        @endif

    </div>

@endsection