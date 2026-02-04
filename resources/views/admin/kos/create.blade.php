@extends('admin.layouts.app')

@section('content')
    <h1 class="text-xl font-bold mb-4">Tambah Kos</h1>

    <form method="POST" action="{{ route('admin.kos.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Nama Kos</label>
            <input name="nama_kos" class="input" value="{{ old('nama_kos') }}">
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <textarea name="alamat" class="input">{{ old('alamat') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Jenis Sewa</label>
            <select name="jenis_sewa" class="input">
                <option value="bulanan">Bulanan</option>
                <option value="tahunan">Tahunan</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Foto Kos</label>
            <input type="file" name="image">
        </div>

        <button class="px-4 py-2 bg-blue-600 text-white rounded">
            Simpan
        </button>
    </form>
@endsection
