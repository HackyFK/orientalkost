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
    <h1 class="text-2xl font-bold mb-4">Tambah Kos</h1>

    <form method="POST" action="{{ route('admin.kos.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label class="block mb-1 font-semibold">Nama Kos</label>
            <input name="nama_kos" value="{{ old('nama_kos') }}" class="w-full border rounded px-3 py-2">
        </div>

        <div>
            <label class="block mb-1 font-semibold">Alamat</label>
            <textarea name="alamat" class="w-full border rounded px-3 py-2">{{ old('alamat') }}</textarea>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Jenis Sewa</label>
            <select name="jenis_sewa" class="w-full border rounded px-3 py-2">
                <option value="bulanan">Bulanan</option>
                <option value="tahunan">Tahunan</option>
            </select>
        </div>

        <div>
            <label class="block mb-1 font-semibold">Foto Kos (bisa banyak)</label>
            <input type="file" name="images[]" multiple class="w-full">
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
    </form>
</div>
@endsection
