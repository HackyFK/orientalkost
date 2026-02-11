@extends('admin.layouts.app')

@section('content')

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Data Booking</h1>
    </div>

    <div class="overflow-x-auto bg-white shadow rounded">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2">Kode</th>
                    <th class="px-4 py-2">Penyewa</th>
                    <th class="px-4 py-2">Kamar</th>
                    <th class="px-4 py-2">Durasi</th>
                    <th class="px-4 py-2">Total</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Tanggal</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($items as $booking)
                    <tr class="border-b">
                        <td class="px-4 py-2 font-semibold">
                            #{{ $booking->id }}
                        </td>

                        <td class="px-4 py-2">
                            <div class="font-semibold">
                                {{ $booking->nama_penyewa }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $booking->email }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $booking->phone }}
                            </div>
                        </td>

                        <td class="px-4 py-2">
                            {{ $booking->kamar->nama_kamar ?? '-' }}
                        </td>

                        <td class="px-4 py-2 text-sm">
                            {{ $booking->durasi }} bulan
                            <div class="text-xs text-gray-500">
                                {{ $booking->tanggal_mulai }} -
                                {{ $booking->tanggal_selesai }}
                            </div>
                        </td>

                        <td class="px-4 py-2 font-semibold">
                            Rp {{ number_format($booking->total_bayar) }}
                        </td>

                        <td class="px-4 py-2">
                            <span class="px-2 py-1 text-xs rounded
                                @if($booking->status == 'confirmed') bg-green-100 text-green-700
                                @elseif($booking->status == 'paid') bg-blue-100 text-blue-700
                                @elseif($booking->status == 'pending') bg-yellow-100 text-yellow-700
                                @elseif($booking->status == 'cancelled') bg-red-100 text-red-700
                                @else bg-gray-100 text-gray-700
                                @endif
                            ">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>

                        <td class="px-4 py-2 text-sm">
                            {{ $booking->created_at->format('d M Y') }}
                        </td>

                        <td class="px-4 py-2 flex gap-2">

                            <a href="{{ route('admin.booking.show', $booking) }}"
                                class="px-3 py-1 bg-blue-500 text-white rounded text-sm">
                                Detail
                            </a>

                            {{-- Update Status --}}
                            <form method="POST"
                                action="{{ route('admin.booking.updateStatus', $booking) }}">
                                @csrf
                                @method('PATCH')

                                <select name="status"
                                    onchange="this.form.submit()"
                                    class="text-xs border rounded px-1 py-1">
                                    @foreach(['draft','pending','paid','confirmed','cancelled','expired'] as $status)
                                        <option value="{{ $status }}"
                                            {{ $booking->status == $status ? 'selected' : '' }}>
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>

                            <form method="POST"
                                action="{{ route('admin.booking.destroy', $booking) }}">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Hapus booking ini?')"
                                    class="px-3 py-1 bg-red-500 text-white rounded text-sm">
                                    Hapus
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $items->links() }}
    </div>

@endsection
