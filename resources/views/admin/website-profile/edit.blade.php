@extends('admin.layouts.app')

@section('page-title', 'Edit Profil Website')

@section('content')

    {{-- BREADCRUMB --}}
    <div class="flex items-center gap-2 text-xs text-slate-400 mb-5">
        <a href="{{ route('admin.website-profile.index') }}" class="hover:text-blue-500 transition-colors">Profil Website</a>
        <i class="fa-solid fa-chevron-right text-[9px]"></i>
        <span class="text-slate-600 font-medium">Edit</span>
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

    <form action="{{ route('admin.website-profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- ═══════════════ LEFT (2/3) ═══════════════ --}}
            <div class="xl:col-span-2 space-y-5">

                {{-- Card: Deskripsi --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                            <i class="fa-solid fa-align-left text-blue-500 text-xs"></i>
                        </div>
                        <h2 class="font-bold text-slate-700 text-sm">Deskripsi Perusahaan</h2>
                    </div>
                    <div class="p-5">
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Deskripsi</label>
                        <textarea name="description" rows="6"
                            placeholder="Tulis deskripsi singkat tentang perusahaan..."
                            class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition resize-none">{{ old('description', $profile->description ?? '') }}</textarea>
                    </div>
                </div>

                {{-- Card: Keunggulan --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-amber-50 flex items-center justify-center">
                            <i class="fa-solid fa-trophy text-amber-500 text-xs"></i>
                        </div>
                        <h2 class="font-bold text-slate-700 text-sm">Keunggulan</h2>
                        <span class="ml-auto text-xs text-slate-400">3 keunggulan</span>
                    </div>
                    <div class="p-5 space-y-5">
                        @for ($i = 1; $i <= 3; $i++)
                            <div class="rounded-xl border border-slate-100 bg-slate-50 p-4 space-y-3">

                                {{-- Label keunggulan --}}
                                <div class="flex items-center gap-2 mb-1">
                                    <div class="w-6 h-6 rounded-lg bg-blue-600 flex items-center justify-center text-white text-[10px] font-bold flex-shrink-0">
                                        {{ $i }}
                                    </div>
                                    <span class="text-xs font-bold text-slate-600">Keunggulan {{ $i }}</span>

                                    {{-- Icon live preview --}}
                                    <div class="ml-auto w-7 h-7 rounded-lg bg-white border border-slate-200 flex items-center justify-center shadow-sm">
                                        <i id="iconPreview{{ $i }}"
                                           class="fa-solid fa-{{ old('advantage_' . $i . '_icon', $profile->{'advantage_' . $i . '_icon'} ?? 'question') }} text-blue-400 text-xs"></i>
                                    </div>
                                </div>

                                <div class="grid sm:grid-cols-3 gap-3">
                                    {{-- Judul --}}
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Judul</label>
                                        <input type="text" name="advantage_{{ $i }}_title"
                                            value="{{ old('advantage_' . $i . '_title', $profile->{'advantage_' . $i . '_title'} ?? '') }}"
                                            placeholder="Contoh: Aman & Nyaman"
                                            class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                                    </div>

                                    {{-- Icon --}}
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Icon FA</label>
                                        <input type="text" name="advantage_{{ $i }}_icon"
                                            id="iconInput{{ $i }}"
                                            value="{{ old('advantage_' . $i . '_icon', $profile->{'advantage_' . $i . '_icon'} ?? '') }}"
                                            placeholder="shield, star, home..."
                                            oninput="updateIcon({{ $i }}, this.value)"
                                            class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition font-mono">
                                    </div>

                                    {{-- Deskripsi --}}
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Deskripsi</label>
                                        <textarea name="advantage_{{ $i }}_desc" rows="2"
                                            placeholder="Deskripsi singkat..."
                                            class="w-full border border-slate-200 rounded-lg px-3 py-2 text-sm text-slate-700 bg-white focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition resize-none">{{ old('advantage_' . $i . '_desc', $profile->{'advantage_' . $i . '_desc'} ?? '') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

                {{-- Card: Video --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-red-50 flex items-center justify-center">
                            <i class="fa-brands fa-youtube text-red-500 text-xs"></i>
                        </div>
                        <h2 class="font-bold text-slate-700 text-sm">Video YouTube</h2>
                    </div>
                    <div class="p-5 space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Link Video 1</label>
                            <textarea name="iframe_1" rows="2"
                                placeholder="https://www.youtube.com/watch?v=... atau paste link video"
                                class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition resize-none font-mono">{{ old('iframe_1', $profile->iframe_1 ?? '') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Link Video 2</label>
                            <textarea name="iframe_2" rows="2"
                                placeholder="https://www.youtube.com/watch?v=... atau paste link video"
                                class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition resize-none font-mono">{{ old('iframe_2', $profile->iframe_2 ?? '') }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Card: Lokasi --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                        <div class="flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-green-50 flex items-center justify-center">
                                <i class="fa-solid fa-location-dot text-green-500 text-xs"></i>
                            </div>
                            <h2 class="font-bold text-slate-700 text-sm">Lokasi Perusahaan</h2>
                        </div>
                        <button type="button" id="btnGps"
                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-green-50 hover:bg-green-100 text-green-600 text-xs font-semibold rounded-lg border border-green-100 transition-colors">
                            <i class="fa-solid fa-location-crosshairs text-[10px]"></i>
                            Gunakan Lokasi Saya
                        </button>
                    </div>
                    <div class="p-5 space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Latitude</label>
                                <div class="relative">
                                    <i class="fa-solid fa-arrows-up-down absolute left-3 top-1/2 -translate-y-1/2 text-slate-300 text-xs"></i>
                                    <input type="text" name="latitude" id="latInput"
                                        value="{{ old('latitude', $profile->latitude ?? '') }}"
                                        placeholder="-6.1900000"
                                        class="w-full border border-slate-200 rounded-lg pl-8 pr-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition font-mono">
                                </div>
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Longitude</label>
                                <div class="relative">
                                    <i class="fa-solid fa-arrows-left-right absolute left-3 top-1/2 -translate-y-1/2 text-slate-300 text-xs"></i>
                                    <input type="text" name="longitude" id="lngInput"
                                        value="{{ old('longitude', $profile->longitude ?? '') }}"
                                        placeholder="106.8266660"
                                        class="w-full border border-slate-200 rounded-lg pl-8 pr-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition font-mono">
                                </div>
                            </div>
                        </div>

                        <div id="map" class="w-full h-64 rounded-xl border border-slate-200 shadow-sm overflow-hidden"></div>
                        <p class="text-xs text-slate-400">
                            <i class="fa-solid fa-circle-info mr-1"></i>
                            Klik pada peta atau seret marker untuk menentukan lokasi
                        </p>
                    </div>
                </div>

            </div>

            {{-- ═══════════════ RIGHT (1/3) ═══════════════ --}}
            <div class="space-y-5">

                {{-- Card: Gambar --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-purple-50 flex items-center justify-center">
                            <i class="fa-solid fa-image text-purple-500 text-xs"></i>
                        </div>
                        <h2 class="font-bold text-slate-700 text-sm">Gambar Perusahaan</h2>
                    </div>
                    <div class="p-5 space-y-3">

                        {{-- Preview existing --}}
                        @if (!empty($profile->image))
                            <div id="currentImgWrap">
                                <img src="{{ asset('storage/' . $profile->image) }}"
                                     class="w-full rounded-xl border border-slate-100 object-cover">
                                <p class="text-[10px] text-slate-400 text-center mt-1">Gambar saat ini</p>
                            </div>
                        @endif

                        {{-- Preview baru --}}
                        <div id="newPreviewWrap" class="hidden">
                            <img id="newPreviewImg" src=""
                                 class="w-full rounded-xl border border-slate-200 object-cover">
                            <p class="text-[10px] text-blue-400 text-center mt-1">Gambar baru (belum tersimpan)</p>
                        </div>

                        {{-- Upload area --}}
                        <label class="flex flex-col items-center justify-center gap-2 border-2 border-dashed border-slate-200 hover:border-blue-300 rounded-xl px-4 py-6 cursor-pointer transition-colors group">
                            <i class="fa-solid fa-cloud-arrow-up text-2xl text-slate-300 group-hover:text-blue-400 transition-colors"></i>
                            <span class="text-xs font-medium text-slate-400 group-hover:text-blue-500 transition-colors text-center">
                                {{ !empty($profile->image) ? 'Klik untuk ganti gambar' : 'Klik untuk upload gambar' }}
                            </span>
                            <span class="text-[10px] text-slate-300">JPG, PNG, WEBP – maks 2MB</span>
                            <input type="file" name="image" class="hidden" accept="image/*"
                                   onchange="previewImg(this)">
                        </label>
                    </div>
                </div>

                {{-- Sticky Action Buttons --}}
                <div class="xl:sticky xl:top-20 space-y-3">
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                        <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                                <i class="fa-solid fa-floppy-disk text-blue-500 text-xs"></i>
                            </div>
                            <h2 class="font-bold text-slate-700 text-sm">Simpan Perubahan</h2>
                        </div>
                        <div class="p-5 space-y-3">
                            <p class="text-xs text-slate-400 leading-relaxed">
                                Perubahan akan langsung diterapkan di halaman utama website.
                            </p>
                            <button type="submit"
                                class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm shadow-blue-200">
                                <i class="fa-solid fa-floppy-disk text-xs"></i>
                                Simpan Perubahan
                            </button>
                            <a href="{{ route('admin.website-profile.index') }}"
                               class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 border border-slate-200 text-slate-600 hover:bg-slate-100 text-sm font-semibold rounded-lg transition-colors">
                                Batal
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>

    <script>
        // ── Map ──
        const latInput = document.getElementById('latInput');
        const lngInput = document.getElementById('lngInput');

        let lat = parseFloat(latInput.value) || -6.190000;
        let lng = parseFloat(lngInput.value) || 106.826666;

        const map = L.map('map').setView([lat, lng], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        const marker = L.marker([lat, lng], { draggable: true }).addTo(map);

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

        // ── Gambar preview ──
        function previewImg(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    document.getElementById('newPreviewImg').src = e.target.result;
                    document.getElementById('newPreviewWrap').classList.remove('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // ── Keunggulan icon live preview ──
        function updateIcon(i, val) {
            const clean = val.trim()
                .replace(/^fa-solid\s+/,'')
                .replace(/^fa-/,'')
                || 'question';
            document.getElementById('iconPreview' + i).className =
                'fa-solid fa-' + clean + ' text-blue-400 text-xs';
        }
    </script>

@endsection