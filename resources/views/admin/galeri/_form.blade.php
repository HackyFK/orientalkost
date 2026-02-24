@csrf

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    {{-- ═══════════════ LEFT (2/3) ═══════════════ --}}
    <div class="xl:col-span-2 space-y-5">

        {{-- Card: Informasi Galeri --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-purple-50 flex items-center justify-center">
                    <i class="fa-solid fa-images text-purple-500 text-xs"></i>
                </div>
                <h2 class="font-bold text-slate-700 text-sm">Informasi Galeri</h2>
            </div>
            <div class="p-5 space-y-4">

                {{-- Judul --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Judul</label>
                    <input type="text" name="judul"
                        value="{{ old('judul', $galeri->judul ?? '') }}"
                        placeholder="Masukkan judul galeri..."
                        oninput="autoSlug(this.value)"
                        required
                        class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition @error('judul') border-red-300 bg-red-50 @enderror">
                    @error('judul')
                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Slug --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Slug</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-300 text-xs">/</span>
                        <input type="text" name="slug" id="slugInput"
                            value="{{ old('slug', $galeri->slug ?? '') }}"
                            placeholder="akan-terisi-otomatis"
                            class="w-full border border-slate-200 rounded-lg pl-6 pr-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition font-mono @error('slug') border-red-300 bg-red-50 @enderror">
                    </div>
                    <p class="text-[11px] text-slate-400 mt-1.5">
                        <i class="fa-solid fa-circle-info mr-1"></i>
                        Dikosongkan untuk generate otomatis dari judul
                    </p>
                    @error('slug')
                        <p class="text-red-500 text-xs mt-1 flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Deskripsi Singkat --}}
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">Deskripsi Singkat</label>
                        <span id="deskripsiCount" class="text-[10px] text-slate-400">0 / 255</span>
                    </div>
                    <textarea name="deskripsi_singkat" rows="4"
                        maxlength="255"
                        placeholder="Deskripsi singkat yang tampil di halaman daftar galeri..."
                        oninput="document.getElementById('deskripsiCount').textContent = this.value.length + ' / 255'"
                        required
                        class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition resize-none @error('deskripsi_singkat') border-red-300 bg-red-50 @enderror">{{ old('deskripsi_singkat', $galeri->deskripsi_singkat ?? '') }}</textarea>
                    @error('deskripsi_singkat')
                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>
        </div>

    </div>

    {{-- ═══════════════ RIGHT (1/3) ═══════════════ --}}
    <div class="space-y-5">

        {{-- Card: Gambar --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                    <i class="fa-solid fa-image text-blue-500 text-xs"></i>
                </div>
                <h2 class="font-bold text-slate-700 text-sm">Gambar</h2>
            </div>
            <div class="p-5 space-y-3">

                {{-- Preview existing (edit mode) --}}
                @if (!empty($galeri?->gambar))
                    <div id="currentImgWrap">
                        <img src="{{ asset('storage/' . $galeri->gambar) }}"
                             class="w-full h-36 object-cover rounded-xl border border-slate-100 shadow-sm">
                        <p class="text-[10px] text-slate-400 text-center mt-1">Gambar saat ini</p>
                    </div>
                @endif

                {{-- Preview baru --}}
                <div id="newPreviewWrap" class="hidden">
                    <img id="newPreviewImg" src=""
                         class="w-full h-36 object-cover rounded-xl border border-blue-200">
                    <p class="text-[10px] text-blue-400 text-center mt-1">Gambar baru (belum tersimpan)</p>
                </div>

                {{-- Upload area --}}
                <label class="flex flex-col items-center justify-center gap-2 border-2 border-dashed border-slate-200 hover:border-blue-300 rounded-xl px-4 py-6 cursor-pointer transition-colors group">
                    <i class="fa-solid fa-cloud-arrow-up text-2xl text-slate-300 group-hover:text-blue-400 transition-colors"></i>
                    <span class="text-xs font-medium text-slate-400 group-hover:text-blue-500 transition-colors text-center">
                        {{ !empty($galeri?->gambar) ? 'Klik untuk ganti gambar' : 'Klik untuk upload gambar' }}
                    </span>
                    <span class="text-[10px] text-slate-300">JPG, PNG, WEBP – maks 2MB</span>
                    <input type="file" name="gambar" class="hidden" accept="image/*"
                           onchange="previewGambar(this)">
                </label>

                @error('gambar')
                    <p class="text-red-500 text-xs flex items-center gap-1">
                        <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                    </p>
                @enderror

            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex gap-3">
            <a href="{{ route('admin.galeri.index') }}"
               class="flex-1 text-center px-4 py-2.5 border border-slate-200 text-slate-600 hover:bg-slate-100 text-sm font-semibold rounded-lg transition-colors">
                Batal
            </a>
            <button type="submit"
                class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm shadow-blue-200">
                <i class="fa-solid fa-floppy-disk text-xs"></i>
                Simpan
            </button>
        </div>

    </div>

</div>

<script>
    // Auto-slug dari judul
    function autoSlug(val) {
        const slugInput = document.getElementById('slugInput');
        if (slugInput.dataset.manual === 'true') return;
        slugInput.value = val.toLowerCase().trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
    }
    document.getElementById('slugInput').addEventListener('input', function () {
        this.dataset.manual = 'true';
    });

    // Preview gambar baru
    function previewGambar(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('newPreviewImg').src = e.target.result;
                document.getElementById('newPreviewWrap').classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Init counter
    window.addEventListener('DOMContentLoaded', () => {
        const ta = document.querySelector('[name="deskripsi_singkat"]');
        if (ta) document.getElementById('deskripsiCount').textContent = ta.value.length + ' / 255';
    });
</script>