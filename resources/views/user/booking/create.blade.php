@extends('user.layouts.app')

@section('content')

<body class="bg-slate-50">

    <!-- HEADER -->
    <header class="bg-white sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 py-6 flex justify-between items-center">
            <div class="text-3xl font-bold text-primary">
                Kos<span class="text-accent">Ku</span>
            </div>
            <a href="{{ url()->previous() }}" class="flex items-center gap-2 text-gray-600 hover:text-primary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </header>

    <div class="max-w-4xl mx-auto py-12 px-4">

        <!-- CARD -->
        <div class="bg-white rounded-3xl shadow-lg p-8">

            <h1 class="text-3xl font-bold text-center mb-8">Booking Kamar</h1>

            <!-- INFO KAMAR -->
            <div class="bg-gray-100 rounded-xl p-5 mb-8">
                <h3 class="font-bold text-lg">{{ $kamar->kos->nama_kos }}</h3>
                <p class="text-sm text-gray-600">{{ $kamar->nama_kamar }}</p>
            </div>

            <!-- FORM -->
            <form method="POST" action="{{ route('user.booking.store', $kamar) }}" class="space-y-8" x-data="bookingForm()">
                @csrf

                <!-- DATA DIRI -->
                <h2 class="text-xl font-bold text-accent text-center">
                    <i class="fas fa-user"></i> Data Diri
                </h2>

                <div class="grid md:grid-cols-2 gap-4">
                    <input name="nama_penyewa" placeholder="Nama Lengkap" class="input" value="{{ auth()->user()->name }}" required>
                    <input name="email" type="email" placeholder="Email Aktif" class="input" value="{{ auth()->user()->email }}" required>
                    <input name="phone" placeholder="Nomor Telepon" class="input" value="{{ auth()->user()->phone }}" required>
                </div>

                <!-- DATA SEWA -->
                <h2 class="text-xl font-bold text-accent text-center">
                    <i class="fas fa-calendar-check"></i> Data Sewa
                </h2>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <label class="radio-card" :class="{ 'border-accent': jenisSewa === 'bulanan' }">
                        <input type="radio" name="jenis_sewa" value="bulanan" x-model="jenisSewa"> Bulanan
                    </label>
                    <label class="radio-card" :class="{ 'border-accent': jenisSewa === 'tahunan' }">
                        <input type="radio" name="jenis_sewa" value="tahunan" x-model="jenisSewa"> Tahunan
                    </label>
                </div>

                <input type="number" name="durasi" placeholder="Durasi (bulan / tahun)" class="input" min="1" x-model.number="durasi">
                <input type="date" name="tanggal_mulai" class="input" required>

                <!-- RINGKASAN -->
                <div class="bg-gray-100 rounded-xl p-6 space-y-3">
                    <h3 class="text-lg font-bold text-accent flex items-center gap-2">
                        <i class="fas fa-receipt"></i> Ringkasan Booking
                    </h3>
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span x-text="format(subtotal)"></span>
                    </div>
                    <div class="flex justify-between">
                        <span>DP (<span x-text="dpPersen"></span>%)</span>
                        <span x-text="format(dpNominal)"></span>
                    </div>
                    <hr>
                    <div class="flex justify-between font-bold text-lg">
                        <span>Bayar Sekarang</span>
                        <span x-text="format(dpNominal)" class="text-accent"></span>
                    </div>
                    <p class="text-sm text-gray-500">
                        Sisa bayar: <span x-text="format(totalBayar)"></span>
                    </p>
                </div>

                <!-- SUBMIT -->
                <button type="submit"
                    class="w-full bg-accent hover:bg-orange-600 text-white py-4 rounded-xl font-bold text-lg">
                    Booking Sekarang
                </button>

            </form>

        </div>

    </div>

    <!-- ALPINE JS -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        function bookingForm() {
            return {
                hargaBulanan: {{ (int) $kamar->harga_bulanan }},
                hargaTahunan: {{ (int) $kamar->harga_tahunan }},
                dpPersen: {{ (int) $kamar->deposit }},

                jenisSewa: 'bulanan',
                durasi: 1,

                get hargaPerBulan() {
                    return this.jenisSewa === 'bulanan' ?
                        this.hargaBulanan :
                        Math.round(this.hargaTahunan / 12)
                },

                get durasiBulan() {
                    return this.jenisSewa === 'tahunan' ?
                        this.durasi * 12 :
                        this.durasi
                },

                get subtotal() {
                    return this.hargaPerBulan * this.durasiBulan
                },

                get dpNominal() {
                    return Math.round(this.subtotal * this.dpPersen / 100)
                },

                get totalBayar() {
                    return this.subtotal - this.dpNominal
                },

                format(val) {
                    return 'Rp ' + Number(val).toLocaleString('id-ID')
                }
            }
        }
    </script>

</body>
@endsection
