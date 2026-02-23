@extends('admin.layouts.app')

@section('content')
    <h1 class="text-xl font-bold mb-6">Edit Kamar</h1>

    <form action="{{ route('admin.kamar.update', $kamar) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label>Kos</label>
            <select name="kos_id" class="w-full border p-2">
                @foreach ($kos as $item)
                    <option value="{{ $item->id }}" {{ $kamar->kos_id == $item->id ? 'selected' : '' }}>
                        {{ $item->nama_kos }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label>Nama Kamar</label>
            <input type="text" name="nama_kamar" value="{{ $kamar->nama_kamar }}" class="w-full border p-2">
        </div>

        <div>
            <label>Tipe Kamar</label>
            <input type="text" name="tipe_kamar" value="{{ $kamar->tipe_kamar }}" class="w-full border p-2">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label>Lantai</label>
                <input type="number" name="lantai" value="{{ $kamar->lantai }}" class="w-full border p-2">
            </div>
            <div>
                <label>Nomor Kamar</label>
                <input type="text" name="nomor_kamar" value="{{ $kamar->nomor_kamar }}" class="w-full border p-2">
            </div>
        </div>

        <div>
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="w-full border p-2">{{ $kamar->deskripsi }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label>Harga Bulanan</label>
                <input type="number" name="harga_bulanan" value="{{ $kamar->harga_bulanan }}" class="w-full border p-2">
            </div>
            <div>
                <label>Harga Tahunan</label>
                <input type="number" name="harga_tahunan" value="{{ $kamar->harga_tahunan }}" class="w-full border p-2">
            </div>
        </div>

        <div>
            <label>Status</label>
            <select name="status" class="w-full border p-2">
                <option value="tersedia" {{ $kamar->status == 'tersedia' ? 'selected' : '' }}>
                    Tersedia
                </option>
                <option value="terisi" {{ $kamar->status == 'terisi' ? 'selected' : '' }}>
                    Terisi
                </option>
            </select>
        </div>

        <div>
            <label>Ganti Gambar Utama</label>
            <input type="file" name="image">
                    <p class="text-sm text-gray-500 mt-1">
            JPG, PNG, WEBP – max 2MB
        </p>
        </div>

        <div>
            <label class="font-semibold block mb-3">Fasilitas Kamar</label>

            <div class="space-y-3">
                @foreach ($fasilitas as $kategori => $items)
                    <div x-data="{
                        open: true,
                        selected: @js($kamar->fasilitas->whereIn('id', $items->pluck('id'))->pluck('id'))
                    }" class="border rounded">
                        <!-- HEADER -->
                        <button type="button" @click="open = !open"
                            class="w-full flex justify-between items-center p-3 bg-gray-100 hover:bg-gray-200">
                            <span class="font-medium text-gray-700">
                                {{ ucfirst(str_replace('_', ' ', $kategori)) }}
                                <span class="text-sm text-gray-500">
                                    (<span x-text="selected.length"></span>)
                                </span>
                            </span>

                            <span x-text="open ? '−' : '+'"></span>
                        </button>

                        <!-- CONTENT -->
                        <div x-show="open" x-transition class="p-3">
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                                @foreach ($items as $item)
                                    <label class="flex items-center gap-2 border p-2 rounded cursor-pointer">
                                        <input type="checkbox" name="fasilitas[]" value="{{ $item->id }}"
                                            x-model="selected">

                                        @if ($item->icon)
                                            <i class="{{ $item->icon }}"></i>
                                        @endif

                                        {{ $item->nama_fasilitas }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>





        <button class="px-4 py-2 bg-blue-600 text-white rounded">
            Update
        </button>
    </form>
@endsection
