@extends('admin.layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8">

        {{-- ACTION BUTTON --}}
        <div class="flex justify-between items-center mb-6">
            <a href="{{ route('admin.blog.index') }}" class="px-4 py-2 border rounded hover:bg-gray-100">
                ← Kembali
            </a>

            <a href="{{ route('admin.blog.edit', $blog) }}"
                class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600">
                Edit
            </a>
        </div>

        {{-- GAMBAR --}}
        @if ($blog->gambar)
            <div class="mb-8">
                <img src="{{ asset('storage/' . $blog->gambar) }}"
                    class="w-full max-h-[500px] object-cover rounded-xl shadow">
            </div>
        @endif


        {{-- JUDUL --}}
        <h1 class="text-4xl font-bold mb-4 leading-tight">
            {{ $blog->judul }}
        </h1>

        {{-- META --}}
        <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 mb-6">

            {{-- Avatar & Author --}}
            <div class="flex items-center gap-2">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($blog->author->name ?? 'Admin') }}&background=1E2F4D&color=fff"
                class="w-10 h-10 rounded-full">
            <div>
                <div class="font-semibold text-primary">
                    {{ $blog->author->name ?? 'Admin' }}
                </div>
                <div class="text-xs text-gray-500">
                    Penulis
                </div>
            </div>

            <span class="text-gray-400">•</span>

            {{-- Tanggal Terbit --}}
            <div class="flex items-center gap-1 text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>
                    {{ $blog->published_at ? $blog->published_at->format('d M Y') : $blog->created_at->format('d M Y') }}
                </span>
            </div>

            <span class="text-gray-400">•</span>

            {{-- Views --}}
            <div class="flex items-center gap-1 text-gray-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <span>{{ $blog->views }}</span>
            </div>

            {{-- Status --}}
            @if ($blog->status === 'published')
                <span class="ml-2 px-3 py-1 text-xs rounded-full bg-green-100 text-green-700 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M16.707 5.293a1 1 0 00-1.414 0L9 11.586 6.707 9.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l7-7a1 1 0 000-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                    Published
                </span>
            @else
                <span class="ml-2 px-3 py-1 text-xs rounded-full bg-red-100 text-red-700 flex items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11V5a1 1 0 10-2 0v2a1 1 0 002 0zm-1 4a1 1 0 100 2 1 1 0 000-2z"
                            clip-rule="evenodd" />
                    </svg>
                    Draft
                </span>
            @endif
        </div>

        
    </div>
    {{-- RINGKASAN --}}
    @if ($blog->ringkasan)
        <div class="mb-8 text-lg text-gray-600 italic border-l-4 border-orange-400 pl-4">
            {{ $blog->ringkasan }}
        </div>
    @endif

    {{-- ISI --}}
    <div class="prose max-w-none">
        {!! $blog->isi !!}
    </div>
@endsection
