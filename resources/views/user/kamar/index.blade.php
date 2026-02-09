@extends('user.layouts.app')

@section('content')

    <body class="bg-gray-50">

        <!-- HERO SECTION -->
        <section class="relative pt-32 pb-20 text-text-light overflow-hidden">

            <!-- Background Image (TETAP) -->
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=1920" alt="Kos Modern"
                    class="w-full h-full object-cover">
            </div>

            <!-- Overlay Gradient -->
            <div class="absolute inset-0 bg-gradient-to-br from-primary/80 via-primary/70 to-secondary/80"></div>

            <!-- Content -->
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">

                    <!-- Badge -->
                    <div
                        class="inline-flex items-center gap-2 mb-6 px-5 py-2
                       bg-white/15 backdrop-blur-md
                       rounded-full text-sm font-semibold">
                        <i class="fas fa-bed text-accent"></i>
                        Kamar Siap Huni
                    </div>

                    <!-- Title -->
                    <h1
                        class="text-4xl md:text-6xl font-extrabold mb-6
           leading-tight tracking-tight drop-shadow-xl">

                        Data
                        <span class="text-accent bg-clip-text ">
                            Kamar
                        </span>
                        <br class="hidden sm:block">

                        <span class="text-white">
                            Tersedia Hari Ini
                        </span>
                    </h1>


                    <p class="text-lg md:text-xl text-text-light/60 max-w-3xl mx-auto leading-relaxed">
                        Temukan kos nyaman, aman, dan modern dari berbagai
                        lokasi strategis dengan fasilitas lengkap dan harga terbaik
                    </p>

                </div>
            </div>
        </section>




        <!-- FILTER SECTION -->
        <section class="py-8 bg-white shadow-md top-20 z-40">
            <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

                <div class="bg-white rounded-3xl shadow-xl p-6 md:p-8">

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                        <!-- Tipe Kamar -->
                        <div class="space-y-1">
                            <label class="text-sm font-semibold text-gray-700">
                                Tipe Kamar
                            </label>
                            <select
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50
                               focus:border-accent focus:ring-2 focus:ring-accent-soft outline-none transition">
                                <option>Semua Tipe</option>
                                <option>Standard</option>
                                <option>AC</option>
                                <option>KM Dalam</option>
                                <option>Premium</option>
                            </select>
                        </div>

                        <!-- Rentang Harga -->
                        <div class="space-y-1">
                            <label class="text-sm font-semibold text-gray-700">
                                Rentang Harga
                            </label>
                            <select
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50
                               focus:border-accent focus:ring-2 focus:ring-accent-soft outline-none transition">
                                <option>Semua Harga</option>
                                <option>
                                    < Rp 1 juta</option>
                                <option>Rp 1-2 juta</option>
                                <option>Rp 2-3 juta</option>
                                <option>> Rp 3 juta</option>
                            </select>
                        </div>

                        <!-- AC -->
                        <div class="space-y-1">
                            <label class="text-sm font-semibold text-gray-700">
                                AC
                            </label>
                            <select
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50
                               focus:border-accent focus:ring-2 focus:ring-accent-soft outline-none transition">
                                <option>Semua</option>
                                <option>Dengan AC</option>
                                <option>Tanpa AC</option>
                            </select>
                        </div>

                        <!-- Kamar Mandi -->
                        <div class="space-y-1">
                            <label class="text-sm font-semibold text-gray-700">
                                Kamar Mandi
                            </label>
                            <select
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 bg-gray-50
                               focus:border-accent focus:ring-2 focus:ring-accent-soft outline-none transition">
                                <option>Semua</option>
                                <option>KM Dalam</option>
                                <option>KM Luar</option>
                            </select>
                        </div>



                    </div>
                    <div class="bg-white rounded-3xl p-6 md:p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                            <!-- isi filter kamu (TIDAK PERLU DIUBAH) -->
                        </div>

                        <!-- Filter Button & Results Count -->
                        <div class="flex flex-col md:flex-row justify-between items-center mt-6 gap-4">
                            <div class="text-text-gray">
                                Menampilkan <span class="font-semibold text-primary">18 kamar</span> dari total 24 kamar
                            </div>
                            <div class="flex gap-3">
                                <button
                                    class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-xl font-medium transition">
                                    <i class="fas fa-redo mr-2"></i>Reset Filter
                                </button>
                                <button
                                    class="bg-accent hover:bg-orange-600 text-white px-6 py-3 rounded-xl font-semibold transition shadow-lg">
                                    <i class="fas fa-search mr-2"></i>Terapkan Filter
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>


        <!-- ROOM CARDS GRID -->
        <section class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                    <!-- Room Card 1 -->
                    <div
                        class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group">
                        <div class="relative overflow-hidden h-64">
                            <img src="https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=600"
                                alt="Kamar Premium A1"
                                class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            <div
                                class="absolute top-4 left-4 bg-green-500 text-white px-4 py-2 rounded-full font-semibold flex items-center shadow-lg">
                                <i class="fas fa-check-circle mr-2"></i>Tersedia
                            </div>

                        </div>
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-accent tracking-tight mb-2">Kamar Premium A1</h3>
                            <p class="text-text-gray text-sm mb-4">
                                Kamar luas dengan interior modern, AC, dan kamar mandi dalam. Cocok untuk kenyamanan
                                maksimal.
                            </p>

                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                    <i class="fas fa-ruler-combined text-accent mr-1"></i> 4x5 m
                                </span>
                                <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                    <i class="fas fa-wind text-accent mr-1"></i> AC
                                </span>
                                <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                    <i class="fas fa-bath text-accent mr-1"></i> KM Dalam
                                </span>
                                <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                    <i class="fas fa-wifi text-accent mr-1"></i> WiFi
                                </span>
                                <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                    <i class="fas fa-warehouse text-accent mr-1"></i> Lemari
                                </span>
                                <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                    <i class="fas fa-chair text-accent mr-1"></i> Meja
                                </span>
                            </div>

                            <div class="border-t border-gray-200 pt-4 mb-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-gray-800 text-3xl font-bold">
                                            Rp 2,5 Jt
                                        </p>


                                        <p class="text-text-gray text-sm">per bulan</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm text-text-gray">Deposit</p>
                                        <p
                                            class="text-primary font-semibold
                                        underline underline-offset-4 decoration-1 decoration-primary/30">
                                            Rp 1 Jt
                                        </p>

                                    </div>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <a href="{{ route('user.kamar.detail') }}"
                                    class="flex-1 inline-flex items-center justify-center border-2 border-accent text-accent hover:bg-accent hover:text-white py-3 rounded-xl font-semibold transition">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Detail
                                </a>

                                <button
                                    class="flex-1 bg-accent hover:bg-orange-600 text-white py-3 rounded-xl font-semibold transition shadow-lg">
                                    <i class="fas fa-calendar-check mr-2"></i>Booking
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- kamar no 2 -->

                    <div
                        class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group">
                        <div class="relative overflow-hidden h-64">
                            <img src="https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=600"
                                alt="Kamar Premium A1"
                                class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            <div
                                class="absolute top-4 left-4 bg-red-500 text-white px-4 py-2 rounded-full font-semibold flex items-center shadow-lg">
                                <i class="fas fa-check-circle mr-2"></i>Tersedia
                            </div>

                        </div>
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-accent tracking-tight mb-2">Kamar Premium A1</h3>
                            <p class="text-text-gray text-sm mb-4">
                                Kamar luas dengan interior modern, AC, dan kamar mandi dalam. Cocok untuk kenyamanan
                                maksimal.
                            </p>

                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                    <i class="fas fa-ruler-combined text-accent mr-1"></i> 4x5 m
                                </span>
                                <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                    <i class="fas fa-wind text-accent mr-1"></i> AC
                                </span>
                                <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                    <i class="fas fa-bath text-accent mr-1"></i> KM Dalam
                                </span>
                                <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                    <i class="fas fa-wifi text-accent mr-1"></i> WiFi
                                </span>
                                <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                    <i class="fas fa-warehouse text-accent mr-1"></i> Lemari
                                </span>
                                <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                    <i class="fas fa-chair text-accent mr-1"></i> Meja
                                </span>
                            </div>

                            <div class="border-t border-gray-200 pt-4 mb-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-gray-800 text-3xl font-bold">
                                            Rp 2,5 Jt
                                        </p>


                                        <p class="text-text-gray text-sm">per bulan</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm text-text-gray">Deposit</p>
                                        <p
                                            class="text-primary font-semibold
                                        underline underline-offset-4 decoration-1 decoration-primary/30">
                                            Rp 1 Jt
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <button
                                    class="flex-1 border-2 border-accent text-accent hover:bg-accent hover:text-white py-3 rounded-xl font-semibold transition">
                                    <i class="fas fa-info-circle mr-2"></i>Detail
                                </button>
                                <button
                                    class="flex-1 bg-accent hover:bg-orange-600 text-white py-3 rounded-xl font-semibold transition shadow-lg">
                                    <i class="fas fa-calendar-check mr-2"></i>Booking
                                </button>
                            </div>
                        </div>
                    </div>


                    <!-- kamar no 3 -->
                    <!-- Room Card 1 -->
                    <div
                        class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group">
                        <div class="relative overflow-hidden h-64">
                            <img src="https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=600"
                                alt="Kamar Premium A1"
                                class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            <div
                                class="absolute top-4 left-4 bg-green-500 text-white px-4 py-2 rounded-full font-semibold flex items-center shadow-lg">
                                <i class="fas fa-check-circle mr-2"></i>Tersedia
                            </div>

                        </div>
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-accent tracking-tight mb-2">Kamar Premium A1</h3>
                            <p class="text-text-gray text-sm mb-4">
                                Kamar luas dengan interior modern, AC, dan kamar mandi dalam. Cocok untuk kenyamanan
                                maksimal.
                            </p>

                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                    <i class="fas fa-ruler-combined text-accent mr-1"></i> 4x5 m
                                </span>
                                <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                    <i class="fas fa-wind text-accent mr-1"></i> AC
                                </span>
                                <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                    <i class="fas fa-bath text-accent mr-1"></i> KM Dalam
                                </span>
                                <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                    <i class="fas fa-wifi text-accent mr-1"></i> WiFi
                                </span>
                                <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                    <i class="fas fa-warehouse text-accent mr-1"></i> Lemari
                                </span>
                                <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                    <i class="fas fa-chair text-accent mr-1"></i> Meja
                                </span>
                            </div>

                            <div class="border-t border-gray-200 pt-4 mb-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-gray-800 text-3xl font-bold">
                                            Rp 2,5 Jt
                                        </p>


                                        <p class="text-text-gray text-sm">per bulan</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm text-text-gray">Deposit</p>
                                        <p
                                            class="text-primary font-semibold
                                        underline underline-offset-4 decoration-1 decoration-primary/30">
                                            Rp 1 Jt
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <button
                                    class="flex-1 border-2 border-accent text-accent hover:bg-accent hover:text-white py-3 rounded-xl font-semibold transition">
                                    <i class="fas fa-info-circle mr-2"></i>Detail
                                </button>
                                <button
                                    class="flex-1 bg-accent hover:bg-orange-600 text-white py-3 rounded-xl font-semibold transition shadow-lg">
                                    <i class="fas fa-calendar-check mr-2"></i>Booking
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- kamar no 4 -->
                    <!-- Room Card 1 -->
                    <div
                        class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group">
                        <div class="relative overflow-hidden h-64">
                            <img src="https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=600"
                                alt="Kamar Premium A1"
                                class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            <div
                                class="absolute top-4 left-4 bg-green-500 text-white px-4 py-2 rounded-full font-semibold flex items-center shadow-lg">
                                <i class="fas fa-check-circle mr-2"></i>Tersedia
                            </div>

                        </div>
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-accent tracking-tight mb-2">Kamar Premium A1</h3>
                            <p class="text-text-gray text-sm mb-4">
                                Kamar luas dengan interior modern, AC, dan kamar mandi dalam. Cocok untuk kenyamanan
                                maksimal.
                            </p>

                            <div class="flex flex-wrap gap-2 mb-4">
                                <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                    <i class="fas fa-ruler-combined text-accent mr-1"></i> 4x5 m
                                </span>
                                <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                    <i class="fas fa-wind text-accent mr-1"></i> AC
                                </span>
                                <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                    <i class="fas fa-bath text-accent mr-1"></i> KM Dalam
                                </span>
                                <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                    <i class="fas fa-wifi text-accent mr-1"></i> WiFi
                                </span>
                                <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                    <i class="fas fa-warehouse text-accent mr-1"></i> Lemari
                                </span>
                                <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                    <i class="fas fa-chair text-accent mr-1"></i> Meja
                                </span>
                            </div>

                            <div class="border-t border-gray-200 pt-4 mb-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-gray-800 text-3xl font-bold">
                                            Rp 2,5 Jt
                                        </p>


                                        <p class="text-text-gray text-sm">per bulan</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm text-text-gray">Deposit</p>
                                        <p class="text-primary font-semibold">Rp 1 Jt</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <button
                                    class="flex-1 border-2 border-accent text-accent hover:bg-accent hover:text-white py-3 rounded-xl font-semibold transition">
                                    <i class="fas fa-info-circle mr-2"></i>Detail
                                </button>
                                <button
                                    class="flex-1 bg-accent hover:bg-orange-600 text-white py-3 rounded-xl font-semibold transition shadow-lg">
                                    <i class="fas fa-calendar-check mr-2"></i>Booking
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

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
                        class="w-10 h-10 rounded-lg border-2 border-gray-300 hover:border-accent hover:bg-accent hover:text-white transition">3</button>
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
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Tidak Menemukan Kamar yang Sesuai?</h2>
                <p class="text-lg text-text-gray mb-8">
                    Hubungi kami untuk bantuan atau konsultasi gratis dalam memilih kamar terbaik
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
