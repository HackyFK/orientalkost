@extends('admin.layouts.app')

@section('page-title', 'Data Layanan')

@section('content')

    {{-- PAGE HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-bold text-slate-800">Data Layanan</h1>
            <p class="text-sm text-slate-400 mt-0.5">Kelola layanan tambahan untuk setiap kos</p>
        </div>
        <a href="{{ route('admin.layanan.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm shadow-blue-200">
            <i class="fa-solid fa-plus text-xs"></i>
            Tambah Layanan
        </a>
    </div>

    {{-- TABLE CARD --}}
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">

        {{-- Toolbar --}}
        <div class="flex items-center justify-between px-5 py-3.5 border-b border-slate-100">
            <span class="text-sm font-semibold text-slate-600">
                Daftar Layanan
                <span class="ml-2 text-xs font-bold bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full">
                    {{ $layanan->count() }}
                </span>
            </span>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">
                        <th class="px-5 py-3">Kos</th>
                        <th class="px-5 py-3">Nama Layanan</th>
                        <th class="px-5 py-3">Harga</th>
                        <th class="px-5 py-3">Deskripsi</th>
                        <th class="px-5 py-3 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($layanan as $l)
                        <tr class="hover:bg-slate-50/60 transition-colors">

                            {{-- Kos --}}
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-2">
                                    <div class="w-6 h-6 rounded-md bg-blue-50 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-house text-blue-400 text-[9px]"></i>
                                    </div>
                                    <span class="text-xs font-semibold text-slate-700">
                                        {{ $l->kos?->nama_kos ?? '-' }}
                                    </span>
                                </div>
                            </td>

                            {{-- Nama Layanan --}}
                            <td class="px-5 py-3.5">
                                <span class="text-xs font-semibold text-slate-700">{{ $l->nama_layanan }}</span>
                            </td>

                            {{-- Harga --}}
                            <td class="px-5 py-3.5">
                                <span class="text-xs font-bold text-green-600">
                                    Rp {{ number_format($l->harga, 0, ',', '.') }}
                                </span>
                            </td>

                            {{-- Deskripsi --}}
                            <td class="px-5 py-3.5">
                                <p class="text-xs text-slate-500 max-w-[240px] truncate" title="{{ $l->deskripsi }}">
                                    {{ $l->deskripsi ?: '—' }}
                                </p>
                            </td>

                            {{-- Aksi --}}
                            <td class="px-5 py-3.5">
                                <div class="flex items-center justify-end gap-1.5">
                                    <a href="{{ route('admin.layanan.edit', $l->id) }}"
                                       class="w-7 h-7 flex items-center justify-center rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-500 border border-amber-100 transition-colors"
                                       title="Edit">
                                        <i class="fa-solid fa-pen text-[10px]"></i>
                                    </a>

                                    <form action="{{ route('admin.layanan.destroy', $l->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus layanan ini?')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                            class="w-7 h-7 flex items-center justify-center rounded-lg bg-red-50 hover:bg-red-100 text-red-400 border border-red-100 transition-colors"
                                            title="Hapus">
                                            <i class="fa-solid fa-trash text-[10px]"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-16 text-center">
                                <div class="flex flex-col items-center gap-3 text-slate-300">
                                    <i class="fa-solid fa-layer-group text-4xl"></i>
                                    <p class="text-sm font-medium text-slate-400">Belum ada layanan</p>
                                    <a href="{{ route('admin.layanan.create') }}"
                                       class="text-xs text-blue-500 hover:underline font-semibold">
                                        + Tambah layanan pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

@endsection