<!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        /* Glow orb behind sidebar */
        #sidebar::after {
            content: '';
            position: absolute;
            top: -60px;
            right: -60px;
            width: 180px;
            height: 180px;
            background: radial-gradient(circle, rgba(59, 130, 246, 0.07) 0%, transparent 70%);
            pointer-events: none;
        }

        /* Blue accent line on top */
        #sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, #3b82f6, transparent);
        }

        /* Active nav indicator bar */
        .nav-active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 3px;
            height: 18px;
            background: #3b82f6;
            border-radius: 0 3px 3px 0;
        }

        /* Thin scrollbar */
        #sidebar-nav::-webkit-scrollbar {
            width: 3px;
        }

        #sidebar-nav::-webkit-scrollbar-track {
            background: transparent;
        }

        #sidebar-nav::-webkit-scrollbar-thumb {
            background: rgba(59, 130, 246, 0.18);
            border-radius: 4px;
        }
    </style>
</head>

<body class="bg-slate-100 text-gray-800">
    <div class="flex min-h-screen">

        {{-- ═══════════════════ SIDEBAR ═══════════════════ --}}
        <aside id="sidebar" class="relative w-64 flex flex-col bg-[#0f172a] border-r border-blue-900/30 shadow-xl">

            {{-- Brand --}}
            <div class="flex items-center gap-3 px-5 py-[18px] border-b border-blue-900/40">
                <div
                    class="flex-shrink-0 w-9 h-9 rounded-xl bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center shadow-lg shadow-blue-600/40">
                    <i class="fa-solid fa-building text-white text-[13px]"></i>
                </div>
                <div class="leading-tight">
                    <p class="text-slate-100 font-bold text-[13.5px] tracking-wide">@yield('title', setting('site_name', 'KosKu'))</p>

                    <p class="text-slate-500 text-[10px] font-semibold uppercase tracking-widest">Admin Panel</p>
                </div>
            </div>

            {{-- Navigation --}}
            <nav id="sidebar-nav" class="flex-1 px-3 py-3 overflow-y-auto space-y-0.5">

                @php
                    $isActive = fn(string $pattern) => request()->routeIs($pattern);
                @endphp

                {{-- ── Overview ── --}}
                <p class="px-3 pt-1 pb-1 text-[10px] font-bold uppercase tracking-widest text-slate-500/70">Overview</p>

                <a href="{{ route('admin.dashboard') }}"
                    class="relative flex items-center gap-3 px-3 py-[9px] rounded-lg text-[13px] font-medium transition-all duration-150
                      {{ $isActive('admin.dashboard') ? 'nav-active bg-blue-500/10 text-slate-100' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
                    <i
                        class="fa-solid fa-chart-pie w-4 text-center text-xs {{ $isActive('admin.dashboard') ? 'text-blue-400' : 'text-slate-500' }}"></i>
                    Dashboard
                </a>

                {{-- ── Manajemen ── --}}
                <p class="px-3 pt-4 pb-1 text-[10px] font-bold uppercase tracking-widest text-slate-500/70">Manajemen
                </p>

                <a href="{{ route('admin.kos.index') }}"
                    class="relative flex items-center gap-3 px-3 py-[9px] rounded-lg text-[13px] font-medium transition-all duration-150
                      {{ $isActive('admin.kos.*') ? 'nav-active bg-blue-500/10 text-slate-100' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
                    <i
                        class="fa-solid fa-house w-4 text-center text-xs {{ $isActive('admin.kos.*') ? 'text-blue-400' : 'text-slate-500' }}"></i>
                    Kos
                </a>

                <a href="{{ route('admin.kamar.index') }}"
                    class="relative flex items-center gap-3 px-3 py-[9px] rounded-lg text-[13px] font-medium transition-all duration-150
                      {{ $isActive('admin.kamar.*') ? 'nav-active bg-blue-500/10 text-slate-100' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
                    <i
                        class="fa-solid fa-door-open w-4 text-center text-xs {{ $isActive('admin.kamar.*') ? 'text-blue-400' : 'text-slate-500' }}"></i>
                    Kamar
                </a>

                <a href="{{ route('admin.fasilitas.index') }}"
                    class="relative flex items-center gap-3 px-3 py-[9px] rounded-lg text-[13px] font-medium transition-all duration-150
                      {{ $isActive('admin.fasilitas.*') ? 'nav-active bg-blue-500/10 text-slate-100' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
                    <i
                        class="fa-solid fa-couch w-4 text-center text-xs {{ $isActive('admin.fasilitas.*') ? 'text-blue-400' : 'text-slate-500' }}"></i>
                    Fasilitas
                </a>

                <a href="{{ route('admin.booking.index') }}"
                    class="relative flex items-center gap-3 px-3 py-[9px] rounded-lg text-[13px] font-medium transition-all duration-150
                      {{ $isActive('admin.booking.*') ? 'nav-active bg-blue-500/10 text-slate-100' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
                    <i
                        class="fa-solid fa-calendar-check w-4 text-center text-xs {{ $isActive('admin.booking.*') ? 'text-blue-400' : 'text-slate-500' }}"></i>
                    Booking
                    {{-- Badge notifikasi — ganti angka sesuai data --}}
                    {{-- <span class="ml-auto text-[10px] font-bold bg-blue-500 text-white px-1.5 py-0.5 rounded-full leading-none">3</span> --}}
                </a>

                <a href="{{ route('admin.users.index') }}"
                    class="relative flex items-center gap-3 px-3 py-[9px] rounded-lg text-[13px] font-medium transition-all duration-150
                        {{ request()->routeIs('admin.users.*') ? 'nav-active bg-blue-500/10 text-slate-100' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
                    <i
                        class="fa-solid fa-users w-4 text-center text-xs {{ request()->routeIs('admin.users.*') ? 'text-blue-400' : 'text-slate-500' }}"></i>
                    User
                </a>

                <a href="{{ route('admin.keuangan.index') }}"
                    class="relative flex items-center gap-3 px-3 py-[9px] rounded-lg text-[13px] font-medium transition-all duration-150
                      {{ $isActive('admin.keuangan.*') ? 'nav-active bg-blue-500/10 text-slate-100' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
                    <i
    class="fa-solid fa-money-bill text-center w-4 text-xs {{ $isActive('admin.keuangan.*') ? 'text-blue-400' : 'text-slate-500' }}">
                    </i>
                    Keuangan
                </a>

                {{-- ── Konten ── --}}
                <p class="px-3 pt-4 pb-1 text-[10px] font-bold uppercase tracking-widest text-slate-500/70">Konten</p>

                <a href="{{ route('admin.blog.index') }}"
                    class="relative flex items-center gap-3 px-3 py-[9px] rounded-lg text-[13px] font-medium transition-all duration-150
                      {{ $isActive('admin.blog.*') ? 'nav-active bg-blue-500/10 text-slate-100' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
                    <i
                        class="fa-solid fa-newspaper w-4 text-center text-xs {{ $isActive('admin.blog.*') ? 'text-blue-400' : 'text-slate-500' }}"></i>
                    Blog
                </a>

                <a href="{{ route('admin.galeri.index') }}"
                    class="relative flex items-center gap-3 px-3 py-[9px] rounded-lg text-[13px] font-medium transition-all duration-150
                      {{ $isActive('admin.galeri.*') ? 'nav-active bg-blue-500/10 text-slate-100' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
                    <i
                        class="fa-solid fa-images w-4 text-center text-xs {{ $isActive('admin.galeri.*') ? 'text-blue-400' : 'text-slate-500' }}"></i>
                    Galeri
                </a>

                <a href="{{ route('admin.review.index') }}"
                    class="relative flex items-center gap-3 px-3 py-[9px] rounded-lg text-[13px] font-medium transition-all duration-150
                      {{ $isActive('admin.review.*') ? 'nav-active bg-blue-500/10 text-slate-100' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
                    <i
                        class="fa-solid fa-star w-4 text-center text-xs {{ $isActive('admin.review.*') ? 'text-blue-400' : 'text-slate-500' }}"></i>
                    Rating & Review
                </a>

                {{-- ── Konfigurasi ── --}}
                <p class="px-3 pt-4 pb-1 text-[10px] font-bold uppercase tracking-widest text-slate-500/70">Konfigurasi
                </p>

                <a href="{{ route('admin.website-profile.index') }}"
                    class="relative flex items-center gap-3 px-3 py-[9px] rounded-lg text-[13px] font-medium transition-all duration-150
                      {{ $isActive('admin.website-profile.*') ? 'nav-active bg-blue-500/10 text-slate-100' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
                    <i
                        class="fa-solid fa-globe w-4 text-center text-xs {{ $isActive('admin.website-profile.*') ? 'text-blue-400' : 'text-slate-500' }}"></i>
                    Profil Website
                </a>

                <a href="{{ route('admin.settings.index') }}"
                    class="relative flex items-center gap-3 px-3 py-[9px] rounded-lg text-[13px] font-medium transition-all duration-150
                      {{ $isActive('admin.settings.*') ? 'nav-active bg-blue-500/10 text-slate-100' : 'text-slate-400 hover:bg-white/5 hover:text-slate-200' }}">
                    <i
                        class="fa-solid fa-gear w-4 text-center text-xs {{ $isActive('admin.settings.*') ? 'text-blue-400' : 'text-slate-500' }}"></i>
                    Pengaturan
                </a>

            </nav>

            {{-- User Footer --}}
            <div class="px-3 pb-3 pt-2 border-t border-blue-900/40">
                <div
                    class="flex items-center gap-2.5 px-3 py-2.5 rounded-lg bg-white/[0.03] hover:bg-white/[0.06] transition-colors cursor-pointer">
                    <div
                        class="flex-shrink-0 w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-blue-500 flex items-center justify-center text-white text-xs font-bold">
                        A
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-slate-200 text-[13px] font-semibold truncate">Administrator</p>
                        <p class="text-slate-500 text-[11px]">Super Admin</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" title="Logout"
                            class="text-slate-500 hover:text-red-400 transition-colors text-xs p-1">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        {{-- ═══════════════════ MAIN CONTENT ═══════════════════ --}}
        <div class="flex-1 flex flex-col min-h-screen bg-slate-50">

            {{-- Top Bar --}}
            <header
                class="sticky top-0 z-10 bg-white border-b border-slate-200 px-6 py-3.5 flex items-center justify-between shadow-sm">

                {{-- BAGIAN KIRI --}}
                <div class="flex items-center gap-3">

                    {{-- Avatar --}}
                    <div
                        class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-500 to-blue-500 flex items-center justify-center text-white text-xs font-bold">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </div>

                    {{-- Tanggal --}}
                    <span class="text-slate-400 text-xs hidden sm:inline">
                        <i class="fa-regular fa-calendar mr-1.5"></i>
                        {{ now()->isoFormat('D MMM YYYY') }}
                    </span>

                    {{-- Notifikasi --}}
                    <button
                        class="relative w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 transition flex items-center justify-center text-slate-500 hover:text-slate-700">
                        <i class="fa-regular fa-bell text-sm"></i>
                        <span class="absolute top-1.5 right-1.5 w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                    </button>

                </div>

                {{-- BAGIAN KANAN --}}
                <div>
                    <a href="https://drive.google.com/your-link-here" target="_blank"
                        class="inline-flex items-center gap-2 px-3.5 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 text-xs font-semibold rounded-lg border border-blue-100 transition-colors group">
                        <i class="fa-solid fa-book-open text-[11px]"></i>
                        <span class="hidden sm:inline">Panduan</span>
                        <i
                            class="fa-solid fa-arrow-up-right-from-square text-[9px] opacity-50 group-hover:opacity-100 transition-opacity"></i>
                    </a>
                </div>

            </header>

            {{-- Page Content --}}
            <main class="flex-1 p-6 md:p-7">
                @yield('content')
            </main>

        </div>

    </div>
</body>

</html>
