@extends('admin.layouts.app')

@section('content')

<div class="max-w-6xl mx-auto">

    {{-- HEADER --}}
    <div class="flex justify-between items-start mb-6">

        

        <div class="flex gap-3">
            <a href="{{ route('admin.blog.index') }}"
                class="px-4 py-2 border rounded hover:bg-gray-100">
                ← Kembali
            </a>

            <a href="{{ route('admin.blog.edit', $blog) }}"
                class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                Edit
            </a>
        </div>
    </div>

    {{-- META INFO --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8 bg-white rounded-lg shadow p-5">

        <div>
              <p class="text-sm text-gray-500">Judul</p>
            <h1 class="text-3xl font-bold mb-2">
                {{ $blog->judul }}
            </h1>
        </div>

        <div>
            <p class="text-sm text-gray-500">Author</p>
            <p class="font-semibold">
                {{ $blog->author->name ?? '-' }}
            </p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Slug</p>
            <p class="font-mono text-sm bg-gray-100 px-2 py-1 rounded inline-block">
                {{ $blog->slug }}
            </p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Tanggal Terbit</p>
            <p class="font-semibold">
                {{ $blog->published_at
                    ? $blog->published_at->format('d M Y H:i')
                    : '-' }}
            </p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Views</p>
            <p class="font-semibold">
                {{ $blog->views }}
            </p>
        </div>

        <div>
            <p class="text-sm text-gray-500">Status</p>
            @if ($blog->status === 'published')
                <span class="inline-block px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                    Published
                </span>
            @else
                <span class="inline-block px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">
                    Draft
                </span>
            @endif
        </div>

        <div>
            <p class="text-sm text-gray-500">Dibuat</p>
            <p class="font-semibold">
                {{ $blog->created_at->format('d M Y H:i') }}
            </p>
        </div>

    </div>

    {{-- GAMBAR --}}
    @if ($blog->gambar)
        <div class="mb-6">
            <img src="{{ asset('storage/' . $blog->gambar) }}"
                class="w-full max-h-[420px] object-cover rounded-lg shadow">
        </div>
    @endif

    {{-- RINGKASAN --}}
    <div class="mb-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded">
        <h3 class="font-semibold mb-1">Ringkasan</h3>
        <p class="text-gray-700">
            {{ $blog->ringkasan }}
        </p>
    </div>

    {{-- ISI --}}
    <div class="bg-white rounded-lg shadow p-6 prose max-w-none">
        {!! $blog->isi !!}
    </div>
    
</div>


@endsection
