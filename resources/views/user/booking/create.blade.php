@extends('user.layouts.app')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<style>
.input{
    width:100%;
    padding:0.625rem 0.875rem;
    border:1px solid #e2e8f0;
    border-radius:0.75rem;
    font-size:0.875rem;
    color:#1e293b;
    background:#f8fafc;
    transition:border-color .15s,box-shadow .15s;
    outline:none;
}

.input:focus{
    border-color:#f97316;
    box-shadow:0 0 0 3px rgba(249,115,22,.12);
    background:#fff;
}

.radio-card{
    display:flex;
    align-items:center;
    gap:.625rem;
    padding:.75rem 1rem;
    border:1.5px solid #e2e8f0;
    border-radius:.75rem;
    cursor:pointer;
    font-size:.875rem;
    font-weight:500;
    color:#475569;
    background:#f8fafc;
    transition:all .15s;
}

.radio-card:hover{
    border-color:#fdba74;
    background:#fff7ed;
    color:#ea580c;
}

.radio-card input[type="radio"]{
    accent-color:#f97316;
}

.flatpickr-calendar{
    border-radius:12px !important;
    box-shadow:0 10px 30px rgba(0,0,0,.12) !important;
}

.flatpickr-day.selected,
.flatpickr-day.selected:hover{
    background:#f97316 !important;
    border-color:#f97316 !important;
}

.flatpickr-day:hover{
    background:#fff7ed !important;
    border-color:#fdba74 !important;
}
</style>

<div class="max-w-3xl mx-auto pt-28 pb-16 px-4">

<div class="text-center mb-8">
<h1 class="text-2xl font-extrabold text-slate-800">Booking Kamar</h1>
<p class="text-sm text-slate-400 mt-1">
Isi formulir di bawah untuk melanjutkan pemesanan
</p>
</div>

<div class="bg-gradient-to-r from-orange-400 to-orange-600 rounded-2xl p-5 mb-6 flex items-center gap-4 shadow-md shadow-orange-200">
<div class="w-11 h-11 rounded-xl bg-white/20 flex items-center justify-center">
<i class="fa-solid fa-door-open text-white text-lg"></i>
</div>
<div>
<p class="text-white font-extrabold">
{{ $kamar->kos->nama_kos }}
</p>
<p class="text-indigo-100 text-sm">
{{ $kamar->nama_kamar }}
</p>
</div>
</div>

<form method="POST"
action="{{ route('user.booking.store', $kamar) }}"
x-data='bookingForm(@json($bookings),@json($layanan),@json($discounts))'
x-init="init()">

@csrf

<div class="space-y-6">

{{-- DATA DIRI --}}
<div class="bg-white rounded-2xl border shadow-sm">
<div class="px-6 py-4 border-b font-bold text-sm text-slate-700">
Data Diri
</div>

<div class="p-6 grid md:grid-cols-2 gap-4">

<div>
<label class="text-xs font-semibold text-slate-500">Nama Lengkap</label>
<input name="nama_penyewa"
class="input"
value="{{ auth()->user()->name }}"
required>
</div>

<div>
<label class="text-xs font-semibold text-slate-500">Email</label>
<input type="email"
name="email"
class="input"
value="{{ auth()->user()->email }}"
required>
</div>

<div>
<label class="text-xs font-semibold text-slate-500">Nomor Telepon</label>
<input name="phone"
class="input"
value="{{ auth()->user()->phone }}"
required>
</div>

<div>
<label class="text-xs font-semibold text-slate-500">Alamat</label>
<input name="alamat"
class="input"
value="{{ auth()->user()->alamat }}"
required>
</div>

<input type="hidden"
name="nomor_identitas"
value="{{ auth()->user()->nomor_identitas }}">

</div>
</div>


{{-- DATA SEWA --}}
<div class="bg-white rounded-2xl border shadow-sm">

<div class="px-6 py-4 border-b font-bold text-sm text-slate-700">
Data Sewa
</div>

<div class="p-6 space-y-5">

<div>
<label class="text-xs font-semibold text-slate-500">
Jenis Sewa
</label>

<div class="grid grid-cols-3 gap-3">

@if(!is_null($kamar->harga_harian))
<label class="radio-card">
<input type="radio"
name="jenis_sewa"
value="harian"
x-model="jenisSewa">
Harian
</label>
@endif

<label class="radio-card">
<input type="radio"
name="jenis_sewa"
value="bulanan"
x-model="jenisSewa">
Bulanan
</label>

<label class="radio-card">
<input type="radio"
name="jenis_sewa"
value="tahunan"
x-model="jenisSewa">
Tahunan
</label>

</div>
</div>

</div>
</div>


{{-- RINGKASAN --}}
<div class="bg-white rounded-2xl border shadow-sm">

<div class="px-6 py-4 border-b font-bold text-sm text-slate-700">
Ringkasan Booking
</div>

<div class="p-6 space-y-3 text-sm">

<div class="flex justify-between">
<span>Durasi</span>
<span x-text="durasi + ' ' + satuanDurasi"></span>
</div>

<div class="flex justify-between">
<span>Harga per <span x-text="satuanDurasi"></span></span>
<span x-text="format(hargaPerUnit)"></span>
</div>

<div class="flex justify-between text-green-600">
<span>Diskon</span>
<span>- <span x-text="format(discount)"></span></span>
</div>

<template x-if="selectedLayanan.length > 0">
<div class="space-y-1">
<div class="font-semibold text-gray-600 text-sm">
Opsi Layanan
</div>

<template x-for="(id,index) in selectedLayanan" :key="id">
<div class="flex justify-between text-sm">
<span>
<span x-text="index+1"></span>.
<span x-text="layanan.find(l => l.id == id)?.nama_layanan"></span>
</span>

<span class="text-green-600"
x-text="format(layanan.find(l => l.id == id)?.harga)">
</span>

</div>
</template>

</div>
</template>

<hr>

<div class="flex justify-between font-bold text-lg">
<span>Total Bayar</span>
<span class="text-orange-600"
x-text="format(grandTotal)">
</span>
</div>

</div>
</div>


<button type="submit"
class="w-full py-3 rounded-xl font-bold bg-orange-500 text-white hover:bg-orange-600 transition">

Booking Sekarang

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
                        if (val === 'harian') {
                            this.$nextTick(() => this.initFlatpickr())
                        } else {
                            if (this._fp) {
                                this._fp.destroy();
                                this._fp = null
                            }
                            this.$nextTick(() => {
                                this.inputMulai = this.getMinMonth()
                                const el = document.getElementById('inputMulai')
                                if (el) el.value = this.inputMulai
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
