@extends('admin.layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Galeri</h1>

        <a href="{{ route('admin.galeri.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            + Tambah Galeri
        </a>
    </div>

    {{-- Search --}}
    <form method="GET" class="mb-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul galeri..."
            class="border rounded px-3 py-2 w-64">
    </form>

    <div class="bg-white shadow rounded overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100 text-sm">
                <tr>
                    <th class="p-3">No</th>
                    <th class="p-3">Gambar</th>
                    <th class="p-3">Judul</th>
                    <th class="p-3">Slug</th>
                    <th class="p-3">Deskripsi</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($galeris as $galeri)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-3 text-center">
                            {{ $galeris->firstItem() + $loop->index }}
                        </td>

                        <td class="p-3 text-center">
                            @if ($galeri->gambar)
                                <img src="{{ asset('storage/' . $galeri->gambar) }}"
                                    class="w-16 h-16 object-cover rounded mx-auto">
                            @else
                                <span class="text-gray-400 text-sm">—</span>
                            @endif
                        </td>

                        <td class="p-3 font-semibold">{{ $galeri->judul }}</td>
                        <td class="p-3 text-sm text-gray-500">{{ $galeri->slug }}</td>
                        <td class="p-3">{{ $galeri->deskripsi_singkat }}</td>

                        <td class="p-3 text-center space-x-3">
                            <a href="{{ route('admin.galeri.show', $galeri) }}" class="text-blue-600">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.galeri.edit', $galeri) }}" class="text-yellow-600">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('admin.galeri.destroy', $galeri) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button onclick="return confirm('Hapus galeri ini?')" class="text-red-600">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-6 text-center text-gray-500">
                            Belum ada galeri
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="flex justify-between items-center mt-4 text-sm text-gray-600">
        <div>
            Menampilkan {{ $galeris->firstItem() }} – {{ $galeris->lastItem() }}
            dari {{ $galeris->total() }} data
        </div>
        {{ $galeris->withQueryString()->links() }}
    </div>
@endsection
