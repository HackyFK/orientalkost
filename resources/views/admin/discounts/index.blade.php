@extends('admin.layouts.app')

@section('content')

<div class="max-w-7xl mx-auto py-10">

<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-xl font-bold text-slate-800">
            Kelola Diskon Kos
        </h1>
        <p class="text-sm text-slate-400">
            Atur promo untuk kos anda
        </p>
    </div>

    <a href="{{ route('admin.kos-discounts.create') }}"
       class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-semibold">
       + Tambah Diskon
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">

<div class="overflow-x-auto">

<table class="min-w-full text-sm">

<thead>
<tr class="bg-slate-50 text-xs font-bold text-slate-400 uppercase">
<th class="px-5 py-3">Nama</th>
<th class="px-5 py-3">Kos</th>
<th class="px-5 py-3">Diskon</th>
<th class="px-5 py-3">Minimal Durasi</th>
<th class="px-5 py-3">Status</th>
<th class="px-5 py-3 text-center">Aksi</th>
</tr>
</thead>

<tbody class="divide-y divide-slate-100">

@forelse($discounts as $discount)

<tr class="hover:bg-slate-50">

<td class="px-5 py-3 font-semibold">
{{ $discount->nama }}
</td>

<td class="px-5 py-3">
{{ $discount->kos->nama_kos }}
</td>

<td class="px-5 py-3">
@if($discount->type == 'percent')
{{ $discount->value }} %
@else
Rp {{ number_format($discount->value) }}
@endif
</td>

<td class="px-5 py-3">
{{ $discount->min_durasi ?? '-' }} bulan
</td>

<td class="px-5 py-3">
<span class="px-2 py-1 rounded text-xs
@if($discount->is_active) bg-green-100 text-green-700
@else bg-gray-100 text-gray-600
@endif">
{{ $discount->is_active ? 'Aktif' : 'Nonaktif' }}
</span>
</td>

<td class="px-5 py-3 text-center">

<a href="{{ route('admin.kos-discounts.edit',$discount) }}"
class="text-blue-600 text-xs font-semibold">
Edit
</a>

<form action="{{ route('admin.kos-discounts.destroy',$discount) }}"
method="POST"
class="inline">
@csrf
@method('DELETE')

<button class="text-red-500 text-xs ml-2">
Hapus
</button>

</form>

</td>

</tr>

@empty

<tr>
<td colspan="6" class="text-center py-10 text-slate-400">
Belum ada diskon
</td>
</tr>

@endforelse

</tbody>

</table>

</div>

@if($discounts->hasPages())
<div class="px-5 py-4 border-t">
{{ $discounts->links() }}
</div>
@endif

</div>

</div>

@endsection
