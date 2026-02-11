<!DOCTYPE html>
<html lang="id">

<head>
    <!-- SEO Meta Tags -->
    <meta name="description" content="{{ setting('seo_description', 'Website kos modern dan terpercaya') }}">
    <meta name="keywords" content="{{ setting('seo_keywords', 'kos, kamar, sewa kos') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', setting('site_name', 'KosKu'))
    </title>

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#0F1E32',
                        'secondary': '#1E2F4D',
                        'accent': '#F97316',
                        'accent-soft': '#FDBA74',
                        'text-light': '#F8FAFC',
                        'text-gray': '#94A3B8'
                    },
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        /* GLOBAL */
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        /* GRADIENT */
        .hero-gradient {
            background: linear-gradient(135deg, rgba(15, 30, 50, 0.95) 0%, rgba(30, 47, 77, 0.85) 100%);
        }

        .gradient-orange {
            background: linear-gradient(135deg, #F97316 0%, #EA580C 100%);
        }

        .gradient-bg {
            background: linear-gradient(135deg, #F8FAFC 0%, #FFFFFF 100%);
        }

        .gradient-overlay {
            background: linear-gradient(180deg, rgba(15, 30, 50, 0) 0%, rgba(15, 30, 50, 0.8) 100%);
        }

        .gradient-text {
            background: linear-gradient(135deg, #F97316 0%, #EA580C 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* BLOG */
        .blog-card {
            transition: all 0.3s ease;
        }

        .blog-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(15, 30, 50, 0.15);
        }

        .blog-image {
            overflow: hidden;
        }

        .blog-image img {
            transition: transform 0.5s ease;
        }

        .blog-card:hover .blog-image img {
            transform: scale(1.1);
        }

        .like-btn.liked {
            color: #F97316;
        }

        /* CATEGORY BADGE (disatukan, tidak dobel lagi) */
        .category-badge {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        /* GALLERY */
        .gallery-item {
            position: relative;
            overflow: hidden;
        }

        .gallery-item img {
            transition: transform 0.5s ease;
        }

        .gallery-item:hover img {
            transform: scale(1.1);
        }

        /* MODAL */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 9999;
            background-color: rgba(15, 30, 50, 0.95);
            backdrop-filter: blur(10px);
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeIn 0.3s ease;
        }

        .modal-content {
            max-width: 90%;
            max-height: 90%;
            animation: zoomIn 0.3s ease;
        }

        /* ANIMATION */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes zoomIn {
            from {
                transform: scale(0.8);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* KOS / KAMAR / DETAIL */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: repeat(2, 250px);
            gap: 1rem;
        }

        .gallery-main {
            grid-column: 1 / 3;
            grid-row: 1 / 3;
        }

        @media (max-width: 768px) {
            .gallery-grid {
                grid-template-columns: 1fr;
                grid-template-rows: auto;
            }

            .gallery-main {
                grid-column: 1;
                grid-row: auto;
            }
        }
    </style>
</head>

<body class="bg-white">

    <!-- NAVBAR -->
    <nav class="bg-primary fixed w-full top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">

                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <i class="fa-brands fa-galactic-senate text-accent text-3xl"></i>
                    <span class="text-text-light text-2xl font-bold">
                        {{ setting('site_name', 'KosKu') }}
                    </span>

                </div>

                <!-- Menu Desktop -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="{{ route('user.beranda') }}"
                        class="flex items-center gap-2 text-text-light hover:text-accent transition">
                        <i class="fas fa-home text-sm"></i>
                        <span>Home</span>
                    </a>

                    <a href="{{ route('user.kos.index') }}"
                        class="flex items-center gap-2 text-text-light hover:text-accent transition">
                        <i class="fas fa-building text-sm"></i>
                        <span>Kos</span>
                    </a>

                    <a href="{{ route('user.galeri') }}"
                        class="flex items-center gap-2 text-text-light hover:text-accent transition">
                        <i class="fas fa-images text-sm"></i>
                        <span>Galeri</span>
                    </a>

                    <a href="{{ route('user.blog') }}"
                        class="flex items-center gap-2 text-text-light hover:text-accent transition">
                        <i class="fas fa-blog text-sm"></i>
                        <span>Blog</span>
                    </a>

                    <a href="#kontak" class="flex items-center gap-2 text-text-light hover:text-accent transition">
                        <i class="fas fa-envelope text-sm"></i>
                        <span>Kontak</span>
                    </a>
                </div>


                <!-- Right -->
                <div class="flex items-center space-x-4">
                    @guest
                        <!-- Jika BELUM login -->
                        <a href="{{ route('login') }}"
                            class="hidden md:block text-text-light hover:text-accent transition font-medium">
                            Login
                        </a>
                    @endguest

                    @auth
                        <!-- Jika SUDAH login -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="hidden md:block text-text-light hover:text-accent transition font-medium">
                                Logout
                            </button>
                        </form>
                    @endauth

                    <a href="https://wa.me/{{ setting('contact_whatsapp') }}"
                        class="bg-accent hover:bg-orange-600 text-white px-6 py-2.5 rounded-full font-semibold transition shadow-lg">
                        {{ setting('cta_booking_text', 'Booking') }}
                    </a>

                    <!-- Toggle -->
                    <button id="menu-toggle" class="lg:hidden text-text-light text-2xl">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>


            </div>
        </div>

        <!-- MENU MOBILE -->
        <div id="mobile-menu" class="hidden lg:hidden bg-primary border-t border-white/10">
            <div class="px-6 py-6 space-y-4">
                <a href="{{ route('user.beranda') }}" class="block text-text-light hover:text-accent">Home</a>
                <a href="{{ route('user.kos.index') }}" class="block text-text-light hover:text-accent">Kos</a>
                <a href="{{ route('user.galeri') }}" class="block text-text-light hover:text-accent">Galeri</a>
                <a href="{{ route('user.blog') }}" class="block text-text-light hover:text-accent">Blog</a>
                <a href="#kontak" class="block text-text-light hover:text-accent">Kontak</a>

                <button class="w-full mt-4 bg-accent text-white py-3 rounded-xl font-semibold">
                    Booking Sekarang
                </button>
            </div>
        </div>
    </nav>


    {{-- KONTEN HALAMAN --}}
    <main class="pt-3">
        @yield('content')
    </main>


    <!-- FOOTER -->
    <footer id="kontak" class="bg-secondary text-text-light py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-12">
                <div>
                    <div class="flex items-center space-x-3 mb-6">
                        <i class="fa-brands fa-galactic-senate text-accent text-3xl"></i>
                        <span class="text-2xl font-bold">@yield('title', setting('site_name', 'KosKu'))</span>
                    </div>
                    <p class="text-text-gray leading-relaxed mb-4">
                        {{ setting('site_tagline') }}
                    </p>

                    <div class="flex space-x-4">
                        @if (setting('social_facebook'))
                            <a href="{{ setting('social_facebook') }}" target="_blank"
                                class="bg-primary hover:bg-accent w-10 h-10 rounded-full flex items-center justify-center transition">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        @endif

                        @if (setting('social_instagram'))
                            <a href="{{ setting('social_instagram') }}" target="_blank"
                                class="bg-primary hover:bg-accent w-10 h-10 rounded-full flex items-center justify-center transition">
                                <i class="fab fa-instagram"></i>
                            </a>
                        @endif

                        @if (setting('contact_whatsapp'))
                            <a href="https://wa.me/{{ setting('contact_whatsapp') }}"
                                class="bg-primary hover:bg-accent w-10 h-10 rounded-full flex items-center justify-center transition"
                                target="_blank">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        @endif

                    </div>

                </div>

                <div>
                    <h3 class="text-xl font-bold mb-6">Menu</h3>
                    <ul class="space-y-3">
                        <li><a href="#home" class="text-text-gray hover:text-accent transition">Home</a></li>
                        <li><a href="#profil" class="text-text-gray hover:text-accent transition">Profil Kami</a></li>
                        <li><a href="#kamar" class="text-text-gray hover:text-accent transition">Kamar</a></li>
                        <li><a href="#galeri" class="text-text-gray hover:text-accent transition">Galeri</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-6">Layanan</h3>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-text-gray hover:text-accent transition">Cari Kamar</a></li>
                        <li><a href="#" class="text-text-gray hover:text-accent transition">Booking Online</a>
                        </li>
                        <li><a href="#" class="text-text-gray hover:text-accent transition">Virtual Tour</a>
                        </li>
                        <li><a href="#" class="text-text-gray hover:text-accent transition">FAQ</a></li>
                        <li><a href="#" class="text-text-gray hover:text-accent transition">Syarat &
                                Ketentuan</a></li>
                    </ul>
                </div>

                <div>
                    <h3 class="text-xl font-bold mb-6">Kontak</h3>
                    <ul class="space-y-4">
                        <li class="flex items-start space-x-3">
                            <i class="fas fa-map-marker-alt text-accent mt-1"></i>
                            <span class="text-text-gray">
                                {!! nl2br(e(setting('contact_address'))) !!}
                            </span>

                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-phone text-accent"></i>
                            <span class="text-text-gray">
                                {{ setting('contact_phone') }}
                            </span>

                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-envelope text-accent"></i>
                            <span class="text-text-gray">
                                {{ setting('contact_email') }}
                            </span>

                        </li>
                        <li class="flex items-center space-x-3">
                            <i class="fas fa-clock text-accent"></i>
                            <span class="text-text-gray">
                                {{ setting('operational_hours') }}
                            </span>

                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-12 pt-8 text-center">
                <p class="text-text-gray">
                    &copy; 2026 KosKu. All rights reserved. Made with <i class="fas fa-heart text-accent"></i> for
                    better living
                </p>
            </div>
        </div>
    </footer>



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

    <!-- navbar -->
    <script>
        const toggle = document.getElementById('menu-toggle');
        const menu = document.getElementById('mobile-menu');

        toggle.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>

</html>
