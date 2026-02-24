@extends('admin.layouts.app')

@section('page-title', 'Edit Fasilitas')

@section('content')

    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-xs text-slate-400 mb-5">
        <a href="{{ route('admin.fasilitas.index') }}" class="hover:text-blue-500 transition-colors">Data Fasilitas</a>
        <i class="fa-solid fa-chevron-right text-[9px]"></i>
        <span class="text-slate-600 font-medium">Edit Fasilitas</span>
    </div>

    <form action="{{ route('admin.fasilitas.update', $fasilita) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            {{-- ═══════════════ LEFT — Main Form ═══════════════ --}}
            <div class="xl:col-span-2 space-y-5">

                {{-- Card: Informasi Fasilitas --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-indigo-50 flex items-center justify-center">
                            <i class="fa-solid fa-couch text-indigo-500 text-xs"></i>
                        </div>
                        <h2 class="font-bold text-slate-700 text-sm">Informasi Fasilitas</h2>
                    </div>

                    <div class="p-5 space-y-4">

                        {{-- Nama Fasilitas --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Nama Fasilitas</label>
                            <input type="text" name="nama_fasilitas"
                                value="{{ old('nama_fasilitas', $fasilita->nama_fasilitas) }}"
                                placeholder="Contoh: AC, WiFi, Kasur"
                                class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition"
                                required>
                            @error('nama_fasilitas')
                                <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Kategori --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Kategori</label>
                            <select name="kategori"
                                class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition"
                                required>
                                @foreach ($kategoriList as $key => $label)
                                    <option value="{{ $key }}" {{ $fasilita->kategori == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori')
                                <p class="text-xs text-red-500 mt-1.5 flex items-center gap-1">
                                    <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>
                </div>

            </div>

            {{-- ═══════════════ RIGHT — Sidebar ═══════════════ --}}
            <div class="space-y-5">

                {{-- Card: Preview Icon --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                            <i class="fa-solid fa-icons text-blue-500 text-xs"></i>
                        </div>
                        <h2 class="font-bold text-slate-700 text-sm">Icon FontAwesome</h2>
                    </div>
                    <div class="p-5 space-y-4">

                        {{-- Input Icon --}}
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
                                Nama Icon <span class="normal-case font-normal text-slate-400">(tanpa prefix)</span>
                            </label>
                            <input type="text" id="iconInput" name="icon"
                                value="{{ old('icon', str_replace('fa-solid fa-', '', $fasilita->icon)) }}"
                                placeholder="Contoh: tv, wifi, bed"
                                class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                            <p class="text-[11px] text-slate-400 mt-1.5">
                                <i class="fa-solid fa-circle-info mr-0.5"></i>
                                Cukup ketik nama ikon, misal: <span class="font-semibold">tv</span>, <span class="font-semibold">wifi</span>, <span class="font-semibold">shower</span>.
                            </p>
                        </div>

                        {{-- Preview Box --}}
                        <div class="flex flex-col items-center justify-center gap-3 bg-slate-50 border border-slate-200 rounded-xl py-6">
                            <div id="iconPreviewWrap"
                                class="w-12 h-12 rounded-xl bg-indigo-50 border border-indigo-100 flex items-center justify-center">
                                <i id="iconPreview"
                                   class="{{ $fasilita->icon ?? '' }} text-indigo-500 text-xl"></i>
                            </div>
                            <p id="iconPreviewLabel" class="text-xs text-slate-400 font-medium">
                                {{ str_replace('fa-solid fa-', '', $fasilita->icon) ?: 'Belum ada icon' }}
                            </p>
                        </div>

                    </div>
                </div>

                {{-- Card: Aksi --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-amber-50 flex items-center justify-center">
                            <i class="fa-solid fa-gear text-amber-500 text-xs"></i>
                        </div>
                        <h2 class="font-bold text-slate-700 text-sm">Aksi</h2>
                    </div>
                    <div class="p-5 flex flex-col gap-2.5">
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm shadow-blue-200">
                            <i class="fa-solid fa-floppy-disk text-xs"></i>
                            Simpan Perubahan
                        </button>
                        <a href="{{ route('admin.fasilitas.index') }}"
                            class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-white hover:bg-slate-50 text-slate-600 text-sm font-semibold rounded-lg border border-slate-200 transition-colors">
                           
                            Batal
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </form>

@push('scripts')
<script>
    const iconInput   = document.getElementById('iconInput')
    const iconEl      = document.getElementById('iconPreview')
    const iconLabel   = document.getElementById('iconPreviewLabel')

    iconInput.addEventListener('input', function () {
        const raw = this.value.trim().replace('fa-solid', '').replace(/fa-/g, '').trim()

        if (!raw) {
            iconEl.className = ''
            iconLabel.textContent = 'Belum ada icon'
            return
        }

        iconEl.className = `fa-solid fa-${raw} text-indigo-500 text-xl`
        iconLabel.textContent = raw
    })
</script>
@endpush

@endsection