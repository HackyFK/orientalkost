@csrf

<div class="space-y-4">
    <!-- Judul -->
    <div>
        <label class="block font-semibold mb-1">Judul</label>
        <input type="text" name="judul"
            value="{{ old('judul', $galeri->judul ?? '') }}"
            class="w-full border rounded px-3 py-2" required>
    </div>

    <!-- Slug -->
    <div>
        <label class="block font-semibold mb-1">Slug</label>
        <input type="text" name="slug"
            value="{{ old('slug', $galeri->slug ?? '') }}"
            class="w-full border rounded px-3 py-2">
    </div>

    <!-- Deskripsi -->
    <div>
        <label class="block font-semibold mb-1">Deskripsi Singkat</label>
        <textarea name="deskripsi_singkat" rows="3"
            class="w-full border rounded px-3 py-2"
            required>{{ old('deskripsi_singkat', $galeri->deskripsi_singkat ?? '') }}</textarea>
    </div>

    <!-- Gambar -->
    <div>
        <label class="block font-semibold mb-1">Gambar</label>

        @if(!empty($galeri?->gambar))
            <img src="{{ asset('storage/'.$galeri->gambar) }}"
                 class="w-32 h-32 object-cover rounded mb-2">
        @endif

        <input type="file" name="gambar"
               accept="image/*"
               class="w-full border rounded px-3 py-2">
        <p class="text-sm text-gray-500 mt-1">
            JPG, PNG, WEBP (max 2MB)
        </p>
    </div>

    <!-- Tombol -->
    <div class="flex justify-end gap-3 pt-4">
        <a href="{{ route('admin.galeri.index') }}"
           class="px-4 py-2 border rounded">
            Batal
        </a>
        <button class="px-4 py-2 bg-blue-600 text-white rounded">
            Simpan
        </button>
    </div>
</div>