@extends('admin.layouts.app')

@section('content')
<div class="flex justify-between mb-4">
    <h1 class="text-xl font-bold">Data Kos</h1>
    <a href="{{ route('kos.create') }}"
       class="px-4 py-2 bg-blue-600 text-white rounded">
       + Tambah Kos
    </a>
</div>

<table class="w-full bg-white shadow rounded">
    <thead>
        <tr class="border-b">
            <th class="p-3 text-left">Nama</th>
            <th>Alamat</th>
            <th>Jenis Sewa</th>
            <th width="150">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $kos)
        <tr class="border-b">
            <td class="p-3">{{ $kos->nama_kos }}</td>
            <td>{{ $kos->alamat }}</td>
            <td>{{ ucfirst($kos->jenis_sewa) }}</td>
            <td class="flex gap-2 p-2">
                <a href="{{ route('kos.edit',$kos) }}"
                   class="px-3 py-1 bg-yellow-400 rounded">Edit</a>

                <form method="POST"
                      action="{{ route('kos.destroy',$kos) }}">
                    @csrf @method('DELETE')
                    <button class="px-3 py-1 bg-red-500 text-white rounded"
                            onclick="return confirm('Hapus?')">
                        Hapus
                    </button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
