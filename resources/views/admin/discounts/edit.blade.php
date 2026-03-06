@extends('admin.layouts.app')

@section('content')

<div class="max-w-3xl mx-auto py-10">

<h1 class="text-xl font-bold mb-6">Edit Diskon</h1>

<form method="POST" action="{{ route('admin.kos-discounts.update',$kosDiscount) }}" class="space-y-6 bg-white p-6 rounded-xl shadow">
@csrf
@method('PUT')

<div>
<label class="text-sm font-semibold">Kos</label>
<select name="kos_id" class="input w-full mt-1">
@foreach($kos as $k)
<option value="{{ $k->id }}"
@if($k->id==$kosDiscount->kos_id) selected @endif>
{{ $k->nama_kos }}
</option>
@endforeach
</select>
</div>

<div>
<label class="text-sm font-semibold">Nama Promo</label>
<input name="nama" value="{{ $kosDiscount->nama }}" class="input w-full mt-1">
</div>

<div class="grid grid-cols-2 gap-4">

<div>
<label class="text-sm font-semibold">Tipe</label>
<select name="type" class="input w-full mt-1">
<option value="percent" @selected($kosDiscount->type=='percent')>Percent</option>
<option value="fixed" @selected($kosDiscount->type=='fixed')>Nominal</option>
</select>
</div>

<div>
<label class="text-sm font-semibold">Nilai</label>
<input type="number" name="value" value="{{ $kosDiscount->value }}" class="input w-full mt-1">
</div>

</div>

<div class="grid grid-cols-2 gap-4">

<div>
<label class="text-sm font-semibold">Minimal Durasi</label>
<input type="number" name="min_durasi" value="{{ $kosDiscount->min_durasi }}" class="input w-full mt-1">
</div>

<div>
<label class="text-sm font-semibold">Minimal Total</label>
<input type="number" name="min_total" value="{{ $kosDiscount->min_total }}" class="input w-full mt-1">
</div>

</div>

<div>
<label class="text-sm font-semibold">Jenis Sewa</label>
<select name="jenis_sewa" class="input w-full mt-1">
<option value="">Semua</option>
<option value="harian" @selected($kosDiscount->jenis_sewa=='harian')>Harian</option>
<option value="bulanan" @selected($kosDiscount->jenis_sewa=='bulanan')>Bulanan</option>
<option value="tahunan" @selected($kosDiscount->jenis_sewa=='tahunan')>Tahunan</option>
</select>
</div>

<div class="grid grid-cols-2 gap-4">

<div>
<label class="text-sm font-semibold">Mulai Promo</label>
<input type="date" name="start_date" value="{{ $kosDiscount->start_date }}" class="input w-full mt-1">
</div>

<div>
<label class="text-sm font-semibold">Berakhir</label>
<input type="date" name="end_date" value="{{ $kosDiscount->end_date }}" class="input w-full mt-1">
</div>

</div>

<div>

<label class="text-sm font-semibold">Hari Aktif</label>

<div class="grid grid-cols-4 gap-2 mt-2 text-sm">

@foreach(['mon'=>'Sen','tue'=>'Sel','wed'=>'Rab','thu'=>'Kam','fri'=>'Jum','sat'=>'Sab','sun'=>'Min'] as $key=>$day)

<label class="flex items-center gap-2">
<input type="checkbox" name="days[]" value="{{ $key }}"
{{ in_array($key,$kosDiscount->days ?? []) ? 'checked' : '' }}>
{{ $day }}
</label>

@endforeach

</div>

</div>

<div class="flex items-center gap-2">
<input type="checkbox" name="is_active" value="1"
{{ $kosDiscount->is_active ? 'checked' : '' }}>
<span class="text-sm">Promo Aktif</span>
</div>

<button class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold">
Update Diskon
</button>

</form>

</div>

@endsection
