@extends('admin.layouts.app')

@section('content')
    <div class="flex justify-between mb-4">
        <h1 class="text-xl font-bold">Data Kos</h1>
        <a href="{{ route('admin.kos.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
            + Tambah Kos
        </a>
    </div>

    <table class="w-full bg-white shadow rounded">
        <thead>
            <tr class="border-b">
                <th>Foto</th>
                <th class="p-3 text-left">Nama</th>
                <th>Alamat</th>
                <th>Jenis Sewa</th>
                <th width="150">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $kos)
                <tr class="border-b">
                    <td>
                        @php
                            $image = $kos->images->where('is_primary', true)->first();
                        @endphp

                        @if ($image)
                            <img src="{{ asset('storage/' . $image->image_path) }}" class="w-20 h-16 object-cover rounded">
                        @else
                            <span class="text-gray-400">No Image</span>
                        @endif
                    </td>
                    <td class="p-3">{{ $kos->nama_kos }}</td>
                    <td>{{ $kos->alamat }}</td>
                    <td>{{ ucfirst($kos->jenis_sewa) }}</td>
                    <td class="flex gap-2 p-2">
                        <a href="{{ route('admin.kos.edit', $kos) }}" class="px-3 py-1 bg-yellow-400 rounded">Edit</a>

                        <form method="POST" action="{{ route('admin.kos.destroy', $kos) }}">
                            @csrf @method('DELETE')
                            <button class="px-3 py-1 bg-red-500 text-white rounded" onclick="return confirm('Hapus?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
