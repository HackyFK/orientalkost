@csrf

<div class="space-y-5">

    {{-- Judul --}}
    <div>
        <label class="block mb-1 font-semibold">Judul Blog</label>
        <input type="text" name="judul"
            value="{{ old('judul', $blog->judul ?? '') }}"
            class="w-full border rounded px-4 py-2 focus:ring focus:ring-blue-200"
            placeholder="Masukkan judul blog">
        @error('judul')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Slug --}}
    <div>
        <label class="block mb-1 font-semibold">Slug</label>
        <input type="text" name="slug"
            value="{{ old('slug', $blog->slug ?? '') }}"
            class="w-full border rounded px-4 py-2 focus:ring focus:ring-blue-200"
            placeholder="contoh: judul-blog-keren">
        @error('slug')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Ringkasan --}}
    <div>
        <label class="block mb-1 font-semibold">Ringkasan</label>
        <textarea name="ringkasan" rows="3"
            class="w-full border rounded px-4 py-2 focus:ring focus:ring-blue-200"
            placeholder="Ringkasan singkat blog (max 255 karakter)">{{ old('ringkasan', $blog->ringkasan ?? '') }}</textarea>
        @error('ringkasan')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Gambar --}}
    <div>
        <label class="block mb-1 font-semibold">Gambar</label>
        <input type="file" name="gambar"
            class="w-full border rounded px-4 py-2 bg-white">

        @if(!empty($blog->gambar))
            <img src="{{ asset('storage/'.$blog->gambar) }}"
                class="w-40 mt-3 rounded shadow">
        @endif

        @error('gambar')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Isi --}}
    <div>
        <label class="block mb-1 font-semibold">Isi Blog</label>
        <textarea name="isi" rows="6"
            class="w-full border rounded px-4 py-2 focus:ring focus:ring-blue-200"
            placeholder="Tulis isi blog...">{{ old('isi', $blog->isi ?? '') }}</textarea>
        @error('isi')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Tanggal Terbit --}}
    <div>
        <label class="block mb-1 font-semibold">Tanggal Terbit</label>
        <input type="datetime-local" name="published_at"
            value="{{ old('published_at', isset($blog->published_at) ? $blog->published_at->format('Y-m-d\TH:i') : '') }}"
            class="w-full border rounded px-4 py-2 focus:ring focus:ring-blue-200">
        @error('published_at')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Button --}}
    <div class="flex justify-end gap-3">
        <a href="{{ route('admin.blog.index') }}"
            class="px-4 py-2 rounded border">Batal</a>

        <button type="submit"
            class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
            Simpan
        </button>
    </div>

</div>
