@extends('user.layouts.app')

@section('content')

    <body class="bg-gray-50">



        <!-- HERO SECTION -->
        <section class="relative pt-32 pb-20 text-text-light overflow-hidden">

            <!-- Background Image -->
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=1920" alt="Kos Modern"
                    class="w-full h-full object-cover">
            </div>

            <!-- Overlay Gradient -->
            <div class="absolute inset-0 bg-gradient-to-br from-primary/90 via-primary/70 to-secondary/90"></div>

            <!-- Decorative Blur -->
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-accent/30 rounded-full blur-3xl"></div>
            <div class="absolute top-1/3 -right-24 w-80 h-80 bg-orange-400/20 rounded-full blur-3xl"></div>

            <!-- Content -->
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">

                    <!-- Badge -->
                    <span
                        class="inline-flex items-center px-4 py-2 mb-6 rounded-full bg-white/10 backdrop-blur-md text-sm font-semibold tracking-wide">
                        <i class="fas fa-home mr-2 text-accent"></i>
                        Kos Terbaik Kami
                    </span>

                    <h1 class="text-4xl md:text-6xl font-extrabold mb-6 leading-tight drop-shadow-xl">
                        Daftar <span class="text-accent">Kos</span><br class="hidden md:block">
                        Tersedia
                    </h1>

                    <p class="text-lg md:text-xl text-text-light/60 max-w-3xl mx-auto leading-relaxed">
                        Temukan kos nyaman, aman, dan modern dari berbagai
                        lokasi strategis dengan fasilitas lengkap dan harga terbaik
                    </p>

                </div>
            </div>

        </section>


        <!-- FILTER SECTION -->
        <section class="py-6 bg-white shadow-md top-20 z-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Filter Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-6 gap-4 items-end">

                    <!-- Jenis Kos -->
                    <div class="space-y-2 lg:col-span-2">
                        <label class="text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-venus-mars text-accent mr-2"></i>
                            Jenis Kos
                        </label>
                        <select
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50
                           focus:border-accent focus:ring-2 focus:ring-accent-soft outline-none transition">
                            <option>Semua Jenis</option>
                            <option>Kos Putra</option>
                            <option>Kos Putri</option>
                            <option>Kos Campur</option>
                        </select>
                    </div>

                    <!-- Fasilitas -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-concierge-bell text-accent mr-2"></i>
                            Fasilitas
                        </label>
                        <select
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50
                           focus:border-accent focus:ring-2 focus:ring-accent-soft outline-none transition">
                            <option>Semua</option>
                            <option>WiFi</option>
                            <option>Parkir</option>
                            <option>Dapur</option>
                            <option>Laundry</option>
                        </select>
                    </div>

                    <!-- Status -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-check-circle text-accent mr-2"></i>
                            Status
                        </label>
                        <select
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50
                           focus:border-accent focus:ring-2 focus:ring-accent-soft outline-none transition">
                            <option>Semua Status</option>
                            <option>Tersedia</option>
                            <option>Penuh</option>
                        </select>
                    </div>

                    <!-- Button -->
                    <div class="flex gap-3 lg:col-span-2">

                        <button
                            class="w-full bg-accent hover:bg-orange-600 text-white px-5 py-3
                           rounded-xl font-semibold transition shadow-lg
                           flex items-center justify-center">
                            <i class="fas fa-search mr-2"></i>
                            Filter
                        </button>
                    </div>
                </div>

                <!-- Result Info -->
                <div class="mt-4 text-sm text-text-gray text-center md:text-left">
                    Menampilkan <span class="font-semibold text-primary">12 kos</span> dari total 15 kos
                </div>

            </div>
        </section>


        <!-- KOS CARDS GRID -->
        <section class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                    @foreach ($kos as $item)
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

                                <!-- Fasilitas (STATIS) -->
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

                                <!-- Status (STATIS) -->
                                <div class="flex gap-3 mb-4">
                                    <span
                                        class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold flex items-center">
                                        <i class="fas fa-check-circle mr-2"></i>Tersedia
                                    </span>
                                    <span
                                        class="bg-pink-100 text-pink-700 px-4 py-2 rounded-full text-sm font-semibold flex items-center">
                                        <i class="fas fa-venus mr-2"></i>Putri
                                    </span>
                                </div>

                                <!-- Rating & Kamar Tersedia (STATIS) -->
                                <div
                                    class="flex items-center justify-between mb-8
                            bg-gray-200/50 backdrop-blur-sm
                            px-4 py-2 rounded-xl">

                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-star text-yellow-400"></i>
                                        <span class="font-bold text-primary">4.8</span>
                                        <span class="text-sm text-text-gray">(127)</span>
                                    </div>

                                    <div class="flex items-center gap-2 text-sm text-purple-700 font-semibold">
                                        <i class="fas fa-bed"></i>
                                        <span>{{ $item->kamars->count() }} Kamar Tersedia</span>
                                    </div>
                                </div>

                                <!-- Button -->
                                <a href="{{ route('user.kos.show', $item->id) }}"
                                    class="inline-flex items-center justify-center bg-accent hover:bg-orange-600
          text-white py-3 rounded-xl font-semibold transition shadow-lg">
                                    <i class="fas fa-eye mr-2"></i> Lihat Kamar
                                </a>

                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>


        <!-- Pagination -->
        <div class="flex justify-center items-center space-x-2 mt-12">
            <button
                class="w-10 h-10 rounded-lg border-2 border-gray-300 hover:border-accent hover:bg-accent hover:text-white transition flex items-center justify-center">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="w-10 h-10 rounded-lg bg-accent text-white font-semibold">1</button>
            <button
                class="w-10 h-10 rounded-lg border-2 border-gray-300 hover:border-accent hover:bg-accent hover:text-white transition">2</button>
            <button
                class="w-10 h-10 rounded-lg border-2 border-gray-300 hover:border-accent hover:bg-accent hover:text-white transition flex items-center justify-center">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
        </div>
        </section>

        <!-- CTA SECTION -->
        <section class="py-16 bg-primary text-text-light">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Butuh Bantuan Menemukan Kos?</h2>
                <p class="text-lg text-text-gray mb-8">
                    Tim kami siap membantu Anda menemukan kos yang sempurna sesuai kebutuhan dan budget
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button
                        class="bg-accent hover:bg-orange-600 text-white px-8 py-4 rounded-xl font-semibold transition shadow-lg">
                        <i class="fas fa-phone-alt mr-2"></i>Hubungi Kami
                    </button>
                    <button
                        class="bg-white hover:bg-gray-100 text-primary px-8 py-4 rounded-xl font-semibold transition shadow-lg">
                        <i class="fab fa-whatsapp mr-2"></i>Chat WhatsApp
                    </button>
                </div>
            </div>
        </section>

        <!-- Scroll to Top Button -->
        <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
            class="fixed bottom-8 right-8 bg-accent hover:bg-orange-600 text-white w-14 h-14 rounded-full shadow-2xl flex items-center justify-center transition z-50">
            <i class="fas fa-arrow-up text-xl"></i>
        </button>
    </body>
@endsection
