@extends('user.layouts.app')

@section('content')

    <body class="bg-slate-50">

        <!-- Hero Section -->
        <section class="relative h-[75vh] flex items-center justify-center text-white overflow-hidden">

    <!-- Background Image -->
    <div class="absolute inset-0">
        <img 
            src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=1600"
            alt="Blog Background"
            class="w-full h-full object-cover">
    </div>

    <!-- Blue Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-br 
        from-blue-900/80 
        via-slate-900/70 
        to-black/80">
    </div>

    <!-- Content -->
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center  pt-5">

        <!-- Badge -->
        <div
            class="inline-flex items-center gap-2 bg-white/15 backdrop-blur-md px-5 py-2.5 rounded-full text-sm font-semibold mb-6">
            <i class="fas fa-blog text-accent"></i>
            <span>Blog & Artikel</span>
        </div>

        <!-- Title -->
        <h1 class="text-4xl lg:text-6xl font-extrabold mb-6 leading-tight">
            Insight & Cerita
            <span class="block text-accent pt-1">Dunia Perhunian</span>
        </h1>

        <!-- Description -->
        <p class="text-lg lg:text-xl text-slate-200 max-w-2xl mx-auto mb-10">
            Artikel seputar kos-kosan, manajemen hunian, dan kehidupan profesional modern
        </p>

        <!-- Search -->
        <div class="max-w-xl mx-auto">
            <div class="relative">
                <input
                    type="text"
                    placeholder="Cari artikel..."
                    class="w-full px-6 py-4 pl-14 rounded-2xl text-primary font-medium
                           focus:outline-none focus:ring-4 focus:ring-blue-400 shadow-xl">
                <i
                    class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-blue-400 text-lg"></i>
            </div>
        </div>

    </div>
</section>



        <!-- Category Filter -->
        <section class="bg-white border-b top-[88px] z-40 shadow-sm mt-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="flex flex-wrap items-center justify-center gap-3">
                    <button class="category-btn active px-6 py-2.5 rounded-full font-medium transition-all text-sm">
                        <i class="fas fa-th mr-2"></i>Semua
                    </button>
                    <button class="category-btn px-6 py-2.5 rounded-full font-medium transition-all text-sm">
                        <i class="fas fa-home mr-2"></i>Properti
                    </button>
                    <button class="category-btn px-6 py-2.5 rounded-full font-medium transition-all text-sm">
                        <i class="fas fa-lightbulb mr-2"></i>Tips & Trik
                    </button>
                    <button class="category-btn px-6 py-2.5 rounded-full font-medium transition-all text-sm">
                        <i class="fas fa-user-graduate mr-2"></i>Kehidupan Mahasiswa
                    </button>
                    <button class="category-btn px-6 py-2.5 rounded-full font-medium transition-all text-sm">
                        <i class="fas fa-money-bill-wave mr-2"></i>Keuangan
                    </button>
                </div>
            </div>
        </section>

        <!-- Featured Post -->
        <section class="py-12 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                    <div class="grid lg:grid-cols-2 gap-0">
                        <div class="blog-image h-full min-h-[400px]">
                            <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800&h=600&fit=crop"
                                alt="Featured" class="w-full h-full object-cover">
                        </div>
                        <div class="p-8 lg:p-12 flex flex-col justify-center">
                            <span
                                class="inline-block bg-accent/10 text-accent px-4 py-2 rounded-full text-sm font-semibold mb-4 w-fit">
                                <i class="fas fa-star mr-1"></i>Featured Article
                            </span>
                            <h2 class="text-3xl lg:text-4xl font-bold text-primary mb-4 leading-tight">
                                10 Tips Memilih Kos yang Aman dan Nyaman untuk Mahasiswa
                            </h2>
                            <p class="text-textGray text-lg mb-6 leading-relaxed">
                                Panduan lengkap memilih kos-kosan yang tepat dengan mempertimbangkan faktor keamanan,
                                kenyamanan, lokasi strategis, dan budget yang sesuai untuk mahasiswa.
                            </p>
                            <div class="flex items-center gap-4 mb-6 text-sm text-textGray">
                                <div class="flex items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name=Sarah+Ahmad&background=F97316&color=fff"
                                        alt="Author" class="w-10 h-10 rounded-full">
                                    <span class="font-medium text-primary">Sarah Ahmad</span>
                                </div>
                                <span>•</span>
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-calendar-alt text-accent"></i>
                                    <span>15 Jan 2025</span>
                                </div>
                                <span>•</span>
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-clock text-accent"></i>
                                    <span>5 min read</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <a href="#"
                                    class="inline-flex items-center gap-2 bg-accent hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-xl transition-all">
                                    Baca Selengkapnya
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                                <button
                                    class="like-btn flex items-center gap-2 text-textGray hover:text-accent transition-colors">
                                    <i class="far fa-heart text-xl"></i>
                                    <span class="font-semibold">248</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Blog Grid -->
        <section class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between mb-12">
                    <h2 class="text-3xl font-bold text-primary">Artikel Terbaru</h2>
                    <div class="flex items-center gap-2 text-sm text-textGray">
                        <span>Urutkan:</span>
                        <select
                            class="px-4 py-2 border-2 border-gray-200 rounded-lg font-medium text-primary focus:outline-none focus:border-accent">
                            <option>Terbaru</option>
                            <option>Terpopuler</option>
                            <option>Terlama</option>
                        </select>
                    </div>
                </div>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">

                    <!-- Blog Card 1 -->
                    <article class="blog-card bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="blog-image h-56 relative">
                            <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?w=600&h=400&fit=crop"
                                alt="Blog" class="w-full h-full object-cover">
                            <span
                                class="category-badge absolute top-4 left-4 bg-white/95 text-accent px-3 py-1.5 rounded-full text-xs font-semibold">
                                <i class="fas fa-home mr-1"></i>Properti
                            </span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-3 mb-3 text-xs text-textGray">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-calendar-alt text-accent"></i>
                                    <span>12 Jan 2025</span>
                                </div>
                                <span>•</span>
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-clock"></i>
                                    <span>4 min</span>
                                </div>
                            </div>
                            <h3
                                class="text-xl font-bold text-primary mb-3 leading-snug hover:text-accent transition-colors cursor-pointer">
                                Tren Desain Interior Kos Modern 2025
                            </h3>
                            <p class="text-textGray text-sm mb-4 leading-relaxed">
                                Simak tren desain interior kos terkini yang membuat hunian lebih nyaman dan aesthetic untuk
                                generasi muda.
                            </p>
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="flex items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=1E2F4D&color=fff"
                                        alt="Author" class="w-8 h-8 rounded-full">
                                    <span class="text-sm font-medium text-primary">Budi Santoso</span>
                                </div>
                                <button onclick="toggleLike(this)"
                                    class="like-btn flex items-center gap-1 text-textGray hover:text-accent transition-colors">
                                    <i class="far fa-heart"></i>
                                    <span class="text-sm font-semibold">156</span>
                                </button>
                            </div>
                        </div>
                    </article>

                    <!-- Blog Card 2 -->
                    <article class="blog-card bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="blog-image h-56 relative">
                            <img src="https://images.unsplash.com/photo-1554995207-c18c203602cb?w=600&h=400&fit=crop"
                                alt="Blog" class="w-full h-full object-cover">
                            <span
                                class="category-badge absolute top-4 left-4 bg-white/95 text-accent px-3 py-1.5 rounded-full text-xs font-semibold">
                                <i class="fas fa-lightbulb mr-1"></i>Tips & Trik
                            </span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-3 mb-3 text-xs text-textGray">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-calendar-alt text-accent"></i>
                                    <span>10 Jan 2025</span>
                                </div>
                                <span>•</span>
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-clock"></i>
                                    <span>6 min</span>
                                </div>
                            </div>
                            <h3
                                class="text-xl font-bold text-primary mb-3 leading-snug hover:text-accent transition-colors cursor-pointer">
                                Cara Mengatur Budget Kos untuk Mahasiswa
                            </h3>
                            <p class="text-textGray text-sm mb-4 leading-relaxed">
                                Tips mengelola keuangan dan mengatur budget kos agar tetap hemat tanpa mengurangi kualitas
                                hidup.
                            </p>
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="flex items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name=Dina+Wijaya&background=1E2F4D&color=fff"
                                        alt="Author" class="w-8 h-8 rounded-full">
                                    <span class="text-sm font-medium text-primary">Dina Wijaya</span>
                                </div>
                                <button onclick="toggleLike(this)"
                                    class="like-btn flex items-center gap-1 text-textGray hover:text-accent transition-colors">
                                    <i class="far fa-heart"></i>
                                    <span class="text-sm font-semibold">203</span>
                                </button>
                            </div>
                        </div>
                    </article>

                    <!-- Blog Card 3 -->
                    <article class="blog-card bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="blog-image h-56 relative">
                            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=600&h=400&fit=crop"
                                alt="Blog" class="w-full h-full object-cover">
                            <span
                                class="category-badge absolute top-4 left-4 bg-white/95 text-accent px-3 py-1.5 rounded-full text-xs font-semibold">
                                <i class="fas fa-user-graduate mr-1"></i>Mahasiswa
                            </span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-3 mb-3 text-xs text-textGray">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-calendar-alt text-accent"></i>
                                    <span>8 Jan 2025</span>
                                </div>
                                <span>•</span>
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-clock"></i>
                                    <span>5 min</span>
                                </div>
                            </div>
                            <h3
                                class="text-xl font-bold text-primary mb-3 leading-snug hover:text-accent transition-colors cursor-pointer">
                                Produktif di Kos: Tips Work From Home
                            </h3>
                            <p class="text-textGray text-sm mb-4 leading-relaxed">
                                Strategi meningkatkan produktivitas saat kuliah online atau kerja dari kos-kosan dengan
                                ruang terbatas.
                            </p>
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="flex items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name=Andi+Pratama&background=1E2F4D&color=fff"
                                        alt="Author" class="w-8 h-8 rounded-full">
                                    <span class="text-sm font-medium text-primary">Andi Pratama</span>
                                </div>
                                <button onclick="toggleLike(this)"
                                    class="like-btn flex items-center gap-1 text-textGray hover:text-accent transition-colors">
                                    <i class="far fa-heart"></i>
                                    <span class="text-sm font-semibold">189</span>
                                </button>
                            </div>
                        </div>
                    </article>

                    <!-- Blog Card 4 -->
                    <article class="blog-card bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="blog-image h-56 relative">
                            <img src="https://images.unsplash.com/photo-1556912173-3bb406ef7e77?w=600&h=400&fit=crop"
                                alt="Blog" class="w-full h-full object-cover">
                            <span
                                class="category-badge absolute top-4 left-4 bg-white/95 text-accent px-3 py-1.5 rounded-full text-xs font-semibold">
                                <i class="fas fa-shield-alt mr-1"></i>Keamanan
                            </span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-3 mb-3 text-xs text-textGray">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-calendar-alt text-accent"></i>
                                    <span>5 Jan 2025</span>
                                </div>
                                <span>•</span>
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-clock"></i>
                                    <span>4 min</span>
                                </div>
                            </div>
                            <h3
                                class="text-xl font-bold text-primary mb-3 leading-snug hover:text-accent transition-colors cursor-pointer">
                                Checklist Keamanan Kos yang Wajib Diperhatikan
                            </h3>
                            <p class="text-textGray text-sm mb-4 leading-relaxed">
                                Panduan lengkap memeriksa aspek keamanan kos sebelum memutuskan untuk menghuni.
                            </p>
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="flex items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name=Rina+Sari&background=1E2F4D&color=fff"
                                        alt="Author" class="w-8 h-8 rounded-full">
                                    <span class="text-sm font-medium text-primary">Rina Sari</span>
                                </div>
                                <button onclick="toggleLike(this)"
                                    class="like-btn flex items-center gap-1 text-textGray hover:text-accent transition-colors">
                                    <i class="far fa-heart"></i>
                                    <span class="text-sm font-semibold">142</span>
                                </button>
                            </div>
                        </div>
                    </article>

                    <!-- Blog Card 5 -->
                    <article class="blog-card bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="blog-image h-56 relative">
                            <img src="https://images.unsplash.com/photo-1484480974693-6ca0a78fb36b?w=600&h=400&fit=crop"
                                alt="Blog" class="w-full h-full object-cover">
                            <span
                                class="category-badge absolute top-4 left-4 bg-white/95 text-accent px-3 py-1.5 rounded-full text-xs font-semibold">
                                <i class="fas fa-money-bill-wave mr-1"></i>Keuangan
                            </span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-3 mb-3 text-xs text-textGray">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-calendar-alt text-accent"></i>
                                    <span>3 Jan 2025</span>
                                </div>
                                <span>•</span>
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-clock"></i>
                                    <span>7 min</span>
                                </div>
                            </div>
                            <h3
                                class="text-xl font-bold text-primary mb-3 leading-snug hover:text-accent transition-colors cursor-pointer">
                                Investasi Properti Kos: Untung atau Rugi?
                            </h3>
                            <p class="text-textGray text-sm mb-4 leading-relaxed">
                                Analisa lengkap mengenai bisnis kos-kosan sebagai investasi properti jangka panjang.
                            </p>
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="flex items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name=Tono+Wijaya&background=1E2F4D&color=fff"
                                        alt="Author" class="w-8 h-8 rounded-full">
                                    <span class="text-sm font-medium text-primary">Tono Wijaya</span>
                                </div>
                                <button onclick="toggleLike(this)"
                                    class="like-btn flex items-center gap-1 text-textGray hover:text-accent transition-colors">
                                    <i class="far fa-heart"></i>
                                    <span class="text-sm font-semibold">276</span>
                                </button>
                            </div>
                        </div>
                    </article>

                    <!-- Blog Card 6 -->
                    <article class="blog-card bg-white rounded-2xl shadow-lg overflow-hidden">
                        <div class="blog-image h-56 relative">
                            <img src="https://images.unsplash.com/photo-1556912167-f556f1f39faa?w=600&h=400&fit=crop"
                                alt="Blog" class="w-full h-full object-cover">
                            <span
                                class="category-badge absolute top-4 left-4 bg-white/95 text-accent px-3 py-1.5 rounded-full text-xs font-semibold">
                                <i class="fas fa-lightbulb mr-1"></i>Tips & Trik
                            </span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-3 mb-3 text-xs text-textGray">
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-calendar-alt text-accent"></i>
                                    <span>1 Jan 2025</span>
                                </div>
                                <span>•</span>
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-clock"></i>
                                    <span>5 min</span>
                                </div>
                            </div>
                            <h3
                                class="text-xl font-bold text-primary mb-3 leading-snug hover:text-accent transition-colors cursor-pointer">
                                DIY Dekorasi Kamar Kos dengan Budget Minim
                            </h3>
                            <p class="text-textGray text-sm mb-4 leading-relaxed">
                                Ide kreatif dan murah untuk mendekorasi kamar kos agar lebih nyaman dan instagramable.
                            </p>
                            <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                <div class="flex items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name=Lisa+Andini&background=1E2F4D&color=fff"
                                        alt="Author" class="w-8 h-8 rounded-full">
                                    <span class="text-sm font-medium text-primary">Lisa Andini</span>
                                </div>
                                <button onclick="toggleLike(this)"
                                    class="like-btn flex items-center gap-1 text-textGray hover:text-accent transition-colors">
                                    <i class="far fa-heart"></i>
                                    <span class="text-sm font-semibold">321</span>
                                </button>
                            </div>
                        </div>
                    </article>

                </div>

                <!-- Load More Button -->
                <div class="text-center mt-12">
                    <button
                        class="inline-flex items-center gap-2 bg-white hover:bg-accent hover:text-white text-primary font-semibold px-8 py-4 rounded-xl transition-all border-2 border-gray-200 hover:border-accent shadow-md hover:shadow-lg">
                        <i class="fas fa-arrow-down"></i>
                        Muat Lebih Banyak
                    </button>
                </div>
            </div>
        </section>

        <!-- Newsletter Section -->
        <section class="bg-gradient-to-br from-primary via-secondary to-primary text-white py-16">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div
                    class="bg-white/10 backdrop-blur-sm w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-envelope text-3xl text-accent"></i>
                </div>
                <h2 class="text-3xl lg:text-4xl font-bold mb-4">Berlangganan Newsletter</h2>
                <p class="text-xl text-slate-300 mb-8">Dapatkan tips dan artikel terbaru langsung ke email Anda</p>
                <div class="max-w-md mx-auto">
                    <div class="flex gap-3">
                        <input type="email" placeholder="Email Anda"
                            class="flex-1 px-6 py-4 rounded-xl text-primary font-medium focus:outline-none focus:ring-4 focus:ring-orange-200">
                        <button
                            class="bg-accent hover:bg-orange-600 text-white font-semibold px-8 py-4 rounded-xl transition-all shadow-lg hover:shadow-xl">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </div>
                    <p class="text-sm text-slate-400 mt-3">
                        <i class="fas fa-lock mr-1"></i>Email Anda aman bersama kami
                    </p>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-primary text-textWhite py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid md:grid-cols-4 gap-8 mb-8">
                    <div>
                        <div class="text-2xl font-bold mb-4">
                            Kos<span class="text-accent">Ku</span>
                        </div>
                        <p class="text-slate-400 text-sm">
                            Platform terpercaya untuk menemukan kos-kosan terbaik di Indonesia.
                        </p>
                    </div>
                    <div>
                        <h3 class="font-semibold mb-4">Kategori</h3>
                        <ul class="space-y-2 text-sm text-slate-400">
                            <li><a href="#" class="hover:text-accent transition-colors">Properti</a></li>
                            <li><a href="#" class="hover:text-accent transition-colors">Tips & Trik</a></li>
                            <li><a href="#" class="hover:text-accent transition-colors">Kehidupan Mahasiswa</a></li>
                            <li><a href="#" class="hover:text-accent transition-colors">Keuangan</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-semibold mb-4">Perusahaan</h3>
                        <ul class="space-y-2 text-sm text-slate-400">
                            <li><a href="#" class="hover:text-accent transition-colors">Tentang Kami</a></li>
                            <li><a href="#" class="hover:text-accent transition-colors">Kontak</a></li>
                            <li><a href="#" class="hover:text-accent transition-colors">Karir</a></li>
                            <li><a href="#" class="hover:text-accent transition-colors">Privacy Policy</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="font-semibold mb-4">Ikuti Kami</h3>
                        <div class="flex gap-3">
                            <a href="#"
                                class="w-10 h-10 bg-white/10 hover:bg-accent rounded-lg flex items-center justify-center transition-colors">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-white/10 hover:bg-accent rounded-lg flex items-center justify-center transition-colors">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="#"
                                class="w-10 h-10 bg-white/10 hover:bg-accent rounded-lg flex items-center justify-center transition-colors">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="border-t border-slate-700 pt-8 text-center text-sm text-slate-400">
                    <p>&copy; 2025 KosKu. All rights reserved.</p>
                </div>
            </div>
        </footer>

        <script>
            function toggleLike(button) {
                const icon = button.querySelector('i');
                const count = button.querySelector('span');

                if (icon.classList.contains('far')) {
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                    button.classList.add('liked');
                    count.textContent = parseInt(count.textContent) + 1;
                } else {
                    icon.classList.remove('fas');
                    icon.classList.add('far');
                    button.classList.remove('liked');
                    count.textContent = parseInt(count.textContent) - 1;
                }
            }

            // Category button styling
            const style = document.createElement('style');
            style.textContent = `
            .category-btn {
                background: white;
                color: #1E2F4D;
                border: 2px solid #E2E8F0;
            }
            .category-btn:hover {
                border-color: #FDBA74;
                background: #FFF7ED;
            }
            .category-btn.active {
                background: linear-gradient(135deg, #F97316 0%, #EA580C 100%);
                color: white;
                border-color: #F97316;
                box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3);
            }
        `;
            document.head.appendChild(style);
        </script>
    </body>
@endsection
