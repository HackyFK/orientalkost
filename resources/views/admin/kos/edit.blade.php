@extends('admin.layouts.app')

@section('content')
<div class="bg-white shadow rounded p-6 max-w-xl">
    <h1 class="text-2xl font-bold mb-4">Edit Kos</h1>

    <form method="POST" action="{{ route('admin.kos.update', $ko) }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 font-semibold">Nama Kos</label>
            <input type="text" name="nama_kos" value="{{ $ko->nama_kos }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block mb-1 font-semibold">Alamat</label>
            <textarea name="alamat" class="w-full border rounded px-3 py-2">{{ $ko->alamat }}</textarea>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Jenis Sewa</label>
            <select name="jenis_sewa" class="w-full border rounded px-3 py-2">
                <option value="bulanan" {{ $ko->jenis_sewa == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                <option value="tahunan" {{ $ko->jenis_sewa == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
            </select>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Tambah Foto</label>
            <input type="file" name="images[]" multiple class="w-full">
        </div>

        <div class="flex gap-4 flex-wrap mt-4">
            @foreach($ko->images as $img)
                <div class="w-28">
                    <img src="{{ asset('storage/'.$img->image_path) }}" class="w-full h-20 object-cover rounded border mb-1">

                    {{-- Tombol aksi di bawah gambar, bukan overlay --}}
                    <div class="flex gap-1">
                        @if($img->is_primary)
                            <span class="bg-green-600 text-white text-xs px-2 rounded">Primary</span>
                        @else
                            <form method="POST" action="{{ route('admin.kos.image.primary', $img) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="bg-blue-600 text-white text-xs px-2 rounded">Primary</button>
                            </form>
                        @endif

                        <form method="POST" action="{{ route('admin.kos.image.delete', $img) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Hapus gambar?')" class="bg-red-600 text-white text-xs px-2 rounded">✕</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Update Kos</button>
    </form>
</div>
@endsection
