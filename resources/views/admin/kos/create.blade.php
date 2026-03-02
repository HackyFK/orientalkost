@extends('admin.layouts.app')

@section('page-title', 'Tambah Kos')

@section('content')

    {{-- BREADCRUMB --}}
    <div class="flex items-center gap-2 text-xs text-slate-400 mb-5">
        <a href="{{ route('admin.kos.index') }}" class="hover:text-blue-500 transition-colors">Data Kos</a>
        <i class="fa-solid fa-chevron-right text-[9px]"></i>
        <span class="text-slate-600 font-medium">Tambah Kos</span>
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

    <form method="POST" action="{{ route('admin.kos.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- ═══════════════ LEFT — Main Form ═══════════════ --}}
            <div class="xl:col-span-2 space-y-5">

                {{-- Card: Informasi Dasar --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-3.5 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                            <i class="fa-solid fa-house text-blue-500 text-xs"></i>
                        </div>
                        <h2 class="font-semibold text-slate-700 text-sm">Informasi Kos</h2>
                    </div>
                    <div class="p-5 space-y-4">

                        {{-- Owner --}}
                        <div>
                            <label
                                class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Owner</label>
                            <select name="owner_id"
                                class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                                <option value="">-- Pilih Owner --</option>
                                @foreach ($owners as $owner)
                                    <option value="{{ $owner->id }}" @selected(old('owner_id') == $owner->id)>
                                        {{ $owner->name }} ({{ $owner->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Nama Kos --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Nama
                                Kos</label>
                            <input type="text" name="nama_kos" value="{{ old('nama_kos') }}"
                                placeholder="Contoh: Kos Melati Indah"
                                class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                        </div>

                        {{-- Gender --}}
                        <div>
                            <label
                                class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Gender</label>
                            <select name="gender" required
                                class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                                <option value="">-- Pilih Gender --</option>
                                <option value="putra" @selected(old('gender') == 'putra')>Putra</option>
                                <option value="putri" @selected(old('gender') == 'putri')>Putri</option>
                                <option value="campuran" @selected(old('gender') == 'campuran')>Campuran</option>
                            </select>
                        </div>

                        {{-- Deskripsi --}}
                        <div>
                            <label
                                class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Deskripsi</label>
                            <textarea name="deskripsi" rows="3" placeholder="Deskripsi singkat tentang kos..."
                                class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition resize-none">{{ old('deskripsi') }}</textarea>
                        </div>

                        {{-- Alamat --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Alamat
                                Lengkap</label>
                            <textarea name="alamat" rows="2" placeholder="Jalan, nomor, kelurahan, kecamatan..."
                                class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition resize-none">{{ old('alamat') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Card: Fasilitas Kos --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-emerald-50 flex items-center justify-center">
                            <i class="fa-solid fa-building text-emerald-500 text-xs"></i>
                        </div>
                        <h2 class="font-bold text-slate-700 text-sm">Fasilitas Kos</h2>
                    </div>

                    <div class="p-5 space-y-3">
                        @foreach ($fasilitasKos as $kategori => $items)
                            <div x-data="{
                                open: false,
                                selected: @js(isset($ko) ? $ko->fasilitas->pluck('id') : [])
                            }" class="border border-slate-200 rounded-xl overflow-hidden">

                                {{-- Accordion Header --}}
                                <button type="button" @click="open = !open"
                                    class="w-full flex justify-between items-center px-4 py-3 bg-slate-50 hover:bg-slate-100 transition-colors text-left">
                                    <div class="flex items-center gap-2">
                                        <span class="text-sm font-semibold text-slate-700">
                                            {{ ucfirst(str_replace('_', ' ', $kategori)) }}
                                        </span>

                                        <span x-show="selected.length > 0"
                                            class="text-xs font-bold bg-emerald-100 text-emerald-600 px-2 py-0.5 rounded-full"
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
                                                :class="selected.includes({{ $item->id }}) ?
                                                    'bg-emerald-50 border-emerald-300' :
                                                    'hover:bg-slate-50'">

                                                <input type="checkbox" name="fasilitas_kos[]" value="{{ $item->id }}"
                                                    x-model="selected" class="accent-emerald-500 w-3.5 h-3.5 flex-shrink-0">

                                                @if ($item->icon)
                                                    <i
                                                        class="{{ $item->icon }} text-slate-500 text-xs w-3 text-center"></i>
                                                @endif

                                                <span class="text-xs font-medium text-slate-600 leading-tight">
                                                    {{ $item->nama_fasilitas }}
                                                </span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Card: Lokasi --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-green-50 flex items-center justify-center">
                                <i class="fa-solid fa-location-dot text-green-500 text-xs"></i>
                            </div>
                            <h2 class="font-bold text-slate-700 text-sm">Koordinat Lokasi</h2>
                        </div>
                        <button type="button" id="btnGps"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-green-50 hover:bg-green-100 text-green-600 text-xs font-semibold rounded-lg border border-green-100 transition-colors">
                            <i class="fa-solid fa-location-crosshairs text-[10px]"></i>
                            Gunakan Lokasi Saya
                        </button>
                    </div>
                    <div class="p-5 space-y-4">

                        {{-- Lat & Lng --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Latitude</label>
                                <div class="relative">
                                    <i
                                        class="fa-solid fa-arrows-up-down absolute left-3 top-1/2 -translate-y-1/2 text-slate-300 text-xs"></i>
                                    <input type="text" name="latitude" id="latInput" value="{{ old('latitude') }}"
                                        placeholder="-7.7970680"
                                        class="w-full border border-slate-200 rounded-lg pl-8 pr-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition font-mono">
                                </div>
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Longitude</label>
                                <div class="relative">
                                    <i
                                        class="fa-solid fa-arrows-left-right absolute left-3 top-1/2 -translate-y-1/2 text-slate-300 text-xs"></i>
                                    <input type="text" name="longitude" id="lngInput"
                                        value="{{ old('longitude') }}" placeholder="110.3705290"
                                        class="w-full border border-slate-200 rounded-lg pl-8 pr-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition font-mono">
                                </div>
                            </div>
                        </div>

                        {{-- Map --}}
                        <div id="map"
                            class="w-full h-64 rounded-xl border border-slate-200 shadow-sm overflow-hidden"></div>
                        <p class="text-xs text-slate-400">
                            <i class="fa-solid fa-circle-info mr-1"></i>
                            Klik pada peta atau seret marker untuk menentukan lokasi kos
                        </p>

                    </div>
                </div>

            </div>

            {{-- ═══════════════ RIGHT — Sidebar ═══════════════ --}}
            <div class="space-y-5">

                {{-- Card: Jenis Sewa --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-amber-50 flex items-center justify-center">
                            <i class="fa-solid fa-tag text-amber-500 text-xs"></i>
                        </div>
                        <h2 class="font-bold text-slate-700 text-sm">Jenis Sewa</h2>
                    </div>
                    <div class="p-5">
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Tipe
                            Sewa</label>
                        <select name="jenis_sewa"
                            class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                            <option value="bulanan" @selected(old('jenis_sewa') == 'bulanan')>📅 Bulanan</option>
                            <option value="tahunan" @selected(old('jenis_sewa') == 'tahunan')>📆 Tahunan</option>
                        </select>
                    </div>
                </div>

                {{-- Card: Foto Kos --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-purple-50 flex items-center justify-center">
                            <i class="fa-solid fa-images text-purple-500 text-xs"></i>
                        </div>
                        <h2 class="font-bold text-slate-700 text-sm">Foto Kos</h2>
                    </div>
                    <div class="p-5">
                        <label
                            class="flex flex-col items-center justify-center gap-2 border-2 border-dashed border-slate-200 hover:border-blue-300 rounded-xl px-4 py-7 cursor-pointer transition-colors group">
                            <i
                                class="fa-solid fa-cloud-arrow-up text-2xl text-slate-300 group-hover:text-blue-400 transition-colors"></i>
                            <span
                                class="text-xs font-medium text-slate-400 group-hover:text-blue-500 transition-colors text-center">
                                Klik untuk upload foto kos
                            </span>
                            <span class="text-[10px] text-slate-300">JPG, PNG, WEBP – maks 2MB</span>
                            <span class="text-[10px] text-blue-400 font-semibold">Multiple foto diperbolehkan</span>
                            <input type="file" name="images[]" multiple accept="image/*" class="hidden"
                                id="fotoInput" onchange="previewFotos(this)">
                        </label>

                        {{-- Preview container --}}
                        <div id="previewGrid" class="mt-3 grid grid-cols-3 gap-2 hidden"></div>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="flex gap-3">
                    <a href="{{ route('admin.kos.index') }}"
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
        // ── Map Setup ──
        const latInput = document.getElementById('latInput');
        const lngInput = document.getElementById('lngInput');

        let lat = parseFloat(latInput.value) || -7.797068;
        let lng = parseFloat(lngInput.value) || 110.370529;

        const map = L.map('map').setView([lat, lng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        const marker = L.marker([lat, lng], {
            draggable: true
        }).addTo(map);

        function setLocation(lat, lng) {
            marker.setLatLng([lat, lng]);
            map.setView([lat, lng], 16);
            latInput.value = lat.toFixed(7);
            lngInput.value = lng.toFixed(7);
        }

        map.on('click', e => setLocation(e.latlng.lat, e.latlng.lng));
        marker.on('dragend', e => {
            const pos = e.target.getLatLng();
            setLocation(pos.lat, pos.lng);
        });

        document.getElementById('btnGps').addEventListener('click', () => {
            navigator.geolocation.getCurrentPosition(
                pos => setLocation(pos.coords.latitude, pos.coords.longitude),
                () => alert('Gagal mengambil lokasi. Pastikan izin lokasi diaktifkan.')
            );
        });

        // ── Foto Preview ──
        function previewFotos(input) {
            const grid = document.getElementById('previewGrid');
            grid.innerHTML = '';
            if (input.files.length === 0) {
                grid.classList.add('hidden');
                return;
            }
            grid.classList.remove('hidden');
            Array.from(input.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = e => {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'w-full h-20 object-cover rounded-lg border border-slate-200';
                    grid.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        }
    </script>

@endsection
