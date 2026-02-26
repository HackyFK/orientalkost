<form method="post" action="{{ route('password.update') }}" class="space-y-4">
    @csrf
    @method('put')

    {{-- Password Saat Ini --}}
    <div>
        <label for="update_password_current_password"
            class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
            Password Saat Ini
        </label>
        <input id="update_password_current_password" name="current_password" type="password"
            autocomplete="current-password"
            class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition">
        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-1.5" />
    </div>

    {{-- Password Baru --}}
    <div>
        <label for="update_password_password"
            class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
            Password Baru
        </label>
        <input id="update_password_password" name="password" type="password"
            autocomplete="new-password"
            class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition">
        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-1.5" />
    </div>

    {{-- Konfirmasi Password --}}
    <div>
        <label for="update_password_password_confirmation"
            class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
            Konfirmasi Password Baru
        </label>
        <input id="update_password_password_confirmation" name="password_confirmation" type="password"
            autocomplete="new-password"
            class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:border-transparent transition">
        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-1.5" />
    </div>

    {{-- Submit --}}
    <div class="flex items-center gap-3 pt-1">
        <button type="submit"
            class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 active:scale-[0.98] text-white text-sm font-semibold px-5 py-2.5 rounded-lg transition shadow-sm shadow-amber-200">
            <i class="fa-solid fa-lock text-xs"></i>
            Ubah Password
        </button>

        @if (session('status') === 'password-updated')
        <span x-data="{ show: true }" x-show="show" x-transition
            x-init="setTimeout(() => show = false, 2000)"
            class="inline-flex items-center gap-1.5 text-xs text-emerald-600 font-medium">
            <i class="fa-solid fa-circle-check"></i>
            Password diperbarui
        </span>
        @endif
    </div>

</form>