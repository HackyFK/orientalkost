<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — {{ setting('site_name', 'KosKu') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .bg-login {
            background-image: url('https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=1920');
            background-size: cover;
            background-position: center;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-login relative">

    {{-- Overlay blur --}}
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-md"></div>

    {{-- Card --}}
    <div class="relative z-10 w-full max-w-3xl mx-4 bg-white rounded-3xl shadow-2xl overflow-hidden flex min-h-[480px]">

        {{-- LEFT: Gambar --}}
        <div class="hidden md:flex w-5/12 flex-shrink-0 relative flex-col justify-between">
            <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=800"
                 alt="Kos Interior"
                 class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent"></div>

            {{-- Bottom text --}}
            <div class="relative z-10 mt-auto p-8">
                <h2 class="text-white text-xl font-bold leading-snug mb-1">
                    {{ setting('site_name', 'KosKu') }}
                   
                </h2>
                <p class="text-slate-300 text-xs leading-relaxed">
                   {{ setting('site_tagline') }}
                </p>
            </div>
        </div>

        {{-- RIGHT: Form --}}
        <div class="flex-1 flex flex-col justify-center px-10 py-10">

            {{-- Title --}}
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-slate-800 mb-1">{{ setting('site_name', 'KosKu') }}</h1>
                <p class="text-xs text-slate-400">Masuk ke akun Anda untuk melanjutkan</p>
            </div>

            {{-- Session Status --}}
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email"
                        class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
                        Email
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fa-regular fa-envelope text-slate-400 text-xs"></i>
                        </div>
                        <input id="email" name="email" type="email"
                            value="{{ old('email') }}"
                            required autofocus autocomplete="username"
                            placeholder="nama@email.com"
                            class="w-full border border-slate-200 rounded-lg pl-9 pr-4 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
                </div>

                {{-- Password --}}
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label for="password"
                            class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            Password
                        </label>
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                            class="text-xs text-blue-500 hover:text-blue-700 font-medium transition">
                            Lupa password?
                        </a>
                        @endif
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fa-solid fa-lock text-slate-400 text-xs"></i>
                        </div>
                        <input id="password" name="password" type="password"
                            required autocomplete="current-password"
                            placeholder="••••••••"
                            class="w-full border border-slate-200 rounded-lg pl-9 pr-4 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center gap-2">
                    <input id="remember_me" name="remember" type="checkbox"
                        class="w-3.5 h-3.5 rounded border-slate-300 text-blue-500 focus:ring-blue-400">
                    <label for="remember_me" class="text-xs text-slate-500 cursor-pointer">Ingat saya</label>
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 active:scale-[0.98] text-white font-semibold text-sm py-2.5 rounded-lg transition shadow-sm shadow-blue-200">
                    <i class="fa-solid fa-right-to-bracket text-xs"></i>
                    Masuk
                </button>

                {{-- Divider --}}
                <div class="flex items-center gap-3">
                    <div class="flex-1 h-px bg-slate-100"></div>
                    <span class="text-xs text-slate-300">atau</span>
                    <div class="flex-1 h-px bg-slate-100"></div>
                </div>

                {{-- Register --}}
                @if (Route::has('register'))
                <a href="{{ route('register') }}"
                    class="w-full flex items-center justify-center gap-2 border border-slate-200 bg-slate-50 hover:bg-slate-100 active:scale-[0.98] text-slate-600 font-semibold text-sm py-2.5 rounded-lg transition">
                    <i class="fa-solid fa-user-plus text-xs"></i>
                    Buat Akun Baru
                </a>
                @endif

            </form>
        </div>
    </div>

</body>
</html>