@extends('user.layouts.app')

@section('content')

    @if ($errors->any())
        <div class="bg-red-100 p-3 rounded mb-3">
            @foreach ($errors->all() as $error)
                <div class="text-red-600 text-sm">{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <!-- HEADER -->
    <nav class="bg-primary fixed w-full top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center space-x-3">
                    <i class="fa-brands fa-galactic-senate text-accent text-3xl"></i>
                    <span class="text-gray-900 dark:text-gray-100 text-2xl font-bold">
                        {{ setting('site_name', 'KosKu') }}
                    </span>
                </div>
                <a href="{{ url()->previous() }}"
                    class="flex items-center gap-2 text-gray-600 dark:text-gray-300 hover:text-primary dark:hover:text-primary transition">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </nav>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <div class="max-w-4xl mx-auto py-12 px-4">
        <div class="bg-white rounded-3xl shadow-lg p-8">

            <h1 class="text-3xl font-bold text-center mb-8">Booking Kamar</h1>

            <div class="bg-gray-100 rounded-xl p-5 mb-8">
                <h3 class="font-bold text-lg">{{ $kamar->kos->nama_kos }}</h3>
                <p class="text-sm text-gray-600">{{ $kamar->nama_kamar }}</p>
            </div>

            <form method="POST" action="{{ route('user.booking.store', $kamar) }}" class="space-y-8"
                x-data='bookingForm(@json($bookings), @json($layanan))' x-init="init()">
                @csrf

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
                    <input type="hidden" name="nomor_identitas" value="{{ auth()->user()->nomor_identitas }}">
                </div>

                <h2 class="text-xl font-bold text-accent text-center flex items-center gap-2 justify-center mb-4">
                    <i class="fas fa-calendar-check"></i> Data Sewa
                </h2>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    @if (!is_null($kamar->harga_harian))
                        <label class="radio-card" :class="{ 'border-accent': jenisSewa === 'harian' }">
                            <input type="radio" name="jenis_sewa" value="harian" x-model="jenisSewa">
                            Harian
                        </label>
                    @endif

                    <label class="radio-card" :class="{ 'border-accent': jenisSewa === 'bulanan' }">
                        <input type="radio" name="jenis_sewa" value="bulanan" x-model="jenisSewa">
                        Bulanan
                    </label>

                    <label class="radio-card" :class="{ 'border-accent': jenisSewa === 'tahunan' }">
                        <input type="radio" name="jenis_sewa" value="tahunan" x-model="jenisSewa">
                        Tahunan
                    </label>
                </div>

                <div class="grid md:grid-cols-2 gap-4">

                    <!-- Kolom Tanggal/Bulan Mulai -->
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">
                            <span x-text="jenisSewa === 'harian' ? 'Mulai Sewa (Tanggal)' : 'Mulai Sewa (Bulan)'"></span>
                        </label>

                        {{--
                            PERBAIKAN KUNCI:
                            Gunakan satu input saja dengan :type dinamis.
                            Hindari x-if/x-show yang menyebabkan Alpine
                            kehilangan binding saat elemen di-destroy/recreate.
                        --}}
                        <input id="inputMulai" :type="jenisSewa === 'harian' ? 'text' : 'month'"
                            :name="jenisSewa === 'harian' ? 'tanggal_mulai' : 'bulan_mulai'" class="input w-full"
                            :min="jenisSewa !== 'harian' ? minMonth : null"
                            :placeholder="jenisSewa === 'harian' ? 'Pilih tanggal...' : ''" x-model="inputMulai"
                            :readonly="jenisSewa === 'harian'">
                    </div>

                    <!-- Durasi -->
                    <div>
                        <label class="block font-medium text-gray-700 mb-1">
                            Durasi (<span x-text="satuanDurasi"></span>)
                        </label>
                        <select name="durasi" class="input w-full" x-model.number="durasi" required>
                            <template x-for="i in durasiOptions" :key="i">
                                <option :value="i" x-text="i + ' ' + satuanDurasi"></option>
                            </template>
                        </select>
                    </div>

                </div>

                <!-- Info Otomatis -->
                <div class="bg-blue-50 rounded-xl p-4 mt-4 text-sm space-y-2">
                    <div class="flex justify-between">
                        <span class="font-medium">Mulai:</span>
                        <span x-text="tanggalMulaiFormatted"></span>
                    </div>
                    <div class="flex justify-between">
                        <span class="font-medium">Selesai:</span>
                        <span x-text="tanggalSelesaiFormatted"></span>
                    </div>

                    <!-- Info booking yang sudah ada -->
                    <template x-if="bookings.length > 0">
                        <div class="pt-2 border-t border-blue-200 mt-2">
                            <p class="font-medium text-blue-700 mb-1">📋 Periode sudah terisi:</p>
                            <template x-for="b in bookings" :key="b.tanggal_mulai">
                                <p class="text-blue-600 text-xs">
                                    • <span x-text="tglFormat(b.tanggal_mulai)"></span>
                                    s/d <span x-text="tglFormat(b.tanggal_selesai)"></span>
                                </p>
                            </template>
                        </div>
                    </template>

                    <!-- Peringatan bentrok -->
                    <div x-show="isBentrok" class="bg-red-50 text-red-600 p-3 rounded-lg text-sm mt-2">
                        ⚠️ Periode ini sudah dibooking. Silakan pilih bulan/tanggal lain.
                    </div>
                </div>

                <div class="border rounded-xl p-4">

                    <label class="flex items-center gap-2 cursor-pointer font-semibold">
                        <input type="checkbox" x-model="showLayanan">
                        Tambah Layanan
                    </label>

                    <div x-show="showLayanan" x-transition class="mt-3 space-y-2">

                        @foreach ($layanan as $l)
                            <label class="flex items-center gap-2 cursor-pointer">

                                <input type="checkbox" name="layanan[]" value="{{ $l->id }}"
                                    x-model="selectedLayanan">

                                {{ $l->nama_layanan }}
                                -
                                Rp {{ number_format($l->harga, 0, ',', '.') }}

                            </label>
                        @endforeach

                    </div>

                </div>

                <!-- RINGKASAN -->
                <div class="bg-gray-100 rounded-xl p-6 space-y-3 mt-4">
                    <h3 class="text-lg font-bold text-accent flex items-center gap-2">
                        <i class="fas fa-receipt"></i> Ringkasan Booking
                    </h3>
                    <div class="flex justify-between">
                        <span>Harga per <span x-text="satuanDurasi"></span></span>
                        <span x-text="format(hargaPerUnit)"></span>
                    </div>
                    <div class="flex justify-between">
                        <span>Durasi</span>
                        <span x-text="durasi + ' ' + satuanDurasi"></span>
                    </div>
                    <template x-if="selectedLayanan.length > 0">
                        <div class="space-y-1">

                            <div class="font-semibold text-sm text-gray-600">
                                Opsi Layanan
                            </div>

                            <template x-for="(id,index) in selectedLayanan" :key="id">

                                <div class="flex justify-between text-sm">

                                    <span>
                                        <span x-text="index+1"></span>.
                                        <span x-text="layanan.find(l => l.id == id)?.nama_layanan"></span>
                                    </span>

                                    <span class="text-green-600">
                                        <span x-text="format(layanan.find(l => l.id == id)?.harga)"></span>
                                    </span>

                                </div>

                            </template>

                        </div>
                    </template>
                    <hr>
                    <div class="flex justify-between font-bold text-lg">
                        <span>Total Bayar</span>
                        <span x-text="format(grandTotal)" class="text-accent"></span>
                    </div>
                </div>

                <button type="submit" :disabled="isBentrok || !inputMulai"
                    :class="(isBentrok || !inputMulai) ? 'bg-gray-400 cursor-not-allowed' : 'bg-accent hover:bg-orange-600'"
                    class="w-full text-white py-4 rounded-xl font-bold text-lg mt-4">
                    <span
                        x-text="isBentrok ? 'Tanggal Tidak Tersedia' : (!inputMulai ? 'Pilih Tanggal Dulu' : 'Booking Sekarang')"></span>
                </button>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        function bookingForm(bookings, layanan) {
            return {
                bookings: bookings,
                layanan: layanan,
                selectedLayanan: [],
                showLayanan: false,

                hargaHarian: {{ (int) ($kamar->harga_harian ?? 0) }},
                hargaBulanan: {{ (int) $kamar->harga_bulanan }},
                hargaTahunan: {{ (int) $kamar->harga_tahunan }},

                jenisSewa: 'bulanan',
                durasi: 1,

                // Satu variabel untuk semua mode
                inputMulai: '',

                _fp: null, // flatpickr instance

                init() {
                    // Default: set ke bulan ini
                    this.inputMulai = this.getMinMonth()
                    this.$nextTick(() => {
                        const el = document.getElementById('inputMulai')
                        if (el) el.value = this.inputMulai
                    })

                    // Watch perubahan jenis sewa
                    this.$watch('jenisSewa', (val) => {
                        this.durasi = 1
                        this.inputMulai = ''

                        if (val === 'harian') {
                            this.$nextTick(() => this.initFlatpickr())
                        } else {
                            // Hancurkan flatpickr kalau ada
                            if (this._fp) {
                                this._fp.destroy()
                                this._fp = null
                            }
                            // Set input ke bulan ini
                            this.$nextTick(() => {
                                this.inputMulai = this.getMinMonth()
                                // Paksa update DOM karena :type berubah
                                const el = document.getElementById('inputMulai')
                                if (el) el.value = this.inputMulai
                            })
                        }
                    })
                },

                initFlatpickr() {
                    const el = document.getElementById('inputMulai')
                    if (!el) return

                    // Kumpulkan tanggal yang sudah di-booking untuk di-disable
                    let disabledDates = []
                    this.bookings.forEach(b => {
                        // Inklusif: disable dari tanggal_mulai s/d tanggal_selesai
                        let d = new Date(b.tanggal_mulai + 'T00:00:00')
                        let end = new Date(b.tanggal_selesai + 'T00:00:00')
                        while (d <= end) {
                            disabledDates.push(d.toISOString().split('T')[0])
                            d.setDate(d.getDate() + 1)
                        }
                    })

                    const self = this
                    if (self._fp) self._fp.destroy()

                    self._fp = flatpickr(el, {
                        dateFormat: "Y-m-d",
                        minDate: "today",
                        disable: disabledDates,
                        onChange(selectedDates, dateStr) {
                            self.inputMulai = dateStr
                        }
                    })
                },

                getMinMonth() {
                    const now = new Date()
                    return `${now.getFullYear()}-${String(now.getMonth() + 1).padStart(2, '0')}`
                },

                get minMonth() {
                    return this.getMinMonth()
                },

                // Parse tanggal mulai ke Date object
                get tanggalMulai() {
                    if (!this.inputMulai) return null

                    if (this.jenisSewa === 'harian') {
                        return new Date(this.inputMulai + 'T00:00:00')
                    }
                    // Bulanan/Tahunan: format "YYYY-MM" → tanggal 1
                    return new Date(this.inputMulai + '-01T00:00:00')
                },

                get tanggalSelesai() {
                    if (!this.tanggalMulai) return null

                    const d = new Date(this.tanggalMulai)

                    if (this.jenisSewa === 'harian') {
                        // Selesai = mulai + durasi hari - 1 (inclusive)
                        d.setDate(d.getDate() + this.durasi - 1)
                    } else if (this.jenisSewa === 'bulanan') {
                        // Selesai = mulai + durasi bulan - 1 hari (akhir bulan terakhir)
                        d.setMonth(d.getMonth() + this.durasi)
                        d.setDate(d.getDate() - 1)
                    } else {
                        // Tahunan
                        d.setFullYear(d.getFullYear() + this.durasi)
                        d.setDate(d.getDate() - 1)
                    }

                    return d
                },

                get tanggalMulaiFormatted() {
                    if (!this.tanggalMulai) return '-'
                    return this.tanggalMulai.toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric'
                    })
                },

                get tanggalSelesaiFormatted() {
                    if (!this.tanggalSelesai) return '-'
                    return this.tanggalSelesai.toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric'
                    })
                },

                tglFormat(tgl) {
                    if (!tgl) return '-'
                    return new Date(tgl + 'T00:00:00').toLocaleDateString('id-ID', {
                        day: '2-digit',
                        month: 'short',
                        year: 'numeric'
                    })
                },

                get isBentrok() {
                    if (!this.tanggalMulai || !this.tanggalSelesai) return false

                    const start = this.tanggalMulai.getTime()
                    const end = this.tanggalSelesai.getTime()

                    return this.bookings.some(b => {
                        const mulai = new Date(b.tanggal_mulai + 'T00:00:00').getTime()
                        const selesai = new Date(b.tanggal_selesai + 'T00:00:00').getTime()

                        /**
                         * DB menyimpan tanggal_selesai sebagai hari TERAKHIR sewa (inclusive).
                         * Dua periode dianggap bentrok jika ada irisan:
                         *   start <= selesai  AND  end >= mulai
                         */
                        return start <= selesai && end >= mulai
                    })
                },

                get hargaPerUnit() {
                    if (this.jenisSewa === 'harian') return this.hargaHarian
                    if (this.jenisSewa === 'bulanan') return this.hargaBulanan
                    return this.hargaTahunan
                },

                get subtotal() {
                    return this.hargaPerUnit * this.durasi
                },

                get layananTotal() {
                    return this.selectedLayanan.reduce((total, id) => {
                        const l = this.layanan.find(x => x.id == id)
                        return total + (l ? parseInt(l.harga) : 0)
                    }, 0)
                },

                get grandTotal() {
                    return this.subtotal + this.layananTotal
                },

                get satuanDurasi() {
                    if (this.jenisSewa === 'harian') return 'Hari'
                    if (this.jenisSewa === 'bulanan') return 'Bulan'
                    return 'Tahun'
                },

                get durasiOptions() {
                    if (this.jenisSewa === 'harian') return Array.from({
                        length: 30
                    }, (_, i) => i + 1)
                    if (this.jenisSewa === 'bulanan') return Array.from({
                        length: 11
                    }, (_, i) => i + 1)
                    return Array.from({
                        length: 5
                    }, (_, i) => i + 1)
                },

                format(val) {
                    return 'Rp ' + Number(val).toLocaleString('id-ID')
                }
            }
        }
    </script>

@endsection
