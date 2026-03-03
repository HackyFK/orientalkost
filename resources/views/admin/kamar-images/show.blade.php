@extends('admin.layouts.app')

@section('content')

    <div class="max-w-6xl mx-auto space-y-6">

        {{-- HEADER --}}
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold text-slate-700">
                    Kelola Gambar Kamar
                </h1>
                <p class="text-sm text-slate-500">
                    {{ $kamar->nama_kamar }} — {{ $kamar->kos->nama_kos }}
                </p>
            </div>

            <a href="{{ route('admin.kamar-images.index') }}"
                class="px-4 py-2 text-sm bg-slate-100 hover:bg-slate-200 rounded-lg">
                ← Kembali
            </a>
        </div>

        @php
            $maxImages = 9;
            $currentImageCount = $kamar->images->count();
            $remainingSlot = $maxImages - $currentImageCount;
        @endphp

        {{-- UPLOAD AREA --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">

            <form action="{{ route('admin.kamar-images.store', $kamar) }}" method="POST" enctype="multipart/form-data"
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

                <p class="text-xs text-slate-400">
                    Maksimal 9 gambar per kamar.
                    Sisa slot: {{ $remainingSlot > 0 ? $remainingSlot : 0 }}
                </p>

                <button type="submit"
                    class="mt-4 px-5 py-2 bg-indigo-600 text-white rounded-lg text-sm hover:bg-indigo-700">
                    Upload Gambar
                </button>

            </form>

        </div>


        {{-- GALLERY --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">

            <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-purple-50 flex items-center justify-center">
                    <i class="fa-solid fa-images text-purple-500 text-xs"></i>
                </div>
                <h2 class="font-bold text-slate-700 text-sm">Foto Kamar</h2>
                <span class="ml-auto text-xs text-slate-400">
                    {{ $kamar->images->count() }} foto
                </span>
            </div>

            @if ($kamar->images->count() > 0)
                <div class="px-5 py-5">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-5">

                        @foreach ($kamar->images as $img)
                            <div
                                class="relative group border border-slate-200 rounded-xl overflow-hidden bg-white shadow-sm hover:shadow-md transition-shadow">

                                {{-- Ukuran BESAR seperti foto kos --}}
                                <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-40 object-cover">

                                {{-- Primary Badge --}}
                                @if ($img->is_primary)
                                    <span
                                        class="absolute top-3 left-3 text-[10px] font-semibold bg-green-500 text-white px-2 py-0.5 rounded-md shadow">
                                        Primary
                                    </span>
                                @endif

                                {{-- Overlay Hover --}}
                                <div
                                    class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center gap-3">

                                    @if (!$img->is_primary)
                                        <form method="POST"
                                            action="{{ route('admin.kamar-images.primary', [$kamar, $img]) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="w-9 h-9 flex items-center justify-center rounded-lg bg-green-500 hover:bg-green-600 text-white shadow">
                                                <i class="fa-solid fa-star text-xs"></i>
                                            </button>
                                        </form>
                                    @endif

                                    <form method="POST" action="{{ route('admin.kamar-images.destroy', [$kamar, $img]) }}"
                                        onsubmit="return confirm('Hapus gambar ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-500 hover:bg-red-600 text-white shadow">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>

                                </div>

                            </div>
                        @endforeach

                    </div>
                </div>
            @else
                <div class="px-5 py-8 text-center text-sm text-slate-400">
                    Belum ada gambar
                </div>
            @endif

        </div>

    </div>


    {{-- DRAG DROP SCRIPT --}}
    @php
        $currentImageCount = $kamar->images->count();
        $maxImages = 9;
        $remainingSlot = $maxImages - $currentImageCount;
    @endphp

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

            const currentCount = {{ $currentImageCount }};
            const maxImages = 9;
            const remaining = maxImages - currentCount;

            if (fileInput.files.length > remaining) {
                alert(`Sisa slot hanya ${remaining} gambar. Maksimal 9 gambar per kamar.`);
                fileInput.value = '';
                return;
            }

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
