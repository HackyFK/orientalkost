@extends('admin.layouts.app')

@section('page-title', 'Laporan Profit')

@section('content')

    {{-- PAGE HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-bold text-slate-800">Laporan Profit</h1>
            <p class="text-sm text-slate-400 mt-0.5">Pendapatan owner dan platform dari booking</p>
        </div>
        <div class="flex items-center gap-2">

            {{-- Cetak PDF --}}
            <a href="{{ route('admin.keuangan.laporan.pdf', ['owner_id' => request('owner_id')]) }}"
               target="_blank"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-red-50 hover:bg-red-100 text-red-500 text-sm font-semibold rounded-lg border border-red-100 transition-colors">
                <i class="fa-solid fa-file-pdf text-xs"></i>
                Cetak PDF
                @if($ownerName)
                    <span class="text-red-400 font-normal">— {{ $ownerName }}</span>
                @endif
            </a>

        </div>
    </div>

    {{-- FILTER + KIRIM BAR --}}
    <div class="bg-white rounded-xl border border-slate-200 shadow-sm px-5 py-4 mb-5">
        <div class="flex flex-wrap items-end gap-4">

            {{-- Filter Owner --}}
            <form method="GET" class="flex items-end gap-3 flex-1 min-w-0">
                <div class="flex-1 min-w-[200px]">
                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Filter Owner</label>
                    <select name="owner_id"
                        class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                        <option value="">Semua Owner</option>
                        @foreach ($owners as $owner)
                            <option value="{{ $owner->id }}" @selected($ownerId == $owner->id)>
                                {{ $owner->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit"
                    class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm shadow-blue-200">
                    <i class="fa-solid fa-filter text-xs"></i>
                    Filter
                </button>
                @if(request('owner_id'))
                    <a href="{{ route('admin.keuangan.laporan') }}"
                       class="inline-flex items-center gap-1.5 px-3 py-2.5 border border-slate-200 text-slate-500 hover:bg-slate-100 text-sm font-semibold rounded-lg transition-colors">
                        <i class="fa-solid fa-xmark text-xs"></i>
                        Reset
                    </a>
                @endif
            </form>

        </div>
    </div>

    {{-- FORM KIRIM --}}
    <form method="POST" action="{{ route('admin.keuangan.laporan.kirim') }}" id="formKirim">
        @csrf
        <input type="hidden" name="owner_id" value="{{ request('owner_id') }}">

        {{-- TABLE CARD --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">

            {{-- Toolbar --}}
            <div class="flex items-center justify-between px-5 py-3.5 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <label class="flex items-center gap-2 cursor-pointer select-none">
                        <input type="checkbox" id="checkAll"
                            class="w-4 h-4 accent-blue-500 rounded cursor-pointer">
                        <span class="text-xs font-semibold text-slate-500">Pilih Semua Pending</span>
                    </label>
                    <span id="selectedCount"
                        class="hidden text-xs font-bold bg-blue-100 text-blue-600 px-2 py-0.5 rounded-full">
                        0 dipilih
                    </span>
                </div>

                {{-- Tombol Kirim --}}
                <button type="submit"
                    onclick="return confirm('Kirim pendapatan ke owner yang dipilih?')"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-green-500 hover:bg-green-600 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm shadow-green-200">
                    <i class="fa-solid fa-paper-plane text-xs"></i>
                    Kirim Pendapatan
                </button>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">
                            <th class="px-4 py-3 text-center w-10"></th>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Owner</th>
                            <th class="px-4 py-3">Kos & Kamar</th>
                            <th class="px-4 py-3 text-right">Total Booking</th>
                            <th class="px-4 py-3 text-right">Pend. Owner</th>
                            <th class="px-4 py-3 text-right">Pend. Platform</th>
                            <th class="px-4 py-3 text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($laporanOwner as $item)
                            <tr class="hover:bg-slate-50/60 transition-colors {{ $item->status == 'pending' ? '' : 'opacity-75' }}">

                                {{-- Checkbox --}}
                                <td class="px-4 py-3.5 text-center">
                                    @if ($item->status == 'pending')
                                        <input type="checkbox"
                                               name="ids[]"
                                               value="{{ $item->id }}"
                                               class="checkbox-item w-4 h-4 accent-blue-500 rounded cursor-pointer">
                                    @else
                                        <i class="fa-solid fa-check text-green-400 text-xs"></i>
                                    @endif
                                </td>

                                {{-- Tanggal --}}
                                <td class="px-4 py-3.5">
                                    <p class="text-xs font-semibold text-slate-700">{{ $item->created_at->format('d M Y') }}</p>
                                    <p class="text-[11px] text-slate-400">{{ $item->created_at->format('H:i') }}</p>
                                </td>

                                {{-- Owner --}}
                                <td class="px-4 py-3.5">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-full bg-gradient-to-br from-indigo-400 to-blue-500 flex items-center justify-center text-white text-[10px] font-bold flex-shrink-0">
                                            {{ strtoupper(substr($item->owner->name ?? '?', 0, 1)) }}
                                        </div>
                                        <span class="text-xs font-medium text-slate-700">{{ $item->owner->name ?? '-' }}</span>
                                    </div>
                                </td>

                                {{-- Kos & Kamar --}}
                                <td class="px-4 py-3.5">
                                    <p class="text-xs font-semibold text-slate-700">{{ $item->booking->kamar->kos->nama_kos ?? '-' }}</p>
                                    <p class="text-[11px] text-slate-400 mt-0.5">
                                        <i class="fa-solid fa-door-open mr-1"></i>
                                        {{ $item->booking->kamar->nama_kamar ?? '-' }}
                                    </p>
                                    <p class="text-[11px] text-slate-300 mt-0.5 truncate max-w-[160px]">
                                        {{ $item->booking->kamar->kos->alamat ?? '' }}
                                    </p>
                                </td>

                                {{-- Total Booking --}}
                                <td class="px-4 py-3.5 text-right">
                                    <span class="text-xs font-semibold text-slate-700">
                                        Rp {{ number_format($item->total_booking, 0, ',', '.') }}
                                    </span>
                                </td>

                                {{-- Pendapatan Owner --}}
                                <td class="px-4 py-3.5 text-right">
                                    <span class="text-xs font-bold text-green-600">
                                        Rp {{ number_format($item->pendapatan_owner, 0, ',', '.') }}
                                    </span>
                                </td>

                                {{-- Pendapatan Platform --}}
                                <td class="px-4 py-3.5 text-right">
                                    <span class="text-xs font-bold text-blue-600">
                                        Rp {{ number_format($item->pendapatan_platform, 0, ',', '.') }}
                                    </span>
                                </td>

                                {{-- Status --}}
                                <td class="px-4 py-3.5 text-center">
                                    @if ($item->status == 'pending')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-amber-50 text-amber-600 border border-amber-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                                            Pending
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-green-50 text-green-600 border border-green-100">
                                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                            Terkirim
                                        </span>
                                        @if ($item->tanggal_kirim)
                                            <p class="text-[10px] text-slate-400 mt-1">
                                                {{ $item->tanggal_kirim->format('d M Y') }}
                                            </p>
                                        @endif
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-5 py-16 text-center">
                                    <div class="flex flex-col items-center gap-3 text-slate-300">
                                        <i class="fa-solid fa-chart-pie text-4xl"></i>
                                        <p class="text-sm font-medium text-slate-400">Tidak ada data laporan</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Footer summary --}}
            @if($laporanOwner->count() > 0)
                <div class="px-5 py-4 border-t border-slate-100 flex flex-wrap items-center justify-between gap-4 bg-slate-50">
                    <p class="text-xs text-slate-400">
                        Total <span class="font-semibold text-slate-600">{{ $laporanOwner->count() }}</span> transaksi
                    </p>
                    <div class="flex items-center gap-6">
                        <div class="text-right">
                            <p class="text-[10px] text-slate-400 uppercase tracking-wider">Total Pend. Owner</p>
                            <p class="text-sm font-bold text-green-600">Rp {{ number_format($laporanOwner->sum('pendapatan_owner'), 0, ',', '.') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] text-slate-400 uppercase tracking-wider">Total Pend. Platform</p>
                            <p class="text-sm font-bold text-blue-600">Rp {{ number_format($laporanOwner->sum('pendapatan_platform'), 0, ',', '.') }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] text-slate-400 uppercase tracking-wider">Total Booking</p>
                            <p class="text-sm font-bold text-slate-700">Rp {{ number_format($laporanOwner->sum('total_booking'), 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </form>

    <div class="p-4">
    {{ $laporanOwner->links() }}
</div>

    <script>
        const checkAll  = document.getElementById('checkAll');
        const countBadge = document.getElementById('selectedCount');
        const checkboxes = document.querySelectorAll('.checkbox-item');

        function updateCount() {
            const checked = document.querySelectorAll('.checkbox-item:checked').length;
            if (checked > 0) {
                countBadge.textContent = checked + ' dipilih';
                countBadge.classList.remove('hidden');
            } else {
                countBadge.classList.add('hidden');
            }
            checkAll.indeterminate = checked > 0 && checked < checkboxes.length;
            checkAll.checked = checked === checkboxes.length && checkboxes.length > 0;
        }

        checkAll.addEventListener('change', () => {
            checkboxes.forEach(cb => cb.checked = checkAll.checked);
            updateCount();
        });

        checkboxes.forEach(cb => cb.addEventListener('change', updateCount));
    </script>

@endsection