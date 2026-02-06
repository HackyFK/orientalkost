@extends('admin.layouts.app')

@section('content')
    {{-- SUCCESS MESSAGE --}}
    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

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
                    <th class="px-4 py-2">Foto</th>
                    <th class="px-4 py-2">Nama</th>
                    <th class="px-4 py-2">Alamat</th>
                    <th class="px-4 py-2">Jenis</th>
                    <th class="px-4 py-2">Koordinat</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($items as $kos)
                    <tr>
                        <td class="px-4 py-2">
                            @if ($kos->primaryImage)
                                <img src="{{ asset('storage/' . $kos->primaryImage->image_path) }}"
                                    class="w-20 h-16 object-cover rounded">
                            @else
                                <span class="text-gray-400">No Image</span>
                            @endif
                        </td>

                        <td class="px-4 py-2 font-semibold">
                            {{ $kos->nama_kos }}
                            <div class="text-xs text-gray-500">{{ $kos->slug }}</div>
                        </td>

                        <td class="px-4 py-2">{{ $kos->alamat }}</td>

                        <td class="px-4 py-2 capitalize">{{ $kos->jenis_sewa }}</td>

                        <td class="px-4 py-2 text-sm">
                            {{ $kos->latitude ?? '-' }},
                            {{ $kos->longitude ?? '-' }}
                        </td>

                        <td class="px-4 py-2 flex gap-2">
                            <a href="{{ route('admin.kos.edit', $kos) }}" class="px-3 py-1 bg-yellow-400 rounded">Edit</a>

                            <form method="POST" action="{{ route('admin.kos.destroy', $kos) }}">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Hapus?')" class="px-3 py-1 bg-red-500 text-white rounded">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>

        </table>
    </div>
@endsection
