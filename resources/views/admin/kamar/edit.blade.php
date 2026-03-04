@extends('admin.layouts.app')

@section('page-title', 'Edit Kamar')

@section('content')

    {{-- BREADCRUMB --}}
    <div class="flex items-center gap-2 text-xs text-slate-400 mb-5">
        <a href="{{ route('admin.kamar.index') }}" class="hover:text-blue-500 transition-colors">Data Kamar</a>
        <i class="fa-solid fa-chevron-right text-[9px]"></i>
        <span class="text-slate-600 font-medium">Edit Kamar</span>
    </div>

    <form action="{{ route('admin.kamar.update', $kamar) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- ═══════════════ LEFT — Main Form ═══════════════ --}}
            <div class="xl:col-span-2 space-y-5">

                {{-- Card: Informasi Dasar --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                            <i class="fa-solid fa-door-open text-blue-500 text-xs"></i>
                        </div>
                        <h2 class="font-bold text-slate-700 text-sm">Informasi Dasar</h2>
                    </div>

                    <div class="p-5 space-y-4">


                        <div>
                            <label
                                class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Kos</label>
                            <select name="kos_id"
                                class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                                @foreach ($kos as $item)
                                    <option value="{{ $item->id }}" {{ $kamar->kos_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_kos }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Nama & Tipe --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Nama
                                    Kamar</label>
                                <input type="text" name="nama_kamar" value="{{ $kamar->nama_kamar }}"
                                    class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition"
                                    placeholder="Contoh: Kamar A1">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
                                    Tipe Kamar
                                </label>

                                <select name="tipe_kamar"
                                    class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">

                                    <option value="">-- Pilih Tipe Kamar --</option>
                                    <option value="Kelas 3" {{ $kamar->tipe_kamar == 'Kelas 3' ? 'selected' : '' }}>Kelas 3
                                    </option>
                                    <option value="Kelas 2" {{ $kamar->tipe_kamar == 'Kelas 2' ? 'selected' : '' }}>Kelas 2
                                    </option>
                                    <option value="Kelas 1" {{ $kamar->tipe_kamar == 'Kelas 1' ? 'selected' : '' }}>Kelas 1
                                    </option>
                                    <option value="VIP" {{ $kamar->tipe_kamar == 'VIP' ? 'selected' : '' }}>VIP</option>
                                    <option value="VVIP" {{ $kamar->tipe_kamar == 'VVIP' ? 'selected' : '' }}>VVIP
                                    </option>
                                    {{-- <option value="Exclusive" {{ $kamar->tipe_kamar == 'Exclusive' ? 'selected' : '' }}>
                                        Exclusive</option> --}}
                                </select>
                            </div>
                        </div>

                        {{-- Lantai & Nomor --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Lantai</label>
                                <input type="number" name="lantai" value="{{ $kamar->lantai }}"
                                    class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition"
                                    placeholder="1">
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Nomor
                                    Kamar</label>
                                <input type="text" name="nomor_kamar" value="{{ $kamar->nomor_kamar }}"
                                    class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition"
                                    placeholder="A1">
                            </div>
                        </div>

                        {{-- Panjang & Lebar --}}
                        <div class="grid grid-cols-2 gap-4">
                            <!-- Panjang -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
                                    Panjang (m)
                                </label>
                                <input type="number" step="0.1" name="panjang" value="{{ $kamar->panjang + 0 }}"
                                    class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition"
                                    placeholder="3">
                            </div>

                            <!-- Lebar -->
                            <div>
                                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
                                    Lebar (m)
                                </label>
                                <input type="number" step="0.1" name="lebar" value="{{ $kamar->lebar + 0 }}"
                                    class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition"
                                    placeholder="4">
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div>
                            <label
                                class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Deskripsi</label>
                            <textarea name="deskripsi" rows="4"
                                class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition resize-none"
                                placeholder="Deskripsi singkat kamar...">{{ $kamar->deskripsi }}</textarea>
                        </div>

                    </div>
                </div>

                {{-- Card: Fasilitas --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-indigo-50 flex items-center justify-center">
                            <i class="fa-solid fa-couch text-indigo-500 text-xs"></i>
                        </div>
                        <h2 class="font-bold text-slate-700 text-sm">Fasilitas Kamar</h2>
                    </div>

                    <div class="p-5 space-y-3">
                        @foreach ($fasilitas as $kategori => $items)
                            <div x-data="{
                                open: true,
                                selected: @js($kamar->fasilitas->whereIn('id', $items->pluck('id'))->pluck('id'))
                            }" class="border border-slate-200 rounded-xl overflow-hidden">

                                {{-- Accordion Header --}}
                                <button type="button" @click="open = !open"
                                    class="w-full flex justify-between items-center px-4 py-3 bg-slate-50 hover:bg-slate-100 transition-colors text-left">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-semibold text-slate-700">
                                            {{ ucfirst(str_replace('_', ' ', $kategori)) }}
                                        </span>
                                        <span class="text-xs font-bold bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full"
                                            x-text="selected.length + ' dipilih'"></span>
                                    </div>
                                    <i class="fa-solid fa-chevron-down text-slate-400 text-xs transition-transform duration-200"
                                        :class="open ? 'rotate-180' : ''"></i>
                                </button>

                                {{-- Accordion Content --}}
                                <div x-show="open" x-transition class="p-4">
                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                                        @foreach ($items as $item)
                                            <label
                                                class="flex items-center gap-2.5 border border-slate-200 px-3 py-2.5 rounded-lg cursor-pointer transition-all"
                                                :class="selected.includes({{ $item->id }}) ? 'bg-blue-50 border-blue-300' :
                                                    'hover:bg-slate-50'">
                                                <input type="checkbox" name="fasilitas[]" value="{{ $item->id }}"
                                                    x-model="selected" class="accent-blue-500 w-3.5 h-3.5 flex-shrink-0">
                                                @if ($item->icon)
                                                    <i
                                                        class="{{ $item->icon }} text-slate-500 text-xs w-3 text-center"></i>
                                                @endif
                                                <span
                                                    class="text-xs font-medium text-slate-600 leading-tight">{{ $item->nama_fasilitas }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

            {{-- ═══════════════ RIGHT — Sidebar Cards ═══════════════ --}}
            <div class="space-y-5">

                {{-- Card: Harga --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-green-50 flex items-center justify-center">
                            <i class="fa-solid fa-tag text-green-500 text-xs"></i>
                        </div>
                        <h2 class="font-bold text-slate-700 text-sm">Harga</h2>
                    </div>
                    <div class="p-5 space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Harga
                                harian</label>
                            <div class="relative">
                                <span
                                    class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-semibold text-slate-400">Rp</span>
                                <input type="number" name="harga_harian" value="{{ $kamar->harga_harian }}"
                                    class="w-full border border-slate-200 rounded-lg pl-9 pr-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition"
                                    placeholder="0">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Harga
                                Bulanan</label>
                            <div class="relative">
                                <span
                                    class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-semibold text-slate-400">Rp</span>
                                <input type="number" name="harga_bulanan" value="{{ $kamar->harga_bulanan }}"
                                    class="w-full border border-slate-200 rounded-lg pl-9 pr-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition"
                                    placeholder="0">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Harga
                                Tahunan</label>
                            <div class="relative">
                                <span
                                    class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-semibold text-slate-400">Rp</span>
                                <input type="number" name="harga_tahunan" value="{{ $kamar->harga_tahunan }}"
                                    class="w-full border border-slate-200 rounded-lg pl-9 pr-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition"
                                    placeholder="0">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Card: Status --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-amber-50 flex items-center justify-center">
                            <i class="fa-solid fa-circle-dot text-amber-500 text-xs"></i>
                        </div>
                        <h2 class="font-bold text-slate-700 text-sm">Status Kamar</h2>
                    </div>
                    <div class="p-5">
                        <select name="status"
                            class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                            <option value="tersedia" {{ $kamar->status == 'tersedia' ? 'selected' : '' }}>✅ Tersedia
                            </option>
                            <option value="terisi" {{ $kamar->status == 'terisi' ? 'selected' : '' }}>🔴 Terisi</option>
                        </select>
                    </div>
                </div>

                {{-- Action Button --}}
                <div class="flex gap-3">
                    <a href="{{ route('admin.kamar.index') }}"
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
