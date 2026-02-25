<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — {{ setting('site_name', 'KosKu') }}</title>
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
<body class="min-h-screen flex items-center justify-center bg-login relative py-8">

    {{-- Overlay blur --}}
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-md"></div>

    {{-- Card --}}
    <div class="relative z-10 w-full max-w-3xl mx-4 bg-white rounded-3xl shadow-2xl overflow-hidden flex">

        {{-- LEFT: Gambar --}}
        <div class="hidden md:flex w-5/12 flex-shrink-0 relative flex-col">
            <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=800"
                 alt="Kos Interior"
                 class="absolute inset-0 w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent"></div>

            <div class="relative z-10 mt-auto p-8">
                <h2 class="text-white text-xl font-bold leading-snug mb-1">
                    Bergabung Sekarang,<br>Gratis!
                </h2>
                <p class="text-slate-300 text-xs leading-relaxed">
                    Daftarkan diri dan temukan kos impian Anda dengan mudah.
                </p>
            </div>
        </div>

        {{-- RIGHT: Form --}}
        <div class="flex-1 flex flex-col justify-center px-10 py-10">

            {{-- Title --}}
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-slate-800 mb-1">{{ setting('site_name', 'KosKu') }}</h1>
                <p class="text-xs text-slate-400">Buat akun baru untuk melanjutkan</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-3.5">
                @csrf

                {{-- Nama --}}
                <div>
                    <label for="name" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Nama Lengkap</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fa-solid fa-user text-slate-400 text-xs"></i>
                        </div>
                        <input id="name" name="name" type="text"
                            value="{{ old('name') }}"
                            required autofocus autocomplete="name"
                            placeholder="Nama lengkap Anda"
                            class="w-full border border-slate-200 rounded-lg pl-9 pr-4 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-1.5" />
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fa-regular fa-envelope text-slate-400 text-xs"></i>
                        </div>
                        <input id="email" name="email" type="email"
                            value="{{ old('email') }}"
                            required autocomplete="username"
                            placeholder="nama@email.com"
                            class="w-full border border-slate-200 rounded-lg pl-9 pr-4 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1.5" />
                </div>

                {{-- 2 Kolom: NIK & No HP --}}
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label for="nomor_identitas" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">NIK</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <i class="fa-solid fa-id-card text-slate-400 text-xs"></i>
                            </div>
                            <input id="nomor_identitas" name="nomor_identitas" type="text"
                                value="{{ old('nomor_identitas') }}"
                                placeholder="16 digit NIK"
                                class="w-full border border-slate-200 rounded-lg pl-9 pr-4 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                        </div>
                        <x-input-error :messages="$errors->get('nomor_identitas')" class="mt-1.5" />
                    </div>

                    <div>
                        <label for="phone" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">No. HP</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <i class="fa-solid fa-phone text-slate-400 text-xs"></i>
                            </div>
                            <input id="phone" name="phone" type="text"
                                value="{{ old('phone') }}"
                                required placeholder="08xxxxxxxxxx"
                                class="w-full border border-slate-200 rounded-lg pl-9 pr-4 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                        </div>
                        <x-input-error :messages="$errors->get('phone')" class="mt-1.5" />
                    </div>
                </div>

                {{-- Alamat --}}
                <div>
                    <label for="alamat" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Alamat</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fa-solid fa-location-dot text-slate-400 text-xs"></i>
                        </div>
                        <input id="alamat" name="alamat" type="text"
                            value="{{ old('alamat') }}"
                            required placeholder="Alamat lengkap"
                            class="w-full border border-slate-200 rounded-lg pl-9 pr-4 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                    </div>
                    <x-input-error :messages="$errors->get('alamat')" class="mt-1.5" />
                </div>

                {{-- 2 Kolom: Password & Konfirmasi --}}
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <label for="password" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <i class="fa-solid fa-lock text-slate-400 text-xs"></i>
                            </div>
                            <input id="password" name="password" type="password"
                                required autocomplete="new-password"
                                placeholder="••••••••"
                                class="w-full border border-slate-200 rounded-lg pl-9 pr-4 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-1.5" />
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Konfirmasi</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                <i class="fa-solid fa-lock text-slate-400 text-xs"></i>
                            </div>
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                required autocomplete="new-password"
                                placeholder="••••••••"
                                class="w-full border border-slate-200 rounded-lg pl-9 pr-4 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1.5" />
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 active:scale-[0.98] text-white font-semibold text-sm py-2.5 rounded-lg transition shadow-sm shadow-blue-200">
                    <i class="fa-solid fa-user-plus text-xs"></i>
                    Daftar Sekarang
                </button>

                {{-- Divider --}}
                <div class="flex items-center gap-3">
                    <div class="flex-1 h-px bg-slate-100"></div>
                    <span class="text-xs text-slate-300">atau</span>
                    <div class="flex-1 h-px bg-slate-100"></div>
                </div>

                {{-- Login --}}
                <a href="{{ route('login') }}"
                    class="w-full flex items-center justify-center gap-2 border border-slate-200 bg-slate-50 hover:bg-slate-100 active:scale-[0.98] text-slate-600 font-semibold text-sm py-2.5 rounded-lg transition">
                    <i class="fa-solid fa-right-to-bracket text-xs"></i>
                    Sudah punya akun? Masuk
                </a>

            </form>
        </div>
    </div>

</body>
</html>