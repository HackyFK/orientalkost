@extends('admin.layouts.app')

@section('page-title', 'Tambah Fasilitas')

@section('content')

    {{-- BREADCRUMB --}}
    <div class="flex items-center gap-2 text-xs text-slate-400 mb-5">
        <a href="{{ route('admin.fasilitas.index') }}" class="hover:text-blue-500 transition-colors">Fasilitas</a>
        <i class="fa-solid fa-chevron-right text-[9px]"></i>
        <span class="text-slate-600 font-medium">Tambah Fasilitas</span>
    </div>

    {{-- VALIDATION ERRORS --}}
    @if ($errors->any())
        <div class="mb-5 p-4 bg-red-50 border border-red-200 rounded-lg">
            <div class="flex items-center gap-2 mb-2">
                <i class="fa-solid fa-circle-exclamation text-red-500 text-sm"></i>
                <p class="text-sm font-semibold text-red-600">Terdapat kesalahan input:</p>
            </div>
            <ul class="list-disc pl-5 space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li class="text-xs text-red-500">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.fasilitas.store') }}">
        @csrf

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- ═══════════════ LEFT — Form ═══════════════ --}}
            <div class="xl:col-span-2 space-y-5">

                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-indigo-50 flex items-center justify-center">
                            <i class="fa-solid fa-couch text-indigo-500 text-xs"></i>
                        </div>
                        <h2 class="font-bold text-slate-700 text-sm">Detail Fasilitas</h2>
                    </div>

                    <div class="p-5 space-y-4">

                        {{-- Nama Fasilitas --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
                                Nama Fasilitas
                            </label>
                            <input type="text" name="nama_fasilitas" value="{{ old('nama_fasilitas') }}"
                                placeholder="Contoh: AC, WiFi, Kamar Mandi Dalam..."
                                oninput="updateCardName(this.value)"
                                required
                                class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                        </div>

                        {{-- Kategori --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
                                Kategori
                            </label>
                            <select name="kategori" required
                                class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategoriList as $key => $label)
                                    <option value="{{ $key }}" @selected(old('kategori') == $key)>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Icon --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
                                Icon
                            </label>
                            <div class="flex gap-3 items-center">
                                <input type="text" id="iconInput" name="icon" value="{{ old('icon') }}"
                                    placeholder="Contoh: tv, wifi, bed, shower..."
                                    oninput="updatePreview(this.value)"
                                    class="flex-1 border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition font-mono">
                                {{-- Preview box --}}
                                <div class="w-11 h-11 rounded-xl border border-slate-200 bg-slate-50 flex items-center justify-center flex-shrink-0 shadow-sm transition-all">
                                    <i id="previewIcon" class="fa-solid fa-question text-slate-300 text-base"></i>
                                </div>
                            </div>
                            <p class="text-[11px] text-slate-400 mt-1.5">
                                <i class="fa-solid fa-circle-info mr-1"></i>
                                Cukup ketik nama ikon saja, contoh:
                                <code class="bg-slate-100 px-1 rounded text-slate-500">tv</code>,
                                <code class="bg-slate-100 px-1 rounded text-slate-500">wifi</code>,
                                <code class="bg-slate-100 px-1 rounded text-slate-500">bed</code> — atau salin class lengkap dari
                                <a href="https://fontawesome.com/icons" target="_blank" class="text-blue-500 hover:underline">fontawesome.com</a>
                            </p>
                        </div>

                    </div>
                </div>

            </div>

            {{-- ═══════════════ RIGHT — Preview + Actions ═══════════════ --}}
            <div class="space-y-5">

                {{-- Live Preview Card --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                            <i class="fa-solid fa-eye text-blue-500 text-xs"></i>
                        </div>
                        <h2 class="font-bold text-slate-700 text-sm">Preview</h2>
                    </div>
                    <div class="p-5">
                        <p class="text-xs text-slate-400 mb-3">Tampilan di halaman fasilitas:</p>
                        <div class="flex items-center gap-3 px-4 py-3 rounded-xl border border-slate-100 bg-slate-50">
                            <div class="w-9 h-9 rounded-xl flex items-center justify-center bg-white border border-slate-200 shadow-sm flex-shrink-0">
                                <i id="cardIcon" class="fa-solid fa-question text-slate-300 text-sm"></i>
                            </div>
                            <div class="min-w-0">
                                <p id="cardName" class="text-sm font-semibold text-slate-700 truncate">Nama Fasilitas</p>
                                <p id="cardClass" class="text-[10px] text-slate-400 font-mono truncate">fa-solid fa-...</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex gap-3">
                    <a href="{{ route('admin.fasilitas.index') }}"
                       class="flex-1 text-center px-4 py-2.5 border border-slate-200 text-slate-600 hover:bg-slate-100 text-sm font-semibold rounded-lg transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="flex-1 inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm shadow-blue-200">
                        <i class="fa-solid fa-floppy-disk text-xs"></i>
                        Simpan
                    </button>
                </div>

            </div>
        </div>
    </form>

    <script>
        // Normalisasi: user bisa ketik "wifi", "fa-wifi", atau "fa-solid fa-wifi"
        function normalizeIcon(val) {
            if (!val.trim()) return '';
            val = val.trim();
            // Sudah class lengkap
            if (val.startsWith('fa-solid ') || val.startsWith('fa-regular ') || val.startsWith('fa-brands ')) {
                return val;
            }
            // Misal "fa-wifi" → "fa-solid fa-wifi"
            if (val.startsWith('fa-')) {
                return 'fa-solid ' + val;
            }
            // Misal "wifi" → "fa-solid fa-wifi"
            return 'fa-solid fa-' + val;
        }

        function updatePreview(raw) {
            const normalized = normalizeIcon(raw);
            const fallback = 'fa-solid fa-question';

            document.getElementById('previewIcon').className = (normalized || fallback) + ' text-slate-400 text-base';
            document.getElementById('cardIcon').className   = (normalized || fallback) + (normalized ? ' text-slate-500' : ' text-slate-300') + ' text-sm';
            document.getElementById('cardClass').textContent = normalized || 'fa-solid fa-...';
        }

        function updateCardName(val) {
            document.getElementById('cardName').textContent = val.trim() || 'Nama Fasilitas';
        }

        // Init dari old() jika ada
        window.addEventListener('DOMContentLoaded', () => {
            const val = document.getElementById('iconInput').value;
            if (val) updatePreview(val);
        });
    </script>

@endsection