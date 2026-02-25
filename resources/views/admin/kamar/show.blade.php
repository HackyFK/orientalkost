@extends('admin.layouts.app')

@section('page-title', 'Data Kamar')

@section('content')

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-blue-50 flex items-center justify-center">
                <i class="fa-solid fa-door-open text-blue-500 text-sm"></i>
            </div>
            <div>
                <h1 class="text-lg font-bold text-slate-800">{{ $kamar->nama_kamar }}</h1>
                <p class="text-xs text-slate-400">{{ $kamar->kos->nama_kos }}</p>
            </div>
        </div>
        <a href="{{ route('admin.kamar.index') }}"
            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 active:scale-[0.98] transition-all duration-150 text-sm font-medium text-slate-600 shadow-sm">
            <i class="fa-solid fa-arrow-left text-xs"></i>
            Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- LEFT: Gambar + Deskripsi + Fasilitas --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Gambar Utama --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <img src="{{ asset('storage/' . ($kamar->images->where('is_primary', true)->first()->image_path ?? '')) }}"
                    class="w-full h-80 object-cover">
                @if ($kamar->images->count() > 1)
                    <div class="flex gap-2 p-3 border-t border-slate-100 overflow-x-auto">
                        @foreach ($kamar->images as $image)
                            <img src="{{ asset('storage/' . $image->image_path) }}"
                                class="w-20 h-20 flex-shrink-0 object-cover rounded-lg border border-slate-200 hover:border-blue-400 transition cursor-pointer">
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Deskripsi --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-5 py-3.5 border-b border-slate-100 flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-slate-50 flex items-center justify-center">
                        <i class="fa-solid fa-align-left text-slate-500 text-xs"></i>
                    </div>
                    <h3 class="font-semibold text-slate-700 text-sm">Deskripsi</h3>
                </div>
                <div class="p-5">
                    <p class="text-sm text-slate-500 leading-relaxed">{{ $kamar->deskripsi ?? 'Tidak ada deskripsi.' }}</p>
                </div>
            </div>

            {{-- Fasilitas --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
    <div class="px-5 py-3.5 border-b border-slate-100 flex items-center gap-2.5">
        <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
            <i class="fa-solid fa-star text-blue-500 text-xs"></i>
        </div>
        <h3 class="font-semibold text-slate-700 text-sm">Fasilitas</h3>
        <span class="ml-auto text-xs text-slate-400 font-medium">{{ $kamar->fasilitas->count() }} item</span>
    </div>
    <div class="p-5">
        @if ($kamar->fasilitas->isNotEmpty())
            <div class="flex flex-wrap gap-2">
                @foreach ($kamar->fasilitas as $f)
                    <div class="relative group">
                        <span class="inline-flex items-center gap-1.5 bg-blue-50 text-blue-700 border border-blue-100
                                     hover:bg-blue-100 hover:border-blue-300 transition-colors cursor-default
                                     px-3 py-1.5 rounded-lg text-xs font-medium">
                            <i class="{{ $f->icon }} text-blue-500 text-[10px]"></i>
                            {{ $f->nama_fasilitas }}
                        </span>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-sm text-slate-400">Belum ada fasilitas.</p>
        @endif
    </div>
</div>
        </div>


        {{-- RIGHT: Info Detail --}}
        <div class="space-y-5">

            {{-- Detail Kamar --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-5 py-3.5 border-b border-slate-100 flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-slate-50 flex items-center justify-center">
                        <i class="fa-solid fa-circle-info text-slate-500 text-xs"></i>
                    </div>
                    <h3 class="font-semibold text-slate-700 text-sm">Detail Kamar</h3>
                </div>
                <div class="p-5 space-y-3">

                    @php
                        $details = [
                            [
                                'icon' => 'fa-building',
                                'label' => 'Kos',
                                'value' => $kamar->kos->nama_kos,
                                'bold' => true,
                            ],
                            ['icon' => 'fa-tag', 'label' => 'Tipe', 'value' => $kamar->tipe_kamar],
                            ['icon' => 'fa-hashtag', 'label' => 'Nomor', 'value' => $kamar->nomor_kamar],
                            ['icon' => 'fa-layer-group', 'label' => 'Lantai', 'value' => $kamar->lantai],
                            [
                                'icon' => 'fa-ruler-combined',
                                'label' => 'Ukuran',
                                'value' => rtrim(rtrim($kamar->panjang, '0'), '.') . ' × ' . rtrim(rtrim($kamar->lebar, '0'), '.') . ' m',
                            ],
                            [
                                'icon' => 'fa-expand',
                                'label' => 'Luas',
                                'value' => $kamar->panjang * $kamar->lebar . ' m²',
                            ],
                        ];
                    @endphp

                    @foreach ($details as $item)
                        <div class="flex items-center justify-between gap-3">
                            <div class="flex items-center gap-2 text-slate-500 text-xs">
                                <i class="fa-solid {{ $item['icon'] }} text-slate-400 w-3.5 text-center"></i>
                                {{ $item['label'] }}
                            </div>
                            <span
                                class="text-xs text-right {{ isset($item['bold']) ? 'font-semibold text-slate-700' : 'text-slate-600' }}">
                                {{ $item['value'] }}
                            </span>
                        </div>
                        <div class="border-t border-slate-50"></div>
                    @endforeach

                    {{-- Status --}}
                    <div class="flex items-center justify-between gap-3">
                        <div class="flex items-center gap-2 text-slate-500 text-xs">
                            <i class="fa-solid fa-circle-dot text-slate-400 w-3.5 text-center"></i>
                            Status
                        </div>
                        <span
                            class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-semibold rounded-full
                        {{ $kamar->status == 'tersedia'
                            ? 'bg-emerald-50 text-emerald-600 border border-emerald-200'
                            : 'bg-red-50 text-red-600 border border-red-200' }}">
                            <i
                                class="fa-solid {{ $kamar->status == 'tersedia' ? 'fa-circle-check' : 'fa-circle-xmark' }} text-[10px]"></i>
                            {{ ucfirst($kamar->status) }}
                        </span>
                    </div>

                </div>
            </div>

            {{-- Harga --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-5 py-3.5 border-b border-slate-100 flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-emerald-50 flex items-center justify-center">
                        <i class="fa-solid fa-money-bill-wave text-emerald-500 text-xs"></i>
                    </div>
                    <h3 class="font-semibold text-slate-700 text-sm">Harga & Biaya</h3>
                </div>
                <div class="p-5 space-y-3">

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2 text-slate-500 text-xs">
                            <i class="fa-regular fa-calendar-days text-slate-400 w-3.5 text-center"></i>
                            harian
                        </div>
                        <span class="text-xs font-semibold text-slate-600">Rp
                            {{ number_format($kamar->harga_harian) }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2 text-slate-500 text-xs">
                            <i class="fa-regular fa-calendar text-slate-400 w-3.5 text-center"></i>
                            Bulanan
                        </div>
                        <span class="text-sm font-bold text-emerald-600">Rp
                            {{ number_format($kamar->harga_bulanan) }}</span>
                    </div>
                    <div class="border-t border-slate-50"></div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2 text-slate-500 text-xs">
                            <i class="fa-regular fa-calendar-days text-slate-400 w-3.5 text-center"></i>
                            Tahunan
                        </div>
                        <span class="text-xs font-semibold text-slate-600">Rp
                            {{ number_format($kamar->harga_tahunan) }}</span>
                    </div>
                    <div class="border-t border-slate-50"></div>

                    

                </div>
            </div>

        </div>

    </div>

@endsection
