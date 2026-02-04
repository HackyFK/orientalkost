<form method="POST"
      action="{{ route('admin.kos.update', $ko) }}"
      enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <input name="nama_kos" value="{{ $ko->nama_kos }}">
    <textarea name="alamat">{{ $ko->alamat }}</textarea>

    <input type="file" name="image">

    @if($ko->images->first())
        <img src="{{ asset('storage/'.$ko->images->first()->image_path) }}"
             class="w-32 mt-2">
    @endif

    <button>Update</button>
</form>
