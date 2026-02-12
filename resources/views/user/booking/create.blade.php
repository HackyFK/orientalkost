@extends('user.layouts.app')

@section('content')

    <body class="bg-slate-50">

        <!-- HEADER -->
        <nav class="bg-primary fixed w-full top-0 z-50 shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-20">

                    <!-- Logo & Site Name -->
                    <div class="flex items-center space-x-3">
                        <i class="fa-brands fa-galactic-senate text-accent text-3xl"></i>
                        <span class="text-gray-900 dark:text-gray-100 text-2xl font-bold">
                            {{ setting('site_name', 'KosKu') }}
                        </span>
                    </div>

                    <!-- Back Button -->
                    <a href="{{ url()->previous() }}"
                        class="flex items-center gap-2 text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-primary transition">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>

                </div>
            </div>
        </nav>


        <div class="max-w-4xl mx-auto py-12 px-4">

            <!-- CARD -->
            <div class="bg-white rounded-3xl shadow-lg p-8">

                <h1 class="text-3xl font-bold text-center mb-8">Booking Kamar</h1>

                <!-- INFO KAMAR -->
                <div class="bg-gray-100 rounded-xl p-5 mb-8">
                    <h3 class="font-bold text-lg">{{ $kamar->kos->nama_kos }}</h3>
                    <p class="text-sm text-gray-600">{{ $kamar->nama_kamar }}</p>
                </div>

                <!-- FORM BOOKING -->
                <form method="POST" action="{{ route('user.booking.store', $kamar) }}" class="space-y-8"
                    x-data="bookingForm()">
                    @csrf

                    <!-- DATA DIRI -->
                    <h2 class="text-xl font-bold text-accent text-center flex items-center gap-2 justify-center mb-4">
                        <i class="fas fa-user"></i> Data Diri
                    </h2>

                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium text-gray-700">Nama Lengkap</label>
                            <input name="nama_penyewa" placeholder="Nama Lengkap" class="input w-full mt-1"
                                value="{{ auth()->user()->name }}" required>
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700">Email</label>
                            <input name="email" type="email" placeholder="Email Aktif" class="input w-full mt-1"
                                value="{{ auth()->user()->email }}" required>
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700">Nomor Telepon</label>
                            <input name="phone" placeholder="Nomor Telepon" class="input w-full mt-1"
                                value="{{ auth()->user()->phone }}" required>
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700">Alamat</label>
                            <input name="alamat" placeholder="Alamat Lengkap" class="input w-full mt-1"
                                value="{{ auth()->user()->alamat }}" required>
                        </div>

                        <!-- Nomor identitas tetap hidden -->
                        <input type="hidden" name="nomor_identitas" value="{{ auth()->user()->nomor_identitas }}">
                    </div>

                    <!-- DATA SEWA -->
                    <h2 class="text-xl font-bold text-accent text-center flex items-center gap-2 justify-center mb-4">
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

                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label class="block font-medium text-gray-700">Durasi</label>
                            <input type="number" name="durasi" placeholder="Durasi (bulan/tahun)"
                                class="input w-full mt-1" min="1" x-model.number="durasi">
                        </div>
                        <div>
                            <label class="block font-medium text-gray-700">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="input w-full mt-1" required>
                        </div>
                    </div>

                    <!-- RINGKASAN -->
                    <div class="bg-gray-100 rounded-xl p-6 space-y-3 mt-4">
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
                        class="w-full bg-accent hover:bg-orange-600 text-white py-4 rounded-xl font-bold text-lg mt-4">
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
