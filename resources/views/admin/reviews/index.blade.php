@extends('admin.layouts.app')

@section('content')
    <div class="p-6">

        <h1 class="text-2xl font-bold mb-6">Manajemen Rating & Ulasan</h1>

        {{-- SEARCH --}}
        <form method="GET" class="mb-4 flex gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama user / kamar..."
                class="border rounded-lg px-4 py-2 w-64">

            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                Cari
            </button>
        </form>

        {{-- TABLE --}}
        <div class="bg-white rounded-xl shadow overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        
                        <th class="p-3 text-left">No</th>
                        <th class="p-3 text-left">User</th>
                        <th class="p-3 text-left">Kamar</th>
                        <th class="p-3 text-center">Rating</th>
                        <th class="p-3 text-left">Ulasan</th>
                        <th class="p-3 text-center">Status</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($reviews as $review)
                        <tr class="border-t">
                            <td class="p-3">
                                {{ $reviews->firstItem() + $loop->index }}
                            </td>
                            <td>{{ $review->user?->name ?? '-' }}</td>
                            <td class="p-3">
                                {{ $review->kamar->nama_kamar }}
                                <div class="text-xs text-gray-500">
                                    {{ $review->kamar->kos->nama_kos ?? '-' }}
                                </div>
                            </td>
                            <td class="p-3 text-center">
                                ⭐ {{ $review->rating }}
                            </td>
                            <td class="p-3 max-w-xs">
                                {{ $review->ulasan ?? '-' }}
                            </td>
                            <td class="p-3 text-center">
                                @if ($review->status === 'approved')
                                    <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                        Approved
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs rounded-full bg-yellow-100 text-yellow-700">
                                        Pending
                                    </span>
                                @endif

                            </td>
                            <td class="p-3 text-center space-x-2">

                                {{-- Toggle Status --}}
                                <form action="{{ route('admin.reviews.status', $review) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button class="px-3 py-1 text-xs rounded bg-indigo-500 text-white hover:bg-indigo-600">
                                        @if ($review->status === 'approved')
                                            Pendingkan
                                        @else
                                            Approve
                                        @endif
                                    </button>
                                </form>

                                {{-- Delete --}}
                                <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Hapus review ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1 text-xs rounded bg-red-500 text-white hover:bg-red-600">
                                        Hapus
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-6 text-center text-gray-500">
                                Tidak ada data review
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $reviews->links() }}
        </div>
    </div>
@endsection
