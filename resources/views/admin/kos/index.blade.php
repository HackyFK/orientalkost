@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Data Kos</h1>
    <a href="{{ route('admin.kos.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
        + Tambah Kos
    </a>
</div>

<div class="overflow-x-auto bg-white shadow rounded">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="px-4 py-2 text-left">Foto</th>
                <th class="px-4 py-2 text-left">Nama</th>
                <th class="px-4 py-2 text-left">Alamat</th>
                <th class="px-4 py-2 text-left">Jenis Sewa</th>
                <th class="px-4 py-2 text-left">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach ($items as $kos)
            <tr>
                <td class="px-4 py-2">
                    @if ($kos->primaryImage)
                        <img src="{{ asset('storage/' . $kos->primaryImage->image_path) }}"
                            class="w-20 h-16 object-cover rounded border">
                    @else
                        <span class="text-gray-400">No Image</span>
                    @endif
                </td>
                <td class="px-4 py-2">{{ $kos->nama_kos }}</td>
                <td class="px-4 py-2">{{ $kos->alamat }}</td>
                <td class="px-4 py-2">{{ ucfirst($kos->jenis_sewa) }}</td>
                <td class="px-4 py-2 flex gap-2">
                    <a href="{{ route('admin.kos.edit', $kos) }}" class="px-3 py-1 bg-yellow-400 rounded hover:bg-yellow-500">Edit</a>
                    <form method="POST" action="{{ route('admin.kos.destroy', $kos) }}">
                        @csrf @method('DELETE')
                        <button class="px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600" onclick="return confirm('Hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
