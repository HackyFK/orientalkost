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
            <h1 class="text-accent text-4xl md:text-6xl font-bold mb-6 leading-tight">
                ORIENTAL KOST<br>
            </h1>
            <p class="text-text-light text-lg md:text-xl max-w-2xl mx-auto">
                Kos modern dan eksklusif untuk mahasiswa & pekerja profesional
            </p>
        </div>

        <!-- Search Box -->
        <div class="bg-white rounded-3xl shadow-2xl p-6 md:p-8 max-w-5xl mx-auto">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">

                <!-- Jenis Kos -->
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-venus-mars text-accent mr-2"></i>
                        Jenis Kos
                    </label>
                    <select
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-accent focus:ring-2 focus:ring-accent-soft outline-none transition">
                        <option>Putra</option>
                        <option>Putri</option>
                        <option>Campur</option>
                    </select>
                </div>

                <!-- Tipe Kamar -->
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-bed text-accent mr-2"></i>
                        Tipe Kamar
                    </label>
                    <select
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-accent focus:ring-2 focus:ring-accent-soft outline-none transition">
                        <option>Semua Tipe</option>
                        <option>Standard</option>
                        <option>AC</option>
                        <option>KM Dalam</option>
                        <option>Premium</option>
                    </select>
                </div>

                <!-- Harga -->
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-money-bill-wave text-accent mr-2"></i>
                        Rentang Harga
                    </label>
                    <select
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-accent focus:ring-2 focus:ring-accent-soft outline-none transition">
                        <option>Semua Harga</option>
                        <option>< Rp 1 juta</option>
                        <option>Rp 1 – 2 juta</option>
                        <option>Rp 2 – 3 juta</option>
                        <option>> Rp 3 juta</option>
                    </select>
                </div>

                <!-- Lokasi -->
                <div class="space-y-2">
                    <label class="text-sm font-medium text-gray-700 flex items-center">
                        <i class="fas fa-map-marker-alt text-accent mr-2"></i>
                        Lokasi
                    </label>
                    <select
                        class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-accent focus:ring-2 focus:ring-accent-soft outline-none transition">
                        <option>Pilih Lokasi</option>
                        <option>Dekat Kampus</option>
                        <option>Pusat Kota</option>
                        <option>Kawasan Strategis</option>
                    </select>
                </div>
            </div>

            <!-- Button -->
            <button
                class="w-full bg-accent hover:bg-orange-600 text-white py-4 rounded-xl font-semibold text-lg transition shadow-lg flex items-center justify-center space-x-2">
                <i class="fas fa-search"></i>
                <span>Cari Kos Sekarang</span>
            </button>

        </div>
    </div>
</section>






    <!-- PROFIL KAMI -->
    <section id="profil" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="order-2 md:order-1">
                    <h2 class="text-4xl font-bold text-primary mb-6">Profil Kami</h2>
                    <p class="text-text-gray text-lg mb-6 leading-relaxed">
                        KosKu adalah penyedia layanan kos modern terpercaya dengan pengalaman lebih dari 10 tahun.
                        Kami berkomitmen menyediakan hunian berkualitas tinggi dengan fasilitas lengkap dan
                        pelayanan terbaik untuk kenyamanan Anda.
                    </p>

                    <div class="space-y-4">
                        <div class="flex items-start space-x-4">
                            <div class="bg-accent-soft rounded-full p-3">
                                <i class="fas fa-shield-alt text-accent text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-primary text-lg">Keamanan 24/7</h3>
                                <p class="text-text-gray">Sistem keamanan modern dengan CCTV dan security</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="bg-accent-soft rounded-full p-3">
                                <i class="fas fa-wifi text-accent text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-primary text-lg">Fasilitas Lengkap</h3>
                                <p class="text-text-gray">WiFi cepat, laundry, dapur bersama, dan parkir luas</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="bg-accent-soft rounded-full p-3">
                                <i class="fas fa-map-marked-alt text-accent text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-primary text-lg">Lokasi Strategis</h3>
                                <p class="text-text-gray">Dekat kampus, pusat kota, dan transportasi umum</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="order-1 md:order-2 relative w-full flex items-center justify-center">

                    <!-- Frame dekoratif (belakang) -->
                    <div class="absolute inset-0 flex justify-center">
                        <div class="w-[92%] md:w-[82%] h-[460px] md:h-[500px]
                    rounded-[2.5rem] bg-primary/10 blur-2xl">
                        </div>
                    </div>

                    <!-- Card Video -->
                    <div class="relative z-10
                w-[95%] md:w-[85%]
                h-[480px] md:h-[520px]
                rounded-3xl overflow-hidden
                bg-black shadow-2xl ring-1 ring-white/10">

                        <!-- IFRAME -->
                        <iframe id="mainVideo" class="w-full h-full" src="https://www.youtube.com/embed/o95awKNftsE"
                            title="Video Profil Kos" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>

                        <iframe id="mainVideo" class="w-full h-full" src="https://www.youtube.com/embed/o95awKNftsE"
                            title="Video Profil Kos" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>

                        <!-- Overlay gradient bawah -->
                        <div class="absolute inset-x-0 bottom-0 h-24
                    bg-gradient-to-t from-black/70 to-transparent pointer-events-none">
                        </div>

                    </div>

                    <!-- Arrow Left -->
                    <button onclick="prevVideo()" class="absolute left-4 md:left-10 top-1/2 -translate-y-1/2
               w-12 h-12 rounded-full
               bg-black/60 backdrop-blur text-white
               flex items-center justify-center
               hover:bg-black/80 hover:scale-110 transition z-20">
                        <i class="fas fa-chevron-left"></i>
                    </button>

                    <!-- Arrow Right -->
                    <button onclick="nextVideo()" class="absolute right-4 md:right-10 top-1/2 -translate-y-1/2
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
                <div class="bg-secondary rounded-2xl p-6 text-center hover:bg-accent transition cursor-pointer group">
                    <div class="text-5xl mb-4">
                        <i class="fas fa-bed"></i>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">Kamar Standard</h3>
                    <p class="text-accent-soft group-hover:text-white">12 Kamar</p>
                </div>

                <div class="bg-secondary rounded-2xl p-6 text-center hover:bg-accent transition cursor-pointer group">
                    <div class="text-5xl mb-4">
                        <i class="fas fa-wind"></i>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">Kamar AC</h3>
                    <p class="text-accent-soft group-hover:text-white">18 Kamar</p>
                </div>

                <div class="bg-secondary rounded-2xl p-6 text-center hover:bg-accent transition cursor-pointer group">
                    <div class="text-5xl mb-4">
                        <i class="fas fa-bath"></i>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">Kamar KM Dalam</h3>
                    <p class="text-accent-soft group-hover:text-white">15 Kamar</p>
                </div>

                <div class="bg-secondary rounded-2xl p-6 text-center hover:bg-accent transition cursor-pointer group">
                    <div class="text-5xl mb-4">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">Kamar Premium</h3>
                    <p class="text-accent-soft group-hover:text-white">10 Kamar</p>
                </div>

                <div class="bg-secondary rounded-2xl p-6 text-center hover:bg-accent transition cursor-pointer group">
                    <div class="text-5xl mb-4">
                        <i class="fas fa-crown"></i>
                    </div>
                    <h3 class="font-semibold text-lg mb-2">Kamar Eksklusif</h3>
                    <p class="text-accent-soft group-hover:text-white">6 Kamar</p>
                </div>
            </div>
        </div>
    </section>

    <!-- KAMAR UNGGULAN -->
    <section id="kamar" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-primary mb-4">Kos Unggulan</h2>
                <p class="text-text-gray text-lg">Pilihan kos terbaik dengan fasilitas premium</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Kos Card -->
                <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 
            overflow-hidden group flex flex-col">

                    <!-- Image -->
                    <div class="relative overflow-hidden h-64">
                        <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=600"
                            alt="KosKu Premium Residence"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>

                    <!-- Content -->
                    <div class="p-6 flex flex-col">
                        <h3 class="text-2xl font-bold text-primary mb-2">
                            KosKu Premium Residence
                        </h3>

                        <p class="text-text-gray text-sm mb-3 line-clamp-2">
                            Kos modern dengan fasilitas lengkap di lokasi strategis dekat kampus dan pusat kota.
                            WiFi cepat, keamanan 24 jam.
                        </p>

                        <!-- Fasilitas -->
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                <i class="fas fa-door-open text-accent mr-1"></i>24 Kamar
                            </span>
                            <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                <i class="fas fa-wifi text-accent mr-1"></i>Free WiFi
                            </span>
                            <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                <i class="fas fa-parking text-accent mr-1"></i>Parkir
                            </span>
                            <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                <i class="fas fa-shield-alt text-accent mr-1"></i>Security
                            </span>
                        </div>

                        <!-- Status -->
                        <div class="flex gap-3 mb-4">
                            <span
                                class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold flex items-center">
                                <i class="fas fa-check-circle mr-2"></i>Tersedia
                            </span>
                            <span
                                class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold flex items-center">
                                <i class="fas fa-mars mr-2"></i>Putra
                            </span>
                        </div>


                        <!-- Rating & Jarak -->
                        <div class="flex items-center justify-between mb-8
            bg-gray-200/50 backdrop-blur-sm 
            px-4 py-2 rounded-xl">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-star text-yellow-400"></i>
                                <span class="font-bold text-primary">4.8</span>
                                <span class="text-sm text-text-gray">(127)</span>
                            </div>

                            <div class="flex items-center gap-2 text-sm 
                text-purple-700 px-3 py-1.5 rounded-full font-semibold">
                                <i class="fas fa-bed"></i>
                                <span>12 Kamar Tersedia</span>
                            </div>
                        </div>



                        <!-- Button -->
                        <div class="grid grid-cols-1 gap-3">

                            <button
                                class="bg-accent hover:bg-orange-600 text-white py-3 rounded-xl font-semibold transition shadow-lg">
                                <i class="fas fa-eye mr-2"></i>Lihat Kamar
                            </button>
                        </div>
                    </div>
                </div>


                <!-- Kos Card -->
                <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 
            overflow-hidden group flex flex-col">

                    <!-- Image -->
                    <div class="relative overflow-hidden h-64">
                        <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=600"
                            alt="KosKu Premium Residence"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>

                    <!-- Content -->
                    <div class="p-6 flex flex-col">
                        <h3 class="text-2xl font-bold text-primary mb-2">
                            KosKu Premium Residence
                        </h3>

                        <p class="text-text-gray text-sm mb-3 line-clamp-2">
                            Kos modern dengan fasilitas lengkap di lokasi strategis dekat kampus dan pusat kota.
                            WiFi cepat, keamanan 24 jam.
                        </p>

                        <!-- Fasilitas -->
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                <i class="fas fa-door-open text-accent mr-1"></i>24 Kamar
                            </span>
                            <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                <i class="fas fa-wifi text-accent mr-1"></i>Free WiFi
                            </span>
                            <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                <i class="fas fa-parking text-accent mr-1"></i>Parkir
                            </span>
                            <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                <i class="fas fa-shield-alt text-accent mr-1"></i>Security
                            </span>
                        </div>

                        <!-- Status -->
                        <div class="flex gap-3 mb-4">
                            <span
                                class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold flex items-center">
                                <i class="fas fa-check-circle mr-2"></i>Tersedia
                            </span>
                            <span
                                class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold flex items-center">
                                <i class="fas fa-mars mr-2"></i>Putra
                            </span>
                        </div>


                        <!-- Rating & Jarak -->
                        <div class="flex items-center justify-between mb-8
            bg-gray-200/50 backdrop-blur-sm 
            px-4 py-2 rounded-xl">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-star text-yellow-400"></i>
                                <span class="font-bold text-primary">4.8</span>
                                <span class="text-sm text-text-gray">(127)</span>
                            </div>

                            <div class="flex items-center gap-2 text-sm 
                text-purple-700 px-3 py-1.5 rounded-full font-semibold">
                                <i class="fas fa-bed"></i>
                                <span>12 Kamar Tersedia</span>
                            </div>
                        </div>



                        <!-- Button -->
                        <div class="grid grid-cols-1 gap-3">

                            <button
                                class="bg-accent hover:bg-orange-600 text-white py-3 rounded-xl font-semibold transition shadow-lg">
                                <i class="fas fa-eye mr-2"></i>Lihat Kamar
                            </button>
                        </div>
                    </div>
                </div>


                <!-- Kos Card -->
                <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 
            overflow-hidden group flex flex-col">

                    <!-- Image -->
                    <div class="relative overflow-hidden h-64">
                        <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=600"
                            alt="KosKu Premium Residence"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>

                    <!-- Content -->
                    <div class="p-6 flex flex-col">
                        <h3 class="text-2xl font-bold text-primary mb-2">
                            KosKu Premium Residence
                        </h3>

                        <p class="text-text-gray text-sm mb-3 line-clamp-2">
                            Kos modern dengan fasilitas lengkap di lokasi strategis dekat kampus dan pusat kota.
                            WiFi cepat, keamanan 24 jam.
                        </p>

                        <!-- Fasilitas -->
                        <div class="flex flex-wrap gap-2 mb-4">
                            <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                <i class="fas fa-door-open text-accent mr-1"></i>24 Kamar
                            </span>
                            <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                <i class="fas fa-wifi text-accent mr-1"></i>Free WiFi
                            </span>
                            <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                <i class="fas fa-parking text-accent mr-1"></i>Parkir
                            </span>
                            <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                <i class="fas fa-shield-alt text-accent mr-1"></i>Security
                            </span>
                        </div>

                        <!-- Status -->
                        <div class="flex gap-3 mb-4">
                            <span
                                class="bg-green-100 text-green-700 px-4 py-2 rounded-full text-sm font-semibold flex items-center">
                                <i class="fas fa-check-circle mr-2"></i>Tersedia
                            </span>
                            <span
                                class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold flex items-center">
                                <i class="fas fa-mars mr-2"></i>Putra
                            </span>
                        </div>


                        <!-- Rating & Jarak -->
                        <div class="flex items-center justify-between mb-8
            bg-gray-200/50 backdrop-blur-sm 
            px-4 py-2 rounded-xl">
                            <div class="flex items-center gap-2">
                                <i class="fas fa-star text-yellow-400"></i>
                                <span class="font-bold text-primary">4.8</span>
                                <span class="text-sm text-text-gray">(127)</span>
                            </div>

                            <div class="flex items-center gap-2 text-sm 
                text-purple-700 px-3 py-1.5 rounded-full font-semibold">
                                <i class="fas fa-bed"></i>
                                <span>12 Kamar Tersedia</span>
                            </div>
                        </div>



                        <!-- Button -->
                        <div class="grid grid-cols-1 gap-3">

                            <button
                                class="bg-accent hover:bg-orange-600 text-white py-3 rounded-xl font-semibold transition shadow-lg">
                                <i class="fas fa-eye mr-2"></i>Lihat Kamar
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-12">
                <button class="bg-primary hover:bg-secondary text-white px-8 py-4 rounded-xl font-semibold transition">
                    Lihat Semua Kamar <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- INFO KOS & LOKASI -->
    <section id="kos" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=800" alt="Lokasi Kos"
                        class="rounded-3xl shadow-2xl w-full h-[500px] object-cover">
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
                KosKu Residence – Hunian Kos Modern & Terpercaya
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
                Jl. Pendidikan No. 123, Kel. Sukamaju, Kec. Central City, Kota Metropolitan
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
                +62 812-3456-7890
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
                info@koskuresidence.com
            </p>
        </div>
    </div>

</div>

                    </div>

                    <button
                        class="bg-accent hover:bg-orange-600 text-white px-8 py-4 rounded-xl font-semibold transition shadow-lg">
                        <i class="fas fa-location-arrow mr-2"></i>
                        Lihat di Maps
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- GALERI KOS -->
<section id="galeri"
    class="py-20 relative bg-cover bg-center"
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
        <div class="bg-white/90 backdrop-blur-md rounded-[2.5rem] 
            p-8 md:p-14 lg:p-16 
            shadow-[0_25px_60px_-15px_rgba(0,0,0,0.35)]">

            <!-- Masonry Auto Layout -->
            <div class="columns-1 sm:columns-2 lg:columns-3 
            gap-6 space-y-6">

                <!-- Item -->
                <div class="break-inside-avoid relative overflow-hidden rounded-2xl group cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800"
                        class="w-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition
                                flex items-center justify-center">
                        <i class="fas fa-search-plus text-white text-3xl opacity-0 group-hover:opacity-100 transition"></i>
                    </div>
                </div>

                <div class="break-inside-avoid relative overflow-hidden rounded-2xl group cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=800"
                        class="w-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition
                                flex items-center justify-center">
                        <i class="fas fa-search-plus text-white text-3xl opacity-0 group-hover:opacity-100 transition"></i>
                    </div>
                </div>

                <div class="break-inside-avoid relative overflow-hidden rounded-2xl group cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=800"
                        class="w-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition
                                flex items-center justify-center">
                        <i class="fas fa-search-plus text-white text-3xl opacity-0 group-hover:opacity-100 transition"></i>
                    </div>
                </div>

                <div class="break-inside-avoid relative overflow-hidden rounded-2xl group cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=800"
                        class="w-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition
                                flex items-center justify-center">
                        <i class="fas fa-search-plus text-white text-3xl opacity-0 group-hover:opacity-100 transition"></i>
                    </div>
                </div>

                <div class="break-inside-avoid relative overflow-hidden rounded-2xl group cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1540518614846-7eded433c457?w=800"
                        class="w-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition
                                flex items-center justify-center">
                        <i class="fas fa-search-plus text-white text-3xl opacity-0 group-hover:opacity-100 transition"></i>
                    </div>
                </div>

                <div class="break-inside-avoid relative overflow-hidden rounded-2xl group cursor-pointer">
                    <img src="https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800"
                        class="w-full object-cover transition duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition
                                flex items-center justify-center">
                        <i class="fas fa-search-plus text-white text-3xl opacity-0 group-hover:opacity-100 transition"></i>
                    </div>
                </div>

            </div>

            <!-- Button -->
            <div class="text-center mt-12">
                <button
                    class="bg-accent hover:bg-orange-600 text-white px-8 py-4 rounded-xl font-semibold transition shadow-lg">
                    Lihat Semua Galeri
                    <i class="fas fa-images ml-2"></i>
                </button>
            </div>

        </div>
    </div>
</section>



    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-primary mb-4">Rating & Ulasan</h2>
                <div class="flex items-center justify-center space-x-2 mb-4">
                    <div class="flex text-yellow-400 text-2xl"> <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star-half-alt"></i>
                    </div> <span class="text-3xl font-bold text-primary">4.8</span> <span class="text-text-gray">dari
                        250+ ulasan</span>
                </div>
            </div>
            <div class="grid md:grid-cols-4 gap-8">
                <div class="bg-gray-50 rounded-3xl p-8 shadow-lg">
                    <div class="flex items-center mb-4"> <img src="https://i.pravatar.cc/100?img=1" alt="User"
                            class="w-14 h-14 rounded-full mr-4">
                        <div>
                            <h4 class="font-semibold text-primary">Budi Santoso</h4>
                            <div class="flex text-yellow-400"> <i class="fas fa-star text-sm"></i> <i
                                    class="fas fa-star text-sm"></i> <i class="fas fa-star text-sm"></i> <i
                                    class="fas fa-star text-sm"></i> <i class="fas fa-star text-sm"></i> </div>
                        </div>
                    </div>
                    <p class="text-text-gray leading-relaxed"> "Kos yang sangat nyaman dan bersih. Fasilitas lengkap,
                        WiFi cepat, dan security 24 jam. Sangat recommended untuk mahasiswa!" </p>
                    <p class="text-sm text-text-gray mt-4"> <i class="fas fa-calendar mr-2"></i>2 minggu yang lalu </p>
                </div>
                <div class="bg-gray-50 rounded-3xl p-8 shadow-lg">
                    <div class="flex items-center mb-4"> <img src="https://i.pravatar.cc/100?img=5" alt="User"
                            class="w-14 h-14 rounded-full mr-4">
                        <div>
                            <h4 class="font-semibold text-primary">Siti Nurhaliza</h4>
                            <div class="flex text-yellow-400"> <i class="fas fa-star text-sm"></i> <i
                                    class="fas fa-star text-sm"></i> <i class="fas fa-star text-sm"></i> <i
                                    class="fas fa-star text-sm"></i> <i class="fas fa-star text-sm"></i> </div>
                        </div>
                    </div>
                    <p class="text-text-gray leading-relaxed"> "Lokasi strategis dekat kampus. Pengelola sangat ramah
                        dan responsif. Kamarnya luas dan fasilitas AC + KM dalam sangat membantu." </p>
                    <p class="text-sm text-text-gray mt-4"> <i class="fas fa-calendar mr-2"></i>1 bulan yang lalu </p>
                </div>
                <div class="bg-gray-50 rounded-3xl p-8 shadow-lg">
                    <div class="flex items-center mb-4"> <img src="https://i.pravatar.cc/100?img=8" alt="User"
                            class="w-14 h-14 rounded-full mr-4">
                        <div>
                            <h4 class="font-semibold text-primary">Ahmad Fauzi</h4>
                            <div class="flex text-yellow-400"> <i class="fas fa-star text-sm"></i> <i
                                    class="fas fa-star text-sm"></i> <i class="fas fa-star text-sm"></i> <i
                                    class="fas fa-star text-sm"></i> <i class="far fa-star text-sm"></i> </div>
                        </div>
                    </div>
                    <p class="text-text-gray leading-relaxed"> "Harga terjangkau dengan kualitas bagus. Suasana kos
                        tenang dan cocok untuk belajar. Proses booking mudah dan cepat." </p>
                    <p class="text-sm text-text-gray mt-4"> <i class="fas fa-calendar mr-2"></i>3 bulan yang lalu </p>
                </div>
                <div class="bg-gray-50 rounded-3xl p-8 shadow-lg">
                    <div class="flex items-center mb-4"> <img src="https://i.pravatar.cc/100?img=1" alt="User"
                            class="w-14 h-14 rounded-full mr-4">
                        <div>
                            <h4 class="font-semibold text-primary">Budi Santoso</h4>
                            <div class="flex text-yellow-400"> <i class="fas fa-star text-sm"></i> <i
                                    class="fas fa-star text-sm"></i> <i class="fas fa-star text-sm"></i> <i
                                    class="fas fa-star text-sm"></i> <i class="fas fa-star text-sm"></i> </div>
                        </div>
                    </div>
                    <p class="text-text-gray leading-relaxed"> "Kos yang sangat nyaman dan bersih. Fasilitas lengkap,
                        WiFi cepat, dan security 24 jam. Sangat recommended untuk mahasiswa!" </p>
                    <p class="text-sm text-text-gray mt-4"> <i class="fas fa-calendar mr-2"></i>2 minggu yang lalu </p>
                </div>
            </div>
        </div>
    </section>



    <!-- BLOG TERBARU -->
    <section id="blog" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-primary mb-4">Blog Terbaru</h2>
                <p class="text-text-gray text-lg">Tips dan informasi seputar kehidupan kos</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition overflow-hidden group">
                    <div class="relative overflow-hidden h-56">
                        <img src="https://images.unsplash.com/photo-1484480974693-6ca0a78fb36b?w=600"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center space-x-4 text-sm text-text-gray mb-3">
                            <span><i class="fas fa-calendar mr-2"></i>15 Jan 2026</span>
                            <span><i class="fas fa-user mr-2"></i>Admin</span>
                        </div>
                        <h3 class="text-xl font-bold text-primary mb-3 line-clamp-2">
                            Tips Memilih Kos yang Nyaman dan Aman untuk Mahasiswa
                        </h3>
                        <p class="text-text-gray mb-4 line-clamp-3">
                            Panduan lengkap memilih tempat kos yang sesuai dengan kebutuhan dan budget mahasiswa...
                        </p>
                        <button class="text-accent font-semibold hover:underline">
                            Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition overflow-hidden group">
                    <div class="relative overflow-hidden h-56">
                        <img src="https://images.unsplash.com/photo-1513694203232-719a280e022f?w=600"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center space-x-4 text-sm text-text-gray mb-3">
                            <span><i class="fas fa-calendar mr-2"></i>10 Jan 2026</span>
                            <span><i class="fas fa-user mr-2"></i>Admin</span>
                        </div>
                        <h3 class="text-xl font-bold text-primary mb-3 line-clamp-2">
                            5 Fasilitas Wajib yang Harus Ada di Kos Modern
                        </h3>
                        <p class="text-text-gray mb-4 line-clamp-3">
                            Mengenal fasilitas penting yang harus tersedia di kos masa kini untuk kenyamanan maksimal...
                        </p>
                        <button class="text-accent font-semibold hover:underline">
                            Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                        </button>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition overflow-hidden group">
                    <div class="relative overflow-hidden h-56">
                        <img src="https://images.unsplash.com/photo-1556911220-bff31c812dba?w=600"
                            class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center space-x-4 text-sm text-text-gray mb-3">
                            <span><i class="fas fa-calendar mr-2"></i>5 Jan 2026</span>
                            <span><i class="fas fa-user mr-2"></i>Admin</span>
                        </div>
                        <h3 class="text-xl font-bold text-primary mb-3 line-clamp-2">
                            Cara Mengatur Keuangan Bulanan Saat Ngekos
                        </h3>
                        <p class="text-text-gray mb-4 line-clamp-3">
                            Tips praktis mengelola uang bulanan agar tetap cukup sampai akhir bulan saat ngekos...
                        </p>
                        <button class="text-accent font-semibold hover:underline">
                            Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                        </button>
                    </div>
                </div>
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
            'o95awKNftsE',
            '-2prh4Nzk14'
        ];

        let index = 0;
        const iframe = document.getElementById('mainVideo');

        function updateVideo() {
            iframe.src = `https://www.youtube.com/embed/${videos[index]}?autoplay=1`;
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