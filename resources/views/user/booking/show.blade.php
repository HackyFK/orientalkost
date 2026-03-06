@extends('user.layouts.app') @section('content') @php
    $badge = match ($booking->status) {
        'pending' => ['bg' => 'bg-amber-100 text-amber-700 border-amber-200', 'dot' => 'bg-amber-400'],
        'paid' => ['bg' => 'bg-blue-100 text-blue-700 border-blue-200', 'dot' => 'bg-blue-500'],
        'confirmed' => ['bg' => 'bg-green-100 text-green-700 border-green-200', 'dot' => 'bg-green-500'],
        'cancelled' => ['bg' => 'bg-red-100 text-red-600 border-red-200', 'dot' => 'bg-red-400'],
        'expired' => ['bg' => 'bg-slate-200 text-slate-600 border-slate-300', 'dot' => 'bg-slate-400'],
        default => ['bg' => 'bg-slate-100 text-slate-500 border-slate-200', 'dot' => 'bg-slate-400'],
    };
    $label = [
        'pending' => 'Menunggu Pembayaran',
        'paid' => 'Sudah Dibayar',
        'confirmed' => 'Aktif',
        'cancelled' => 'Dibatalkan',
        'expired' => 'Selesai',
    ];
@endphp <div class="min-h-screen bg-slate-50 py-8 px-4 sm:px-6">
        <div class="max-w-4xl mx-auto"> {{-- ── Breadcrumb & Back Button ── --}} <div class="flex items-center justify-between mb-7">
                <div class="flex items-center gap-2 text-xs text-slate-400"> <a href="{{ route('user.booking.history') }}"
                        class="hover:text-blue-500 transition-colors">Booking Saya</a> <i
                        class="fa-solid fa-chevron-right text-[9px]"></i> <span
                        class="text-slate-600 font-medium">#{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</span> </div>
                <a href="{{ route('user.booking.history') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-white border border-slate-200 text-slate-600 hover:bg-slate-100 text-sm font-semibold rounded-xl transition-colors shadow-sm">
                    <i class="fa-solid fa-arrow-left text-xs"></i> Kembali </a>
            </div> {{-- ── Page Title + Status ── --}} <div class="flex items-start justify-between mb-6 gap-4">
                <div>
                    <h1 class="text-2xl font-extrabold text-slate-800">Detail Booking</h1>
                    <p class="text-sm text-slate-400 mt-1">Informasi lengkap mengenai booking dan status pembayaran kamu.
                    </p>
                </div> <span
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full text-sm font-semibold border {{ $badge['bg'] }} flex-shrink-0">
                    @if ($booking->status === 'pending')
                        <a href="{{ route('user.payment.show', $booking->id) }}"
                            class="inline-flex items-center gap-1.5 text-orange-600 text-xs font-semibold hover:text-orange-700 transition">
                            <span class="w-2 h-2 rounded-full bg-orange-500 animate-pulse"></span> Bayar Sekarang </a>
                    @else
                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold"> <span
                                class="w-2 h-2 rounded-full {{ $badge['dot'] }}"></span>
                            {{ $label[$booking->status] ?? ucfirst($booking->status) }} </span>
                    @endif
                </span>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-5"> {{-- ═══════════ LEFT (2/3) ═══════════ --}} <div class="lg:col-span-2 space-y-5">
                    {{-- ── Identitas Penyewa ── --}} <div
                        class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-indigo-50 flex items-center justify-center"> <i
                                    class="fa-solid fa-user text-indigo-400 text-xs"></i> </div>
                            <h2 class="font-bold text-slate-700 text-sm">Identitas Penyewa</h2>
                        </div>
                        <div class="px-6 py-5 flex items-center gap-4">
                            <div
                                class="w-14 h-14 rounded-full bg-gradient-to-br from-indigo-400 to-blue-500 flex items-center justify-center text-white text-lg font-extrabold flex-shrink-0">
                                {{ strtoupper(substr($booking->nama_penyewa, 0, 1)) }} </div>
                            <div>
                                <p class="text-base font-bold text-slate-800">{{ $booking->nama_penyewa }}</p>
                                <p class="text-sm text-slate-400 mt-0.5">{{ $booking->email }}</p>
                                <p class="text-sm text-slate-400">{{ $booking->phone }}</p>
                            </div>
                        </div>
                    </div> {{-- ── Detail Kamar ── --}} <div
                        class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-blue-50 flex items-center justify-center"> <i
                                    class="fa-solid fa-door-open text-blue-400 text-xs"></i> </div>
                            <h2 class="font-bold text-slate-700 text-sm">Detail Kamar</h2>
                        </div>
                        <div class="px-6 py-5">
                            <div class="grid grid-cols-2 gap-5 mb-5">
                                <div>
                                    <p class="text-xs text-slate-400 mb-1">Nama Kamar</p>
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-6 h-6 rounded-lg bg-blue-50 flex items-center justify-center flex-shrink-0">
                                            <i class="fa-solid fa-door-open text-blue-400 text-[10px]"></i>
                                        </div>
                                        <p class="text-sm font-bold text-slate-800">
                                            {{ $booking->kamar->nama_kamar ?? '-' }}</p>
                                    </div>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400 mb-1">Nama Kos</p>
                                    <div class="flex items-center gap-2">
                                        <div
                                            class="w-6 h-6 rounded-lg bg-green-50 flex items-center justify-center flex-shrink-0">
                                            <i class="fa-solid fa-house text-green-400 text-[10px]"></i>
                                        </div>
                                        <p class="text-sm font-bold text-slate-800">
                                            {{ $booking->kamar->kos->nama_kos ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-slate-50 rounded-xl p-4 grid grid-cols-3 divide-x divide-slate-200 text-center">
                                <div class="px-3">
                                    <p class="text-xs text-slate-400 mb-1">Durasi Sewa</p>
                                    <p class="text-base font-extrabold text-slate-800">{{ $booking->durasi }}</p>
                                    <p class="text-xs text-slate-400">bulan</p>
                                </div>
                                <div class="px-3">
                                    <p class="text-xs text-slate-400 mb-1">Tanggal Mulai</p>
                                    <p class="text-sm font-bold text-slate-800">
                                        {{ \Carbon\Carbon::parse($booking->tanggal_mulai)->format('d M Y') }} </p>
                                </div>
                                <div class="px-3">
                                    <p class="text-xs text-slate-400 mb-1">Tanggal Selesai</p>
                                    <p class="text-sm font-bold text-slate-800">
                                        {{ \Carbon\Carbon::parse($booking->tanggal_selesai)->format('d M Y') }} </p>
                                </div>
                            </div>
                        </div>
                    </div> {{-- ── Layanan Tambahan ── --}} <div
                        class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-violet-50 flex items-center justify-center"> <i
                                    class="fa-solid fa-concierge-bell text-violet-400 text-xs"></i> </div>
                            <h2 class="font-bold text-slate-700 text-sm">Layanan Tambahan</h2> <span
                                class="ml-auto text-[10px] font-bold bg-violet-50 text-violet-500 px-2.5 py-0.5 rounded-full border border-violet-100">
                                {{ $booking->kamar->kos->layanan->count() }} layanan </span>
                        </div>
                        <div class="px-6 py-5">
                            @if ($booking->kamar->kos->layanan->count())
                                <div class="space-y-2">
                                    @foreach ($booking->kamar->kos->layanan as $i => $layanan)
                                        <div
                                            class="flex items-center justify-between px-3 py-2.5 bg-slate-50 hover:bg-violet-50 rounded-xl border border-slate-100 hover:border-violet-100 transition-colors group">
                                            <div class="flex items-center gap-2.5"> <span
                                                    class="w-5 h-5 rounded-full bg-white border border-slate-200 group-hover:border-violet-200 flex items-center justify-center text-[9px] font-bold text-slate-400 group-hover:text-violet-400 flex-shrink-0 transition-colors">
                                                    {{ $i + 1 }} </span> <span
                                                    class="text-sm font-medium text-slate-700">{{ $layanan->nama_layanan }}</span>
                                            </div> <span
                                                class="text-xs font-bold text-slate-600 bg-white border border-slate-200 group-hover:border-violet-200 group-hover:text-violet-600 px-2.5 py-1 rounded-lg transition-colors">
                                                Rp {{ number_format($layanan->harga, 0, ',', '.') }} </span>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div
                                    class="flex items-center gap-3 px-4 py-4 bg-slate-50 rounded-xl border border-dashed border-slate-200">
                                    <div
                                        class="w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-sparkles text-slate-300 text-xs"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-400">Tidak ada layanan tambahan</p>
                                        <p class="text-xs text-slate-300 mt-0.5">Kamu tidak menambah opsi layanan
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div> {{-- ── Data Pembayaran ── --}} <div
                        class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                        <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-green-50 flex items-center justify-center"> <i
                                    class="fa-solid fa-credit-card text-green-500 text-xs"></i> </div>
                            <h2 class="font-bold text-slate-700 text-sm">Data Pembayaran</h2>
                        </div>
                        @if ($booking->payments)
                            <div class="px-6 py-5 space-y-4">
                                <div class="grid grid-cols-2 gap-5">
                                    <div>
                                        <p class="text-xs text-slate-400 mb-1">Transaction ID</p>
                                        <p class="text-sm font-mono font-semibold text-slate-700">
                                            {{ $booking->payments->booking_id }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-400 mb-1">Referensi</p>
                                        <p class="text-sm font-mono font-semibold text-slate-700">
                                            {{ $booking->payments->reference ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="grid grid-cols-2 gap-5">
                                    <div>
                                        <p class="text-xs text-slate-400 mb-1">Metode Pembayaran</p>
                                        <div class="flex items-center gap-2 mt-1">
                                            <div class="w-6 h-6 rounded-lg bg-indigo-50 flex items-center justify-center">
                                                <i class="fa-solid fa-wallet text-indigo-400 text-[10px]"></i>
                                            </div>
                                            <p class="text-sm font-semibold text-slate-700">
                                                {{ $booking->payments->payment_method ?? '-' }}</p>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-400 mb-1">Dibayar Pada</p>
                                        <div class="flex items-center gap-1.5 mt-1"> <i
                                                class="fa-regular fa-clock text-slate-300 text-xs"></i>
                                            <p class="text-sm font-semibold text-slate-700">
                                                {{ $booking->payments->paid_at ? \Carbon\Carbon::parse($booking->payments->paid_at)->format('d M Y, H:i') : '-' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="px-6 py-12 flex flex-col items-center gap-3 text-center">
                                <div class="w-14 h-14 rounded-full bg-slate-100 flex items-center justify-center"> <i
                                        class="fa-solid fa-credit-card text-slate-300 text-xl"></i> </div>
                                <p class="text-sm font-semibold text-slate-400">Belum ada data pembayaran</p>
                                <p class="text-xs text-slate-300">Pembayaran akan muncul setelah kamu menyelesaikan
                                    transaksi.</p>
                            </div>
                        @endif
                    </div>
                </div> {{-- ═══════════ RIGHT (1/3) ═══════════ --}} <div class="space-y-5"> {{-- ── Total Bayar ── --}} <div
                        class="bg-gradient-to-br from-green-500 to-green-700 rounded-2xl p-6 shadow-md">
                        <p class="text-xs text-green-100 font-medium mb-1">Total Pembayaran</p>
                        <p class="text-2xl font-extrabold text-white"> Rp
                            {{ number_format($booking->subtotal, 0, ',', '.') }} </p>
                        <div
                            class="mt-4 pt-4 border-t border-white/20 flex items-center justify-between text-xs text-green-100">
                            <span>{{ $booking->durasi }} bulan sewa</span>
                            <span>{{ $booking->kamar->nama_kamar ?? '-' }}</span>
                        </div>
                    </div> {{-- ── Status Booking ── --}} <div
                        class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                        <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-amber-50 flex items-center justify-center"> <i
                                    class="fa-solid fa-circle-dot text-amber-400 text-xs"></i> </div>
                            <h2 class="font-bold text-slate-700 text-sm">Status Booking</h2>
                        </div>
                        <div class="px-5 py-5 space-y-4"> @php
                            $statusStyle = match ($booking->status) {
                                'pending' => [
                                    'bg' => 'bg-amber-50 border-amber-200',
                                    'text' => 'text-amber-600',
                                    'icon' => 'fa-hourglass-half text-amber-400',
                                ],
                                'paid' => [
                                    'bg' => 'bg-blue-50 border-blue-200',
                                    'text' => 'text-blue-600',
                                    'icon' => 'fa-credit-card text-blue-400',
                                ],
                                'confirmed' => [
                                    'bg' => 'bg-green-50 border-green-200',
                                    'text' => 'text-green-600',
                                    'icon' => 'fa-circle-check text-green-500',
                                ],
                                'expired' => [
                                    'bg' => 'bg-slate-100 border-slate-300',
                                    'text' => 'text-slate-600',
                                    'icon' => 'fa-clock text-slate-400',
                                ],
                                'cancelled' => [
                                    'bg' => 'bg-red-50 border-red-200',
                                    'text' => 'text-red-600',
                                    'icon' => 'fa-circle-xmark text-red-400',
                                ],
                                default => [
                                    'bg' => 'bg-slate-100 border-slate-200',
                                    'text' => 'text-slate-600',
                                    'icon' => 'fa-circle text-slate-400',
                                ],
                            };
                        @endphp <div
                                class="flex items-center justify-center gap-3 py-4 rounded-xl border {{ $statusStyle['bg'] }}">
                                <i class="fa-solid {{ $statusStyle['icon'] }} text-lg"></i> <span
                                    class="text-sm font-bold {{ $statusStyle['text'] }}">
                                    {{ $label[$booking->status] ?? ucfirst($booking->status) }} </span>
                            </div>
                            <p class="text-xs text-slate-400 leading-relaxed text-center"> @switch($booking->status)
                                    @case('pending')
                                        Booking kamu sedang menunggu pembayaran. Segera lakukan pembayaran sebelum batas waktu.
                                    @break

                                    @case('paid')
                                        Pembayaran berhasil diterima. Tunggu konfirmasi dari pemilik kos.
                                    @break

                                    @case('confirmed')
                                        Booking kamu sudah dikonfirmasi. Selamat, kamu resmi menjadi penghuni!
                                    @break

                                    @case('cancelled')
                                        Booking ini telah dibatalkan. Hubungi kami jika ada pertanyaan.
                                    @break

                                    @case('expired')
                                        Masa sewa sudah berakhir. Terima kasih telah menggunakan layanan kami.
                                    @break
                                @endswitch </p>
                            @if ($booking->status === 'pending')
                                <a href="{{ route('user.payment.show', $booking->id) }}"
                                    class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-orange-500 hover:bg-orange-600 text-white text-sm font-bold rounded-xl transition-colors shadow-sm shadow-orange-200">
                                    <i class="fa-solid fa-bolt text-xs"></i> Bayar Sekarang </a>
                            @endif
                        </div>
                    </div> {{-- ── Informasi Booking ── --}} <div
                        class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                        <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-slate-100 flex items-center justify-center"> <i
                                    class="fa-solid fa-circle-info text-slate-400 text-xs"></i> </div>
                            <h2 class="font-bold text-slate-700 text-sm">Informasi Booking</h2>
                        </div>
                        <div class="divide-y divide-slate-50">
                            <div class="px-5 py-3.5 flex items-center justify-between"> <span
                                    class="text-xs text-slate-400">ID Booking</span> <span
                                    class="text-xs font-mono font-bold text-slate-600">#{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</span>
                            </div>
                            <div class="px-5 py-3.5 flex items-center justify-between"> <span
                                    class="text-xs text-slate-400">Tanggal Dibuat</span> <span
                                    class="text-xs font-medium text-slate-600">{{ $booking->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="px-5 py-3.5 flex items-center justify-between"> <span
                                    class="text-xs text-slate-400">Terakhir Diperbarui</span> <span
                                    class="text-xs font-medium text-slate-600">{{ $booking->updated_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div> {{-- ── Tombol Kembali ── --}} <a href="{{ route('user.booking.history') }}"
                        class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 bg-white border border-slate-200 text-slate-600 hover:bg-slate-100 text-sm font-semibold rounded-xl transition-colors shadow-sm">
                        <i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke Daftar Booking </a> </div>
            </div>
        </div>
    </div>
@endsection
