@extends('admin.layouts.app')

@section('page-title', 'Edit Galeri')

@section('content')

    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-xs text-slate-400 mb-5">
        <a href="{{ route('admin.galeri.index') }}" class="hover:text-blue-500 transition-colors">Data Galeri</a>
        <i class="fa-solid fa-chevron-right text-[9px]"></i>
        <span class="text-slate-600 font-medium">Edit Galeri</span>
    </div>

    <form action="{{ route('admin.galeri.update', $galeri) }}"
          method="POST"
          enctype="multipart/form-data">

        @method('PUT')
        @include('admin.galeri._form', ['galeri' => $galeri])

    </form>

@endsection