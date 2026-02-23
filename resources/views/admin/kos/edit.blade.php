@extends('admin.layouts.app')

@section('content')
    {{-- VALIDATION ERRORS --}}
    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow rounded p-6 max-w-xl">
        <h1 class="text-2xl font-bold mb-4">Edit Kos</h1>

        {{-- SUCCESS --}}
        @if (session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        {{-- FORM UPDATE DATA --}}
        <form method="POST" action="{{ route('admin.kos.update', $ko) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label>Owner</label>
                <select name="owner_id" class="w-full border px-3 py-2">
                    <option value="">-- Pilih Owner --</option>
                    @foreach ($owners as $owner)
                        <option value="{{ $owner->id }}" @selected(old('owner_id', $ko->owner_id) == $owner->id)>
                            {{ $owner->name }} ({{ $owner->email }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>Nama Kos</label>
                <input name="nama_kos" class="w-full border px-3 py-2" value="{{ old('nama_kos', $ko->nama_kos) }}">
            </div>

            <div>
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="w-full border px-3 py-2" rows="3">{{ old('deskripsi', $ko->deskripsi) }}</textarea>
            </div>

            <div>
                <label>Alamat</label>
                <textarea name="alamat" class="w-full border px-3 py-2" rows="3">{{ old('alamat', $ko->alamat) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label>Latitude</label>
                    <input name="latitude" class="w-full border px-3 py-2" value="{{ old('latitude', $ko->latitude) }}">
                </div>

                <div>
                    <label>Longitude</label>
                    <input name="longitude" class="w-full border px-3 py-2" value="{{ old('longitude', $ko->longitude) }}">
                </div>
            </div>

            <div class="flex gap-2 mb-2">
                <button type="button" id="btnGps" class="px-4 py-2 bg-green-600 text-white rounded">
                    📍 Gunakan Lokasi Saya
                </button>
            </div>

            <div id="map" class="w-full h-64 rounded border"></div>



            <div>
                <label>Jenis Sewa</label>
                <select name="jenis_sewa" class="w-full border px-3 py-2">
                    <option value="bulanan" @selected(old('jenis_sewa', $ko->jenis_sewa) === 'bulanan')>
                        Bulanan
                    </option>

                    <option value="tahunan" @selected(old('jenis_sewa', $ko->jenis_sewa) === 'tahunan')>
                        Tahunan
                    </option>
                </select>
            </div>

            <div>
                <label>Foto Kos</label>
                <input type="file" name="images[]" multiple>
                        <p class="text-sm text-gray-500 mt-1">
            JPG, PNG, WEBP – max 2MB
        </p>
            </div>

            <button class="px-4 py-2 bg-blue-600 text-white rounded">
                Update Kos
            </button>
        </form>


        {{-- ==== IMAGE MANAGEMENT (DI LUAR FORM) ==== --}}
        <div class="flex gap-4 flex-wrap mt-6">
            @foreach ($ko->images as $img)
                <div class="w-28">
                    <img src="{{ asset('storage/' . $img->image_path) }}"
                        class="w-full h-20 object-cover rounded border mb-1">

                    <div class="flex gap-1">
                        @if ($img->is_primary)
                            <span class="bg-green-600 text-white text-xs px-2 rounded">Primary</span>
                        @else
                            <form method="POST" action="{{ route('admin.kos.image.primary', $img) }}">
                                @csrf
                                @method('PATCH')
                                <button class="bg-blue-600 text-white text-xs px-2 rounded">
                                    Primary
                                </button>
                            </form>
                        @endif

                        <form method="POST" action="{{ route('admin.kos.image.delete', $img) }}">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Hapus gambar?')"
                                class="bg-red-600 text-white text-xs px-2 rounded">✕</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        const latInput = document.querySelector('[name="latitude"]');
        const lngInput = document.querySelector('[name="longitude"]');

        let lat = latInput.value || -6.200000;
        let lng = lngInput.value || 106.816666;

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
