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
                    <h1 class="text-4xl md:text-6xl font-extrabold mb-6">
                        Kamar di
                        <span class="text-accent">{{ $kos->nama_kos }}</span>
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
                                Menampilkan
                                <span class="font-semibold text-primary">{{ $kamars->count() }} kamar</span>

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
        <!-- ROOM CARDS GRID -->
        <section class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

                    @forelse ($kamars as $kamar)
                        <div
                            class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden group">

                            <!-- Image -->
                            <div class="relative overflow-hidden h-64">
                                <img src="{{ $kamar->primaryImage
                                    ? asset('storage/' . $kamar->primaryImage->image_path)
                                    : 'https://images.unsplash.com/photo-1522771739844-6a9f6d5f14af?w=600' }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                                <!-- Status -->
                                <div
                                    class="absolute top-4 left-4
                            {{ $kamar->status === 'tersedia' ? 'bg-green-500' : 'bg-red-500' }}
                            text-white px-4 py-2 rounded-full font-semibold flex items-center shadow-lg">
                                    {{ ucfirst($kamar->status) }}
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-6">
                                <h3 class="text-2xl font-bold text-accent tracking-tight mb-2">
                                    {{ $kamar->nama_kamar }}
                                </h3>

                                <p class="text-text-gray text-sm mb-4">
                                    {{ $kamar->deskripsi ?? 'Kamar nyaman dengan fasilitas lengkap.' }}
                                </p>

                                <!-- Fasilitas -->
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach ($kamar->fasilitas->take(5) as $fasilitas)
                                        <span
                                            class="bg-gray-100 px-3 py-1.5 rounded-full text-sm text-gray-700 font-medium">
                                            <i class="{{ $fasilitas->icon ?? 'fas fa-circle-check' }} text-accent mr-1"></i>
                                            {{ $fasilitas->nama_fasilitas }}
                                        </span>
                                    @endforeach
                                </div>

                                <!-- Harga -->
                                <div class="border-t border-gray-200 pt-4 mb-4">
                                    <p class="text-gray-800 text-3xl font-bold">
                                        Rp {{ number_format($kamar->harga_bulanan, 0, ',', '.') }}
                                    </p>
                                    <p class="text-text-gray text-sm">per bulan</p>
                                </div>

                                <!-- Button -->
                                <div class="flex gap-3">
                                    <a href="{{ route('user.kamar.show', $kamar->id) }}"
                                        class="flex-1 inline-flex items-center justify-center border-2 border-accent
                                       text-accent hover:bg-accent hover:text-white py-3 rounded-xl font-semibold transition">
                                        <i class="fas fa-info-circle mr-2"></i>
                                        Detail
                                    </a>

                                    <a href="{{ route('user.booking', ['kamar' => $kamar->id]) }}"
                                        class="flex-1 bg-accent hover:bg-orange-600 text-white py-3 rounded-xl
                                       font-semibold transition shadow-lg text-center">
                                        <i class="fas fa-calendar-check mr-2"></i>
                                        Booking
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center text-text-gray py-20">
                            <i class="fas fa-bed text-4xl mb-4"></i>
                            <p class="text-lg font-semibold">Belum ada kamar tersedia untuk kos ini</p>
                        </div>
                    @endforelse

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
