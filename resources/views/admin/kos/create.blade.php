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
        <h1 class="text-2xl font-bold mb-4">Tambah Kos</h1>

        <form method="POST" action="{{ route('admin.kos.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div class="space-y-4">

                <div>
                    <label>Owner</label>
                    <select name="owner_id" class="w-full border px-3 py-2">
                        <option value="">-- Pilih Owner --</option>
                        @foreach ($owners as $owner)
                            <option value="{{ $owner->id }}" @selected(old('owner_id') == $owner->id)>
                                {{ $owner->name }} ({{ $owner->email }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label>Nama Kos</label>
                    <input name="nama_kos" class="w-full border px-3 py-2">
                </div>

                <div>
                    <label>Deskripsi</label>
                    <textarea name="deskripsi" class="w-full border px-3 py-2"></textarea>
                </div>

                <div>
                    <label>Alamat</label>
                    <textarea name="alamat" class="w-full border px-3 py-2"></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label>Latitude</label>
                        <input name="latitude" class="w-full border px-3 py-2">
                    </div>
                    <div>
                        <label>Longitude</label>
                        <input name="longitude" class="w-full border px-3 py-2">
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
                        <option value="bulanan">Bulanan</option>
                        <option value="tahunan">Tahunan</option>
                    </select>
                </div>

                <div>
                    <label>Foto Kos</label>
                    <input type="file" name="images[]" multiple>
                </div>
            </div>


            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
        </form>
    </div>

    <script>
        const latInput = document.querySelector('[name="latitude"]');
        const lngInput = document.querySelector('[name="longitude"]');

        let lat = latInput.value || -7.797068;
        let lng = lngInput.value || 110.370529;

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
