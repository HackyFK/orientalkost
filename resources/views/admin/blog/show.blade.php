@extends('admin.layouts.app')

@section('page-title', 'Detail Blog')

@section('content')

    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-xs text-slate-400 mb-5">
        <a href="{{ route('admin.blog.index') }}" class="hover:text-blue-500 transition-colors">Data Blog</a>
        <i class="fa-solid fa-chevron-right text-[9px]"></i>
        <span class="text-slate-600 font-medium">Detail Blog</span>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        {{-- ═══════════════ LEFT — Konten (2/3) ═══════════════ --}}
        <div class="xl:col-span-2 space-y-5">

            {{-- Card: Isi Artikel --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                        <i class="fa-solid fa-newspaper text-blue-500 text-xs"></i>
                    </div>
                    <h2 class="font-bold text-slate-700 text-sm">Isi Artikel</h2>
                </div>

                <div class="p-5 space-y-4">

                    {{-- Judul --}}
                    <h1 class="text-xl font-bold text-slate-800 leading-snug">
                        {{ $blog->judul }}
                    </h1>

                    {{-- Meta --}}
                    <div class="flex flex-wrap items-center gap-2.5">

                        {{-- Author --}}
                        <div class="flex items-center gap-2">
                            <div class="w-7 h-7 rounded-full bg-gradient-to-br from-indigo-400 to-blue-500 flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                                {{ strtoupper(substr($blog->author->name ?? 'A', 0, 1)) }}
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-slate-700 leading-none">{{ $blog->author->name ?? 'Admin' }}</p>
                                <p class="text-[10px] text-slate-400 mt-0.5">Penulis</p>
                            </div>
                        </div>

                        <span class="text-slate-200">|</span>

                        {{-- Tanggal --}}
                        <div class="flex items-center gap-1.5 text-xs text-slate-500">
                            <i class="fa-regular fa-calendar text-blue-400"></i>
                            <span>{{ ($blog->published_at ?? $blog->created_at)->format('d M Y') }}</span>
                        </div>

                        <span class="text-slate-200">|</span>

                        {{-- Views --}}
                        <div class="flex items-center gap-1.5 text-xs text-slate-500">
                            <i class="fa-regular fa-eye text-green-400"></i>
                            <span>{{ number_format($blog->views) }} views</span>
                        </div>

                        <span class="text-slate-200">|</span>

                        {{-- Status --}}
                        @if ($blog->status === 'published')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-green-50 text-green-600 border border-green-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Published
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-amber-50 text-amber-600 border border-amber-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span> Draft
                            </span>
                        @endif

                    </div>

                    <hr class="border-slate-100">

                    {{-- Ringkasan --}}
                    @if ($blog->ringkasan)
                        <div class="flex gap-3 bg-orange-50 border border-orange-100 rounded-lg px-4 py-3.5">
                            <div class="w-1 rounded-full bg-orange-400 flex-shrink-0 self-stretch"></div>
                            <p class="text-sm text-slate-600 italic leading-relaxed">{{ $blog->ringkasan }}</p>
                        </div>
                    @endif

                    {{-- Isi --}}
                    <div class="prose prose-sm max-w-none text-slate-700">
                        {!! $blog->isi !!}
                    </div>

                </div>
            </div>

        </div>

        {{-- ═══════════════ RIGHT — Sidebar (1/3) ═══════════════ --}}
        <div class="space-y-5">

            {{-- Card: Gambar --}}
            @if ($blog->gambar)
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-purple-50 flex items-center justify-center">
                            <i class="fa-solid fa-image text-purple-500 text-xs"></i>
                        </div>
                        <h2 class="font-bold text-slate-700 text-sm">Gambar Utama</h2>
                    </div>
                    <div class="p-3">
                        <img src="{{ asset('storage/' . $blog->gambar) }}"
                             class="w-full h-48 object-cover rounded-lg border border-slate-100">
                    </div>
                </div>
            @endif

            {{-- Card: Informasi --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-amber-50 flex items-center justify-center">
                        <i class="fa-solid fa-circle-info text-amber-500 text-xs"></i>
                    </div>
                    <h2 class="font-bold text-slate-700 text-sm">Informasi</h2>
                </div>
                <div class="p-5 space-y-3">

                    <div class="flex items-center justify-between">
                        <span class="text-xs text-slate-400">Status</span>
                        @if ($blog->status === 'published')
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-green-50 text-green-600 border border-green-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Published
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-amber-50 text-amber-600 border border-amber-100">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span> Draft
                            </span>
                        @endif
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-xs text-slate-400">Penulis</span>
                        <span class="text-xs font-semibold text-slate-700">{{ $blog->author->name ?? 'Admin' }}</span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-xs text-slate-400">Tanggal Terbit</span>
                        <span class="text-xs font-semibold text-slate-700">
                            {{ ($blog->published_at ?? $blog->created_at)->format('d M Y') }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-xs text-slate-400">Views</span>
                        <span class="text-xs font-semibold text-slate-700">{{ number_format($blog->views) }}</span>
                    </div>

                </div>
            </div>

            {{-- Tombol Aksi --}}
            <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                    <div class="w-7 h-7 rounded-lg bg-slate-50 flex items-center justify-center">
                        <i class="fa-solid fa-gear text-slate-400 text-xs"></i>
                    </div>
                    <h2 class="font-bold text-slate-700 text-sm">Aksi</h2>
                </div>
                <div class="p-5 flex flex-col gap-2.5">
                    <a href="{{ route('admin.blog.edit', $blog) }}"
                       class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm shadow-blue-200">
                        <i class="fa-solid fa-pen text-xs"></i>
                        Edit Artikel
                    </a>
                    <a href="{{ route('admin.blog.index') }}"
                       class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-white hover:bg-slate-50 text-slate-600 text-sm font-semibold rounded-lg border border-slate-200 transition-colors">
                        <i class="fa-solid fa-arrow-left text-xs"></i>
                        Kembali
                    </a>
                </div>
            </div>

        </div>

    </div>

@endsection