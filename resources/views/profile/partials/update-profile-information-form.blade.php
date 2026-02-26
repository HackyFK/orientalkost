<form id="send-verification" method="post" action="{{ route('verification.send') }}">
    @csrf
</form>

<form method="post" action="{{ route('profile.update') }}" class="space-y-4">
    @csrf
    @method('patch')

    {{-- Nama --}}
    <div>
        <label for="name" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
            Nama
        </label>
        <input id="name" name="name" type="text"
            value="{{ old('name', $user->name) }}"
            required autofocus autocomplete="name"
            class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
        <x-input-error class="mt-1.5" :messages="$errors->get('name')" />
    </div>

    {{-- Email --}}
    <div>
        <label for="email" class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
            Email
        </label>
        <input id="email" name="email" type="email"
            value="{{ old('email', $user->email) }}"
            required autocomplete="username"
            class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
        <x-input-error class="mt-1.5" :messages="$errors->get('email')" />

        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <div class="mt-2 flex items-start gap-2 p-3 bg-amber-50 border border-amber-100 rounded-lg">
            <i class="fa-solid fa-triangle-exclamation text-amber-500 text-xs mt-0.5 flex-shrink-0"></i>
            <div>
                <p class="text-xs text-amber-700">
                    Email belum diverifikasi.
                    <button form="send-verification"
                        class="underline font-semibold hover:text-amber-900 transition">
                        Kirim ulang email verifikasi.
                    </button>
                </p>
                @if (session('status') === 'verification-link-sent')
                <p class="mt-1 text-xs text-emerald-600 font-medium">
                    <i class="fa-solid fa-circle-check mr-1"></i>
                    Link verifikasi berhasil dikirim.
                </p>
                @endif
            </div>
        </div>
        @endif
    </div>

    {{-- Submit --}}
    <div class="flex items-center gap-3 pt-1">
        <button type="submit"
            class="inline-flex items-center gap-2 bg-blue-600 hover:bg-blue-700 active:scale-[0.98] text-white text-sm font-semibold px-5 py-2.5 rounded-lg transition shadow-sm shadow-blue-200">
            <i class="fa-solid fa-floppy-disk text-xs"></i>
            Simpan Perubahan
        </button>

        @if (session('status') === 'profile-updated')
        <span x-data="{ show: true }" x-show="show" x-transition
            x-init="setTimeout(() => show = false, 2000)"
            class="inline-flex items-center gap-1.5 text-xs text-emerald-600 font-medium">
            <i class="fa-solid fa-circle-check"></i>
            Tersimpan
        </span>
        @endif
    </div>

</form>