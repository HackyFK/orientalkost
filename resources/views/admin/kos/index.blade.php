@extends('admin.layouts.app')

@section('page-title', 'Data Kos')

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
            <h1 class="text-xl font-bold text-slate-800">Data Kos</h1>
            <p class="text-sm text-slate-400 mt-0.5">Kelola seluruh data kos yang terdaftar</p>
        </div>
        <a href="{{ route('admin.kos.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm shadow-blue-200">
            <i class="fa-solid fa-plus text-xs"></i>
            Tambah Kos
        </a>
    </div>

    {{-- TABLE CARD --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">

        {{-- Table Toolbar --}}
        <div class="flex items-center justify-between px-5 py-3.5 border-b border-slate-100">
            <span class="text-sm font-semibold text-slate-600">
                Semua Kos
                <span class="ml-2 text-xs font-bold bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full">
                    {{ $items->count() }}
                </span>
            </span>
            {{-- Search (opsional) --}}
            {{-- <input type="text" placeholder="Cari kos..." class="text-sm border border-slate-200 rounded-lg px-3 py-1.5 focus:outline-none focus:ring-2 focus:ring-blue-400"> --}}
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">
                        <th class="px-5 py-3">Foto</th>
                        <th class="px-5 py-3">Nama Kos</th>
                        <th class="px-5 py-3">Owner</th>
                        <th class="px-5 py-3">Alamat</th>
                        <th class="px-5 py-3">Jenis</th>
                        <th class="px-5 py-3">Koordinat</th>
                        <th class="px-5 py-3 text-center">Status</th>
                        <th class="px-5 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse ($items as $kos)
                        <tr class="hover:bg-slate-50/60 transition-colors">

                            {{-- Foto --}}
                            <td class="px-5 py-3.5">
                                @if ($kos->primaryImage)
                                    <img src="{{ asset('storage/' . $kos->primaryImage->image_path) }}"
                                        class="w-20 h-14 object-cover rounded-lg border border-slate-100 shadow-sm">
                                @else
                                    <div class="w-20 h-14 rounded-lg bg-slate-100 flex items-center justify-center">
                                        <i class="fa-regular fa-image text-slate-300 text-lg"></i>
                                    </div>
                                @endif
                            </td>

                            {{-- Nama Kos --}}
                            <td class="px-5 py-3.5">
                                <p class="font-semibold text-slate-800">{{ $kos->nama_kos }}</p>
                                <p class="text-xs text-slate-400 mt-0.5">{{ $kos->slug }}</p>
                            </td>

                            {{-- Owner --}}
                            <td class="px-5 py-3.5">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-7 h-7 rounded-full bg-gradient-to-br from-indigo-400 to-blue-500 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                        {{ strtoupper(substr($kos->owner->name ?? '?', 0, 1)) }}
                                    </div>
                                    <span class="text-slate-600 font-medium">{{ $kos->owner->name ?? '-' }}</span>
                                </div>
                            </td>

                            {{-- Alamat --}}
                            <td class="px-5 py-3.5 text-slate-500 max-w-[200px]">
                                <p class="truncate" title="{{ $kos->alamat }}">{{ $kos->alamat }}</p>
                            </td>

                            {{-- Jenis --}}
                            <td class="px-5 py-3.5">
                                @php
                                    $jenis = strtolower($kos->jenis_sewa);
                                    $badgeClass = match ($jenis) {
                                        'bulanan' => 'bg-blue-50 text-blue-600 border-blue-100',
                                        'harian' => 'bg-amber-50 text-amber-600 border-amber-100',
                                        'tahunan' => 'bg-green-50 text-green-600 border-green-100',
                                        default => 'bg-slate-100 text-slate-500 border-slate-200',
                                    };
                                @endphp
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold capitalize border {{ $badgeClass }}">
                                    {{ $kos->jenis_sewa }}
                                </span>
                            </td>

                            {{-- Koordinat --}}
                            <td class="px-5 py-3.5">
                                @if ($kos->latitude && $kos->longitude)
                                    <div class="flex items-center gap-1.5 text-xs text-slate-400">
                                        <i class="fa-solid fa-location-dot text-blue-400"></i>
                                        <span>{{ number_format($kos->latitude, 5) }},<br>{{ number_format($kos->longitude, 5) }}</span>
                                    </div>
                                @else
                                    <span class="text-xs text-slate-300">—</span>
                                @endif
                            </td>

                            <td class="px-5 py-3.5">
                                <span
                                    class="{{ $kos->kamar_tersedia > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} 
                                    px-4 py-2 rounded-full text-sm font-semibold flex items-center">

                                    @if ($kos->kamar_tersedia > 0)
                                        <i class="fas fa-check-circle mr-2"></i>Tersedia
                                    @else
                                        <i class="fas fa-times-circle mr-2"></i>Tidak tersedia
                                    @endif

                                </span>
                            </td>

                            {{-- Aksi --}}
                            <td class="px-5 py-3.5">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.kos.edit', $kos) }}"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-600 text-xs font-semibold rounded-lg border border-amber-100 transition-colors">
                                        <i class="fa-solid fa-pen text-[10px]"></i>

                                    </a>

                                    <form method="POST" action="{{ route('admin.kos.destroy', $kos) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Yakin ingin menghapus kos ini?')"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50 hover:bg-red-100 text-red-500 text-xs font-semibold rounded-lg border border-red-100 transition-colors">
                                            <i class="fa-solid fa-trash text-[10px]"></i>

                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-5 py-16 text-center">
                                <div class="flex flex-col items-center gap-3 text-slate-300">
                                    <i class="fa-solid fa-house-circle-xmark text-4xl"></i>
                                    <p class="text-sm font-medium text-slate-400">Belum ada data kos</p>
                                    <a href="{{ route('admin.kos.create') }}"
                                        class="mt-1 text-xs text-blue-500 hover:underline font-semibold">
                                        + Tambah kos pertama
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
