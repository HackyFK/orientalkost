@extends('admin.layouts.app')

@section('page-title', 'Blog')

@section('content')
{{-- SUCCESS MESSAGE --}}
    @if (session('success'))
        <div
            class="mb-5 flex items-center gap-3 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm font-medium">
            <i class="fa-solid fa-circle-check text-green-500"></i>
            {{ session('success') }}
        </div>
    @endif
    
    {{-- PAGE HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-bold text-slate-800">Blog</h1>
            <p class="text-sm text-slate-400 mt-0.5">Kelola artikel dan konten blog</p>
        </div>
        <a href="{{ route('admin.blog.create') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm shadow-blue-200">
            <i class="fa-solid fa-plus text-xs"></i>
            Tambah Blog
        </a>
    </div>

    {{-- TABLE CARD --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden" x-data="publishHandler()" x-cloak>

        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 px-5 py-3.5 border-b border-slate-100">

    {{-- LEFT --}}
    <span class="text-sm font-semibold text-slate-600">
        Semua Artikel
        <span class="ml-2 text-xs font-bold bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full">
            {{ $blogs->total() }}
        </span>
    </span>

    {{-- RIGHT: Search + Sort --}}
    <form method="GET" class="flex items-center gap-2">

        {{-- SORT STATUS --}}
        <select name="status"
            onchange="this.form.submit()"
            class="text-sm border border-slate-200 rounded-lg px-3 py-2 bg-white text-slate-600
                   focus:outline-none focus:ring-2 focus:ring-blue-400 transition">

            <option value="">Semua Status</option>

            <option value="published"
                {{ request('status') == 'published' ? 'selected' : '' }}>
                Published
            </option>

            <option value="draft"
                {{ request('status') == 'draft' ? 'selected' : '' }}>
                Draft
            </option>

        </select>


        {{-- SEARCH --}}
        <div class="relative">

            {{-- icon --}}
            <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>

            <input type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari judul blog..."
                class="pl-9 pr-9 py-2 text-sm border border-slate-200 rounded-lg
                       bg-white text-slate-600
                       focus:outline-none focus:ring-2 focus:ring-blue-400
                       w-56 transition">

            {{-- clear --}}
            @if(request('search') || request('status'))
                <a href="{{ route('admin.blog.index') }}"
                   class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-red-500">
                    <i class="fa-solid fa-xmark text-xs"></i>
                </a>
            @endif

        </div>

    </form>

</div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">
                        <th class="px-4 py-3 w-10">#</th>
                        <th class="px-4 py-3">Artikel</th>
                        <th class="px-4 py-3">Terbit</th>
                        <th class="px-4 py-3 text-center">Views</th>
                        <th class="px-4 py-3 text-center">Like</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @foreach ($blogs as $blog)
                        <tr class="hover:bg-slate-50/60 transition-colors">

                            {{-- No --}}
                            <td class="px-4 py-3.5 text-xs text-slate-400 font-medium">
                                {{ $blogs->firstItem() + $loop->index }}
                            </td>

                            {{-- Artikel (gambar + judul + slug) --}}
                            <td class="px-4 py-3.5">
                                <div class="flex items-center gap-3">
                                    @if ($blog->gambar)
                                        <img src="{{ asset('storage/' . $blog->gambar) }}"
                                            class="w-20 h-14 object-cover rounded-lg border border-slate-100 shadow-sm flex-shrink-0">
                                    @else
                                        <div class="w-20 h-14 rounded-lg bg-slate-100 flex items-center justify-center flex-shrink-0">
                                            <i class="fa-regular fa-image text-slate-300 text-lg"></i>
                                        </div>
                                    @endif
                                    <div class="min-w-0">
                                        <p class="font-semibold text-slate-800 leading-snug line-clamp-2">{{ $blog->judul }}</p>
                                        <p class="text-xs text-slate-400 mt-0.5 truncate max-w-[200px]">{{ $blog->slug }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Terbit --}}
                            <td class="px-4 py-3.5 text-slate-500 whitespace-nowrap">
                                @if ($blog->published_at)
                                    <div class="flex items-center gap-1.5 text-xs">
                                        <i class="fa-regular fa-calendar text-slate-300"></i>
                                        {{ $blog->published_at->format('d M Y') }}
                                    </div>
                                @else
                                    <span class="text-xs text-slate-300">—</span>
                                @endif
                            </td>

                            {{-- Views --}}
                            <td class="px-4 py-3.5 text-center">
                                <div class="inline-flex items-center gap-1 text-xs text-slate-500 font-medium">
                                    <i class="fa-solid fa-eye text-slate-300 text-[10px]"></i>
                                    {{ number_format($blog->views) }}
                                </div>
                            </td>

                            {{-- Like --}}
                            <td class="px-4 py-3.5 text-center">
                                <div class="inline-flex items-center gap-1 text-xs text-slate-500 font-medium">
                                    <i class="fa-solid fa-heart text-red-300 text-[10px]"></i>
                                    {{ number_format($blog->likes) }}
                                </div>
                            </td>

                            {{-- Status --}}
                            <td class="px-4 py-3.5 text-center">
                                @if ($blog->status === 'published')
                                    <button @click="openModal({{ $blog->id }}, 'unpublish')"
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-green-50 text-green-600 border border-green-100 hover:bg-green-100 transition-colors">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                        Published
                                    </button>
                                @else
                                    <button @click="openModal({{ $blog->id }}, 'publish')"
                                        class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-semibold bg-slate-100 text-slate-500 border border-slate-200 hover:bg-slate-200 transition-colors">
                                        <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                        Draft
                                    </button>
                                @endif
                            </td>

                            {{-- Aksi --}}
                            <td class="px-4 py-3.5">
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="{{ route('admin.blog.show', $blog) }}"
                                        title="Detail"
                                        class="w-7 h-7 flex items-center justify-center rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-500 transition-colors border border-blue-100">
                                        <i class="fa-solid fa-eye text-[11px]"></i>
                                    </a>
                                    <a href="{{ route('admin.blog.edit', $blog) }}"
                                        title="Edit"
                                        class="w-7 h-7 flex items-center justify-center rounded-lg bg-amber-50 hover:bg-amber-100 text-amber-500 transition-colors border border-amber-100">
                                        <i class="fa-solid fa-pen text-[11px]"></i>
                                    </a>
                                    <form action="{{ route('admin.blog.destroy', $blog) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus blog ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus"
                                            class="w-7 h-7 flex items-center justify-center rounded-lg bg-red-50 hover:bg-red-100 text-red-500 transition-colors border border-red-100">
                                            <i class="fa-solid fa-trash text-[11px]"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
         
        @if ($blogs->hasPages())
            <div class="px-5 py-4 border-t border-slate-100">
                {{ $blogs->links() }}
            </div>
        @endif

        {{-- ═══════════ MODAL ═══════════ --}}
        <div x-show="open" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center">
            <div class="absolute inset-0 bg-black/40 backdrop-blur-sm" @click="closeModal"></div>

            <div x-transition.scale class="relative bg-white rounded-2xl shadow-2xl w-full max-w-sm mx-4 z-10 overflow-hidden">
                {{-- Modal header --}}
                <div class="px-6 pt-6 pb-4">
                    <div class="flex items-center gap-3 mb-1">
                        <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0"
                             :class="mode === 'publish' ? 'bg-green-100' : 'bg-red-50'">
                            <i class="fa-solid text-sm"
                               :class="mode === 'publish' ? 'fa-globe text-green-600' : 'fa-eye-slash text-red-500'"></i>
                        </div>
                        <h2 class="text-base font-bold text-slate-800"
                            x-text="mode === 'publish' ? 'Publish Artikel?' : 'Unpublish Artikel?'"></h2>
                    </div>
                    <p class="text-sm text-slate-400 ml-12">
                        Perubahan status akan langsung diterapkan.
                    </p>
                </div>

                <div class="px-6 pb-6 flex gap-3">
                    <button @click="closeModal"
                        class="flex-1 px-4 py-2.5 border border-slate-200 text-slate-600 hover:bg-slate-50 text-sm font-semibold rounded-lg transition-colors">
                        Batal
                    </button>
                    <button @click="submit"
                        class="flex-1 px-4 py-2.5 text-white text-sm font-semibold rounded-lg transition-colors"
                        :class="mode === 'publish' ? 'bg-green-600 hover:bg-green-700' : 'bg-red-500 hover:bg-red-600'">
                        <span x-text="mode === 'publish' ? 'Publish Sekarang' : 'Unpublish'"></span>
                    </button>
                </div>
            </div>
        </div>

    </div>

    <script>
        function publishHandler() {
            return {
                open: false,
                blogId: null,
                mode: 'publish',

                openModal(id, mode) {
                    this.blogId = id
                    this.mode = mode
                    this.open = true
                },

                closeModal() {
                    this.open = false
                    this.blogId = null
                },

                submit() {
                    fetch(`/admin/blog/${this.blogId}/${this.mode}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                            'Accept': 'application/json',
                        }
                    })
                    .then(res => res.json())
                    .then(() => window.location.reload())
                }
            }
        }
    </script>

@endsection