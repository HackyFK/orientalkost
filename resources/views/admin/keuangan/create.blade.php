<form method="POST" action="{{ route('admin.keuangan.store') }}">

@csrf

<input type="number" name="pengeluaran" placeholder="Jumlah">

<input type="text" name="keterangan" placeholder="Keterangan">

<button type="submit">
Tambah Pengeluaran
</button>

</form>