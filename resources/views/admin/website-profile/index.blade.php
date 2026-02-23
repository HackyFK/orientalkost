@extends('admin.layouts.app')

@section('content')
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

        @if ($profile)
            <!-- HEADER SECTION -->
            <div class="px-8 py-6 border-b bg-gray-50">
                <h2 class="text-lg font-semibold text-gray-700">
                    Informasi Home Page
                </h2>
            </div>



            <!-- BODY -->
            <div class="p-8 space-y-10">

                @if ($profile->image)
                    <div class="text-center">

                        <h3 class="text-sm font-semibold text-gray-500 mb-4 uppercase tracking-wide">
                            Gambar Perusahaan
                        </h3>

                        <div class="flex justify-center">
                            <img src="{{ asset('storage/' . $profile->image) }}"
                                class="w-full max-w-sm rounded-2xl shadow-xl border">
                        </div>

                    </div>
                @endif




                <!-- DESKRIPSI -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 mb-4 uppercase tracking-wide">
                        Deskripsi
                    </h3>

                    <div class="bg-gray-50 p-6 rounded-xl border text-gray-700 leading-relaxed">
                        {{ $profile->description }}
                    </div>
                </div>

                @if ($profile->iframe_1 || $profile->iframe_2)

                    <div class="grid md:grid-cols-2 gap-8 mt-10">

                        {{-- VIDEO 1 --}}
                        @if ($profile->iframe_1)
                            @php
                                preg_match('/(youtu\.be\/|v=)([^&]+)/', $profile->iframe_1, $matches);
                                $videoId1 = $matches[2] ?? null;
                            @endphp

                            @if ($videoId1)
                                <div class="aspect-video rounded-2xl overflow-hidden shadow-xl border">
                                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $videoId1 }}"
                                        title="Video 1" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            @endif
                        @endif


                        {{-- VIDEO 2 --}}
                        @if ($profile->iframe_2)
                            @php
                                preg_match('/(youtu\.be\/|v=)([^&]+)/', $profile->iframe_2, $matches);
                                $videoId2 = $matches[2] ?? null;
                            @endphp

                            @if ($videoId2)
                                <div class="aspect-video rounded-2xl overflow-hidden shadow-xl border">
                                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $videoId2 }}"
                                        title="Video 2" frameborder="0"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                        allowfullscreen>
                                    </iframe>
                                </div>
                            @endif
                        @endif

                    </div>

                @endif


                <!-- KEUNGGULAN -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-500 mb-4 uppercase tracking-wide">
                        Keunggulan
                    </h3>

                    <div class="overflow-x-auto">
                        <table class="min-w-full border rounded-xl overflow-hidden">





                            <div class="grid md:grid-cols-3 gap-8 mt-10">

                                @for ($i = 1; $i <= 3; $i++)
                                    @php
                                        $title = $profile->{'advantage_' . $i . '_title'};
                                        $icon = $profile->{'advantage_' . $i . '_icon'};
                                        $desc = $profile->{'advantage_' . $i . '_desc'};
                                    @endphp

                                    @if ($title)
                                        <div
                                            class="bg-white p-8 rounded-2xl shadow-lg border text-center hover:shadow-xl transition">

                                            @if ($icon)
                                                <div
                                                    class="w-16 h-16 mx-auto mb-5 flex items-center justify-center 
                                bg-blue-100 text-blue-600 rounded-full text-2xl">
                                                    <i class="fa-solid fa-{{ $icon }}"></i>
                                                </div>
                                            @endif

                                            <h3 class="font-semibold text-lg text-gray-800 mb-3">
                                                {{ $title }}
                                            </h3>

                                            @if ($desc)
                                                <p class="text-gray-500 text-sm leading-relaxed">
                                                    {{ $desc }}
                                                </p>
                                            @endif

                                        </div>
                                    @endif
                                @endfor

                            </div>



                        </table>
                    </div>
                </div>

                @if ($profile && !is_null($profile->latitude) && !is_null($profile->longitude))
                    <div class="mt-10">

                        <div class="mt-10">
                            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">

                                <div class="flex items-center gap-3 mb-6">
                                    <div
                                        class="w-12 h-12 flex items-center justify-center rounded-xl bg-blue-100 text-blue-600 text-xl shadow">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-800">
                                            Lokasi Perusahaan
                                        </h3>
                                        <p class="text-sm text-gray-500">
                                            Koordinat lokasi perusahaan yang tersimpan
                                        </p>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="bg-gray-50 p-4 rounded-xl border">
                                        <p class="text-xs text-gray-500 uppercase tracking-wide">
                                            Latitude
                                        </p>
                                        <p class="text-lg font-semibold text-gray-800 mt-1">
                                            {{ $profile->latitude ?? '-' }}
                                        </p>
                                    </div>

                                    <div class="bg-gray-50 p-4 rounded-xl border">
                                        <p class="text-xs text-gray-500 uppercase tracking-wide">
                                            Longitude
                                        </p>
                                        <p class="text-lg font-semibold text-gray-800 mt-1">
                                            {{ $profile->longitude ?? '-' }}
                                        </p>
                                    </div>
                                </div>

                            </div>
                        </div>


                        <div id="adminCompanyMap" class="w-full h-80 rounded-xl border shadow">
                        </div>

                        <div class="mt-4">
                            <a href="https://www.google.com/maps?q={{ $profile->latitude }},{{ $profile->longitude }}"
                                target="_blank"
                                class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                Lihat di Google Maps
                            </a>
                        </div>

                    </div>
                @endif




                <div class="flex justify-end mt-6">
                    <a href="{{ route('admin.website-profile.edit') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow">
                        Edit Home
                    </a>
                </div>

            </div>
        @else
            <div class="p-8 text-center text-gray-500">
                Belum ada profil website.
            </div>
        @endif

    </div>
    @if (!empty($profile->latitude) && !empty($profile->longitude))
        <script>
            const adminLat = {{ $profile->latitude }};
            const adminLng = {{ $profile->longitude }};

            const adminMap = L.map('adminCompanyMap').setView([adminLat, adminLng], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap'
            }).addTo(adminMap);

            L.marker([adminLat, adminLng]).addTo(adminMap);
        </script>
    @endif


@endsection
