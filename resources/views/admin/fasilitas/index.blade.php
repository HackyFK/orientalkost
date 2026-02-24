@extends('admin.layouts.app')

@section('page-title', 'Fasilitas')

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
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

    <!-- Title Section -->
    <div>
        <h1 class="text-2xl font-bold text-slate-800 tracking-tight">
            Fasilitas
        </h1>
        <p class="text-sm text-slate-400 mt-1">
            Kelola fasilitas yang tersedia untuk kamar
        </p>
    </div>

    <!-- Action Section -->
    <div class="flex items-center gap-3">

        <!-- Filter -->
        <form method="GET"
              action="{{ route('admin.fasilitas.index') }}"
              class="flex items-center gap-2 bg-white px-3 py-2 rounded-xl shadow-sm border border-slate-200">

            <i class="fa-solid fa-filter text-slate-400 text-xs"></i>

            <select name="kategori"
                onchange="this.form.submit()"
                class="bg-transparent text-sm focus:outline-none text-slate-600">

                <option value="">Semua Kategori</option>

                @foreach ($allKategori as $kat)
                    <option value="{{ $kat }}"
                        {{ request('kategori') == $kat ? 'selected' : '' }}>
                        {{ ucfirst($kat) }}
                    </option>
                @endforeach

            </select>

            @if(request('kategori'))
                <a href="{{ route('admin.fasilitas.index') }}"
                   class="text-xs text-red-500 hover:text-red-600 ml-2">
                   Reset
                </a>
            @endif

        </form>

        <!-- Button -->
        <a href="{{ route('admin.fasilitas.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5
                  bg-blue-600 hover:bg-blue-700
                  text-white text-sm font-semibold
                  rounded-xl transition-all duration-200
                  shadow-md hover:shadow-lg">

            <i class="fa-solid fa-plus text-xs"></i>
            Tambah
        </a>

    </div>
</div>

    @forelse ($fasilitas as $kategori => $items)

        {{-- CATEGORY CARD --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-5">

            {{-- Category Header --}}
            <div class="flex items-center justify-between px-5 py-3.5 border-b border-slate-100 bg-slate-50">
                <div class="flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-indigo-100 flex items-center justify-center">
                        <i class="fa-solid fa-layer-group text-indigo-500 text-xs"></i>
                    </div>
                    <span class="font-bold text-slate-700 text-sm">
                        {{ ucfirst(str_replace('_', ' ', $kategori)) }}
                    </span>
                    <span class="text-xs font-bold bg-slate-200 text-slate-500 px-2 py-0.5 rounded-full">
                        {{ $items->count() }} item
                    </span>
                </div>
            </div>

            {{-- Items Grid --}}
            <div class="p-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3">
                @foreach ($items as $item)
                    <div
                        class="group flex items-center justify-between gap-3 px-4 py-3 rounded-xl border border-slate-100 bg-slate-50 hover:bg-white hover:border-blue-200 hover:shadow-sm transition-all duration-150">

                        {{-- Icon + Name --}}
                        <div class="flex items-center gap-3 min-w-0">
                            <div
                                class="w-9 h-9 rounded-xl flex items-center justify-center bg-white border border-slate-200 shadow-sm flex-shrink-0 group-hover:border-blue-200 transition-colors">
                                @if ($item->icon)
                                    <i
                                        class="{{ $item->icon }} text-slate-500 group-hover:text-blue-500 text-sm transition-colors"></i>
                                @else
                                    <i class="fa-solid fa-question text-slate-300 text-xs"></i>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-semibold text-slate-700 truncate">{{ $item->nama_fasilitas }}</p>
                                @if ($item->icon)
                                    <p class="text-[10px] text-slate-400 font-mono truncate">{{ $item->icon }}</p>
                                @endif
                            </div>
                        </div>

                        {{-- Edit Button --}}
                        <a href="{{ route('admin.fasilitas.edit', $item) }}"
                            class="flex-shrink-0 w-7 h-7 flex items-center justify-center rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-500 border border-amber-100 transition-colors opacity-0 group-hover:opacity-100"
                            title="Edit">
                            <i class="fa-solid fa-pen text-[10px]"></i>
                        </a>

                    </div>
                @endforeach
            </div>

        </div>

    @empty
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm px-5 py-16 text-center">
            <div class="flex flex-col items-center gap-3 text-slate-300">
                <i class="fa-solid fa-couch text-4xl"></i>
                <p class="text-sm font-medium text-slate-400">Belum ada fasilitas</p>
                <a href="{{ route('admin.fasilitas.create') }}"
                    class="mt-1 text-xs text-blue-500 hover:underline font-semibold">
                    + Tambah fasilitas pertama
                </a>
            </div>
        </div>
    @endforelse

@endsection
