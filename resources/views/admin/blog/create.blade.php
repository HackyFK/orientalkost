@extends('admin.layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-6 rounded shadow">

    <h1 class="text-2xl font-bold mb-6">Tambah Blog</h1>

    <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
        @include('admin.blog._form')
    </form>

</div>
@endsection
