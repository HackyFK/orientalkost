@extends('admin.layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Detail Galeri</h1>

    <div class="bg-white shadow rounded p-6 space-y-4">
        <div>
            <p class="text-sm text-gray-500">Judul</p>
            <p class="font-semibold">{{ $galeri->judul }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Slug</p>
            <p>{{ $galeri->slug }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Deskripsi</p>
            <p>{{ $galeri->deskripsi_singkat }}</p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Jumlah Foto</p>
            <p class="font-semibold">{{ $galeri->gambar ? 1 : 0 }}</p>
        </div>

        @if ($galeri->gambar)
            <div class="mt-2">
                <p class="text-sm text-gray-500">Gambar Galeri:</p>
                <img src="{{ asset('storage/' . $galeri->gambar) }}" alt="{{ $galeri->judul }}"
                    class="w-48 h-48 object-cover rounded">
            </div>
        @endif
    </div>


    <div class="mt-4">
        <a href="{{ route('admin.galeri.index') }}" class="text-blue-600">
            ← Kembali
        </a>
    </div>
@endsection
