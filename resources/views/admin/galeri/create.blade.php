@extends('admin.layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Tambah Galeri</h1>

<form action="{{ route('admin.galeri.store') }}"
      method="POST"
      enctype="multipart/form-data"
      class="bg-white p-6 rounded shadow max-w-xl">

    @csrf

    <!-- Judul -->
    <div class="mb-4">
        <label class="block font-semibold mb-1">Judul Galeri</label>
        <input type="text"
               name="judul"
               value="{{ old('judul') }}"
               class="w-full border rounded px-3 py-2"
               required>

        @error('judul')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Slug -->
    <div class="mb-4">
        <label class="block font-semibold mb-1">Slug (opsional)</label>
        <input type="text"
               name="slug"
               value="{{ old('slug') }}"
               class="w-full border rounded px-3 py-2">

        @error('slug')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Deskripsi -->
    <div class="mb-4">
        <label class="block font-semibold mb-1">Deskripsi Singkat</label>
        <textarea name="deskripsi_singkat"
                  rows="3"
                  class="w-full border rounded px-3 py-2"
                  required>{{ old('deskripsi_singkat') }}</textarea>

        @error('deskripsi_singkat')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Gambar -->
    <div class="mb-6">
        <label class="block font-semibold mb-1">Gambar</label>
        <input type="file"
               name="gambar"
               accept="image/*"
               class="w-full border rounded px-3 py-2">

        @error('gambar')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror

        <p class="text-sm text-gray-500 mt-1">
            JPG, PNG, WEBP – max 2MB
        </p>
    </div>

    <!-- Tombol -->
    <div class="flex gap-3">
        <button type="submit"
                class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
            Simpan
        </button>

        <a href="{{ route('admin.galeri.index') }}"
           class="px-5 py-2 rounded border">
            Batal
        </a>
    </div>

</form>
@endsection