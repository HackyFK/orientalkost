@extends('admin.layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Galeri</h1>

<form action="{{ route('admin.galeri.update', $galeri) }}"
      method="POST"
      enctype="multipart/form-data"
      class="bg-white p-6 rounded shadow max-w-xl">

    @method('PUT')
    @include('admin.galeri._form', ['galeri' => $galeri])

</form>
@endsection