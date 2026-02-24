@extends('admin.layouts.app')

@section('page-title', 'Profil Website')

@section('content')
{{-- SUCCESS MESSAGE --}}
    @if (session('success'))
        <div
            class="mb-5 flex items-center gap-3 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm font-medium">
            <i class="fa-solid fa-circle-check text-green-500"></i>
            {{ session('success') }}
        </div>
    @endif
    @if ($profile)

        {{-- PAGE HEADER --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-xl font-bold text-slate-800">Profil Website</h1>
                <p class="text-sm text-slate-400 mt-0.5">Informasi tampilan halaman utama</p>
            </div>
            <a href="{{ route('admin.website-profile.edit') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm shadow-blue-200">
                <i class="fa-solid fa-pen text-xs"></i>
                Edit Profil
            </a>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-5">

            {{-- ═══════════════ LEFT (2/3) ═══════════════ --}}
            <div class="xl:col-span-2 space-y-5">

                {{-- Card: Deskripsi --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                            <i class="fa-solid fa-align-left text-blue-500 text-xs"></i>
                        </div>
                        <h2 class="font-bold text-slate-700 text-sm">Deskripsi</h2>
                    </div>
                    <div class="p-5">
                        <p class="text-sm text-slate-600 leading-relaxed">
                            {{ $profile->description ?? '-' }}
                        </p>
                    </div>
                </div>

                {{-- Card: Video --}}
                @if ($profile->iframe_1 || $profile->iframe_2)
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                        <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-lg bg-red-50 flex items-center justify-center">
                                <i class="fa-brands fa-youtube text-red-500 text-xs"></i>
                            </div>
                            <h2 class="font-bold text-slate-700 text-sm">Video</h2>
                        </div>
                        <div class="p-5 grid sm:grid-cols-2 gap-4">
                            @foreach (['iframe_1', 'iframe_2'] as $field)
                                @if ($profile->$field)
                                    @php
                                        preg_match('/(youtu\.be\/|v=)([^&]+)/', $profile->$field, $matches);
                                        $videoId = $matches[2] ?? null;
                                    @endphp
                                    @if ($videoId)
                                        <div class="aspect-video rounded-xl overflow-hidden border border-slate-200 shadow-sm">
                                            <iframe class="w-full h-full"
                                                src="https://www.youtube.com/embed/{{ $videoId }}"
                                                frameborder="0"
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                allowfullscreen>
                                            </iframe>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Card: Keunggulan --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-amber-50 flex items-center justify-center">
                            <i class="fa-solid fa-trophy text-amber-500 text-xs"></i>
                        </div>
                        <h2 class="font-bold text-slate-700 text-sm">Keunggulan</h2>
                    </div>
                    <div class="p-5 grid sm:grid-cols-3 gap-4">
                        @for ($i = 1; $i <= 3; $i++)
                            @php
                                $title = $profile->{'advantage_' . $i . '_title'};
                                $icon  = $profile->{'advantage_' . $i . '_icon'};
                                $desc  = $profile->{'advantage_' . $i . '_desc'};
                            @endphp
                            @if ($title)
                                <div class="flex flex-col items-center text-center p-5 rounded-xl border border-slate-100 bg-slate-50 hover:bg-white hover:border-blue-200 hover:shadow-sm transition-all duration-150">
                                    @if ($icon)
                                        <div class="w-12 h-12 mb-4 flex items-center justify-center bg-blue-50 text-blue-500 rounded-xl text-lg border border-blue-100">
                                            <i class="fa-solid fa-{{ $icon }}"></i>
                                        </div>
                                    @endif
                                    <h3 class="font-bold text-slate-800 text-sm mb-1.5">{{ $title }}</h3>
                                    @if ($desc)
                                        <p class="text-xs text-slate-500 leading-relaxed">{{ $desc }}</p>
                                    @endif
                                </div>
                            @endif
                        @endfor
                    </div>
                </div>

                {{-- Card: Lokasi Map --}}
                @if (!is_null($profile->latitude) && !is_null($profile->longitude))
                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                        <div class="px-5 py-4 border-b border-slate-100 flex items-center justify-between">
                            <div class="flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-lg bg-green-50 flex items-center justify-center">
                                    <i class="fa-solid fa-location-dot text-green-500 text-xs"></i>
                                </div>
                                <h2 class="font-bold text-slate-700 text-sm">Lokasi Perusahaan</h2>
                            </div>
                            <a href="https://www.google.com/maps?q={{ $profile->latitude }},{{ $profile->longitude }}"
                               target="_blank"
                               class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 text-xs font-semibold rounded-lg border border-blue-100 transition-colors">
                                <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                                Google Maps
                            </a>
                        </div>

                        {{-- Koordinat --}}
                        <div class="px-5 pt-4 pb-3 grid grid-cols-2 gap-3">
                            <div class="bg-slate-50 border border-slate-100 rounded-lg px-4 py-3">
                                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Latitude</p>
                                <p class="text-sm font-semibold text-slate-700 mt-0.5 font-mono">{{ $profile->latitude }}</p>
                            </div>
                            <div class="bg-slate-50 border border-slate-100 rounded-lg px-4 py-3">
                                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Longitude</p>
                                <p class="text-sm font-semibold text-slate-700 mt-0.5 font-mono">{{ $profile->longitude }}</p>
                            </div>
                        </div>

                        {{-- Map --}}
                        <div class="px-5 pb-5">
                            <div id="adminCompanyMap" class="w-full h-64 rounded-xl border border-slate-200 shadow-sm overflow-hidden"></div>
                        </div>
                    </div>
                @endif

            </div>

            {{-- ═══════════════ RIGHT (1/3) ═══════════════ --}}
            <div class="space-y-5">

                {{-- Card: Gambar Perusahaan --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-purple-50 flex items-center justify-center">
                            <i class="fa-solid fa-image text-purple-500 text-xs"></i>
                        </div>
                        <h2 class="font-bold text-slate-700 text-sm">Gambar Perusahaan</h2>
                    </div>
                    <div class="p-4">
                        @if ($profile->image)
                            <img src="{{ asset('storage/' . $profile->image) }}"
                                 class="w-full rounded-xl border border-slate-100 shadow-sm object-cover">
                        @else
                            <div class="w-full h-36 rounded-xl bg-slate-50 border border-dashed border-slate-200 flex flex-col items-center justify-center gap-2">
                                <i class="fa-regular fa-image text-2xl text-slate-300"></i>
                                <span class="text-xs text-slate-400">Belum ada gambar</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Card: Info Singkat --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-indigo-50 flex items-center justify-center">
                            <i class="fa-solid fa-circle-info text-indigo-500 text-xs"></i>
                        </div>
                        <h2 class="font-bold text-slate-700 text-sm">Info Singkat</h2>
                    </div>
                    <div class="p-4 space-y-3">
                        <div class="flex items-center justify-between text-xs py-2 border-b border-slate-50">
                            <span class="text-slate-400 font-medium">Video 1</span>
                            <span class="{{ $profile->iframe_1 ? 'text-green-500' : 'text-slate-300' }} font-semibold">
                                {{ $profile->iframe_1 ? 'Ada' : 'Kosong' }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between text-xs py-2 border-b border-slate-50">
                            <span class="text-slate-400 font-medium">Video 2</span>
                            <span class="{{ $profile->iframe_2 ? 'text-green-500' : 'text-slate-300' }} font-semibold">
                                {{ $profile->iframe_2 ? 'Ada' : 'Kosong' }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between text-xs py-2 border-b border-slate-50">
                            <span class="text-slate-400 font-medium">Keunggulan</span>
                            @php $totalKeunggulan = collect([1,2,3])->filter(fn($i) => $profile->{'advantage_'.$i.'_title'})->count(); @endphp
                            <span class="text-slate-700 font-semibold">{{ $totalKeunggulan }} / 3</span>
                        </div>
                        <div class="flex items-center justify-between text-xs py-2">
                            <span class="text-slate-400 font-medium">Lokasi</span>
                            <span class="{{ ($profile->latitude && $profile->longitude) ? 'text-green-500' : 'text-slate-300' }} font-semibold">
                                {{ ($profile->latitude && $profile->longitude) ? 'Tersimpan' : 'Belum' }}
                            </span>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    @else
        {{-- Empty state --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm px-5 py-20 text-center">
            <div class="flex flex-col items-center gap-3 text-slate-300">
                <i class="fa-solid fa-globe text-5xl"></i>
                <p class="text-sm font-medium text-slate-400">Belum ada profil website</p>
                <a href="{{ route('admin.website-profile.edit') }}"
                   class="mt-2 inline-flex items-center gap-2 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg transition-colors">
                    <i class="fa-solid fa-plus text-[10px]"></i>
                    Buat Profil
                </a>
            </div>
        </div>
    @endif

    {{-- Leaflet Map Script --}}
    @if (!empty($profile->latitude) && !empty($profile->longitude))
        <script>
            const adminLat = {{ $profile->latitude }};
            const adminLng = {{ $profile->longitude }};

            const adminMap = L.map('adminCompanyMap').setView([adminLat, adminLng], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(adminMap);

            L.marker([adminLat, adminLng]).addTo(adminMap)
                .bindPopup('<b>Lokasi Perusahaan</b>')
                .openPopup();
        </script>
    @endif

@endsection