    @extends('admin.layouts.app')

    @section('page-title', 'Rating & Ulasan')

    @section('content')
{{-- SUCCESS MESSAGE --}}
    @if (session('success'))
        <div
            class="mb-5 flex items-center gap-3 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm font-medium">
            <i class="fa-solid fa-circle-check text-green-500"></i>
            {{ session('success') }}
        </div>
    @endif
        {{-- PAGE HEADER --}}
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-xl font-bold text-slate-800">Rating & Ulasan</h1>
                <p class="text-sm text-slate-400 mt-0.5">Moderasi ulasan dari penghuni kos</p>
            </div>
        </div>

        {{-- TABLE CARD --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">

            {{-- Toolbar --}}
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 px-5 py-3.5 border-b border-slate-100">

    {{-- Kiri --}}
    <span class="text-sm font-semibold text-slate-600">
        Semua Ulasan
        <span class="ml-2 text-xs font-bold bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full">
            {{ $reviews->total() }}
        </span>
    </span>

    {{-- Kanan --}}
    <form method="GET" class="flex items-center gap-2">

        {{-- keep search --}}
        <input type="hidden" name="search" value="{{ request('search') }}">

        {{-- SORT RATING --}}
        <select name="rating"
    onchange="this.form.submit()"
    class="px-3 py-2 text-xs border border-slate-200 rounded-lg bg-white text-slate-600
           focus:outline-none focus:ring-2 focus:ring-blue-400">

    <option value="">Semua Rating</option>

    <option value="5" {{ request('rating') == '5' ? 'selected' : '' }}>
        ⭐⭐⭐⭐⭐ (5)
    </option>

    <option value="4" {{ request('rating') == '4' ? 'selected' : '' }}>
        ⭐⭐⭐⭐ (4)
    </option>

    <option value="3" {{ request('rating') == '3' ? 'selected' : '' }}>
        ⭐⭐⭐ (3)
    </option>

    <option value="2" {{ request('rating') == '2' ? 'selected' : '' }}>
        ⭐⭐ (2)
    </option>

    <option value="1" {{ request('rating') == '1' ? 'selected' : '' }}>
        ⭐ (1)
    </option>

</select>


        {{-- FILTER STATUS --}}
        <select name="status"
            onchange="this.form.submit()"
            class="px-3 py-2 text-xs border border-slate-200 rounded-lg bg-white text-slate-600
                   focus:outline-none focus:ring-2 focus:ring-blue-400">

            <option value="">Semua Status</option>

            <option value="approved"
                {{ request('status') == 'approved' ? 'selected' : '' }}>
                Approved
            </option>

            <option value="pending"
                {{ request('status') == 'pending' ? 'selected' : '' }}>
                Pending
            </option>

        </select>


        {{-- SEARCH --}}
        <div class="relative">
            <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-300 text-xs"></i>
            <input type="text" name="search"
                value="{{ request('search') }}"
                placeholder="Cari user / kamar..."
                class="pl-8 pr-4 py-2 text-xs border border-slate-200 rounded-lg bg-slate-50
                       focus:outline-none focus:ring-2 focus:ring-blue-400 w-52">
        </div>

    </form>

</div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">
                            <th class="px-4 py-3 w-10">#</th>
                            <th class="px-4 py-3">User</th>
                            <th class="px-4 py-3">Kamar</th>
                            <th class="px-4 py-3 text-center">Rating</th>
                            <th class="px-4 py-3">Ulasan</th>
                            <th class="px-4 py-3 text-center">Status</th>
                            <th class="px-4 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse ($reviews as $review)
                            <tr class="hover:bg-slate-50/60 transition-colors">

                                {{-- No --}}
                                <td class="px-4 py-4 text-xs text-slate-400 font-medium">
                                    {{ $reviews->firstItem() + $loop->index }}
                                </td>

                                {{-- User --}}
                                <td class="px-4 py-4">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-400 to-blue-500 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                            {{ strtoupper(substr($review->user?->name ?? '?', 0, 1)) }}
                                        </div>
                                        <span class="font-medium text-slate-700">
                                            {{ $review->user?->name ?? '-' }}
                                        </span>
                                    </div>
                                </td>

                                {{-- Kamar --}}
                                <td class="px-4 py-4">
                                    <p class="font-semibold text-slate-700 text-xs">{{ $review->kamar->nama_kamar }}</p>
                                    <p class="text-xs text-slate-400 mt-0.5 flex items-center gap-1">
                                        <i class="fa-solid fa-house text-[9px]"></i>
                                        {{ $review->kamar->kos->nama_kos ?? '-' }}
                                    </p>
                                </td>

                                {{-- Rating --}}
                                <td class="px-4 py-4 text-center">
                                    <div class="inline-flex flex-col items-center gap-0.5">
                                        <span class="text-base font-bold text-slate-800">{{ $review->rating }}</span>
                                        <div class="flex gap-0.5">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fa-solid fa-star text-[9px] {{ $i <= $review->rating ? 'text-amber-400' : 'text-slate-200' }}"></i>
                                            @endfor
                                        </div>
                                    </div>
                                </td>

                                {{-- Ulasan --}}
                                <td class="px-4 py-4 max-w-[220px]">
                                    @if ($review->ulasan)
                                        <p class="text-xs text-slate-500 leading-relaxed line-clamp-2">
                                            "{{ $review->ulasan }}"
                                        </p>
                                    @else
                                        <span class="text-xs text-slate-300">—</span>
                                    @endif
                                </td>

                                {{-- Status --}}
                                <td class="px-4 py-4 text-center">
                                    @if ($review->status === 'approved')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-green-50 text-green-600 border border-green-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                            Approved
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-amber-50 text-amber-600 border border-amber-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                            Pending
                                        </span>
                                    @endif
                                </td>

                                {{-- Aksi --}}
                                <td class="px-4 py-4">
                                    <div class="flex items-center justify-center gap-2">

                                        {{-- Toggle Status --}}
                                        <form action="{{ route('admin.reviews.status', $review) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            @if ($review->status === 'approved')
                                                <button type="submit"
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-50 hover:bg-amber-100 text-amber-600 text-xs font-semibold rounded-lg border border-amber-100 transition-colors">
                                                    <i class="fa-solid fa-clock-rotate-left text-[10px]"></i>
                                                    Pending
                                                </button>
                                            @else
                                                <button type="submit"
                                                    class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-green-50 hover:bg-green-100 text-green-600 text-xs font-semibold rounded-lg border border-green-100 transition-colors">
                                                    <i class="fa-solid fa-check text-[10px]"></i>
                                                    Approve
                                                </button>
                                            @endif
                                        </form>

                                        {{-- Hapus --}}
                                        <form action="{{ route('admin.reviews.destroy', $review) }}" method="POST" class="inline"
                                            onsubmit="return confirm('Yakin ingin menghapus ulasan ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-7 h-7 flex items-center justify-center rounded-lg bg-red-50 hover:bg-red-100 text-red-500 transition-colors border border-red-100">
                                                <i class="fa-solid fa-trash text-[10px]"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-5 py-16 text-center">
                                    <div class="flex flex-col items-center gap-3 text-slate-300">
                                        <i class="fa-solid fa-star text-4xl"></i>
                                        <p class="text-sm font-medium text-slate-400">Belum ada ulasan</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Footer: pagination --}}
            @if ($reviews->hasPages())
            <div class="px-5 py-4 border-t border-slate-100">
                {{ $reviews->links() }}
            </div>
        @endif

        </div>

    @endsection