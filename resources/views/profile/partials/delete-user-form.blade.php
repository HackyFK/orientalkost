<div class="space-y-4">

    {{-- Warning Info --}}
    <div class="flex items-start gap-3 p-4 bg-red-50 border border-red-100 rounded-lg">
        <i class="fa-solid fa-circle-exclamation text-red-400 text-sm mt-0.5 flex-shrink-0"></i>
        <p class="text-xs text-red-700 leading-relaxed">
            Setelah akun dihapus, semua data akan <span class="font-semibold">dihapus secara permanen</span>.
            Pastikan Anda sudah mengunduh data penting sebelum melanjutkan.
        </p>
    </div>

    {{-- Trigger Button --}}
    <button type="button"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 active:scale-[0.98] text-white text-sm font-semibold px-5 py-2.5 rounded-lg transition shadow-sm shadow-red-200">
        <i class="fa-solid fa-trash text-xs"></i>
        Hapus Akun
    </button>

</div>

{{-- Modal --}}
<x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <form method="post" action="{{ route('profile.destroy') }}">
        @csrf
        @method('delete')

        <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2.5">
            <div class="w-7 h-7 rounded-lg bg-red-50 flex items-center justify-center">
                <i class="fa-solid fa-trash text-red-500 text-xs"></i>
            </div>
            <h3 class="font-semibold text-slate-700 text-sm">Konfirmasi Hapus Akun</h3>
        </div>

        <div class="p-6 space-y-4">

            <p class="text-sm text-slate-500 leading-relaxed">
                Tindakan ini <span class="font-semibold text-red-600">tidak dapat dibatalkan</span>.
                Masukkan password Anda untuk mengkonfirmasi penghapusan akun.
            </p>

            <div>
                <label for="password"
                    class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
                    Password
                </label>
                <input id="password" name="password" type="password"
                    placeholder="Masukkan password Anda"
                    class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent transition">
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-1.5" />
            </div>

            <div class="flex items-center justify-end gap-2.5 pt-1">
                <button type="button"
                    x-on:click="$dispatch('close')"
                    class="inline-flex items-center gap-2 border border-slate-200 bg-white hover:bg-slate-50 active:scale-[0.98] text-slate-600 text-sm font-medium px-4 py-2.5 rounded-lg transition">
                    <i class="fa-solid fa-xmark text-xs"></i>
                    Batal
                </button>
                <button type="submit"
                    class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 active:scale-[0.98] text-white text-sm font-semibold px-5 py-2.5 rounded-lg transition shadow-sm shadow-red-200">
                    <i class="fa-solid fa-trash text-xs"></i>
                    Ya, Hapus Akun
                </button>
            </div>

        </div>
    </form>
</x-modal>