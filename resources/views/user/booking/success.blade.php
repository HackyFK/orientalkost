@extends('user.layouts.app')

@section('content')

<div class="min-h-screen bg-slate-50 flex items-center justify-center px-4 py-12">
    <div class="max-w-md w-full">

        {{-- ── Success Card ── --}}
        <div class="bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden">

            {{-- Header Green Banner --}}
            <div class="bg-gradient-to-br from-green-400 to-emerald-600 px-8 pt-10 pb-16 text-center relative">
                {{-- Decorative circles --}}
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                <div class="absolute bottom-0 left-0 w-20 h-20 bg-white/10 rounded-full translate-y-1/2 -translate-x-1/2"></div>

                {{-- Icon --}}
                <div class="relative inline-flex items-center justify-center">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-lg">
                        <i class="fa-solid fa-check text-emerald-500 text-3xl"></i>
                    </div>
                </div>

                <h1 class="text-2xl font-extrabold text-white mt-10">Pembayaran Berhasil!</h1>
                <p class="text-green-100 text-sm mt-1.5">Transaksi kamu telah berhasil diproses.</p>
            </div>

            {{-- Body --}}
            <div class="px-6 -mt-6 relative z-10">
                {{-- Amount Card --}}
                <div class="bg-white rounded-2xl border border-slate-100 shadow-md px-6 py-5 text-center">
                    <p class="text-xs text-slate-400 font-medium mb-1">Total Dibayar</p>
                    <p class="text-3xl font-extrabold text-slate-800">
                        Rp {{ number_format($booking->subtotal, 0, ',', '.') }}
                    </p>
                </div>

                {{-- Divider with dots --}}
                <div class="flex items-center gap-2 my-5">
                    <div class="h-px flex-1 border-t border-dashed border-slate-200"></div>
                    <i class="fa-solid fa-scissors text-slate-300 text-xs rotate-90"></i>
                    <div class="h-px flex-1 border-t border-dashed border-slate-200"></div>
                </div>

                {{-- Detail Rows --}}
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-slate-400">ID Booking</span>
                        <span class="text-sm font-mono font-bold text-slate-700">
                            #{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-slate-400">Kamar</span>
                        <span class="text-sm font-semibold text-slate-700">
                            {{ $booking->kamar->nama_kamar ?? '-' }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-slate-400">Kos</span>
                        <span class="text-sm font-semibold text-slate-700">
                            {{ $booking->kamar->kos->nama_kos ?? '-' }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-slate-400">Durasi</span>
                        <span class="text-sm font-semibold text-slate-700">
                            {{ $booking->durasi }} bulan
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-slate-400">Status</span>
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                            {{ ucfirst($booking->status) }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-slate-400">Tanggal Bayar</span>
                        <span class="text-sm font-semibold text-slate-700">
                            {{ now()->format('d M Y, H:i') }}
                        </span>
                    </div>
                </div>

                {{-- CTA Buttons --}}
                <div class="space-y-3 pb-6">
                    <a href="{{ route('user.booking.history') }}"
                        class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold rounded-xl transition-colors shadow-sm shadow-emerald-200">
                        <i class="fa-solid fa-clock-rotate-left text-xs"></i>
                        Lihat History Transaksi
                    </a>
                    <a href="{{ route('user.beranda') }}"
                        class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 text-sm font-semibold rounded-xl transition-colors">
                        <i class="fa-solid fa-house text-xs"></i>
                        Kembali ke Beranda
                    </a>
                </div>

            </div>
        </div>

        {{-- Footer note --}}
        <p class="text-center text-xs text-slate-400 mt-5">
            Konfirmasi akan dikirimkan ke email kamu. <br>Ada pertanyaan? <a href="#" class="text-emerald-600 hover:underline font-medium">Hubungi kami</a>
        </p>

    </div>
</div>

@endsection