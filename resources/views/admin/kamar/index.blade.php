@extends('admin.layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-bold">Data Kamar</h1>

        <a href="{{ route('admin.kamar.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">
            + Tambah Kamar
        </a>
    </div>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <table class="w-full border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 border">Kos</th>
                <th class="p-2 border">Nama Kamar</th>
                <th class="p-2 border">Tipe</th>
                <th class="p-2 border">Fasilitas</th>
                <th class="p-2 border">Harga Bulanan</th>
                <th class="p-2 border">Status</th>
                <th class="p-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $kamar)
                <tr>
                    <td class="p-2 border">{{ $kamar->kos->nama_kos }}</td>
                    <td class="p-2 border">{{ $kamar->nama_kamar }}</td>
                    <td class="p-2 border">{{ $kamar->tipe_kamar }}</td>
                    <td class="p-2 border">
                        <div class="flex flex-wrap gap-1">
                            @foreach ($kamar->fasilitas as $f)
                                <span class="px-2 py-1 text-xs bg-gray-100 rounded">
                                    <i class="{{ $f->icon }}"></i>
                                </span>
                            @endforeach
                        </div>
                    </td>

                    <td class="p-2 border">
                        Rp {{ number_format($kamar->harga_bulanan, 0, ',', '.') }}
                    </td>
                    <td class="p-2 border">
                        <span
                            class="px-2 py-1 text-xs rounded
                        {{ $kamar->status == 'tersedia' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ ucfirst($kamar->status) }}
                        </span>
                    </td>
                    <td class="p-2 border">
                        <a href="{{ route('admin.kamar.edit', $kamar) }}" class="text-blue-600">Edit</a>

                        <form action="{{ route('admin.kamar.destroy', $kamar) }}" method="POST" class="inline"
                            onsubmit="return confirm('Hapus kamar ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 ml-2">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center p-4 text-gray-500">
                        Belum ada data kamar
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
