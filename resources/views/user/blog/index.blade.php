@extends('user.layouts.app')

@section('content')

    <body class="bg-slate-50">

        <!-- Hero Section -->
        <section class="relative h-[75vh] flex items-center justify-center text-white overflow-hidden">

            <!-- Background Image -->
            <div class="absolute inset-0">
                <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=1600" alt="Blog Background"
                    class="w-full h-full object-cover">
            </div>

            <!-- Blue Gradient Overlay -->
            <div
                class="absolute inset-0 bg-gradient-to-br 
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
                    <form method="GET" action="{{ route('user.blog') }}">
                        <div class="relative">

                            <input 
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                placeholder="Cari artikel..."
                                class="w-full px-6 py-4 pl-14 rounded-2xl text-primary font-medium
                                    focus:outline-none focus:ring-4 focus:ring-blue-400 shadow-xl">

                            <i class="fas fa-search absolute left-5 top-1/2 -translate-y-1/2 text-blue-400 text-lg"></i>

                        </div>
                    </form>
                </div>

            </div>
        </section>



        

        <!-- Featured Post -->
        @if ($featuredBlog)
            <section class="py-12 bg-slate-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
                        <div class="grid lg:grid-cols-2 gap-0">

                            {{-- IMAGE --}}
                            <div class="h-full min-h-[70px]">
                                <img src="{{ $featuredBlog->gambar
                                    ? asset('storage/' . $featuredBlog->gambar)
                                    : 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800&h=600&fit=crop' }}"
                                    alt="{{ $featuredBlog->judul }}" class="w-full h-full object-cover">
                            </div>

                            {{-- CONTENT --}}
                            <div class="p-8 lg:p-12 flex flex-col justify-center">

                                <span
                                    class="inline-block bg-yellow-100 text-yellow-700 
                                 px-4 py-2 rounded-full text-sm font-semibold mb-4 w-fit">
                                    🔥 Most Liked Article
                                </span>

                                <h2 class="text-3xl lg:text-4xl font-bold text-primary mb-4 leading-tight">
                                    {{ $featuredBlog->judul }}
                                </h2>

                                <p class="text-textGray text-lg mb-6 leading-relaxed">
                                    {{ Str::limit($featuredBlog->ringkasan, 150) }}
                                </p>

                                <div class="flex items-center gap-4 mb-6 text-sm text-textGray">

                                    {{-- AUTHOR --}}
                                    <div class="flex items-center gap-2">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($blog->author->name ?? 'Admin') }}&background=1E2F4D&color=fff"
                                            class="w-8 h-8 rounded-full">

                                        <span class="text-sm font-medium text-primary">
                                            {{ $blog->author->name ?? 'Admin' }}
                                        </span>
                                    </div>



                                    <span>•</span>

                                    {{-- Date --}}
                                    <div class="flex items-center gap-1">
                                        <i class="fas fa-calendar-alt text-accent"></i>
                                        <span>
                                            {{ $featuredBlog->published_at?->translatedFormat('d M Y') }}
                                        </span>
                                    </div>

                                    <span>•</span>

                                    {{-- Reading Time --}}
                                    <div class="flex items-center gap-1">
                                        <i class="fas fa-clock text-blue-500"></i>
                                        <span>{{ $featuredBlog->reading_time ?? '5' }} min read</span>
                                    </div>

                                    <span>•</span>

                                    @auth
                                        <button type="button"
                                            onclick="event.stopPropagation(); toggleLike({{ $featuredBlog->id }})"
                                            id="like-btn-{{ $featuredBlog->id }}"
                                            class="flex items-center gap-2 px-4 py-2 rounded-lg
                                            bg-gray-50 hover:bg-gray-100
                                            transition duration-200 shadow-sm">

                                            <i id="like-icon-{{ $featuredBlog->id }}"
                                                class="fas fa-thumbs-up text-lg 
                                            {{ DB::table('blog_likes')->where('blog_id', $featuredBlog->id)->where('user_id', auth()->id())->exists()
                                                ? 'text-yellow-500'
                                                : 'text-gray-500' }}">
                                            </i>

                                            <span id="like-count-{{ $featuredBlog->id }}"
                                                class="font-semibold text-sm text-gray-700">
                                                {{ $featuredBlog->likes ?? 0 }}
                                            </span>
                                        </button>
                                    @else
                                        <span class="text-sm text-gray-400">
                                            Login untuk menyukai blog
                                        </span>
                                    @endauth

                                </div>

                                <div class="flex items-center gap-4">
                                    <a href="{{ route('user.blog.show', $featuredBlog->slug) }}"
                                        class="inline-flex items-center gap-2 bg-accent hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-xl transition-all">
                                        Baca Selengkapnya
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </section>
        @endif

        <!-- Blog Grid -->
        <section class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <form method="GET" action="{{ route('user.blog') }}">
    <div class="flex items-center justify-between mb-12">

        <h2 class="text-3xl font-bold text-primary">
            Artikel Terbaru
        </h2>

        <div class="flex items-center gap-3 text-sm text-textGray">
            <span>Urutkan:</span>

            <select name="sort"
                onchange="this.form.submit()"
                class="px-4 py-2 border-2 border-gray-200 rounded-lg font-medium text-primary focus:outline-none focus:border-accent">

                <option value="latest"
                    {{ request('sort') == 'latest' ? 'selected' : '' }}>
                    Terbaru
                </option>

                <option value="popular"
                    {{ request('sort') == 'popular' ? 'selected' : '' }}>
                    Terpopuler
                </option>

                <option value="oldest"
                    {{ request('sort') == 'oldest' ? 'selected' : '' }}>
                    Terlama
                </option>

            </select>
        </div>

    </div>
</form>

                <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">



                    @foreach ($blogs as $blog)
                        <article
                            class="bg-white rounded-2xl shadow-lg overflow-hidden 
               transition duration-300 hover:-translate-y-2 hover:shadow-2xl">

                            {{-- LINK AREA --}}
                            <a href="{{ route('user.blog.show', $blog->slug) }}" class="block group">

                                {{-- IMAGE --}}
                                <div class="h-56 relative overflow-hidden">
                                    <img src="{{ $blog->gambar
                                        ? asset('storage/' . $blog->gambar)
                                        : 'https://images.unsplash.com/photo-1556912173-3bb406ef7e77?w=600&h=400&fit=crop' }}"
                                        alt="{{ $blog->judul }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-500">

                                    <span
                                        class="absolute top-4 left-4 bg-white/95 text-accent 
                         px-3 py-1.5 rounded-full text-xs font-semibold shadow">
                                        <i class="fas fa-newspaper mr-1"></i>
                                        {{ $blog->slug }}
                                    </span>
                                </div>

                                {{-- CONTENT --}}
                                <div class="p-6">

                                    @php
                                        $wordCount = str_word_count(strip_tags($blog->isi));
                                        $readingTime = ceil($wordCount / 200);
                                    @endphp

                                    {{-- META --}}
                                    <div class="flex items-center gap-3 mb-3 text-xs text-gray-500">

                                        <div class="flex items-center gap-1">
                                            <i class="fas fa-calendar-alt text-accent"></i>
                                            <span>{{ $blog->published_at?->translatedFormat('d M Y') }}</span>
                                        </div>

                                        <span>•</span>

                                        {{-- Reading Time --}}
                                        <div
                                            class="flex items-center gap-1 px-2.5 py-1 
                bg-blue-50 text-blue-600 
                rounded-full font-medium">
                                            <i class="fas fa-clock text-blue-500"></i>
                                            <span>{{ $readingTime }} min</span>
                                        </div>

                                        {{-- Views --}}
                                        <div
                                            class="flex items-center gap-1 px-2.5 py-1 
                bg-emerald-50 text-emerald-600 
                rounded-full font-medium">
                                            <i class="fas fa-eye text-emerald-500"></i>
                                            <span>{{ $blog->views ?? 0 }}</span>
                                        </div>

                                    </div>

                                    {{-- TITLE --}}
                                    <h3
                                        class="text-xl font-bold text-primary mb-3 leading-snug 
                       group-hover:text-accent transition">
                                        {{ $blog->judul }}
                                    </h3>

                                    {{-- RINGKASAN --}}
                                    <p class="text-gray-400 text-sm mb-6 leading-relaxed">
                                        {{ $blog->ringkasan }}
                                    </p>

                                </div>
                            </a>

                            {{-- FOOTER (AUTHOR + LIKE) --}}
                            <div class="flex items-center justify-between px-6 pb-6">

                                {{-- AUTHOR --}}
                                <div class="flex items-center gap-2">
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($blog->author->name ?? 'Admin') }}&background=1E2F4D&color=fff"
                                        class="w-8 h-8 rounded-full">

                                    <span class="text-sm font-medium text-primary">
                                        {{ $blog->author->name ?? 'Admin' }}
                                    </span>
                                </div>

                                {{-- LIKE BUTTON --}}
                                @auth
                                    <button type="button" onclick="event.stopPropagation(); toggleLike({{ $blog->id }})"
                                        id="like-btn-{{ $blog->id }}"
                                        class="flex items-center gap-2 px-3 py-1.5 
                   bg-gray-50 hover:bg-gray-100
                   text-gray-600 rounded-lg
                   transition duration-200 shadow-sm">

                                        <i class="fas fa-thumbs-up"></i>
                                        <span id="like-count-{{ $blog->id }}" class="text-sm font-semibold">
                                            {{ $blog->likes ?? 0 }}
                                        </span>
                                    </button>
                                @else
                                    <span class="text-xs text-gray-400">
                                        Login untuk menyukai blog
                                    </span>
                                @endauth

                            </div>

                        </article>
                    @endforeach

                </div>

                <!-- Load More Button -->
                @if ($blogs->hasPages())
<div class="flex justify-center items-center space-x-2 mt-12 mb-10">

    {{-- Previous --}}
    @if ($blogs->onFirstPage())
        <span class="w-10 h-10 rounded-xl border border-gray-200 text-gray-300 flex items-center justify-center cursor-not-allowed">
            <i class="fas fa-chevron-left"></i>
        </span>
    @else
        <a href="{{ $blogs->previousPageUrl() }}"
           class="w-10 h-10 rounded-xl border border-gray-300 hover:border-accent hover:bg-accent hover:text-white transition flex items-center justify-center">
            <i class="fas fa-chevron-left"></i>
        </a>
    @endif


    {{-- Page Numbers --}}
    @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)

        @if ($page == $blogs->currentPage())

            <span class="w-10 h-10 rounded-xl bg-accent text-white font-semibold flex items-center justify-center shadow">
                {{ $page }}
            </span>

        @else

            <a href="{{ $url }}"
               class="w-10 h-10 rounded-xl border border-gray-300 hover:border-accent hover:bg-accent hover:text-white transition flex items-center justify-center">
                {{ $page }}
            </a>

        @endif

    @endforeach


    {{-- Next --}}
    @if ($blogs->hasMorePages())
        <a href="{{ $blogs->nextPageUrl() }}"
           class="w-10 h-10 rounded-xl border border-gray-300 hover:border-accent hover:bg-accent hover:text-white transition flex items-center justify-center">
            <i class="fas fa-chevron-right"></i>
        </a>
    @else
        <span class="w-10 h-10 rounded-xl border border-gray-200 text-gray-300 flex items-center justify-center cursor-not-allowed">
            <i class="fas fa-chevron-right"></i>
        </span>
    @endif

</div>
@endif
            </div>
        </section>

        <!-- Newsletter Section -->
        <section class="bg-gradient-to-br from-primary via-secondary to-primary text-white py-16">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <div
                    class="bg-white/10 backdrop-blur-sm w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-envelope text-3xl text-accent"></i>
                </div>
                <h2 class="text-3xl lg:text-4xl font-bold mb-4">Nikmati Newsletter Dari Kami</h2>
                <p class="text-xl text-slate-300 mb-8">Dapatkan beberapa tips dan kumpulan artikel terbaru </p>
                <div class="max-w-md mx-auto">
                    
                </div>
            </div>
        </section>

        <script>
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

<script>
    function toggleLike(blogId) {
        fetch(`/blog/${blogId}/like`, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json",
                }
            })
            .then(res => res.json())
            .then(data => {

                const count = document.getElementById('like-count-' + blogId);
                const button = document.getElementById('like-btn-' + blogId);

                count.innerText = data.likes;

                if (data.status === 'liked') {
                    button.classList.remove('bg-gray-100', 'text-gray-500');
                    button.classList.add('bg-yellow-50', 'text-yellow-600');
                } else {
                    button.classList.remove('bg-yellow-50', 'text-yellow-600');
                    button.classList.add('bg-gray-100', 'text-gray-500');
                }

            })
            .catch(err => console.error(err));
    }
</script>
