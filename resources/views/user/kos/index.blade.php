@extends('user.layouts.app')

@section('content')
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
    <form method="GET" action="{{ route('user.kos.index') }}">
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

                        <select name="jenis_kos"
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50
                    focus:border-accent focus:ring-2 focus:ring-accent-soft outline-none transition">

                            <option value="">Semua Jenis</option>

                            <option value="putra" {{ request('jenis_kos') == 'putra' ? 'selected' : '' }}>
                                Kos Putra
                            </option>

                            <option value="putri" {{ request('jenis_kos') == 'putri' ? 'selected' : '' }}>
                                Kos Putri
                            </option>

                            <option value="campur" {{ request('jenis_kos') == 'campur' ? 'selected' : '' }}>
                                Kos Campuran
                            </option>

                        </select>
                    </div>


                    <!-- Fasilitas 1 -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-concierge-bell text-accent mr-2"></i>
                            Fasilitas 1
                        </label>

                        <select name="fasilitas1" class="w-full border rounded-lg px-3 py-2">
                            <option value="">Semua</option>

                            @foreach ($fasilitasList as $f)
                                <option value="{{ $f->nama_fasilitas }}"
                                    {{ request('fasilitas1') == $f->nama_fasilitas ? 'selected' : '' }}>
                                    {{ $f->nama_fasilitas }}
                                </option>
                            @endforeach

                        </select>
                    </div>


                    <!-- Fasilitas 2 -->
                    <div class="space-y-2">
                        <label class="text-sm font-medium text-gray-700 flex items-center">
                            <i class="fas fa-concierge-bell text-accent mr-2"></i>
                            Fasilitas 2
                        </label>

                        <select name="fasilitas2" class="w-full border rounded-lg px-3 py-2">
                            <option value="">Semua</option>

                            @foreach ($fasilitasList as $f)
                                <option value="{{ $f->nama_fasilitas }}"
                                    {{ request('fasilitas2') == $f->nama_fasilitas ? 'selected' : '' }}>
                                    {{ $f->nama_fasilitas }}
                                </option>
                            @endforeach

                        </select>
                    </div>


                    <!-- Button -->
                    <div class="flex gap-3 lg:col-span-2">

                        <button type="submit"
                            class="w-full bg-accent hover:bg-orange-600 text-white px-5 py-3
                    rounded-xl font-semibold transition shadow-lg
                    flex items-center justify-center">

                            <i class="fas fa-search mr-2"></i>
                            Filter

                        </button>

                        <!-- Reset -->
                        <a href="{{ route('user.kos.index') }}"
                            class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 px-5 py-3
                    rounded-xl font-semibold transition shadow-lg
                    flex items-center justify-center">

                            Reset

                        </a>

                    </div>

                </div>


                <!-- Result Info -->
                <div class="mt-4 text-sm text-text-gray text-center md:text-left">

                    Menampilkan
                    <span class="font-semibold text-primary">
                        {{ $kos->count() }}
                    </span>

                    kos

                </div>

            </div>
        </section>
    </form>


    <!-- KOS CARDS GRID -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @if ($noResult)
                    <p class="text-center text-red-500 font-semibold mt-4">
                        Data Kos tidak ditemukan.
                    </p>
                @endif
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

                                    {{ $item->jumlah_kamar }}
                                    Kamar
                                </span>

                                {{-- fasilitas dari kamar --}}
                                {{-- 1 fasilitas per kategori --}}
                                @foreach ($item->fasilitas as $kategori => $fasilitasGroup)
                                    @php
                                        $fasilitas = $fasilitasGroup->first();
                                    @endphp

                                    @if ($fasilitas)
                                        <span class="bg-gray-100 px-3 py-1.5 rounded-full text-sm font-medium">
                                            <i class="{{ $fasilitas->icon }} text-accent mr-1"></i>
                                            {{ $fasilitas->nama_fasilitas }}
                                        </span>
                                    @endif
                                @endforeach
                            </div>

                            <!-- Status (STATIS) -->
                            <div class="flex gap-3 mb-4">
                                <span
                                    class="{{ $item->kamar_tersedia > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }} 
    px-4 py-2 rounded-full text-sm font-semibold flex items-center">

                                    @if ($item->kamar_tersedia > 0)
                                        <i class="fas fa-check-circle mr-2"></i>Tersedia
                                    @else
                                        <i class="fas fa-times-circle mr-2"></i>Tidak tersedia
                                    @endif

                                </span>

                                @php
                                    $gender = strtolower($item->gender);

                                    $config = match ($gender) {
                                        'putra' => [
                                            'bg' => 'bg-blue-100 text-blue-700',
                                            'icon' => 'fa-mars',
                                            'label' => 'Putra',
                                        ],
                                        'putri' => [
                                            'bg' => 'bg-pink-100 text-pink-700',
                                            'icon' => 'fa-venus',
                                            'label' => 'Putri',
                                        ],
                                        'campuran' => [
                                            'bg' => 'bg-purple-100 text-purple-700',
                                            'icon' => 'fa-venus-mars',
                                            'label' => 'Campuran',
                                        ],
                                        default => [
                                            'bg' => 'bg-gray-100 text-gray-700',
                                            'icon' => 'fa-circle',
                                            'label' => ucfirst($item->gender),
                                        ],
                                    };
                                @endphp

                                <span
                                    class="{{ $config['bg'] }} px-4 py-2 rounded-full text-sm font-semibold flex items-center">
                                    <i class="fas {{ $config['icon'] }} mr-2"></i>
                                    {{ $config['label'] }}
                                </span>
                            </div>


                            <!-- Rating & Kamar Tersedia (STATIS) -->
                            <div
                                class="flex items-center justify-between mb-8
                            bg-gray-200/50 backdrop-blur-sm
                            px-4 py-2 rounded-xl">
                                <button type="button"
                                    class="like-btn flex items-center gap-1 text-primary hover:text-red-500"
                                    data-id="{{ $item->id }}"
                                    @if (auth()->user() &&
                                            $item->likesUsers()->where('user_id', auth()->id())->exists()) data-liked="true"
    @else
        data-liked="false" @endif>
                                    <i class="fas fa-heart"></i>
                                    <span class="like-count">{{ $item->likes }}</span>
                                </button>




                                <div class="flex items-center gap-2 text-sm text-purple-700 font-semibold">
                                    <i class="fas fa-bed"></i>

                                    {{ $item->kamar_tersedia }}
                                    Kamar Tersedia</span>
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
    @if ($kos->hasPages())
        <div class="flex justify-center items-center space-x-2 mt-12 mb-10">

            {{-- Previous --}}
            @if ($kos->onFirstPage())
                <span
                    class="w-10 h-10 rounded-lg border-2 border-gray-200 text-gray-300 flex items-center justify-center cursor-not-allowed">
                    <i class="fas fa-chevron-left"></i>
                </span>
            @else
                <a href="{{ $kos->previousPageUrl() }}"
                    class="w-10 h-10 rounded-lg border-2 border-gray-300 hover:border-accent hover:bg-accent hover:text-white transition flex items-center justify-center">
                    <i class="fas fa-chevron-left"></i>
                </a>
            @endif


            {{-- Page Numbers --}}
            @foreach ($kos->getUrlRange(1, $kos->lastPage()) as $page => $url)
                @if ($page == $kos->currentPage())
                    <span class="w-10 h-10 rounded-lg bg-accent text-white font-semibold flex items-center justify-center">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $url }}"
                        class="w-10 h-10 rounded-lg border-2 border-gray-300 hover:border-accent hover:bg-accent hover:text-white transition flex items-center justify-center">
                        {{ $page }}
                    </a>
                @endif
            @endforeach


            {{-- Next --}}
            @if ($kos->hasMorePages())
                <a href="{{ $kos->nextPageUrl() }}"
                    class="w-10 h-10 rounded-lg border-2 border-gray-300 hover:border-accent hover:bg-accent hover:text-white transition flex items-center justify-center">
                    <i class="fas fa-chevron-right"></i>
                </a>
            @else
                <span
                    class="w-10 h-10 rounded-lg border-2 border-gray-200 text-gray-300 flex items-center justify-center cursor-not-allowed">
                    <i class="fas fa-chevron-right"></i>
                </span>
            @endif

        </div>
    @endif

    </section>

    <!-- CTA SECTION -->
    <section class="py-16 bg-primary text-text-light">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Butuh Bantuan Menemukan Kos?</h2>
            <p class="text-lg text-text-gray mb-8">
                Tim kami siap membantu Anda menemukan kos yang sempurna sesuai kebutuhan dan budget
            </p>
            {{-- Tombol Telepon --}}
            <a href="tel:{{ $settings->contact_phone }}"
                class="bg-accent hover:bg-orange-600 text-white px-8 py-4 rounded-xl font-semibold transition shadow-lg inline-flex items-center justify-center">
                <i class="fas fa-phone-alt mr-2"></i>
                Hubungi Kami
            </a>

            {{-- Tombol WhatsApp --}}
            <a href="https://wa.me/{{ $settings->contact_whatsapp }}" target="_blank"
                class="bg-white hover:bg-gray-100 text-primary px-8 py-4 rounded-xl font-semibold transition shadow-lg inline-flex items-center justify-center">
                <i class="fab fa-whatsapp mr-2"></i>
                Chat WhatsApp
            </a>
        </div>
    </section>

    <!-- Scroll to Top Button -->
    <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
        class="fixed bottom-8 right-8 bg-accent hover:bg-orange-600 text-white w-14 h-14 rounded-full shadow-2xl flex items-center justify-center transition z-50">
        <i class="fas fa-arrow-up text-xl"></i>
    </button>

    <!-- CSRF Meta -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Like Button JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const token = document.querySelector('meta[name="csrf-token"]').content;

            document.querySelectorAll('.like-btn').forEach(button => {

                // Warna awal
                if (button.dataset.liked === "true") {
                    button.classList.add('text-pink-500');
                } else {
                    button.classList.add('text-black');
                }

                button.addEventListener('click', function() {
                    const kosId = this.dataset.id;
                    const countSpan = this.querySelector('.like-count');

                    fetch(`/kos/${kosId}/like`, {
                            method: "POST",
                            headers: {
                                'X-CSRF-TOKEN': token,
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            },
                        })
                        .then(res => res.json())
                        .then(data => {
                            // Update jumlah like
                            countSpan.textContent = data.likes;

                            if (data.liked) {
                                // LIKE → pink
                                this.classList.remove('text-black');
                                this.classList.add('text-pink-500');
                                this.dataset.liked = "true";
                            } else {
                                // UNLIKE → hitam
                                this.classList.remove('text-pink-500');
                                this.classList.add('text-black');
                                this.dataset.liked = "false";
                            }
                        })
                        .catch(err => console.error(err));
                });
            });
        });
    </script>
@endsection
