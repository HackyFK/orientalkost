@extends('admin.layouts.app')

@section('page-title', 'Tambah Kamar')

@section('content')

    {{-- BREADCRUMB --}}
    <div class="flex items-center gap-2 text-xs text-slate-400 mb-5">
        <a href="{{ route('admin.kamar.index') }}" class="hover:text-blue-500 transition-colors">Data Kamar</a>
        <i class="fa-solid fa-chevron-right text-[9px]"></i>
        <span class="text-slate-600 font-medium">Tambah Kamar</span>
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

    <form action="{{ route('admin.kamar.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

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

                        {{-- Kos --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Kos</label>
                            <select name="kos_id"
                                class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                                <option value="">-- Pilih Kos --</option>
                                @foreach ($kos as $item)
                                    <option value="{{ $item->id }}" @selected(old('kos_id') == $item->id)>
                                        {{ $item->nama_kos }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Nama & Tipe --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Nama Kamar</label>
                                <input type="text" name="nama_kamar" value="{{ old('nama_kamar') }}"
                                    placeholder="Contoh: Kamar A1"
                                    class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Tipe Kamar</label>
                                <input type="text" name="tipe_kamar" value="{{ old('tipe_kamar') }}"
                                    placeholder="Contoh: Standard"
                                    class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                            </div>
                        </div>

                        {{-- Lantai & Nomor --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Lantai</label>
                                <input type="number" name="lantai" value="{{ old('lantai') }}"
                                    placeholder="1"
                                    class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Nomor Kamar</label>
                                <input type="text" name="nomor_kamar" value="{{ old('nomor_kamar') }}"
                                    placeholder="A1"
                                    class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                            </div>
                        </div>

                        {{-- Deskripsi --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Deskripsi</label>
                            <textarea name="deskripsi" rows="4"
                                placeholder="Deskripsi singkat kamar..."
                                class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition resize-none">{{ old('deskripsi') }}</textarea>
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
                            <div x-data="{ open: false, selected: [] }"
                                 class="border border-slate-200 rounded-xl overflow-hidden">

                                {{-- Accordion Header --}}
                                <button type="button" @click="open = !open"
                                    class="w-full flex justify-between items-center px-4 py-3 bg-slate-50 hover:bg-slate-100 transition-colors text-left">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-semibold text-slate-700">
                                            {{ ucfirst(str_replace('_', ' ', $kategori)) }}
                                        </span>
                                        <span x-show="selected.length > 0"
                                              class="text-xs font-bold bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full"
                                              x-text="selected.length + ' dipilih'"></span>
                                    </div>
                                    <i class="fa-solid fa-chevron-down text-slate-400 text-xs transition-transform duration-200"
                                       :class="open ? 'rotate-180' : ''"></i>
                                </button>

                                {{-- Accordion Content --}}
                                <div x-show="open" x-transition class="p-4">
                                    <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                                        @foreach ($items as $item)
                                            <label class="flex items-center gap-2.5 border border-slate-200 px-3 py-2.5 rounded-lg cursor-pointer transition-all"
                                                   :class="selected.includes({{ $item->id }}) ? 'bg-blue-50 border-blue-300' : 'hover:bg-slate-50'">
                                                <input type="checkbox" name="fasilitas[]" value="{{ $item->id }}"
                                                       x-model="selected" class="accent-blue-500 w-3.5 h-3.5 flex-shrink-0">
                                                @if ($item->icon)
                                                    <i class="{{ $item->icon }} text-slate-500 text-xs w-3 text-center"></i>
                                                @endif
                                                <span class="text-xs font-medium text-slate-600 leading-tight">{{ $item->nama_fasilitas }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>

            </div>

            {{-- ═══════════════ RIGHT — Sidebar ═══════════════ --}}
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
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Harga Bulanan</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-semibold text-slate-400">Rp</span>
                                <input type="number" name="harga_bulanan" value="{{ old('harga_bulanan') }}"
                                    placeholder="0"
                                    class="w-full border border-slate-200 rounded-lg pl-9 pr-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Harga Tahunan</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs font-semibold text-slate-400">Rp</span>
                                <input type="number" name="harga_tahunan" value="{{ old('harga_tahunan') }}"
                                    placeholder="0"
                                    class="w-full border border-slate-200 rounded-lg pl-9 pr-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
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
                            <option value="tersedia" @selected(old('status') == 'tersedia')>✅ Tersedia</option>
                            <option value="terisi"   @selected(old('status') == 'terisi')>🔴 Terisi</option>
                        </select>
                    </div>
                </div>

                {{-- Card: Gambar --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-purple-50 flex items-center justify-center">
                            <i class="fa-solid fa-image text-purple-500 text-xs"></i>
                        </div>
                        <h2 class="font-bold text-slate-700 text-sm">Gambar Utama</h2>
                    </div>
                    <div class="p-5">
                        <label class="flex flex-col items-center justify-center gap-2 border-2 border-dashed border-slate-200 hover:border-blue-300 rounded-xl px-4 py-6 cursor-pointer transition-colors group">
                            <i class="fa-solid fa-cloud-arrow-up text-2xl text-slate-300 group-hover:text-blue-400 transition-colors"></i>
                            <span class="text-xs font-medium text-slate-400 group-hover:text-blue-500 transition-colors">Klik untuk upload gambar</span>
                            <span class="text-[10px] text-slate-300">JPG, PNG, WEBP – maks 2MB</span>
                            <input type="file" name="image" class="hidden" accept="image/*"
                                   onchange="previewGambar(this)">
                        </label>
                        <div id="previewWrap" class="mt-3 hidden">
                            <img id="previewImg" src="" class="w-full h-36 object-cover rounded-xl border border-slate-200">
                        </div>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
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

    <script>
        function previewGambar(input) {
            const wrap = document.getElementById('previewWrap');
            const img  = document.getElementById('previewImg');
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    img.src = e.target.result;
                    wrap.classList.remove('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection