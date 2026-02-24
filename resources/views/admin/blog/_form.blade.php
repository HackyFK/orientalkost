@csrf

<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    {{-- ═══════════════ LEFT — Konten Utama ═══════════════ --}}
    <div class="xl:col-span-2 space-y-5">

        {{-- Card: Informasi Blog --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                    <i class="fa-solid fa-newspaper text-blue-500 text-xs"></i>
                </div>
                <h2 class="font-bold text-slate-700 text-sm">Informasi Blog</h2>
            </div>
            <div class="p-5 space-y-4">

                {{-- Judul --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
                        Judul Blog
                    </label>
                    <input type="text" name="judul"
                        value="{{ old('judul', $blog->judul ?? '') }}"
                        placeholder="Masukkan judul blog..."
                        oninput="autoSlug(this.value)"
                        class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition @error('judul') border-red-300 bg-red-50 @enderror">
                    @error('judul')
                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Slug --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
                        Slug
                    </label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-300 text-xs">/</span>
                        <input type="text" name="slug" id="slugInput"
                            value="{{ old('slug', $blog->slug ?? '') }}"
                            placeholder="judul-blog-keren"
                            class="w-full border border-slate-200 rounded-lg pl-6 pr-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition font-mono @error('slug') border-red-300 bg-red-50 @enderror">
                    </div>
                    @error('slug')
                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Ringkasan --}}
                <div>
                    <div class="flex items-center justify-between mb-1.5">
                        <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider">
                            Ringkasan
                        </label>
                        <span id="ringkasanCount" class="text-[10px] text-slate-400">0 / 255</span>
                    </div>
                    <textarea name="ringkasan" rows="3"
                        maxlength="255"
                        placeholder="Ringkasan singkat yang muncul di halaman daftar blog..."
                        oninput="document.getElementById('ringkasanCount').textContent = this.value.length + ' / 255'"
                        class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition resize-none @error('ringkasan') border-red-300 bg-red-50 @enderror">{{ old('ringkasan', $blog->ringkasan ?? '') }}</textarea>
                    @error('ringkasan')
                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>
        </div>

        {{-- Card: Isi Blog --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-indigo-50 flex items-center justify-center">
                    <i class="fa-solid fa-align-left text-indigo-500 text-xs"></i>
                </div>
                <h2 class="font-bold text-slate-700 text-sm">Isi Blog</h2>
            </div>
            <div class="p-5">
                <textarea name="isi" rows="14"
                    placeholder="Tulis isi blog di sini..."
                    class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition resize-y @error('isi') border-red-300 bg-red-50 @enderror">{{ old('isi', $blog->isi ?? '') }}</textarea>
                @error('isi')
                    <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                        <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                    </p>
                @enderror
            </div>
        </div>

    </div>

    {{-- ═══════════════ RIGHT — Sidebar ═══════════════ --}}
    <div class="space-y-5">

        {{-- Card: Gambar --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-purple-50 flex items-center justify-center">
                    <i class="fa-solid fa-image text-purple-500 text-xs"></i>
                </div>
                <h2 class="font-bold text-slate-700 text-sm">Gambar Utama</h2>
            </div>
            <div class="p-5 space-y-3">

                {{-- Preview gambar existing (edit mode) --}}
                @if (!empty($blog->gambar))
                    <div id="currentImgWrap">
                        <img src="{{ asset('storage/' . $blog->gambar) }}"
                             class="w-full h-36 object-cover rounded-xl border border-slate-200">
                        <p class="text-[10px] text-slate-400 text-center mt-1">Gambar saat ini</p>
                    </div>
                @endif

                {{-- Preview baru --}}
                <div id="newPreviewWrap" class="hidden">
                    <img id="newPreviewImg" src="" class="w-full h-36 object-cover rounded-xl border border-slate-200">
                    <p class="text-[10px] text-blue-400 text-center mt-1">Gambar baru (belum tersimpan)</p>
                </div>

                {{-- Upload area --}}
                <label class="flex flex-col items-center justify-center gap-2 border-2 border-dashed border-slate-200 hover:border-blue-300 rounded-xl px-4 py-6 cursor-pointer transition-colors group">
                    <i class="fa-solid fa-cloud-arrow-up text-2xl text-slate-300 group-hover:text-blue-400 transition-colors"></i>
                    <span class="text-xs font-medium text-slate-400 group-hover:text-blue-500 transition-colors text-center">
                        {{ !empty($blog->gambar) ? 'Klik untuk ganti gambar' : 'Klik untuk upload gambar' }}
                    </span>
                    <span class="text-[10px] text-slate-300">JPG, PNG, WEBP – maks 2MB</span>
                    <input type="file" name="gambar" class="hidden" accept="image/*"
                           onchange="previewBlogImg(this)">
                </label>

                @error('gambar')
                    <p class="text-red-500 text-xs flex items-center gap-1">
                        <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                    </p>
                @enderror
            </div>
        </div>

        {{-- Card: Penerbitan --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-green-50 flex items-center justify-center">
                    <i class="fa-solid fa-calendar-check text-green-500 text-xs"></i>
                </div>
                <h2 class="font-bold text-slate-700 text-sm">Penerbitan</h2>
            </div>
            <div class="p-5 space-y-4">

                {{-- Tanggal Terbit --}}
                <div>
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
                        Tanggal Terbit
                    </label>
                    <input type="datetime-local" name="published_at"
                        value="{{ old('published_at', isset($blog->published_at) ? $blog->published_at->format('Y-m-d\TH:i') : '') }}"
                        class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition @error('published_at') border-red-300 bg-red-50 @enderror">
                    @error('published_at')
                        <p class="text-red-500 text-xs mt-1.5 flex items-center gap-1">
                            <i class="fa-solid fa-circle-exclamation text-[10px]"></i> {{ $message }}
                        </p>
                    @enderror
                    <p class="text-[11px] text-slate-400 mt-1.5">
                        <i class="fa-solid fa-circle-info mr-1"></i>
                        Kosongkan jika ingin menyimpan sebagai draft
                    </p>
                </div>

            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="flex gap-3">
            <a href="{{ route('admin.blog.index') }}"
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
    // Auto-generate slug dari judul
    function autoSlug(val) {
        const slugInput = document.getElementById('slugInput');
        // Hanya auto-fill jika slug masih kosong atau belum diedit manual
        if (slugInput.dataset.manual === 'true') return;
        slugInput.value = val
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-');
    }

    // Tandai slug sudah diedit manual
    document.getElementById('slugInput').addEventListener('input', function () {
        this.dataset.manual = 'true';
    });

    // Preview gambar baru
    function previewBlogImg(input) {
        const wrap = document.getElementById('newPreviewWrap');
        const img  = document.getElementById('newPreviewImg');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                img.src = e.target.result;
                wrap.classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Init counter ringkasan
    window.addEventListener('DOMContentLoaded', () => {
        const textarea = document.querySelector('[name="ringkasan"]');
        if (textarea) {
            document.getElementById('ringkasanCount').textContent = textarea.value.length + ' / 255';
        }
    });
</script>