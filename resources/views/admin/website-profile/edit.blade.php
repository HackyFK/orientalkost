@extends('admin.layouts.app')

@section('content')
    <div class="container mx-auto px-6 py-10">

        <h1 class="text-2xl font-bold text-gray-800 mb-8">
            Edit Home Website
        </h1>

        <div class="bg-white rounded-2xl shadow-lg p-8">

                <form action="{{ route('admin.website-profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <label class="block font-semibold mb-2">
                        Gambar Perusahaan
                    </label>

                    <input type="file" name="image" class="w-full border rounded-lg px-4 py-2">

                    @if (!empty($profile->image))
                        <div class="mt-4">
                            <img src="{{ asset('storage/' . $profile->image) }}" class="w-40 rounded-lg shadow">
                        </div>
                    @endif
                </div>


                <!-- DESKRIPSI -->
                <div class="mb-8">
                    <label class="block font-semibold mb-2">
                        Deskripsi Perusahaan
                    </label>

                    <textarea name="description" rows="5" class="w-full border rounded-lg px-4 py-3 focus:ring focus:ring-blue-200">{{ old('description', $profile->description ?? '') }}</textarea>
                </div>


                <!-- KEUNGGULAN -->
                <h2 class="text-lg font-semibold mb-4">Keunggulan</h2>

                @for ($i = 1; $i <= 3; $i++)
                    <div class="grid md:grid-cols-3 gap-6 mb-6">

                        <!-- TITLE -->
                        <div>
                            <label class="block font-semibold mb-2">
                                Keunggulan {{ $i }}
                            </label>

                            <input type="text" name="advantage_{{ $i }}_title"
                                value="{{ old('advantage_' . $i . '_title', $profile->{'advantage_' . $i . '_title'} ?? '') }}"
                                class="w-full border rounded-lg px-4 py-3">
                        </div>

                        <!-- ICON -->
                        <div>
                            <label class="block font-semibold mb-2">
                                Icon
                            </label>

                            <input type="text" name="advantage_{{ $i }}_icon"
                                value="{{ old('advantage_' . $i . '_icon', $profile->{'advantage_' . $i . '_icon'} ?? '') }}"
                                class="w-full border rounded-lg px-4 py-3">
                        </div>

                        <!-- DESCRIPTION -->
                        <div>
                            <label class="block font-semibold mb-2">
                                Deskripsi Singkat
                            </label>

                            <textarea name="advantage_{{ $i }}_desc" rows="2" class="w-full border rounded-lg px-4 py-3">{{ old('advantage_' . $i . '_desc', $profile->{'advantage_' . $i . '_desc'} ?? '') }}</textarea>
                        </div>

                    </div>
                @endfor


                <!-- IFRAME 1 -->
                <div class="mb-6">
                    <label class="block font-semibold mb-2">
                        Link Iframe 1
                    </label>

                    <textarea name="iframe_1" rows="3" class="w-full border rounded-lg px-4 py-3 focus:ring focus:ring-blue-200"
                        placeholder="Paste iframe embed code di sini...">{{ old('iframe_1', $profile->iframe_1 ?? '') }}</textarea>
                </div>

                <!-- IFRAME 2 -->
                <div class="mb-6">
                    <label class="block font-semibold mb-2">
                        Link Iframe 2
                    </label>

                    <textarea name="iframe_2" rows="3" class="w-full border rounded-lg px-4 py-3 focus:ring focus:ring-blue-200"
                        placeholder="Paste iframe embed code di sini...">{{ old('iframe_2', $profile->iframe_2 ?? '') }}</textarea>
                </div>

                {{-- Maps --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label>Latitude</label>
                        <input name="latitude" value="{{ old('latitude', $profile->latitude ?? '') }}"
                            class="w-full border px-3 py-2 rounded">
                    </div>
                    <div>
                        <label>Longitude</label>
                        <input name="longitude" value="{{ old('longitude', $profile->longitude ?? '') }}"
                            class="w-full border px-3 py-2 rounded">
                    </div>
                </div>

                <div class="flex gap-2 mb-4">
                    <button type="button" id="btnGps"
                        class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                        📍 Gunakan Lokasi Saya
                    </button>
                </div>

                <div id="map" class="w-full h-64 rounded border"></div>


                <div class="mt-8 flex gap-4">

                    <!-- Tombol Kembali -->
                    <a href="{{ route('admin.website-profile.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg shadow">
                        Kembali
                    </a>

                    <!-- Tombol Simpan -->
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow">
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>
    <script>
        const latInput = document.querySelector('[name="latitude"]');
        const lngInput = document.querySelector('[name="longitude"]');

        let lat = latInput.value || -6.1900000; // default Jakarta
        let lng = lngInput.value || 106.8266660;

        const map = L.map('map').setView([lat, lng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap'
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
                () => alert('Gagal mengambil lokasi')
            );
        });
    </script>
@endsection
