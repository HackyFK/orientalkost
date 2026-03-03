@extends('admin.layouts.app')

@section('page-title', 'Kelola Gambar Kos')

@section('content')

    <div class="max-w-6xl mx-auto space-y-6">

        {{-- SUCCESS MESSAGE --}}
        @if (session('success'))
            <div
                class="flex items-center gap-3 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm font-medium">
                <i class="fa-solid fa-circle-check text-green-500"></i>
                {{ session('success') }}
            </div>
        @endif


        {{-- HEADER --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold text-slate-700">
                    Kelola Gambar Kos
                </h1>
                <p class="text-sm text-slate-500">
                    {{ $kos->nama_kos }} — Owner: {{ $kos->owner->name ?? '-' }}
                </p>
            </div>

            <a href="{{ route('admin.kos-images.index') }}"
                class="px-4 py-2 text-sm bg-slate-100 hover:bg-slate-200 rounded-lg">
                ← Kembali
            </a>
        </div>


        {{-- UPLOAD AREA --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">

            <form action="{{ route('admin.kos-images.store', $kos) }}" method="POST" enctype="multipart/form-data"
                id="uploadForm">

                @csrf

                <div id="drop-area"
                    class="border-2 border-dashed border-slate-300 rounded-xl p-8 text-center cursor-pointer hover:border-indigo-400 transition">

                    <input type="file" name="images[]" id="fileInput" multiple class="hidden">

                    <div class="space-y-2">
                        <div class="text-indigo-500 text-3xl">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                        </div>
                        <p class="text-sm text-slate-600">
                            Drag & Drop gambar di sini
                        </p>
                        <p class="text-xs text-slate-400">
                            atau klik untuk pilih file (max 2MB)
                        </p>
                    </div>
                </div>

                <div id="preview" class="grid grid-cols-4 gap-3 mt-4"></div>

                <button type="submit"
                    class="mt-4 px-5 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700">
                    Upload Gambar
                </button>

            </form>

        </div>


        {{-- GALLERY --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">

            {{-- HEADER FOTO --}}
            <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-purple-50 flex items-center justify-center">
                    <i class="fa-solid fa-images text-purple-500 text-xs"></i>
                </div>
                <h2 class="font-bold text-slate-700 text-sm">Foto Kos</h2>

                <span class="ml-auto text-xs text-slate-400">
                    {{ $kos->images->count() }} foto
                </span>
            </div>

            @if ($kos->images->isEmpty())

                <div class="py-16 text-center text-slate-300">
                    <i class="fa-solid fa-image text-4xl mb-3"></i>
                    <p class="text-sm font-medium text-slate-400">
                        Belum ada gambar
                    </p>
                </div>
            @else
                <div class="px-5 py-5">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-5">

                        @foreach ($kos->images as $img)
                            <div
                                class="relative group border border-slate-200 rounded-xl overflow-hidden bg-white shadow-sm hover:shadow-md transition-shadow">

                                {{-- Ukuran tetap --}}
                                <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-40 object-cover">

                                {{-- Primary Badge --}}
                                @if ($img->is_primary)
                                    <span
                                        class="absolute top-3 left-3 text-[10px] font-semibold bg-green-500 text-white px-2 py-0.5 rounded-md shadow">
                                        Primary
                                    </span>
                                @endif

                                {{-- Action Buttons --}}
                                <div
                                    class="absolute top-3 right-3 flex gap-2 opacity-0 group-hover:opacity-100 transition-opacity">

                                    @if (!$img->is_primary)
                                        <form method="POST" action="{{ route('admin.kos-images.primary', [$kos, $img]) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button
                                                class="w-8 h-8 flex items-center justify-center bg-blue-500 hover:bg-blue-600 text-white rounded-lg text-xs shadow">
                                                <i class="fa-solid fa-star text-[10px]"></i>
                                            </button>
                                        </form>
                                    @endif

                                    <form method="POST" action="{{ route('admin.kos-images.destroy', [$kos, $img]) }}"
                                        onsubmit="return confirm('Hapus gambar ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="w-8 h-8 flex items-center justify-center bg-red-500 hover:bg-red-600 text-white rounded-lg text-xs shadow">
                                            <i class="fa-solid fa-trash text-[10px]"></i>
                                        </button>
                                    </form>

                                </div>

                            </div>
                        @endforeach

                    </div>
                </div>

            @endif

        </div>

    </div>


    {{-- DRAG DROP SCRIPT --}}
    <script>
        const dropArea = document.getElementById('drop-area');
        const fileInput = document.getElementById('fileInput');
        const preview = document.getElementById('preview');

        dropArea.addEventListener('click', () => fileInput.click());

        dropArea.addEventListener('dragover', e => {
            e.preventDefault();
            dropArea.classList.add('border-indigo-500');
        });

        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('border-indigo-500');
        });

        dropArea.addEventListener('drop', e => {
            e.preventDefault();
            dropArea.classList.remove('border-indigo-500');
            fileInput.files = e.dataTransfer.files;
            showPreview();
        });

        fileInput.addEventListener('change', showPreview);

        function showPreview() {
            preview.innerHTML = '';

            [...fileInput.files].forEach(file => {
                const reader = new FileReader();
                reader.onload = e => {
                    preview.innerHTML += `
                <div class="rounded-lg border bg-slate-50 flex items-center justify-center p-2">
                    <img src="${e.target.result}"
                         class="max-h-40 w-auto object-contain">
                </div>
            `;
                };
                reader.readAsDataURL(file);
            });
        }
    </script>

@endsection
