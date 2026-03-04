    @extends('admin.layouts.app')

    @section('page-title', 'Kelola Gambar Kos')

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
                <h1 class="text-xl font-bold text-slate-800">Kelola Gambar Kos</h1>
                <p class="text-sm text-slate-400 mt-0.5">
                    Atur dan kelola seluruh gambar dari setiap kos
                </p>
            </div>
        </div>

        {{-- TABLE CARD --}}
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">

            {{-- CARD HEADER --}}
    <div class="flex items-center justify-between px-5 py-3.5 border-b border-slate-100">

        <span class="text-sm font-semibold text-slate-600">
            Semua Kos
            <span
                class="ml-2 text-xs font-bold bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full">
                {{ $items->total() }}
            </span>
        </span>

        {{-- Search Nama Kos --}}
        <form method="GET" action="{{ route('admin.kos-images.index') }}" class="relative">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama kos..."
                class="pl-9 pr-4 py-2 text-sm border border-slate-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent"
            >
            <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
        </form>

    </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr
                            class="bg-slate-50 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">
                            <th class="px-5 py-3">Nama Kos</th>
                            <th class="px-5 py-3">Owner</th>
                            <th class="px-5 py-3 text-center">Jumlah Gambar</th>
                            <th class="px-5 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">

                        @forelse($items as $kos)
                            <tr class="hover:bg-slate-50/60 transition-colors">

                                {{-- Nama Kos --}}
                                <td class="px-5 py-3.5 font-semibold text-slate-800">
                                    {{ $kos->nama_kos }}
                                </td>

                                {{-- Owner --}}
                                <td class="px-5 py-3.5 text-slate-600">
                                    {{ $kos->owner->name ?? '-' }}
                                </td>

                                {{-- Jumlah Gambar --}}
                                <td class="px-5 py-3.5 text-center">
                                    <span
                                        class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold bg-indigo-50 text-indigo-600 border border-indigo-100">
                                        {{ $kos->images->count() }} Gambar
                                    </span>
                                </td>

                                {{-- Aksi --}}
                                <td class="px-5 py-3.5">
                                    <div class="flex items-center justify-center">
                                        <a href="{{ route('admin.kos-images.show',$kos) }}"
                                            class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 text-xs font-semibold rounded-lg border border-blue-100 transition-colors">
                                            <i class="fa-solid fa-image text-[10px]"></i>
                                            Kelola
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-5 py-16 text-center">
                                    <div class="flex flex-col items-center gap-3 text-slate-300">
                                        <i class="fa-solid fa-image text-4xl"></i>
                                        <p class="text-sm font-medium text-slate-400">
                                            Belum ada data kos
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if ($items->hasPages())
                <div class="px-5 py-4 border-t border-slate-100">
                    {{ $items->links() }}
                </div>
            @endif

        </div>

    @endsection
