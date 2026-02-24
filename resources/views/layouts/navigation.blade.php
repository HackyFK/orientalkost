<!DOCTYPE html>
<html lang="id">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
                <div class="flex items-center space-x-4 relative">
                    @guest
                        <!-- Jika BELUM login -->
                        <a href="{{ route('login') }}"
                            class="hidden md:block text-text-light hover:text-accent transition font-medium">
                            Login
                        </a>
                    @endguest

                    @auth
                        <!-- Jika SUDAH login -->
                        <div class="relative hidden md:block">
                            <!-- Button User -->
                            <button id="user-menu-button"
                                class="w-10 h-10 rounded-full bg-accent text-white flex items-center justify-center focus:outline-none">
                                <i class="fas fa-user"></i>
                            </button>

                            <!-- Dropdown -->
                            <div id="user-dropdown"
                                class="hidden absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg py-2 z-50">

                                <!-- Profile -->
                                <a href="{{ route('profile.edit') }}"
                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                                    Profile
                                </a>

                                <!-- Logout -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endauth

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
            </div>
        </div>
    </nav>
</body>

</html>
