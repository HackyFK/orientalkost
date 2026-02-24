@extends('admin.layouts.app')

@section('page-title', 'Pengaturan')

@section('content')

    {{-- SUCCESS MESSAGE --}}
    @if (session('success'))
        <div class="mb-5 flex items-center gap-3 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm font-medium">
            <i class="fa-solid fa-circle-check text-green-500"></i>
            {{ session('success') }}
        </div>
    @endif

    @php
        $groupLabels = config('settings.groups');
        $fieldLabels = config('settings.labels');

        
        $groupIcons = [
            'general'  => ['icon' => 'fa-globe',          'color' => 'blue'],
            'contact'  => ['icon' => 'fa-phone',          'color' => 'green'],
            'social'   => ['icon' => 'fa-share-nodes',    'color' => 'indigo'],
            'seo'      => ['icon' => 'fa-magnifying-glass','color' => 'amber'],
            'payment'  => ['icon' => 'fa-credit-card',    'color' => 'purple'],
            'email'    => ['icon' => 'fa-envelope',       'color' => 'red'],
        ];

        $colorMap = [
            'blue'   => ['bg' => 'bg-blue-50',   'icon' => 'text-blue-500',   'ring' => 'focus:ring-blue-400'],
            'green'  => ['bg' => 'bg-green-50',  'icon' => 'text-green-500',  'ring' => 'focus:ring-blue-400'],
            'indigo' => ['bg' => 'bg-indigo-50', 'icon' => 'text-indigo-500', 'ring' => 'focus:ring-blue-400'],
            'amber'  => ['bg' => 'bg-amber-50',  'icon' => 'text-amber-500',  'ring' => 'focus:ring-blue-400'],
            'purple' => ['bg' => 'bg-purple-50', 'icon' => 'text-purple-500', 'ring' => 'focus:ring-blue-400'],
            'red'    => ['bg' => 'bg-red-50',    'icon' => 'text-red-500',    'ring' => 'focus:ring-blue-400'],
        ];
    @endphp

    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-5 items-start">

            {{-- ═══════════════ LEFT: Setting Groups ═══════════════ --}}
            <div class="xl:col-span-2 space-y-5">

                {{-- PAGE HEADER --}}
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-xl font-bold text-slate-800">Pengaturan Website</h1>
                        <p class="text-sm text-slate-400 mt-0.5">Konfigurasi umum dan tampilan website</p>
                    </div>
                </div>

                @foreach ($settings as $group => $items)
                    @php
                        $meta  = $groupIcons[$group] ?? ['icon' => 'fa-gear', 'color' => 'blue'];
                        $color = $colorMap[$meta['color']] ?? $colorMap['blue'];
                    @endphp

                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">

                        {{-- Card Header --}}
                        <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                            <div class="w-7 h-7 rounded-lg {{ $color['bg'] }} flex items-center justify-center">
                                <i class="fa-solid {{ $meta['icon'] }} {{ $color['icon'] }} text-xs"></i>
                            </div>
                            <h2 class="font-bold text-slate-700 text-sm">
                                {{ $groupLabels[$group] ?? ucfirst($group) }}
                            </h2>
                            <span class="ml-auto text-xs font-bold bg-slate-100 text-slate-400 px-2 py-0.5 rounded-full">
                                {{ count($items) }} field
                            </span>
                        </div>

                        {{-- Fields --}}
                        <div class="p-5 grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($items as $item)
                                <div>
                                    <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">
                                        {{ $fieldLabels[$item->key] ?? ucfirst(str_replace('_', ' ', $item->key)) }}
                                    </label>
                                    <input type="text"
                                           name="settings[{{ $item->key }}]"
                                           value="{{ $item->value }}"
                                           placeholder="{{ $fieldLabels[$item->key] ?? $item->key }}"
                                           class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent transition">
                                </div>
                            @endforeach
                        </div>

                    </div>
                @endforeach

            </div>

            {{-- ═══════════════ RIGHT: Sticky Actions ═══════════════ --}}
            <div class="xl:sticky xl:top-20 space-y-4">

                {{-- Save Card --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                            <i class="fa-solid fa-floppy-disk text-blue-500 text-xs"></i>
                        </div>
                        <h2 class="font-bold text-slate-700 text-sm">Simpan Perubahan</h2>
                    </div>
                    <div class="p-5 space-y-3">
                        <p class="text-xs text-slate-400 leading-relaxed">
                            Pastikan semua pengaturan sudah benar sebelum menyimpan. Perubahan akan langsung diterapkan.
                        </p>
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm shadow-blue-200">
                            <i class="fa-solid fa-floppy-disk text-xs"></i>
                            Simpan Pengaturan
                        </button>
                    </div>
                </div>

                {{-- Info Card --}}
                <div class="bg-slate-50 rounded-xl border border-slate-200 overflow-hidden">
                    <div class="px-5 py-4 space-y-3">
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wider">Ringkasan</p>
                        @foreach ($settings as $group => $items)
                            @php
                                $meta  = $groupIcons[$group] ?? ['icon' => 'fa-gear', 'color' => 'blue'];
                                $color = $colorMap[$meta['color']] ?? $colorMap['blue'];
                            @endphp
                            <div class="flex items-center justify-between text-xs">
                                <div class="flex items-center gap-2 text-slate-500">
                                    <i class="fa-solid {{ $meta['icon'] }} {{ $color['icon'] }} text-[10px] w-3 text-center"></i>
                                    {{ $groupLabels[$group] ?? ucfirst($group) }}
                                </div>
                                <span class="font-semibold text-slate-600">{{ count($items) }} field</span>
                            </div>
                        @endforeach

                        <div class="pt-2 border-t border-slate-200 flex items-center justify-between text-xs">
                            <span class="text-slate-400 font-medium">Total</span>
                            <span class="font-bold text-slate-700">
                                {{ $settings->flatten()->count() }} field
                            </span>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </form>

@endsection