@extends('admin.layouts.app')

@section('content')
    <div class="flex justify-between mb-6">
        <h1 class="text-2xl font-bold">Fasilitas</h1>
        <a href="{{ route('admin.fasilitas.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">
            + Tambah Fasilitas
        </a>
    </div>

    <div class="bg-white rounded shadow">
        <table class="w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">Icon</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($fasilitas as $kategori => $items)
                    <tr class="bg-gray-50">
                        <td colspan="3" class="p-3 font-semibold text-gray-700">
                            {{ ucfirst(str_replace('_', ' ', $kategori)) }}
                        </td>
                    </tr>

                    @foreach ($items as $item)
                        <tr class="border-t">
                            <td class="p-3">{{ $item->nama_fasilitas }}</td>

                            <td class="p-3">
                                @if ($item->icon)
                                    <i class="{{ $item->icon }} text-lg"></i>
                                @else
                                    -
                                @endif
                            </td>

                            <td class="p-3 text-center">
                                <a href="{{ route('admin.fasilitas.edit', $item) }}" class="text-blue-600">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-gray-500">
                            Belum ada fasilitas
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>
@endsection
