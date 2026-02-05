@extends('admin.layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Edit Fasilitas</h1>

    <form action="{{ route('admin.fasilitas.update', $fasilita) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1">Nama Fasilitas</label>
            <input type="text" name="nama_fasilitas" class="w-full border rounded p-2"
                value="{{ $fasilita->nama_fasilitas }}" required>
        </div>

        <div>
            <label>Icon (cukup: tv / wifi / bed)</label>
            <input type="text" id="iconInput" name="icon" class="w-full border p-2" placeholder="contoh: tv" value="{{ str_replace('fa-solid fa-', '', $fasilita->icon) }}">

            <div class="mt-2 text-lg">
                <i id="iconPreview"></i>
            </div>
        </div>


        <div>
            <label class="block mb-1">Kategori</label>

            <select name="kategori" class="w-full border rounded p-2" required>
                @foreach ($kategoriList as $key => $label)
                    <option value="{{ $key }}" {{ $fasilita->kategori == $key ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>




        <button class="px-4 py-2 bg-indigo-600 text-white rounded">
            Update
        </button>
    </form>

    <script>
document.getElementById('iconInput').addEventListener('input', function () {
    let val = this.value.trim()
    let preview = document.getElementById('iconPreview')

    if (!val) {
        preview.className = ''
        return
    }

    // normalisasi sederhana
    val = val.replace('fa-solid', '').replace('fa-', '')
    preview.className = 'fa-solid fa-' + val
})
</script>
@endsection
