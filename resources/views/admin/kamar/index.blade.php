@extends('admin.layouts.app')

@section('page-title', 'Data Kamar')

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
            <h1 class="text-xl font-bold text-slate-800">Data Kamar</h1>
            <p class="text-sm text-slate-400 mt-0.5">Kelola seluruh kamar dari setiap kos</p>
        </div>
        <a href="{{ route('admin.kamar.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm shadow-blue-200">
            <i class="fa-solid fa-plus text-xs"></i>
            Tambah Kamar
        </a>
    </div>

    {{-- TABLE CARD --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">

        <div class="flex items-center justify-between px-5 py-3.5 border-b border-slate-100">

            <span class="text-sm font-semibold text-slate-600">
                Semua Kamar
                <span class="ml-2 text-xs font-bold bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full">
                    {{ $items->count() }}
                </span>
            </span>

            <form method="GET" action="{{ route('admin.kamar.index') }}" class="flex items-center gap-3">

                {{-- FILTER KOS --}}
                <select name="kos_id" onchange="this.form.submit()"
                    class="px-4 py-2 border border-slate-200 rounded-lg text-sm">

                    <option value="">Pilih Kos</option>

                    @foreach ($allKos as $kos)
                        <option value="{{ $kos->id }}" {{ request('kos_id') == $kos->id ? 'selected' : '' }}>
                            {{ $kos->nama_kos }}
                        </option>
                    @endforeach
                </select>

                {{-- SORT KAMAR --}}
                <select name="sort" onchange="this.form.submit()" {{ request('kos_id') ? '' : 'disabled' }}
                    class="px-4 py-2 border border-slate-200 rounded-lg text-sm
               disabled:bg-slate-100 disabled:text-slate-400">

                    <option value="">Urutkan Kamar</option>

                    <option value="harga_asc" {{ request('sort') == 'harga_asc' ? 'selected' : '' }}>
                        Harga Termurah
                    </option>

                    <option value="harga_desc" {{ request('sort') == 'harga_desc' ? 'selected' : '' }}>
                        Harga Termahal
                    </option>

                    <option value="nama" {{ request('sort') == 'nama' ? 'selected' : '' }}>
                        Nama A-Z
                    </option>

                </select>

            </form>

        </div>


          

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">
                        <th class="px-5 py-3">Kos</th>
                        <th class="px-5 py-3">Nama Kamar</th>
                        <th class="px-5 py-3">Tipe</th>
                        <th class="px-5 py-3">Fasilitas</th>
                        <th class="px-5 py-3">Harga Bulanan</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                 
                    @forelse ($items as $kamar)
                        <tr class="hover:bg-slate-50/60 transition-colors">

                            {{-- Kos --}}
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-house text-blue-400 text-[10px]"></i>
                                    </div>
                                    <span class="font-medium text-slate-700 truncate max-w-[130px]"
                                        title="{{ $kamar->kos->nama_kos }}">
                                        {{ $kamar->kos->nama_kos }}
                                    </span>
                                </div>
                            </td>

                            {{-- Nama Kamar --}}
                            <td class="px-5 py-3.5 font-semibold text-slate-800">
                                {{ $kamar->nama_kamar }}
                            </td>

                            {{-- Tipe --}}
                            <td class="px-5 py-3.5">
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold capitalize bg-indigo-50 text-indigo-600 border border-indigo-100">
                                    {{ $kamar->tipe_kamar }}
                                </span>
                            </td>

                            {{-- Fasilitas --}}
                            <td class="px-5 py-3.5">
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach ($kamar->fasilitas as $f)
                                        <div class="relative group">
                                            <span
                                                class="w-7 h-7 flex items-center justify-center bg-slate-100 hover:bg-blue-50 rounded-lg cursor-default transition-colors border border-slate-200 hover:border-blue-200">
                                                <i
                                                    class="{{ $f->icon }} text-slate-500 group-hover:text-blue-500 text-xs transition-colors"></i>
                                            </span>
                                            {{-- Tooltip --}}
                                            <div
                                                class="absolute z-20 bottom-full left-1/2 -translate-x-1/2 mb-2
                                                        hidden group-hover:block
                                                        px-2 py-1 text-xs text-white bg-slate-800 rounded-md whitespace-nowrap shadow-lg pointer-events-none">
                                                {{ $f->nama_fasilitas }}
                                                <div
                                                    class="absolute top-full left-1/2 -translate-x-1/2 border-4 border-transparent border-t-slate-800">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    @if ($kamar->fasilitas->isEmpty())
                                        <span class="text-xs text-slate-300">—</span>
                                    @endif
                                </div>
                            </td>

                            {{-- Harga --}}
                            <td class="px-5 py-3.5">
                                <span class="font-semibold text-slate-800">
                                    Rp {{ number_format($kamar->harga_bulanan, 0, ',', '.') }}
                                </span>
                                <span class="block text-xs text-slate-400">/bulan</span>
                            </td>

                            {{-- Status --}}
                            <td class="px-5 py-3.5">
                                @if ($kamar->status == 'tersedia')
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-green-50 text-green-600 border border-green-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                        Tersedia
                                    </span>
                                @else
                                    <span
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-red-50 text-red-500 border border-red-100">
                                        <span class="w-1.5 h-1.5 rounded-full bg-red-400"></span>
                                        {{ ucfirst($kamar->status) }}
                                    </span>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="px-5 py-3.5">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.kamar.edit', $kamar) }}"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-600 text-xs font-semibold rounded-lg border border-amber-100 transition-colors">
                                        <i class="fa-solid fa-pen text-[10px]"></i>
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.kamar.destroy', $kamar) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus kamar ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-500 text-xs font-semibold rounded-lg border border-red-100 transition-colors">
                                            <i class="fa-solid fa-trash text-[10px]"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-16 text-center">
                                <div class="flex flex-col items-center gap-3 text-slate-300">
                                    <i class="fa-solid fa-door-open text-4xl"></i>
                                    <p class="text-sm font-medium text-slate-400">Belum ada data kamar</p>
                                    <a href="{{ route('admin.kamar.create') }}"
                                        class="mt-1 text-xs text-blue-500 hover:underline font-semibold">
                                        + Tambah kamar pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
         
        @if ($items->hasPages())
            <div class="px-5 py-4 border-t border-slate-100">
                {{ $items->links() }}
            </div>
        @endif

    </div>

@endsection
