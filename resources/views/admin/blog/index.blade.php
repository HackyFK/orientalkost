@extends('admin.layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Blog</h1>

        <a href="{{ route('admin.blog.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            + Tambah Blog
        </a>
    </div>

    {{-- Search --}}
    <form method="GET" class="mb-4">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul blog..."
            class="border rounded px-3 py-2 w-64 focus:ring focus:ring-blue-200">
    </form>

    <div class="bg-white shadow rounded overflow-hidden">
        <div x-data="publishHandler()" x-cloak>

            <div class="bg-white shadow rounded overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-100 text-sm">
                        <tr>
                            <th class="p-3">No</th>
                            <th class="p-3">Gambar</th>
                            <th class="p-3">Judul</th>
                            <th class="p-3">Slug</th>
                            <th class="p-3">Terbit</th>
                            <th class="p-3 text-center">Views</th>
                            <th class="p-3 text-center">Like</th>
                            <th class="p-3 text-center">Status</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($blogs as $blog)
                            <tr class="border-t hover:bg-gray-50">

                                <td class="p-3 text-center">
                                    {{ $blogs->firstItem() + $loop->index }}
                                </td>

                                <td class="p-3">
                                    @if ($blog->gambar)
                                        <img src="{{ asset('storage/' . $blog->gambar) }}"
                                            class="w-20 h-14 object-cover rounded">
                                    @endif
                                </td>

                                <td class="p-3 font-semibold">
                                    {{ $blog->judul }}
                                </td>

                                <td class="p-3 text-sm text-gray-500">
                                    {{ $blog->slug }}
                                </td>

                                <td class="p-3 text-sm">
                                    {{ $blog->published_at?->format('d M Y') ?? '-' }}
                                </td>

                                <td class="p-3 text-center">
                                    {{ $blog->views }}
                                </td>

                                <td class="p-3 text-center">
                                    -
                                </td>

                                {{-- STATUS --}}
                                <td class="p-3 text-center">
                                    @if ($blog->status === 'published')
                                        <button @click="openModal({{ $blog->id }}, 'unpublish')"
                                            class="px-3 py-1 text-sm rounded-full
                                           bg-green-100 text-green-700 cursor-pointer">
                                            Published
                                        </button>
                                    @else
                                        <button @click="openModal({{ $blog->id }}, 'publish')"
                                            class="px-3 py-1 text-sm rounded-full
                                           bg-red-100 text-red-700 cursor-pointer">
                                            Draft
                                        </button>
                                    @endif
                                </td>

                                {{-- AKSI --}}
                                <td class="p-3 text-center space-x-3">

                                    {{-- DETAIL --}}
                                    <a href="{{ route('admin.blog.show', $blog) }}"
                                        class="text-blue-600 hover:text-blue-800" title="Detail">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>

                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.blog.edit', $blog) }}"
                                        class="text-yellow-500 hover:text-yellow-700" title="Edit">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    {{-- HAPUS --}}
                                    <form action="{{ route('admin.blog.destroy', $blog) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus blog ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="text-red-600 hover:text-red-800" title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- MODAL (SATU KALI SAJA) --}}
            <div x-show="open" x-transition class="fixed inset-0 z-50 flex items-center justify-center">

                <div class="absolute inset-0 bg-black/50" @click="closeModal"></div>

                <div class="relative bg-white rounded-lg p-6 w-96 shadow-xl z-10">
                    <h2 class="text-lg font-bold mb-3"
                        x-text="mode === 'publish'
                ? 'Publish Blog'
                : 'Unpublish Blog'">
                    </h2>

                    <p class="text-gray-600 mb-5">
                        Apakah kamu yakin?
                    </p>

                    <div class="flex justify-end gap-3">
                        <button @click="closeModal" class="px-4 py-2 border rounded">
                            Batal
                        </button>

                        <button @click="submit" class="px-4 py-2 text-white rounded"
                            :class="mode === 'publish'
                                ?
                                'bg-green-600' :
                                'bg-red-600'">
                            <span
                                x-text="mode === 'publish'
                        ? 'Publish Now'
                        : 'Unpublish'"></span>
                        </button>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="mt-4">
        {{ $blogs->withQueryString()->links() }}
    </div>
    <div class="mt-4 text-sm text-gray-500">
    Menampilkan
    <span class="px-2 py-1 bg-gray-100 rounded font-medium">
        {{ $blogs->firstItem() }} – {{ $blogs->lastItem() }}
    </span>
    dari
    <span class="font-semibold">{{ $blogs->total() }}</span>
    data
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
                                'X-CSRF-TOKEN': document
                                    .querySelector('meta[name=csrf-token]')
                                    .content,
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
