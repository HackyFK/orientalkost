@extends('user.layouts.app')

@section('content')

<body class="bg-slate-50">
    <!-- Header -->
    <header class="bg-white sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex items-center justify-between">
                <div class="text-3xl font-bold text-primary">
                    Kos<span class="text-accent">Ku</span>
                </div>
                <a href="#"
                    class="flex items-center gap-2 text-textGray hover:text-primary transition-colors font-medium">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 lg:px-12 xl:px-16 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Left Section - Booking Form -->
            <div class="lg:col-span-10 lg:col-start-2 xl:col-span-8 xl:col-start-3">

                <div class="bg-white rounded-3xl shadow-lg p-8 lg:p-10">
                    <div class="mb-10 text-center">
                        <div class="inline-flex items-center justify-center gap-3 mb-4">
                            <div class="w-12 h-12 rounded-2xl bg-orange-100 flex items-center justify-center">
                                <i class="fas fa-credit-card text-accent text-xl"></i>
                            </div>
                            <h1 class="text-3xl lg:text-4xl font-bold text-primary">
                                TRANSAKSI PEMBAYARAN
                            </h1>
                        </div>

                        <p class="text-textGray max-w-xl mx-auto">
                            Lengkapi data pembayaran anda untuk menyelesaikan transaksi dengan aman
                        </p>
                    </div>


                    <!-- Kos Info Card -->
                    <div class="gradient-bg border border-gray-200 rounded-2xl p-6 mb-8">
                        <div class="flex flex-col sm:flex-row gap-6">
                            <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=400&h=400&fit=crop"
                                alt="Kos Room" class="w-full sm:w-36 h-36 rounded-xl object-cover flex-shrink-0">
                            <div class="flex-1">
                                <h3 class="text-xl font-semibold text-primary mb-3">Kos Putri Melati Residence</h3>
                                <p class="flex items-center gap-2 text-textGray text-sm mb-2">
                                    <i class="fas fa-map-marker-alt text-accent"></i>
                                    Jl. Kaliurang KM 5, Yogyakarta
                                </p>
                                <p class="flex items-center gap-2 text-textGray text-sm mb-3">
                                    <i class="fas fa-door-open text-accent"></i>
                                    Kamar Tipe A - 3x4 meter
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Form -->
                    <form id="bookingForm" class="space-y-7">

                        <!-- DATA PENYEWA -->
                        <div>
                            <h2
                                class="text-xl font-bold text-accent mb-8 mt-10 flex items-center items-center justify-center gap-2 mt-30">
                                <i class="fas fa-user text-accent text-accent"></i>
                                DATA DIRI
                            </h2>

                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Nama Lengkap -->
                                <div>
                                    <label class="block font-semibold text-secondary mb-2">
                                        Nama Lengkap
                                    </label>
                                    <input type="text" required placeholder="Masukkan nama lengkap" class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl font-medium text-primary
                       focus:outline-none focus:border-accent focus:ring-4 focus:ring-orange-100">
                                </div>

                                <!-- Nomor Identitas -->
                                <div>
                                    <label class="block font-semibold text-secondary mb-2">
                                        Nomor Kartu Identitas
                                    </label>
                                    <input type="number" required placeholder="KTP / KARTU PELAJAR" class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl font-medium text-primary
                       focus:outline-none focus:border-accent focus:ring-4 focus:ring-orange-100">
                                </div>

                                <!-- Email -->
                                <div>
                                    <label class="block font-semibold text-secondary mb-2">
                                        Email Aktif
                                    </label>
                                    <input type="email" required placeholder="contoh@email.com" class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl font-medium text-primary
                       focus:outline-none focus:border-accent focus:ring-4 focus:ring-orange-100">
                                </div>

                                <!-- Telepon -->
                                <div>
                                    <label class="block font-semibold text-secondary mb-2">
                                        Nomor Telepon
                                    </label>
                                    <input type="number" required placeholder="08xxxxxxxxxx" class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl font-medium text-primary
                       focus:outline-none focus:border-accent focus:ring-4 focus:ring-orange-100">
                                </div>
                            </div>

                            <!-- Alamat -->
                            <div class="mt-6">
                                <label class="block font-semibold text-secondary mb-2">
                                    Alamat Lengkap
                                </label>
                                <textarea rows="3" required placeholder="Masukkan alamat sesuai identitas" class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl font-medium text-primary
                   focus:outline-none focus:border-accent focus:ring-4 focus:ring-orange-100 resize-none"></textarea>
                            </div>


                            <!-- FOTO KARTU IDENTITAS -->
                            <div>
                                <h2
                                    class="text-xl font-bold text-gray-400 mb-4 flex items-center justify-center gap-3 mt-4">

                                    Foto Kartu Identitas
                                </h2>


                                <div
                                    class="relative overflow-hidden rounded-2xl border-2 border-dashed border-gray-300 bg-gray-50">
                                    <!-- Aspect Ratio 2:1 -->
                                    <div class="aspect-[2/1]">
                                        <img src="https://images.unsplash.com/photo-1607746882042-944635dfe10e?w=1200"
                                            alt="Contoh Kartu Pelajar" class="w-full h-full object-cover">
                                    </div>
                                </div>

                                <p class="text-xs text-textGray mt-2 mb-20">
                                    Pastikan foto kartu identitas jelas dan terbaca
                                </p>
                            </div>
                        </div>


                        <!-- Data Sewa -->

                        <h2
                            class="text-xl font-bold text-accent mb-4 mt-5 flex items-center items-center justify-center gap-2 mt-30">
                            <i class="fas fa-calendar-check text-accent"></i>
                            DATA SEWA
                        </h2>

                        <!-- Jenis Sewa -->
                        <div>
                            <label class="block font-semibold text-secondary mb-3">
                                <i class="fas fa-calendar-alt text-accent mr-2"></i>Jenis Sewa
                            </label>
                            <div class="grid sm:grid-cols-2 gap-4">
                                <div class="relative">
                                    <input type="radio" name="rental-type" id="monthly" value="monthly" checked
                                        class="peer sr-only">
                                    <label for="monthly"
                                        class="block p-4 border-2 border-gray-200 rounded-xl text-center cursor-pointer font-medium text-secondary transition-all peer-checked:border-accent peer-checked:bg-orange-50 peer-checked:text-accent hover:border-accentSoft hover:bg-orange-50/50">
                                        <i class="fas fa-calendar-day mb-1"></i>
                                        <div>Bulanan</div>
                                    </label>
                                </div>
                                <div class="relative">
                                    <input type="radio" name="rental-type" id="yearly" value="yearly"
                                        class="peer sr-only">
                                    <label for="yearly"
                                        class="block p-4 border-2 border-gray-200 rounded-xl text-center cursor-pointer font-medium text-secondary transition-all peer-checked:border-accent peer-checked:bg-orange-50 peer-checked:text-accent hover:border-accentSoft hover:bg-orange-50/50">
                                        <i class="fas fa-calendar-check mb-1"></i>
                                        <div>Tahunan</div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Durasi -->
                        <div>
                            <label for="duration" class="block font-semibold text-secondary mb-3">
                                <i class="fas fa-clock text-accent mr-2"></i>Durasi Sewa
                            </label>
                            <select id="duration" required
                                class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl font-medium text-primary transition-all focus:outline-none focus:border-accent focus:ring-4 focus:ring-orange-100">
                                <option value="">Pilih durasi</option>
                                <option value="1">1 Bulan</option>
                                <option value="3">3 Bulan</option>
                                <option value="6">6 Bulan</option>
                                <option value="12">12 Bulan</option>
                            </select>
                        </div>

                        <!-- Tanggal Mulai -->
                        <div>
                            <label for="start-date" class="block font-semibold text-secondary mb-3">
                                <i class="fas fa-calendar-plus text-accent mr-2"></i>Tanggal Mulai Sewa
                            </label>
                            <input type="date" id="start-date" required
                                class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl font-medium text-primary transition-all focus:outline-none focus:border-accent focus:ring-4 focus:ring-orange-100">
                        </div>

                        <!-- Tanggal akhir otomatis -->
                        <div>
                            <label for="start-date" class="block font-semibold text-secondary mb-3">
                                <i class="fas fa-calendar-minus text-accent mr-2"></i>Tanggal akhir Sewa
                            </label>
                            <input type="date" id="start-date" required
                                class="w-full px-4 py-4 border-2 border-gray-200 rounded-xl font-medium text-primary transition-all focus:outline-none focus:border-accent focus:ring-4 focus:ring-orange-100">
                        </div>


                        <!-- upload bukti -->
                        <div class="mt-8 bg-white rounded-2xl border border-gray-200 p-6">
                            <h2 class="text-lg font-bold text-primary mb-4 flex items-center gap-2">
                                <i class="fas fa-money-check-alt text-accent"></i>
                                Bukti Transfer
                            </h2>

                            <input type="file" accept="image/*,.pdf" class="w-full px-4 py-3 border-2 border-dashed border-gray-300 rounded-xl
               file:mr-4 file:py-2 file:px-4
               file:rounded-lg file:border-0
               file:bg-accent file:text-white file:font-semibold
               hover:border-accent transition cursor-pointer" required>
                        </div>


                        <!-- ACTION BUTTONS -->
                        <div class="flex flex-col sm:flex-row gap-4 mt-10">

                            <!-- Tombol Lanjut -->
                            <button type="submit" class="flex-1 flex items-center justify-center gap-2 gradient-orange text-white
               py-4 rounded-xl font-semibold shadow-lg transition
               hover:shadow-xl hover:scale-[1.02]">
                                KIRIM BUKTI PEMBAYARAN
                                <i class="fas fa-arrow-right"></i>
                            </button>

                        </div>
                    </form>
                </div>
            </div>



        </div>
    </div>


</body>

@endsection