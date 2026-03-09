@extends('user.layouts.app')

@section('content')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <<<<<<< style/user <style>
        .input {
        width: 100%;
        padding: 0.625rem 0.875rem;
        border: 1px solid #e2e8f0;
        border-radius: 0.75rem;
        font-size: 0.875rem;
        color: #1e293b;
        background: #f8fafc;
        transition: border-color 0.15s, box-shadow 0.15s;
        outline: none;
        }
        =======
        <div class="max-w-4xl mx-auto py-12 px-4">
            <div class="bg-white rounded-3xl shadow-lg p-8">

                <h1 class="text-3xl font-bold text-center mb-8">Booking Kamar</h1>

                <div class="bg-gray-100 rounded-xl p-5 mb-8">
                    <h3 class="font-bold text-lg">{{ $kamar->kos->nama_kos }}</h3>
                    <p class="text-sm text-gray-600">{{ $kamar->nama_kamar }}</p>
                </div>

                <form method="POST" action="{{ route('user.booking.store', $kamar) }}" class="space-y-8"
                    x-data='bookingForm(@json($bookings), @json($layanan), @json($discounts))'
                    x-init="init()">

                    @csrf

                    <h2class="text-xl font-bold text-accent text-center flex items-center gap-2 justify-center mb-4">
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
                        >>>>>>> main

                        .input:focus {
                        border-color: #f97316;
                        box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.12);
                        background: #fff;
                        }

                        .radio-card {
                        display: flex;
                        align-items: center;
                        gap: 0.625rem;
                        padding: 0.75rem 1rem;
                        border: 1.5px solid #e2e8f0;
                        border-radius: 0.75rem;
                        cursor: pointer;
                        font-size: 0.875rem;
                        font-weight: 500;
                        color: #475569;
                        background: #f8fafc;
                        transition: all 0.15s;
                        }

                        .radio-card:hover {
                        border-color: #fdba74;
                        background: #fff7ed;
                        color: #ea580c;
                        }

                        .radio-card input[type="radio"] {
                        accent-color: #f97316;
                        }

                        /* Flatpickr override */
                        .flatpickr-calendar {
                        border-radius: 12px !important;
                        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12) !important;
                        }

                        .flatpickr-day.selected,
                        .flatpickr-day.selected:hover {
                        background: #f97316 !important;
                        border-color: #f97316 !important;
                        }

                        .flatpickr-day:hover {
                        background: #fff7ed !important;
                        border-color: #fdba74 !important;
                        }
                        </style>

                        <body class="bg-gray-200">






                            {{-- ── Page Content ── --}}
                            <div class="max-w-3xl mx-auto pt-28 pb-16 px-4">

                                {{-- Page Title --}}
                                <div class="text-center mb-8">
                                    <h1 class="text-2xl font-extrabold text-slate-800">Booking Kamar</h1>
                                    <p class="text-sm text-slate-400 mt-1">Isi formulir di bawah untuk melanjutkan pemesanan
                                    </p>
                                </div>

                                {{-- Kamar Info --}}
                                <div
                                    class="bg-gradient-to-r from-orange-400 to-orange-600 rounded-2xl p-5 mb-6 flex items-center gap-4 shadow-md shadow-orange-200">
                                    <div
                                        class="w-11 h-11 rounded-xl bg-white/20 flex items-center justify-center flex-shrink-0">
                                        <i class="fa-solid fa-door-open text-white text-lg"></i>
                                    </div>
                                    <div>
                                        <p class="text-white font-extrabold text-base leading-tight">
                                            {{ $kamar->kos->nama_kos }}</p>
                                        <p class="text-indigo-100 text-sm mt-0.5">{{ $kamar->nama_kamar }}</p>
                                    </div>
                                </div>

                                <form method="POST" action="{{ route('user.booking.store', $kamar) }}"
                                    x-data='bookingForm(@json($bookings), @json($layanan), @json($discounts))'
                                    x-init="init()">
                                    @csrf

                                    <div class="space-y-5">

                                        {{-- ── Data Diri ── --}}
                                        <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                                            <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                                                <div
                                                    class="w-8 h-8 rounded-xl bg-indigo-50 flex items-center justify-center">
                                                    <i class="fa-solid fa-user text-indigo-400 text-xs"></i>
                                                </div>
                                                <h2 class="font-bold text-slate-700 text-sm">Data Diri</h2>
                                            </div>
                                            <div class="px-6 py-5 grid md:grid-cols-2 gap-4">
                                                <div>
                                                    <label class="block text-xs font-semibold text-slate-500 mb-1.5">Nama
                                                        Lengkap</label>
                                                    <input name="nama_penyewa" placeholder="Nama Lengkap" class="input"
                                                        value="{{ auth()->user()->name }}" required>
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-semibold text-slate-500 mb-1.5">Email</label>
                                                    <input name="email" type="email" placeholder="Email Aktif"
                                                        class="input" value="{{ auth()->user()->email }}" required>
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-semibold text-slate-500 mb-1.5">Nomor
                                                        Telepon</label>
                                                    <input name="phone" placeholder="Nomor Telepon" class="input"
                                                        value="{{ auth()->user()->phone }}" required>
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-xs font-semibold text-slate-500 mb-1.5">Alamat</label>
                                                    <input name="alamat" placeholder="Alamat Lengkap" class="input"
                                                        value="{{ auth()->user()->alamat }}" required>
                                                </div>
                                                <input type="hidden" name="nomor_identitas"
                                                    value="{{ auth()->user()->nomor_identitas }}">
                                            </div>
                                        </div>

                                        {{-- ── Data Sewa ── --}}
                                        <div
                                            class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                                            <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                                                <div
                                                    class="w-8 h-8 rounded-xl bg-blue-50 flex items-center justify-center">
                                                    <i class="fa-solid fa-calendar-check text-blue-400 text-xs"></i>
                                                </div>
                                                <h2 class="font-bold text-slate-700 text-sm">Data Sewa</h2>
                                            </div>
                                            <div class="px-6 py-5 space-y-5">

                                                {{-- Jenis Sewa --}}
                                                <div>
                                                    <label class="block text-xs font-semibold text-slate-500 mb-2">Jenis
                                                        Sewa</label>
                                                    <div class="grid grid-cols-3 gap-3">
                                                        @if (!is_null($kamar->harga_harian))
                                                            <label class="radio-card"
                                                                :class="jenisSewa === 'harian' ?
                                                                    'border-indigo-400 bg-indigo-50 text-indigo-700' :
                                                                    ''">
                                                                <input type="radio" name="jenis_sewa" value="harian"
                                                                    x-model="jenisSewa" class="hidden">
                                                                <i class="fa-regular fa-sun text-xs"></i> Harian
                                                            </label>
                                                        @endif
                                                        <label class="radio-card"
                                                            :class="jenisSewa === 'bulanan' ?
                                                                'border-indigo-400 bg-indigo-50 text-indigo-700' : ''">
                                                            <input type="radio" name="jenis_sewa" value="bulanan"
                                                                x-model="jenisSewa" class="hidden">
                                                            <i class="fa-regular fa-calendar text-xs"></i> Bulanan
                                                        </label>
                                                        <label class="radio-card"
                                                            :class="jenisSewa === 'tahunan' ?
                                                                'border-indigo-400 bg-indigo-50 text-indigo-700' : ''">
                                                            <input type="radio" name="jenis_sewa" value="tahunan"
                                                                x-model="jenisSewa" class="hidden">
                                                            <i class="fa-regular fa-calendar-days text-xs"></i> Tahunan
                                                        </label>
                                                    </div>
                                                </div>

                                                {{-- Tanggal & Durasi --}}
                                                <div class="grid md:grid-cols-2 gap-4">
                                                    <div>
                                                        <label class="block text-xs font-semibold text-slate-500 mb-1.5">
                                                            <span
                                                                x-text="jenisSewa === 'harian' ? 'Mulai Sewa (Tanggal)' : 'Mulai Sewa (Bulan)'"></span>
                                                        </label>
                                                        <input id="inputMulai"
                                                            :type="jenisSewa === 'harian' ? 'text' : 'month'"
                                                            :name="jenisSewa === 'harian' ? 'tanggal_mulai' : 'bulan_mulai'"
                                                            class="input"
                                                            :min="jenisSewa !== 'harian' ? minMonth : null"
                                                            :placeholder="jenisSewa === 'harian' ? 'Pilih tanggal...' : ''"
                                                            x-model="inputMulai" :readonly="jenisSewa === 'harian'">
                                                    </div>
                                                    <div>
                                                        <label class="block text-xs font-semibold text-slate-500 mb-1.5">
                                                            Durasi (<span x-text="satuanDurasi"></span>)
                                                        </label>
                                                        <select name="durasi" class="input" x-model.number="durasi"
                                                            required>
                                                            <template x-for="i in durasiOptions" :key="i">
                                                                <option :value="i"
                                                                    x-text="i + ' ' + satuanDurasi"></option>
                                                            </template>
                                                        </select>
                                                    </div>
                                                </div>

                                                {{-- Info Otomatis --}}
                                                <div
                                                    class="bg-blue-50 border border-blue-100 rounded-xl p-4 text-sm space-y-2">
                                                    <div class="flex justify-between items-center">
                                                        <span class="text-blue-600 font-medium">Mulai</span>
                                                        <span class="font-semibold text-slate-700"
                                                            x-text="tanggalMulaiFormatted"></span>
                                                    </div>
                                                    <div class="flex justify-between items-center">
                                                        <span class="text-blue-600 font-medium">Selesai</span>
                                                        <span class="font-semibold text-slate-700"
                                                            x-text="tanggalSelesaiFormatted"></span>
                                                    </div>

                                                    <template x-if="bookings.length > 0">
                                                        <div class="pt-2 border-t border-blue-200">
                                                            <p class="text-xs font-semibold text-blue-600 mb-1.5">📋
                                                                Periode sudah terisi:</p>
                                                            <template x-for="b in bookings" :key="b.tanggal_mulai">
                                                                <p class="text-xs text-blue-500">
                                                                    • <span x-text="tglFormat(b.tanggal_mulai)"></span>
                                                                    s/d <span x-text="tglFormat(b.tanggal_selesai)"></span>
                                                                </p>
                                                            </template>
                                                        </div>
                                                    </template>

                                                    <div x-show="isBentrok" x-transition
                                                        class="flex items-center gap-2 bg-red-50 border border-red-100 text-red-600 px-3 py-2.5 rounded-lg text-xs font-medium">
                                                        <i class="fa-solid fa-triangle-exclamation"></i>
                                                        Periode ini sudah dibooking. Silakan pilih tanggal lain.
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        {{-- ── Layanan Tambahan ── --}}
                                        <div
                                            class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                                            <div
                                                class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-8 h-8 rounded-xl bg-violet-50 flex items-center justify-center">
                                                        <i class="fa-solid fa-concierge-bell text-violet-400 text-xs"></i>
                                                    </div>
                                                    <h2 class="font-bold text-slate-700 text-sm">Layanan Tambahan</h2>
                                                </div>
                                                <label class="relative inline-flex items-center cursor-pointer gap-2">
                                                    <div class="relative">
                                                        <input type="checkbox" x-model="showLayanan"
                                                            class="sr-only peer">
                                                        <div
                                                            class="w-10 h-5 bg-slate-200 peer-checked:bg-indigo-500 rounded-full transition-colors">
                                                        </div>
                                                        <div
                                                            class="absolute top-0.5 left-0.5 w-4 h-4 bg-white rounded-full shadow transition-transform peer-checked:translate-x-5">
                                                        </div>
                                                    </div>
                                                    <span class="text-xs font-semibold text-slate-500"
                                                        x-text="showLayanan ? 'Aktif' : 'Nonaktif'"></span>
                                                </label>
                                            </div>

                                            <div x-show="showLayanan" x-transition class="px-6 py-5">
                                                <div class="space-y-2">
                                                    @foreach ($layanan as $l)
                                                        <label
                                                            class="flex items-center justify-between px-3 py-2.5 bg-slate-50 hover:bg-violet-50 rounded-xl border border-slate-100 hover:border-violet-100 transition-colors cursor-pointer group">
                                                            <div class="flex items-center gap-2.5">
                                                                <input type="checkbox" name="layanan[]"
                                                                    value="{{ $l->id }}" x-model="selectedLayanan"
                                                                    class="w-4 h-4 rounded accent-indigo-500 flex-shrink-0">
                                                                <span
                                                                    class="text-sm font-medium text-slate-700">{{ $l->nama_layanan }}</span>
                                                            </div>
                                                            <span
                                                                class="text-xs font-bold text-slate-500 bg-white border border-slate-200 group-hover:border-violet-200 group-hover:text-violet-600 px-2.5 py-1 rounded-lg transition-colors">
                                                                Rp {{ number_format($l->harga, 0, ',', '.') }}
                                                            </span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div x-show="!showLayanan" class="px-6 py-4">
                                                <p class="text-xs text-slate-400">Aktifkan toggle untuk memilih layanan
                                                    tambahan.</p>
                                            </div>
                                        </div>

                                        {{-- ── Ringkasan Booking ── --}}
                                        <div
                                            class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
                                            <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-3">
                                                <div
                                                    class="w-8 h-8 rounded-xl bg-green-50 flex items-center justify-center">
                                                    <i class="fa-solid fa-receipt text-green-500 text-xs"></i>
                                                </div>
                                                <h2 class="font-bold text-slate-700 text-sm">Ringkasan Booking</h2>
                                            </div>
                                            <div class="px-6 py-5 space-y-3 text-sm">

                                                <div class="flex justify-between items-center">
                                                    <span class="text-slate-500">Durasi</span>
                                                    <span class="font-semibold text-slate-700"
                                                        x-text="durasi + ' ' + satuanDurasi"></span>
                                                </div>
                                                <div class="flex justify-between items-center">
                                                    <span class="text-slate-500">Harga per <span
                                                            x-text="satuanDurasi"></span></span>
                                                    <span class="font-semibold text-slate-700"
                                                        x-text="format(hargaPerUnit)"></span>
                                                </div>
                                                <div class="flex justify-between items-center text-green-600">
                                                    <span>Diskon</span>
                                                    <span class="font-semibold">- <span
                                                            x-text="format(discount)"></span></span>
                                                </div>

                                                <template x-if="selectedLayanan.length > 0">
                                                    <div class="pt-2 border-t border-dashed border-slate-100 space-y-1.5">
                                                        <p
                                                            class="text-xs font-semibold text-slate-400 uppercase tracking-wide">
                                                            Layanan Dipilih
                                                        </p>
                                                        <template x-for="(id, index) in selectedLayanan"
                                                            :key="id">
                                                            <div class="flex justify-between items-center">
                                                                <span class="text-slate-500">
                                                                    <span x-text="index + 1"></span>.
                                                                    <span
                                                                        x-text="layanan.find(l => l.id == id)?.nama_layanan"></span>
                                                                </span>
                                                                <span class="font-semibold text-slate-700"
                                                                    x-text="format(layanan.find(l => l.id == id)?.harga)"></span>
                                                            </div>
                                                        </template>
                                                    </div>
                                                </template>

                                                <div
                                                    class="pt-3 border-t border-slate-100 flex justify-between items-center">
                                                    <span class="font-bold text-slate-800">Total Bayar</span>
                                                    <span class="text-lg font-extrabold text-indigo-600"
                                                        x-text="format(grandTotal)"></span>
                                                </div>

                                            </div>
                                        </div>
                                        {{-- Error --}}
                                        @if ($errors->any())
                                            <div class="max-w-3xl mx-auto mt-6 px-4">
                                                <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                                                    @foreach ($errors->all() as $error)
                                                        <div class="flex items-center gap-2 text-sm text-red-600">
                                                            <i class="fa-solid fa-circle-exclamation text-xs"></i>
                                                            {{ $error }}
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                        {{-- ── Submit ── --}}
                                        <button type="submit" :disabled="isBentrok || !inputMulai"
                                            :class="(isBentrok || !inputMulai) ?
                                            'bg-slate-200 text-slate-400 cursor-not-allowed' :
                                            'bg-gradient-to-r from-orange-400 to-orange-600 text-white shadow-md shadow-indigo-200 cursor-pointer'"
                                            class="w-full py-3.5 rounded-2xl font-bold text-sm transition-colors flex items-center justify-center gap-2">
                                            <i class="fa-solid fa-bolt text-xs" x-show="!isBentrok && inputMulai"></i>
                                            <span
                                                x-text="isBentrok ? 'Tanggal Tidak Tersedia' : (!inputMulai ? 'Pilih Tanggal Dulu' : 'Booking Sekarang')"></span>
                                        </button>


                                    </div>
                                </form>
                            </div>
                        </body>

                        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                        <script>
                            function bookingForm(bookings, layanan, discounts) {
                                return {
                                    bookings: bookings,
                                    layanan: layanan,
                                    discounts: discounts,

                                    selectedLayanan: [],
                                    showLayanan: false,

                                    hargaHarian: {{ (int) ($kamar->harga_harian ?? 0) }},
                                    hargaBulanan: {{ (int) $kamar->harga_bulanan }},
                                    hargaTahunan: {{ (int) $kamar->harga_tahunan }},

                                    jenisSewa: 'bulanan',
                                    durasi: 1,
                                    inputMulai: '',
                                    _fp: null,

                                    init() {

                                        this.inputMulai = this.getMinMonth()

                                        this.$nextTick(() => {
                                            const el = document.getElementById('inputMulai')
                                            if (el) el.value = this.inputMulai
                                        })

                                        this.$watch('jenisSewa', (val) => {

                                            this.durasi = 1
                                            this.inputMulai = ''

                                            const el = document.getElementById('inputMulai')

                                            if (!el) return

                                            /* destroy flatpickr jika ada */
                                            if (this._fp) {
                                                this._fp.destroy()
                                                this._fp = null
                                            }

                                            /* reset attribute */
                                            el.value = ''
                                            el.removeAttribute('readonly')

                                            if (val === 'harian') {

                                                /* ubah ke text untuk flatpickr */
                                                el.type = 'text'
                                                el.setAttribute('readonly', true)

                                                this.$nextTick(() => {
                                                    this.initFlatpickr()
                                                })

                                            } else {

                                                /* ubah kembali ke month */
                                                el.type = 'month'

                                                this.$nextTick(() => {
                                                    this.inputMulai = this.getMinMonth()
                                                    el.value = this.inputMulai
                                                })
                                            }

                                        })

                                    },

                                    initFlatpickr() {

                                        const el = document.getElementById('inputMulai')
                                        if (!el) return

                                        let disabledDates = []

                                        this.bookings.forEach(b => {

                                            let d = new Date(b.tanggal_mulai + 'T00:00:00')
                                            let end = new Date(b.tanggal_selesai + 'T00:00:00')

                                            while (d <= end) {
                                                disabledDates.push(d.toISOString().split('T')[0])
                                                d.setDate(d.getDate() + 1)
                                            }

                                        })

                                        const self = this

                                        if (self._fp) {
                                            self._fp.destroy()
                                        }

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
                                        return `${now.getFullYear()}-${String(now.getMonth() + 1).padStart(2,'0')}`
                                    },

                                    get minMonth() {
                                        return this.getMinMonth()
                                    },


                                    get tanggalMulai() {
                                        if (!this.inputMulai) return null
                                        return this.jenisSewa === 'harian' ?
                                            new Date(this.inputMulai + 'T00:00:00') :
                                            new Date(this.inputMulai + '-01T00:00:00')
                                    },

                                    get tanggalSelesai() {
                                        if (!this.tanggalMulai) return null
                                        const d = new Date(this.tanggalMulai)
                                        if (this.jenisSewa === 'harian') d.setDate(d.getDate() + this.durasi - 1)
                                        else if (this.jenisSewa === 'bulanan') {
                                            d.setMonth(d.getMonth() + this.durasi);
                                            d.setDate(d.getDate() - 1)
                                        } else {
                                            d.setFullYear(d.getFullYear() + this.durasi);
                                            d.setDate(d.getDate() - 1)
                                        }
                                        return d
                                    },

                                    get tanggalMulaiFormatted() {
                                        return this.tanggalMulai ? this.tanggalMulai.toLocaleDateString('id-ID', {
                                            day: '2-digit',
                                            month: 'long',
                                            year: 'numeric'
                                        }) : '-'
                                    },
                                    get tanggalSelesaiFormatted() {
                                        return this.tanggalSelesai ? this.tanggalSelesai.toLocaleDateString('id-ID', {
                                            day: '2-digit',
                                            month: 'long',
                                            year: 'numeric'
                                        }) : '-'
                                    },
                                    tglFormat(tgl) {
                                        if (!tgl) return '-'
                                        const d = new Date(tgl)
                                        if (isNaN(d)) return '-'
                                        return d.toLocaleDateString('id-ID', {
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
                                            return start <= selesai && end >= mulai
                                        })
                                    },

                                    get hargaPerUnit() {
                                        if (this.jenisSewa === 'harian') return this.hargaHarian
                                        if (this.jenisSewa === 'bulanan') return this.hargaBulanan
                                        return this.hargaTahunan
                                    },
                                    get subtotal() {

                                        if (this.jenisSewa === 'harian') {
                                            return this.hargaHarian * this.durasi
                                        }

                                        if (this.jenisSewa === 'bulanan') {
                                            return this.hargaBulanan * this.durasi
                                        }

                                        return this.hargaTahunan * this.durasi
                                    },
                                    get layananTotal() {
                                        return this.selectedLayanan.reduce((total, id) => {
                                            const l = this.layanan.find(x => x.id == id)
                                            return total + (l ? parseInt(l.harga) : 0)
                                        }, 0)
                                    },

                                    get grandTotal() {
                                        return this.subtotal - this.discount + this.layananTotal
                                    },

                                    get totalBayar() {
                                        return this.subtotal - this.discount

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
                                    get discount() {
                                        const subtotal = this.hargaPerUnit * this.durasi
                                        const promo = this.discounts.find(d => {
                                            if (d.jenis_sewa && d.jenis_sewa !== this.jenisSewa) return false
                                            if (d.min_durasi && this.durasi < d.min_durasi) return false
                                            if (d.min_total && subtotal < d.min_total) return false
                                            return true
                                        })
                                        if (!promo) return 0

                                        let discount = 0

                                        if (promo.type === 'percent') {

                                            discount = subtotal * promo.value / 100

                                        } else {

                                            discount = parseInt(promo.value)
                                        }

                                        // APPLY MAX DISCOUNT
                                        if (promo.max_discount && discount > promo.max_discount) {
                                            discount = promo.max_discount
                                        }

                                        return discount
                                    },
                                    format(val) {
                                        return 'Rp ' + Number(val).toLocaleString('id-ID')
                                    }
                                }
                            }
                        </script>

                    @endsection
