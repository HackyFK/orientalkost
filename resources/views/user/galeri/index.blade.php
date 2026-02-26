@extends('user.layouts.app')

@section('content')

    <body class="bg-slate-50">

        <!-- Hero Section -->
        <section class="relative text-white py-24">
            <!-- Background Image -->
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=1920" alt="KosKu Residence"
                    class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-br from-primary/90 via-secondary/85 to-primary/90"></div>
            </div>

            <!-- Content -->
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mt-10">
                <div
                    class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm px-5 py-2.5 rounded-full text-sm font-medium mb-6">
                    <i class="fas fa-images text-accent"></i>
                    <span>Galeri KosKu</span>
                </div>

                <h1 class="text-4xl lg:text-5xl font-bold mb-4">
                    Kumpulan <span class="text-accent pl-1 pr-2">Galeri</span>KosKu
                </h1>

                <p class="text-lg lg:text-xl text-slate-200 max-w-2xl mx-auto mb-8">
                    Jelajahi kenyamanan, fasilitas, dan suasana hunian terbaik KosKu melalui galeri foto pilihan kami
                </p>
            </div>
        </section>


        

        <!-- Gallery Grid -->
        <section class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Gallery Grid -->
                <div id="galleryGrid" class="columns-1 sm:columns-2 lg:columns-3 xl:columns-4 gap-8">

                    @foreach ($galeris as $galeri)
                        <div class="gallery-item bg-white rounded-2xl shadow-lg cursor-pointer group
    mb-8 break-inside-avoid hover:-translate-y-1 hover:shadow-2xl transition-all relative"
                            onclick="openGallery(
        '{{ addslashes($galeri->judul) }}',
        '{{ $galeri->created_at->translatedFormat('d F Y') }}',
        '{{ addslashes($galeri->deskripsi_singkat) }}',
        '{{ asset('storage/' . $galeri->gambar) }}'
    )">

                            <div class="relative overflow-hidden rounded-2xl">

                                <!-- Gambar -->
                                <img src="{{ asset('storage/' . $galeri->gambar) }}" class="w-full object-cover">

                                <!-- Overlay -->
                                <div
                                    class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center transition duration-300">
                                    <i class="fas fa-eye text-white text-3xl"></i>
                                </div>

                                <!-- Info -->
                                <div
                                    class="absolute inset-0 bottom-0 p-4 flex flex-col justify-end opacity-100 bg-gradient-to-t from-black/50 to-transparent">
                                    <h3 class="font-semibold text-lg text-white mb-1">
                                        {{ $galeri->judul }}
                                    </h3>
                                    <p class="text-sm text-slate-200">
                                        {{ $galeri->created_at->translatedFormat('d F Y') }}
                                    </p>
                                </div>

                            </div>
                        </div>
                    @endforeach

                    @if ($galeris->isEmpty())
                        <div class="text-center py-20">
                            <div class="bg-white rounded-2xl shadow-lg p-12 max-w-md mx-auto">
                                <i class="fas fa-images text-6xl text-textGray mb-4"></i>
                                <h3 class="text-2xl font-bold text-primary mb-2">Tidak Ada Foto</h3>
                                <p class="text-textGray">Belum ada galeri tersedia</p>
                            </div>
                        </div>
                    @endif

                    <!-- Modal / Popup Responsif -->
                    <div id="galleryModal"
                        class="fixed inset-0 bg-black/70 hidden z-50 flex items-center justify-center p-4 overflow-auto">
                        <div
                            class="bg-white rounded-3xl shadow-2xl overflow-hidden w-full max-w-lg sm:max-w-2xl lg:max-w-4xl relative">

                            <!-- Tombol Close -->
                            <button onclick="closeGallery()"
                                class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 text-3xl sm:text-4xl font-bold z-50">
                                &times;
                            </button>

                            <!-- Bagian Gambar -->
                            <div class="w-full mt-10 mb-10 rounded-2xl shadow-2xl">
                                <img id="galleryModalImg" src=""
                                    class="w-full h-auto max-h-[50vh] sm:max-h-[60vh] lg:max-h-[70vh] object-contain">
                            </div>


                            <!-- Konten Info -->
                            <div class="p-4 sm:p-6 lg:p-8">
                                <h2 id="galleryModalTitle" class="text-lg sm:text-2xl lg:text-3xl font-bold mb-2"></h2>
                                <p id="galleryModalDate" class="text-xs sm:text-sm lg:text-base text-gray-500 mb-4"></p>
                                <p id="galleryModalDesc" class="text-sm sm:text-base lg:text-lg text-gray-700"></p>
                            </div>
                        </div>
                    </div>

                    <script>
                        function openGallery(title, date, desc, imgUrl) {
                            const modal = document.getElementById('galleryModal');
                            modal.classList.remove('hidden');

                            document.getElementById('galleryModalTitle').innerText = title;
                            document.getElementById('galleryModalDate').innerText = date;
                            document.getElementById('galleryModalDesc').innerText = desc;
                            document.getElementById('galleryModalImg').src = imgUrl;

                            // Disable scroll saat modal terbuka
                            document.body.style.overflow = 'hidden';
                        }

                        function closeGallery() {
                            const modal = document.getElementById('galleryModal');
                            modal.classList.add('hidden');

                            // Aktifkan scroll lagi
                            document.body.style.overflow = 'auto';
                        }
                    </script>

                    <!-- No Results -->
                    <div id="noResults" class="hidden text-center py-20">
                        <div class="bg-white rounded-2xl shadow-lg p-12 max-w-md mx-auto">
                            <i class="fas fa-images text-6xl text-textGray mb-4"></i>
                            <h3 class="text-2xl font-bold text-primary mb-2">Tidak Ada Foto</h3>
                            <p class="text-textGray">Tidak ada foto dalam kategori ini</p>
                        </div>
                    </div>
                </div>
        </section>

        <!-- CTA Section -->
        <section class="bg-gradient-to-br from-primary via-secondary to-primary text-white py-16">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-3xl lg:text-4xl font-bold mb-4">Tertarik dengan Kos Kami?</h2>
                <p class="text-xl text-slate-300 mb-8">Jadwalkan kunjungan atau booking kamar sekarang juga</p>
                <div class="flex flex-wrap gap-4 justify-center">
                    <a href="{{ route('user.kos.index') }}"
                        class="inline-flex items-center gap-2 bg-accent hover:bg-orange-600 text-white font-semibold px-8 py-4 rounded-xl transition-all shadow-lg hover:shadow-xl hover:-translate-y-1">
                        <i class="fas fa-calendar-check"></i>
                        Booking Sekarang
                    </a>
                     <a href="https://wa.me/{{ $settings->contact_whatsapp }}" target="_blank"
                        class="inline-flex items-center gap-2 bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white font-semibold px-8 py-4 rounded-xl transition-all border-2 border-white/20">
                      <i class="fab fa-whatsapp mr-2"></i>
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </section>
    </body>
@endsection
