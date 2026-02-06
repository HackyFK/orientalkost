@extends('admin.layouts.app')

@section('content')
{{-- VALIDATION ERRORS --}}
@if($errors->any())
    <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
        <ul class="list-disc pl-5">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="bg-white shadow rounded p-6 max-w-xl">
    <h1 class="text-2xl font-bold mb-4">Edit Kos</h1>

    {{-- SUCCESS --}}
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- FORM UPDATE DATA --}}
    <form method="POST" action="{{ route('admin.kos.update', $ko) }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="font-semibold">Nama Kos</label>
            <input type="text" name="nama_kos" value="{{ $ko->nama_kos }}"
                   class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="font-semibold">Alamat</label>
            <textarea name="alamat"
                      class="w-full border rounded px-3 py-2">{{ $ko->alamat }}</textarea>
        </div>

        <div>
            <label class="font-semibold">Jenis Sewa</label>
            <select name="jenis_sewa" class="w-full border rounded px-3 py-2">
                <option value="bulanan" @selected($ko->jenis_sewa == 'bulanan')>Bulanan</option>
                <option value="tahunan" @selected($ko->jenis_sewa == 'tahunan')>Tahunan</option>
            </select>
        </div>

        <div>
            <label class="font-semibold">Tambah Foto</label>
            <input type="file" name="images[]" multiple>
        </div>

        <button class="px-4 py-2 bg-blue-600 text-white rounded">
            Update Kos
        </button>
    </form>

    {{-- ==== IMAGE MANAGEMENT (DI LUAR FORM) ==== --}}
    <div class="flex gap-4 flex-wrap mt-6">
        @foreach($ko->images as $img)
            <div class="w-28">
                <img src="{{ asset('storage/'.$img->image_path) }}"
                     class="w-full h-20 object-cover rounded border mb-1">

                <div class="flex gap-1">
                    @if($img->is_primary)
                        <span class="bg-green-600 text-white text-xs px-2 rounded">Primary</span>
                    @else
                        <form method="POST" action="{{ route('admin.kos.image.primary', $img) }}">
                            @csrf
                            @method('PATCH')
                            <button class="bg-blue-600 text-white text-xs px-2 rounded">
                                Primary
                            </button>
                        </form>
                    @endif

                    <form method="POST" action="{{ route('admin.kos.image.delete', $img) }}">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Hapus gambar?')"
                                class="bg-red-600 text-white text-xs px-2 rounded">✕</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
