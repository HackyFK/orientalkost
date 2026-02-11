@extends('user.layouts.app')

@section('content')

    <body class="bg-gray-50">


        <!-- TOMBOL KEMBALI -->
        <section class="pt-28 pb-6 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <a href="{{ url()->previous() }}"
                    class="inline-flex items-center gap-2 text-sm font-medium text-primary
                  hover:text-accent transition">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </section>


        <!-- GALLERY SECTION -->
        <section class="pb-8 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div
                    class="grid gap-6
            grid-cols-[repeat(auto-fit,minmax(240px,1fr))]
            auto-rows-[200px]">

                    <!-- Gambar BESAR -->
                    <div
                        class="relative overflow-hidden rounded-3xl shadow-lg
                md:col-span-2 md:row-span-2 group">
                        <!-- Gambar Utama -->
                        <img src="{{ $kamar->images->first()
                            ? asset('storage/' . $kamar->images->first()->image_path)
                            : 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=1200' }}"
                            class="w-full h-full object-cover">

                    </div>


                    <!-- Gambar KECIL -->
                    <div class="relative overflow-hidden rounded-2xl shadow-lg group">
                        <img src="https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=600"
                            class="w-full h-full object-cover group-hover:scale-110 transition">
                    </div>

                    <!-- Gambar KECIL -->
                    <div class="relative overflow-hidden rounded-2xl shadow-lg group">
                        <img src="https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=600"
                            class="w-full h-full object-cover group-hover:scale-110 transition">
                    </div>

                    <div class="relative overflow-hidden rounded-2xl shadow-lg group">
                        <img src="https://images.unsplash.com/photo-1586105251261-72a756497a11?w=600"
                            class="w-full h-full object-cover group-hover:scale-110 transition">
                    </div>

                </div>


            </div>
        </section>


        <!-- MAIN CONTENT -->
        <section class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-3 gap-8">

                    <!-- LEFT COLUMN - MAIN INFO -->
                    <div class="lg:col-span-2 space-y-6">

                        <!-- Header Info -->
                        <div class="bg-white rounded-3xl shadow-lg p-8">
                            <div class="flex items-start justify-between mb-6">
                                <div>
                                    <div class="flex items-center gap-3 mb-3">
                                        <i class="fas fa-building text-2xl text-accent"></i>
                                        <h1 class="text-4xl font-bold text-primary">
                                            {{ $kamar->nama_kamar }}
                                        </h1>
                                    </div>

                                    <div class="flex items-center space-x-2 text-text-gray mb-4">

                                        <p class="text-text-gray">
                                            {{ $kamar->kos->alamat }}
                                        </p>
                                    </div>
                                    <div class="flex items-center space-x-6">
                                        <div class="flex items-center space-x-2">
                                            <div class="flex text-yellow-400 text-xl">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                            </div>
                                            <span class="text-2xl font-bold text-primary">4.8</span>
                                            <span class="text-text-gray">(127 ulasan)</span>
                                        </div>
                                    </div>
                                </div>
                                <button class="bg-gray-100 hover:bg-gray-200 p-3 rounded-xl transition">
                                    <i class="fas fa-share-alt text-primary text-xl"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Fasilitas -->
                        <div class="bg-white rounded-3xl shadow-lg p-8">
                            <h2 class="text-2xl font-bold text-primary mb-6 flex items-center">
                                <i class="fas fa-concierge-bell text-accent mr-3"></i>
                                Fasilitas Kos
                            </h2>

                            <div class="grid md:grid-cols-2 gap-4">

                                @forelse ($kamar->fasilitas as $fasilitas)
                                    <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-xl">

                                        <i
                                            class="{{ $fasilitas->icon ?? 'fa-solid fa-circle-check' }}
                   text-accent text-xl"></i>

                                        <span class="text-primary font-medium">
                                            {{ $fasilitas->nama_fasilitas }}
                                        </span>
                                    </div>
                                @empty
                                    <div class="md:col-span-2 text-text-gray text-sm">
                                        Fasilitas belum tersedia
                                    </div>
                                @endforelse

                            </div>
                        </div>


                        <!-- Deskripsi -->
                        <div class="bg-white rounded-3xl shadow-lg p-8">
                            <h2 class="text-2xl font-bold text-primary mb-4 flex items-center">
                                <i class="fas fa-info-circle text-accent mr-3"></i>
                                Deskripsi Kamar
                            </h2>
                            <p class="text-text-gray leading-relaxed">
                                {{ $kamar->deskripsi ?? 'Deskripsi kamar belum tersedia.' }}
                            </p>
                        </div>





                        <!-- Ulasan -->
                        <div class="bg-white rounded-3xl shadow-lg p-8">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-2xl font-bold text-primary flex items-center">
                                    <i class="fas fa-comments text-accent mr-3"></i>
                                    Ulasan Penghuni Kamar
                                </h2>
                                <button class="text-accent hover:text-orange-600 font-semibold">
                                    Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
                                </button>
                            </div>

                            <!-- Rating Summary -->
                            <div class="bg-gradient-to-r from-accent-soft to-accent/20 rounded-2xl p-6 mb-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="flex items-center space-x-3 mb-2">
                                            <span class="text-5xl font-bold text-primary">4.8</span>
                                            <div>
                                                <div class="flex text-yellow-400 text-xl mb-1">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star-half-alt"></i>
                                                </div>
                                                <p class="text-text-gray text-sm">dari 127 ulasan</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="space-y-2 flex-1 max-w-sm ml-8">
                                        <div class="flex items-center space-x-2">
                                            <span class="text-sm text-primary w-8">5★</span>
                                            <div class="flex-1 bg-gray-200 rounded-full h-2">
                                                <div class="bg-accent rounded-full h-2" style="width: 85%"></div>
                                            </div>
                                            <span class="text-sm text-text-gray w-8">108</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <span class="text-sm text-primary w-8">4★</span>
                                            <div class="flex-1 bg-gray-200 rounded-full h-2">
                                                <div class="bg-accent rounded-full h-2" style="width: 12%"></div>
                                            </div>
                                            <span class="text-sm text-text-gray w-8">15</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <span class="text-sm text-primary w-8">3★</span>
                                            <div class="flex-1 bg-gray-200 rounded-full h-2">
                                                <div class="bg-accent rounded-full h-2" style="width: 2%"></div>
                                            </div>
                                            <span class="text-sm text-text-gray w-8">3</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <span class="text-sm text-primary w-8">2★</span>
                                            <div class="flex-1 bg-gray-200 rounded-full h-2">
                                                <div class="bg-accent rounded-full h-2" style="width: 1%"></div>
                                            </div>
                                            <span class="text-sm text-text-gray w-8">1</span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <span class="text-sm text-primary w-8">1★</span>
                                            <div class="flex-1 bg-gray-200 rounded-full h-2">
                                                <div class="bg-accent rounded-full h-2" style="width: 0%"></div>
                                            </div>
                                            <span class="text-sm text-text-gray w-8">0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Reviews -->
                            <div class="space-y-4">
                                <div class="border-b border-gray-200 pb-4">
                                    <div class="flex items-start space-x-4">
                                        <img src="https://i.pravatar.cc/100?img=1" alt="User"
                                            class="w-12 h-12 rounded-full">
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between mb-2">
                                                <div>
                                                    <h4 class="font-semibold text-primary">Budi Santoso</h4>
                                                    <div class="flex items-center space-x-2">
                                                        <div class="flex text-yellow-400 text-sm">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                        </div>
                                                        <span class="text-xs text-text-gray">2 minggu lalu</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-text-gray text-sm leading-relaxed">
                                                Kos yang sangat nyaman dan bersih. Fasilitas lengkap, WiFi cepat, dan
                                                security 24 jam membuat saya merasa aman. Pengelola sangat responsif dan
                                                ramah. Highly recommended!
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-b border-gray-200 pb-4">
                                    <div class="flex items-start space-x-4">
                                        <img src="https://i.pravatar.cc/100?img=5" alt="User"
                                            class="w-12 h-12 rounded-full">
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between mb-2">
                                                <div>
                                                    <h4 class="font-semibold text-primary">Siti Nurhaliza</h4>
                                                    <div class="flex items-center space-x-2">
                                                        <div class="flex text-yellow-400 text-sm">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                        </div>
                                                        <span class="text-xs text-text-gray">1 bulan lalu</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-text-gray text-sm leading-relaxed">
                                                Lokasi strategis dekat kampus dan pusat kota. Kamar luas, AC dingin, dan
                                                kamar mandi bersih. Suasana kos tenang cocok untuk belajar. Worth the price!
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="pb-4">
                                    <div class="flex items-start space-x-4">
                                        <img src="https://i.pravatar.cc/100?img=8" alt="User"
                                            class="w-12 h-12 rounded-full">
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between mb-2">
                                                <div>
                                                    <h4 class="font-semibold text-primary">Ahmad Fauzi</h4>
                                                    <div class="flex items-center space-x-2">
                                                        <div class="flex text-yellow-400 text-sm">
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="far fa-star"></i>
                                                        </div>
                                                        <span class="text-xs text-text-gray">2 bulan lalu</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <p class="text-text-gray text-sm leading-relaxed">
                                                Overall bagus, hanya kadang WiFi agak lambat di jam sibuk. Tapi untuk harga
                                                segini, fasilitasnya sudah sangat memuaskan. Proses booking juga mudah dan
                                                cepat.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- RIGHT COLUMN - BOOKING CARD -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-3xl shadow-2xl p-8 top-28">
                            <div class="mb-6">
                                <p class="text-sm text-text-gray mb-2">Mulai dari</p>
                                <div class="flex items-baseline space-x-2">
                                    <span class="text-4xl font-bold text-accent">
                                        Rp {{ number_format($kamar->harga_bulanan ?? 800000, 0, ',', '.') }}
                                    </span>
                                    <span class="text-text-gray">/bulan</span>
                                </div>
                            </div>

                            <!-- Jenis Sewa -->
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-primary mb-3">Jenis Sewa</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <button
                                        class="border-2 border-accent bg-accent text-white py-3 rounded-xl font-semibold transition">
                                        Bulanan
                                    </button>
                                    <button
                                        class="border-2 border-gray-300 text-gray-700 hover:border-accent hover:text-accent py-3 rounded-xl font-semibold transition">
                                        Tahunan
                                    </button>
                                </div>
                            </div>

                            <!-- Biaya -->
                            <div class="bg-gray-50 rounded-2xl p-6 mb-6">
                                <h3 class="font-semibold text-primary mb-4">Rincian Biaya</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-text-gray">Sewa per bulan</span>
                                        <span class="font-semibold text-primary">Rp 800.000</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-text-gray">Deposit</span>
                                        <span class="font-semibold text-primary">Rp 500.000</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-text-gray">Listrik (estimasi)</span>
                                        <span class="font-semibold text-primary">Rp 150.000</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-text-gray">Air</span>
                                        <span class="font-semibold text-primary">Rp 50.000</span>
                                    </div>
                                    <div class="border-t border-gray-300 pt-3 flex justify-between">
                                        <span class="font-semibold text-primary">Total Awal</span>
                                        <span class="font-bold text-accent text-xl">Rp 1.500.000</span>
                                    </div>
                                </div>
                            </div>



                            <!-- CTA Buttons -->
                            <div class="space-y-3">
                                @guest
                                    <button
                                        class="w-full bg-gray-400 text-white py-4 rounded-xl font-bold text-lg shadow-lg flex items-center justify-center cursor-not-allowed relative group">

                                        <i class="fas fa-calendar-check mr-3"></i>
                                        Booking Sekarang

                                        <!-- Tooltip -->
                                        <span
                                            class="absolute -top-10 bg-black text-white text-sm px-3 py-1 rounded opacity-0 group-hover:opacity-100 transition">
                                            Login untuk booking
                                        </span>
                                    </button>
                                @endguest

                                @auth
                                    <a href="{{ route('user.booking.create', $kamar->id) }}"
                                        class="w-full bg-accent hover:bg-orange-600 text-white py-4 rounded-xl font-bold text-lg transition shadow-lg flex items-center justify-center">
                                        <i class="fas fa-calendar-check mr-3"></i>
                                        Booking Sekarang
                                    </a>
                                @endauth

                                <button
                                    class="w-full border-2 border-accent text-accent hover:bg-accent hover:text-white py-4 rounded-xl font-semibold transition flex items-center justify-center">
                                    <i class="fab fa-whatsapp mr-3 text-xl"></i>
                                    Chat WhatsApp
                                </button>
                                <button
                                    class="w-full border-2 border-gray-300
           hover:border-yellow-400 text-yellow-400 py-4 rounded-xl transition flex items-center justify-center">

                                    <i class="fas fa-star text-yellow-400 text-xl mr-3"></i>
                                    <span class="font-semibold text-primary tracking-wide">
                                        Rating Kamar
                                    </span>
                                </button>


                                <!-- Popup Pemberitahuan -->
                                <div id="bookingModal"
                                    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50">

                                    <div
                                        class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 p-8 text-center animate-fadeIn">

                                        <div
                                            class="w-16 h-16 mx-auto mb-4 flex items-center justify-center rounded-full bg-orange-100 text-accent">
                                            <i class="fas fa-info-circle text-3xl"></i>
                                        </div>

                                        <h3 class="text-xl font-bold text-primary mb-2">
                                            Informasi Booking
                                        </h3>

                                        <p class="text-textGray mb-6">
                                            Kamar<span class="font-semibold text-accent ml-1">bisa dibooking dari tanggal
                                                1</span>.
                                            <br>
                                            Harap pilih tanggal 1 disetiap bulan yang anda pilih dan berapa lama durasi kos
                                        </p>

                                        <button id="closeModal"
                                            class="w-full bg-accent hover:bg-orange-600 text-white py-3 rounded-xl font-semibold transition">
                                            MENGERTI!
                                        </button>

                                        <a href="panduan.html"
                                            class="block w-full bg-primary hover:bg-secondary text-white py-3 rounded-xl font-semibold transition
          flex items-center justify-center mt-3 gap-3">
                                            <i class="fas fa-book-open text-lg"></i>
                                            Baca Panduan
                                        </a>

                                    </div>
                                </div>


                            </div>

                            <!-- Info -->
                            <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-xl">
                                <div class="flex items-start space-x-3">
                                    <i class="fas fa-info-circle text-blue-500 mt-1"></i>
                                    <p class="text-sm text-blue-900">
                                        <strong>Harap Perhatikan:</strong> Sebelum booking harap perhatikan kembali
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Scroll to Top Button -->
        <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
            class="fixed bottom-8 right-8 bg-accent hover:bg-orange-600 text-white w-14 h-14 rounded-full shadow-2xl flex items-center justify-center transition z-50">
            <i class="fas fa-arrow-up text-xl"></i>
        </button>

        <script>
            const bookingBtn = document.getElementById('bookingBtn');
            const bookingModal = document.getElementById('bookingModal');
            const closeModal = document.getElementById('closeModal');

            bookingBtn.addEventListener('click', function(e) {
                e.preventDefault();
                bookingModal.classList.remove('hidden');
                bookingModal.classList.add('flex');
            });

            closeModal.addEventListener('click', function() {
                window.location.href = "booking.html";
            });
        </script>



    </body>
@endsection
