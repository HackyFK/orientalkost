@extends('user.layouts.app')

@section('content')


<div class="max-w-4xl mx-auto px-4 py-12">

    {{-- BACK BUTTON --}}
    <a href="{{ route('user.blog') }}" 
       class="inline-flex items-center text-sm text-accent hover:underline mb-6">
        ← Kembali ke Blog
    </a>

    {{-- HERO IMAGE --}}
    <div class="rounded-3xl overflow-hidden shadow-xl mb-8">
        <img src="{{ $blog->gambar 
            ? asset('storage/' . $blog->gambar) 
            : 'https://images.unsplash.com/photo-1556912173-3bb406ef7e77?w=1200&h=600&fit=crop' }}"
            class="w-full h-[400px] object-cover">
    </div>

    {{-- TITLE --}}
    <h1 class="text-4xl font-bold text-primary leading-tight mb-6">
        {{ $blog->judul }}
    </h1>

    @php
        $wordCount = str_word_count(strip_tags($blog->isi));
        $readingTime = ceil($wordCount / 200);
    @endphp

    {{-- META INFO --}}
    <div class="flex flex-wrap items-center gap-6 text-sm text-textGray border-b pb-6 mb-8">

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
        </div>

        <div class="flex items-center gap-1">
            <i class="fas fa-calendar-alt text-accent"></i>
            {{ $blog->published_at?->translatedFormat('d F Y') }}
        </div>

        <div class="flex items-center gap-1">
            <i class="fas fa-clock"></i>
            {{ $readingTime }} menit baca
        </div>

        <div class="flex items-center gap-1">
            <i class="fas fa-eye"></i>
            {{ $blog->views ?? 0 }} views
        </div>

    </div>

    {{-- RINGKASAN --}}
    @if($blog->ringkasan)
        <div class="bg-accent/5 border-l-4 border-accent p-6 rounded-xl mb-8 italic text-gray-700">
            {{ $blog->ringkasan }}
        </div>
    @endif

    {{-- CONTENT --}}
    <div class="prose max-w-none prose-lg">
        {!! $blog->isi !!}
    </div>
</div>

@endsection