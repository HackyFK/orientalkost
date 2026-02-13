@php use Illuminate\Support\Str; @endphp

@extends('user.layouts.app')

@section('content')

    <body class="bg-white">


        <!-- HERO SECTION -->
        <section id="home" class="relative min-h-screen flex items-center pt-20"
            style="background: linear-gradient(rgba(15, 30, 50, 0.7), rgba(30, 47, 77, 0.8)), url('https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=1920') center/cover;">

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 w-full">

                <!-- Brand -->
                <div class="text-center mb-6">
                    <h2 class="text-blue-400 font-semibold tracking-widest uppercase text-sm md:text-base">
                        Kost & Kamar
                    </h2>
                    <p class="text-text-gray text-sm md:text-base mt-1">
                        Murah • Aman • Strategis • Berkualitas
                    </p>
                </div>

                <!-- Headline -->
                <div class="text-center mb-12">
                    <h1 class="text-accent text-4xl md:text-6xl font-bold mb-6 leading-tight uppercase">
                        @yield('title', setting('site_name', 'KosKu'))<br>
                    </h1>
                    <p class="text-text-light text-lg md:text-xl max-w-2xl mx-auto">
                        {{ setting('site_tagline') }}
                    </p>
                </div>

                <form method="GET" action="{{ route('user.beranda') }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4 items-end">

                        <!-- Jenis Kos -->
                        <div class="space-y-2 lg:col-span-2">
                            <label class="text-sm font-medium text-gray-700">
                                Jenis Kos
                            </label>
                            <select name="jenis_sewa" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50">
                                <option value="">Semua Jenis</option>
                                <option value="Kos Putra">Kos Putra</option>
                                <option value="Kos Putri">Kos Putri</option>
                                <option value="Kos Campur">Kos Campur</option>
                            </select>
                        </div>

                        <select name="jenis_sewa">
                            <option value="">Semua</option>
                            <option value="Bulanan">Bulanan</option>
                            <option value="Tahunan">Tahunan</option>
                        </select>


                        <!-- Status -->
                        <div class="space-y-2">
                            <label class="text-sm font-medium text-gray-700">
                                Status
                            </label>
                            <select name="status_kamar"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50">
                                <option value="">Semua Status</option>
                                <option value="Tersedia">Tersedia</option>
                                <option value="tidakTersedia">Penuh</option>
                            </select>
                        </div>

                        <div class="flex gap-3 lg:col-span-2">
                            <button type="submit"
                                class="w-full bg-accent text-white px-5 py-3 rounded-xl font-semibold shadow-lg">
                                Filter
                            </button>
                        </div>
                        @if ($kosUnggulan->isEmpty())
                            <div class="text-center py-16">
                                <h2 class="text-xl font-semibold text-gray-600">
                                    😔 Maaf data tidak ditemukan
                                </h2>
                            </div>
                        @else
                            @foreach ($kosUnggulan as $kos)
                                <!-- card kos -->
                            @endforeach
                        @endif

                    </div>
                </form>




            </div>
        </section>






        <!-- PROFIL KAMI -->
        <section id="profil" class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="order-2 md:order-1">
                        <h2 class="text-4xl font-bold text-primary mb-6">Profil Kami</h2>
                        @if ($profile && $profile->description)
                            <p class="text-text-gray text-lg mb-6 leading-relaxed">
                                {{ $profile->description }}
                            </p>
                        @endif

                        @if ($profile)
                            <div class="space-y-6">

                                @for ($i = 1; $i <= 3; $i++)
                                    @php
                                        $title = $profile->{'advantage_' . $i . '_title'};
                                        $icon = $profile->{'advantage_' . $i . '_icon'};
                                        $desc = $profile->{'advantage_' . $i . '_desc'};
                                    @endphp

                                    @if ($title)
                                        <div class="flex items-start space-x-4">

                                            <div class="bg-accent-soft rounded-full p-3">
                                                @if ($icon)
                                                    <i class="fas fa-{{ $icon }} text-accent text-xl"></i>
                                                @else
                                                    <i class="fas fa-star text-accent text-xl"></i>
                                                @endif
                                            </div>

                                            <div>
                                                <h3 class="font-semibold text-primary text-lg">
                                                    {{ $title }}
                                                </h3>

                                                @if ($desc)
                                                    <p class="text-text-gray">
                                                        {{ $desc }}
                                                    </p>
                                                @endif
                                            </div>

                                        </div>
                                    @endif
                                @endfor

                            </div>
                        @endif

                    </div>

                    <div class="order-1 md:order-2 relative w-full flex items-center justify-center">

                        <!-- Frame dekoratif (belakang) -->
                        <div class="absolute inset-0 flex justify-center">
                            <div
                                class="w-[92%] md:w-[82%] h-[460px] md:h-[500px]
                    rounded-[2.5rem] bg-primary/10 blur-2xl">
                            </div>
                        </div>

                        <!-- Card Video -->
                        <div
                            class="relative z-10
                w-[95%] md:w-[85%]
                h-[480px] md:h-[520px]
                rounded-3xl overflow-hidden
                bg-black shadow-2xl ring-1 ring-white/10">


                            <!-- IFRAME 1 -->
                            @if ($iframe1)
                                <iframe id="mainVideo" class="w-full h-full" src="{{ $iframe1 }}"
                                    title="Video Profil Kos" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                                </iframe>
                            @endif


                            <!-- IFRAME 2 -->
                            @if ($iframe2)
                                <iframe id="mainVideo" class="w-full h-full" src="{{ $iframe2 }}"
                                    title="Video Profil Kos" frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen>
                                </iframe>
                            @endif


                            <!-- Overlay gradient bawah -->
                            <div
                                class="absolute inset-x-0 bottom-0 h-24
                    bg-gradient-to-t from-black/70 to-transparent pointer-events-none">
                            </div>

                        </div>

                        <!-- Arrow Left -->
                        <button onclick="prevVideo()"
                            class="absolute left-4 md:left-10 top-1/2 -translate-y-1/2
               w-12 h-12 rounded-full
               bg-black/60 backdrop-blur text-white
               flex items-center justify-center
               hover:bg-black/80 hover:scale-110 transition z-20">
                            <i class="fas fa-chevron-left"></i>
                        </button>

                        <!-- Arrow Right -->
                        <button onclick="nextVideo()"
                            class="absolute right-4 md:right-10 top-1/2 -translate-y-1/2
               w-12 h-12 rounded-full
               bg-black/60 backdrop-blur text-white
               flex items-center justify-center
               hover:bg-black/80 hover:scale-110 transition z-20">
                            <i class="fas fa-chevron-right"></i>
                        </button>

                    </div>


                </div>
            </div>
        </section>

        <!-- TIPE KAMAR -->
        <section id="tipe" class="py-20 bg-primary text-text-light">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold mb-4">Tipe Kamar Tersedia</h2>
                    <p class="text-text-gray text-lg">Pilih tipe kamar yang sesuai dengan kebutuhan Anda</p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                    @php
                        $iconMap = [
                            'Standard' => 'bed',
                            'AC' => 'wind',
                            'Kamar Mandi Dalam' => 'shower',
                            'Premium' => 'star',
                            'Eksklusif' => 'crown',
                            'WiFi' => 'wifi',
                            'Parkir' => 'parking',
                            'Water Heater' => 'fire',
                            'Kulkas Mini' => 'snowflake',
                            'TV' => 'tv',
                            'Kamar Mandi Luar' => 'restroom',
                            'Bathtub' => 'bath',
                        ];
                    @endphp

                    {{-- Tampilkan tipe kamar --}}
                    @foreach ($tipeKamarAll as $tipe)
                        <div
                            class="bg-secondary rounded-2xl p-6 text-center hover:bg-accent transition cursor-pointer group">

                            <div class="text-5xl mb-4">
                                <i class="fas fa-{{ $iconMap[$tipe->tipe_kamar] ?? 'bed' }}"></i>
                            </div>

                            <h3 class="font-semibold text-lg mb-2">
                                {{ $tipe->tipe_kamar }}
                            </h3>

                            <p class="text-accent-soft group-hover:text-white">
                                {{ $tipe->total }} Kamar
                            </p>
                        </div>
                    @endforeach


                    {{-- Tampilkan fasilitas kamar --}}
                    @foreach ($jumlahFasilitas as $nama => $fasil)
                        <div
                            class="bg-secondary rounded-2xl p-6 text-center hover:bg-accent transition cursor-pointer group">
                            <div class="text-5xl mb-4">
                                <i class="fas fa-{{ $iconMap[$nama] ?? 'star' }}"></i>
                            </div>
                            <h3 class="font-semibold text-lg mb-2">{{ $nama }}</h3>
                            <p class="text-accent-soft group-hover:text-white">{{ $fasil->kamars_count }} Kamar</p>
                        </div>
                    @endforeach
                </div>


            </div>
        </section>

        <section class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-primary mb-3">
                        Kos Unggulan
                    </h2>
                    <p class="text-text-gray">
                        Kos dengan like terbanyak dan paling diminati
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                    @foreach ($kosUnggulan as $item)
                        <div
                            class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300
                    overflow-hidden group flex flex-col">

                            <!-- Image -->
                            <div class="relative overflow-hidden h-64">
                                <img src="{{ $item->primaryImage
                                    ? asset('storage/' . $item->primaryImage->image_path)
                                    : 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=600' }}"
                                    alt="{{ $item->nama_kos }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            </div>

                            <!-- Content -->
                            <div class="p-6 flex flex-col">

                                <h3 class="text-2xl font-bold text-primary mb-2">
                                    {{ $item->nama_kos }}
                                </h3>

                                <p class="text-text-gray text-sm mb-3 line-clamp-2">
                                    {{ $item->deskripsi ?? 'Kos nyaman dengan fasilitas lengkap di lokasi strategis.' }}
                                </p>

                                <!-- Fasilitas -->
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm font-medium">
                                        <i class="fas fa-door-open text-accent mr-1"></i>
                                        {{ $item->kamars->count() }} Kamar
                                    </span>

                                    <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm font-medium">
                                        <i class="fas fa-wifi text-accent mr-1"></i>WiFi
                                    </span>

                                    <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm font-medium">
                                        <i class="fas fa-parking text-accent mr-1"></i>Parkir
                                    </span>

                                    <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm font-medium">
                                        <i class="fas fa-shield-alt text-accent mr-1"></i>Security
                                    </span>
                                </div>

                                <!-- Status -->
                                <div class="flex gap-3 mb-4">
                                    <span
                                        class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold flex items-center">
                                        <i class="fas fa-check-circle mr-2"></i>
                                        {{ $item->status ?? 'Tersedia' }}
                                    </span>

                                    <span
                                        class="bg-pink-100 text-pink-700 px-4 py-2 rounded-full text-sm font-semibold flex items-center">
                                        <i class="fas fa-venus mr-2"></i>
                                        {{ $item->jenis_kos ?? 'Campur' }}
                                    </span>
                                </div>

                                <!-- Like & Kamar -->
                                <div
                                    class="flex items-center justify-between mb-6
                            bg-gray-200/50 backdrop-blur-sm
                            px-4 py-2 rounded-xl">
                                    <button type="button"
                                        class="like-btn flex items-center gap-1
                                {{ auth()->check() && $item->likesUsers->contains(auth()->id()) ? 'text-red-500' : 'text-primary' }}"
                                        data-id="{{ $item->id }}"
                                        data-liked="{{ auth()->check() && $item->likesUsers->contains(auth()->id()) ? 'true' : 'false' }}">

                                        <i class="fas fa-heart"></i>
                                        <span class="like-count">
                                            {{ $item->likes_users_count }}
                                        </span>
                                    </button>

                                    <div class="flex items-center gap-2 text-sm text-purple-700 font-semibold">
                                        <i class="fas fa-bed"></i>
                                        <span>{{ $item->kamars->count() }} Kamar</span>
                                    </div>
                                </div>

                                <!-- Button -->
                                <a href="{{ route('user.kos.show', $item->id) }}"
                                    class="inline-flex items-center justify-center
                            bg-accent hover:bg-orange-600
                            text-white py-3 rounded-xl font-semibold transition shadow-lg">
                                    <i class="fas fa-eye mr-2"></i> Lihat Kamar
                                </a>

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

        </section>

        <!-- INFO KOS & LOKASI -->
        <section id="kos" class="py-20 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div>
                        @if ($profile && $profile->image)
                            <img src="{{ asset('storage/' . $profile->image) }}" alt="Lokasi Kos"
                                class="rounded-3xl shadow-2xl w-full h-[500px] object-cover">
                        @endif

                    </div>

                    <div>
                        <h2 class="text-4xl font-bold text-primary mb-6">Lokasi Strategis Kami</h2>
                        <div class="space-y-4 mb-8">
                            <div class="space-y-6">

                                <!-- Nama Perusahaan -->
                                <div class="flex items-start space-x-4">
                                    <div class=" p-3">
                                        <i class="fas fa-building text-accent text-xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-primary text-lg">Nama Perusahaan</h3>
                                        <p class="text-text-gray">
                                            {{ setting('site_name', 'KosKu') }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Alamat -->
                                <div class="flex items-start space-x-4">
                                    <div class=" p-3">
                                        <i class="fas fa-map-marker-alt text-accent text-xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-primary text-lg">Alamat</h3>
                                        <p class="text-text-gray">
                                            {!! nl2br(e(setting('contact_address'))) !!}
                                        </p>
                                    </div>
                                </div>

                                <!-- Nomor Telepon -->
                                <div class="flex items-start space-x-4">
                                    <div class=" p-3">
                                        <i class="fas fa-phone-alt text-accent text-xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-primary text-lg">Nomor Telepon</h3>
                                        <p class="text-text-gray">
                                            {{ setting('contact_phone') }}
                                        </p>
                                    </div>
                                </div>

                                <!-- Email -->
                                <div class="flex items-start space-x-4">
                                    <div class=" p-3">
                                        <i class="fas fa-envelope text-accent text-xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-primary text-lg">Email</h3>
                                        <p class="text-text-gray">
                                            {{ setting('contact_email') }}
                                        </p>
                                    </div>
                                </div>

                            </div>

                        </div>

                        @if ($profile && $profile->latitude && $profile->longitude)
                            <a href="https://www.google.com/maps?q={{ $profile->latitude }},{{ $profile->longitude }}"
                                target="_blank"
                                class="bg-accent hover:bg-orange-600 text-white px-8 py-4 rounded-xl font-semibold transition shadow-lg inline-flex items-center">
                                <i class="fas fa-location-arrow mr-2"></i>
                                Lihat di Maps
                            </a>
                        @else
                            <button
                                class="bg-gray-400 text-white px-8 py-4 rounded-xl font-semibold shadow-lg cursor-not-allowed"
                                disabled>
                                <i class="fas fa-location-arrow mr-2"></i>
                                Lokasi Belum Tersedia
                            </button>
                        @endif

                    </div>
                </div>
            </div>
        </section>

        <!-- GALERI KOS -->
        <section id="galeri" class="py-20 relative bg-cover bg-center"
            style="background-image: url('https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1600');">

            <!-- Overlay -->
            <div class="absolute inset-0 bg-primary/85"></div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Heading -->
                <div class="text-center mb-16 text-white">
                    <h2 class="text-4xl font-bold mb-4">
                        Galeri Kos & Kamar
                    </h2>
                    <p class="text-gray-200 text-lg">
                        Lihat suasana dan fasilitas kos dan kamar dari kami
                    </p>
                </div>

                <!-- Galeri Wrapper (Glass Effect) -->
                <div
                    class="bg-white/90 backdrop-blur-md rounded-[2.5rem] 
            p-8 md:p-14 lg:p-16 
            shadow-[0_25px_60px_-15px_rgba(0,0,0,0.35)]">

                    <!-- Masonry Auto Layout -->
                    <div class="columns-1 sm:columns-2 lg:columns-3 gap-6 space-y-6">

                        @foreach ($galeriTerbaru as $item)
                            <div class="break-inside-avoid relative overflow-hidden rounded-2xl group cursor-pointer">
                                <img src="{{ asset('storage/' . $item->gambar) }}"
                                    class="w-full object-cover transition duration-500 group-hover:scale-110">
                            </div>
                        @endforeach

                    </div>


                    <!-- Button -->
                    <div class="text-center mt-12">
                        <a href="{{ route('user.galeri') }}"
                            class="inline-flex items-center justify-center
              bg-accent hover:bg-orange-600
              text-white px-8 py-4 rounded-xl
              font-semibold transition shadow-lg">
                            Lihat Semua Galeri
                            <i class="fas fa-images ml-2"></i>
                        </a>
                    </div>


                </div>
            </div>
        </section>



        <section class="py-20 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-primary mb-4">Rating & Ulasan</h2>
                    <div class="flex items-center justify-center space-x-2 mb-4">

                        {{-- Bintang --}}
                        <div class="flex text-yellow-400 text-2xl">
                            @php
                                $fullStars = floor($averageRating);
                                $halfStar = $averageRating - $fullStars >= 0.5;
                            @endphp

                            @for ($i = 1; $i <= 5; $i++)
                                @if ($i <= $fullStars)
                                    <i class="fas fa-star"></i>
                                @elseif ($halfStar && $i == $fullStars + 1)
                                    <i class="fas fa-star-half-alt"></i>
                                @else
                                    <i class="far fa-star text-gray-300"></i>
                                @endif
                            @endfor
                        </div>

                        {{-- Angka --}}
                        <span class="text-3xl font-bold text-primary">
                            {{ number_format($averageRating, 1) }}
                        </span>

                        {{-- Total --}}
                        <span class="text-text-gray">
                            dari {{ $totalReview }} ulasan
                        </span>

                    </div>

                </div>
                <div class="grid md:grid-cols-4 gap-8">
                    @foreach ($reviewTerbaru as $item)
                        <div class="bg-gray-50 rounded-3xl p-8 shadow-lg">
                            <div class="flex items-center mb-4">
                                <img src="https://i.pravatar.cc/100?u={{ $item->user->id }}"
                                    class="w-14 h-14 rounded-full mr-4">
                                <div>
                                    <h4 class="font-semibold text-primary">
                                        {{ $item->user->name }}
                                    </h4>
                                    <div class="flex text-yellow-400">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star {{ $i <= $item->rating ? '' : 'text-gray-300' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <p class="text-text-gray">
                                "{{ $item->ulasan }}"
                            </p>

                            <p class="text-sm text-text-gray mt-4">
                                {{ $item->created_at->diffForHumans() }}
                            </p>
                        </div>
                    @endforeach
                </div>

            </div>
        </section>



        <!-- BLOG TERBARU -->
        <section id="blog" class="py-20 bg-gray-50">
            <div class="container mx-auto px-6">

                <div class="text-center mb-14">
                    <h2 class="text-3xl font-bold text-primary mb-4">
                        Blog & Tips Terbaru
                    </h2>
                    <p class="text-gray-500">
                        Artikel pilihan untuk kamu yang sedang mencari kos terbaik
                    </p>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">

                    @forelse ($blogs as $blog)
                        <article
                            class="bg-white rounded-2xl shadow-lg overflow-hidden 
                    transition duration-300 hover:-translate-y-2 hover:shadow-2xl">

                            <a href="{{ route('user.blog.show', $blog->slug) }}" class="block group">

                                {{-- IMAGE --}}
                                <div class="h-56 relative overflow-hidden">
                                    <img src="{{ $blog->gambar
                                        ? asset('storage/' . $blog->gambar)
                                        : 'https://images.unsplash.com/photo-1556912173-3bb406ef7e77?w=600&h=400&fit=crop' }}"
                                        alt="{{ $blog->judul }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                                    <span
                                        class="absolute top-4 left-4 bg-white/95 text-accent 
                                px-3 py-1.5 rounded-full text-xs font-semibold shadow">
                                        <i class="fas fa-newspaper mr-1"></i>
                                        {{ $blog->slug }}
                                    </span>
                                </div>

                                <div class="p-6">

                                    @php
                                        $wordCount = str_word_count(strip_tags($blog->isi));
                                        $readingTime = ceil($wordCount / 200);
                                    @endphp

                                    {{-- META --}}
                                    <div class="flex items-center gap-3 mb-3 text-xs text-gray-500">

                                        <div class="flex items-center gap-1">
                                            <i class="fas fa-calendar-alt text-accent"></i>
                                            <span>{{ $blog->published_at?->translatedFormat('d M Y') }}</span>
                                        </div>

                                        <span>•</span>

                                        <div
                                            class="flex items-center gap-1 px-2.5 py-1 
                                    bg-blue-50 text-blue-600 rounded-full font-medium">
                                            <i class="fas fa-clock text-blue-500"></i>
                                            <span>{{ $readingTime }} min</span>
                                        </div>

                                        <div
                                            class="flex items-center gap-1 px-2.5 py-1 
                                    bg-emerald-50 text-emerald-600 rounded-full font-medium">
                                            <i class="fas fa-eye text-emerald-500"></i>
                                            <span>{{ $blog->views ?? 0 }}</span>
                                        </div>

                                    </div>

                                    {{-- TITLE --}}
                                    <h3
                                        class="text-xl font-bold text-primary mb-3 leading-snug 
                                group-hover:text-accent transition">
                                        {{ $blog->judul }}
                                    </h3>

                                    {{-- RINGKASAN --}}
                                    <p class="text-gray-400 text-sm mb-6 leading-relaxed">
                                        {{ $blog->ringkasan }}
                                    </p>

                                </div>
                            </a>

                            {{-- FOOTER --}}
                            <div class="flex items-center justify-between px-6 pb-6">

                                {{-- AUTHOR --}}
                                <div class="flex items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($blog->author->name ?? 'Admin') }}&background=1E2F4D&color=fff"
                                        class="w-8 h-8 rounded-full">

                                    <span class="text-sm font-medium text-primary">
                                        {{ $blog->author->name ?? 'Admin' }}
                                    </span>
                                </div>

                                {{-- LIKE --}}
                                @auth
                                    <button type="button" onclick="event.stopPropagation(); toggleLike({{ $blog->id }})"
                                        id="like-btn-{{ $blog->id }}"
                                        class="flex items-center gap-2 px-3 py-1.5 
                                bg-gray-50 hover:bg-gray-100
                                text-gray-600 rounded-lg
                                transition duration-200 shadow-sm">

                                        <i class="fas fa-thumbs-up"></i>
                                        <span id="like-count-{{ $blog->id }}" class="text-sm font-semibold">
                                            {{ $blog->likes ?? 0 }}
                                        </span>
                                    </button>
                                @else
                                    <span class="text-xs text-gray-400">
                                        Login untuk menyukai blog
                                    </span>
                                @endauth

                            </div>

                        </article>

                    @empty
                        <div class="col-span-3 text-center text-gray-400">
                            Belum ada blog tersedia.
                        </div>
                    @endforelse

                </div>


                <div class="text-center mt-14">
                    <a href="{{ route('user.blog') }}"
                        class="inline-block bg-accent hover:bg-orange-600 
                text-white px-8 py-4 rounded-xl font-semibold 
                transition shadow-lg">
                        Lihat Semua Blog
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

            </div>
        </section>


        <!-- CTA BOOKING -->
        <section class="py-20 bg-primary text-text-light">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl md:text-5xl font-bold mb-6">Siap Menemukan Kos Impianmu?</h2>
                <p class="text-xl text-text-gray mb-8 max-w-2xl mx-auto">
                    Jangan lewatkan kesempatan untuk mendapatkan kamar terbaik. Booking sekarang dan dapatkan penawaran
                    spesial!
                </p>
                <button
                    class="bg-accent hover:bg-orange-600 text-white px-12 py-5 rounded-full text-xl font-bold transition shadow-2xl">
                    <i class="fas fa-calendar-check mr-3"></i>
                    Booking Sekarang
                </button>
                <p class="text-text-gray mt-6">

                    Hubungi kami: <span class="text-accent font-semibold">0812-3456-7890</span>
                </p>
            </div>
        </section>






        <script>
            const videos = [
                @if ($iframe1)
                    '{{ $iframe1 }}',
                @endif
                @if ($iframe2)
                    '{{ $iframe2 }}',
                @endif
            ];

            let index = 0;
            const iframe = document.getElementById('mainVideo');

            function updateVideo() {
                iframe.src = videos[index] + '?autoplay=1';
            }

            function nextVideo() {
                index = (index + 1) % videos.length;
                updateVideo();
            }

            function prevVideo() {
                index = (index - 1 + videos.length) % videos.length;
                updateVideo();
            }
        </script>

    </body>
@endsection
