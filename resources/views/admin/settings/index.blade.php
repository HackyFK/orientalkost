@extends('admin.layouts.app')

@section('page-title', 'Pengaturan')

@section('content')

    {{-- SUCCESS / ERROR MESSAGE --}}
    @if (session('success'))
        <div class="mb-5 flex items-center gap-3 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm font-medium">
            <i class="fa-solid fa-circle-check text-green-500"></i>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-5 flex items-center gap-3 px-4 py-3 bg-red-50 border border-red-200 text-red-700 rounded-lg text-sm font-medium">
            <i class="fa-solid fa-circle-xmark text-red-500"></i>
            {{ session('error') }}
        </div>
    @endif

    @php
        $groupLabels = config('settings.groups');
        $fieldLabels = config('settings.labels');

        $groupIcons = [
            'general'  => ['icon' => 'fa-globe', 'color' => 'blue'],
            'contact'  => ['icon' => 'fa-phone', 'color' => 'green'],
            'social'   => ['icon' => 'fa-share-nodes', 'color' => 'indigo'],
            'seo'      => ['icon' => 'fa-magnifying-glass', 'color' => 'amber'],
            'payment'  => ['icon' => 'fa-credit-card', 'color' => 'purple'],
            'email'    => ['icon' => 'fa-envelope', 'color' => 'red'],
        ];

        $colorMap = [
            'blue'   => ['bg' => 'bg-blue-50', 'icon' => 'text-blue-500'],
            'green'  => ['bg' => 'bg-green-50', 'icon' => 'text-green-500'],
            'indigo' => ['bg' => 'bg-indigo-50', 'icon' => 'text-indigo-500'],
            'amber'  => ['bg' => 'bg-amber-50', 'icon' => 'text-amber-500'],
            'purple' => ['bg' => 'bg-purple-50', 'icon' => 'text-purple-500'],
            'red'    => ['bg' => 'bg-red-50', 'icon' => 'text-red-500'],
        ];
    @endphp

    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-5 items-start">

            {{-- ================= LEFT CONTENT ================= --}}
            <div class="xl:col-span-2 space-y-5">

                {{-- Header --}}
                <div>
                    <h1 class="text-xl font-bold text-slate-800">Pengaturan Website</h1>
                    <p class="text-sm text-slate-400">Konfigurasi umum dan tampilan website</p>
                </div>

                @foreach ($settings as $group => $items)

                    @php
                        $meta  = $groupIcons[$group] ?? ['icon' => 'fa-gear', 'color' => 'blue'];
                        $color = $colorMap[$meta['color']] ?? $colorMap['blue'];
                        $sensitiveFields = ['smtp_password', 'midtrans_server_key'];
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

                        {{-- Card Body --}}
                        <div class="p-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach ($items as $item)
                                    <div>
                                        <label class="block text-sm font-medium text-slate-600 mb-1">
                                            {{ $fieldLabels[$item->key] ?? ucfirst(str_replace('_', ' ', $item->key)) }}
                                        </label>

                                        @if (in_array($item->key, $sensitiveFields))
                                            <input type="password"
                                                name="settings[{{ $item->key }}]"
                                                placeholder="Kosongkan jika tidak ingin mengubah"
                                                class="w-full border border-slate-200 focus:ring-2 focus:ring-blue-400 p-2 rounded-lg text-sm">
                                        @else
                                            <input type="text"
                                                name="settings[{{ $item->key }}]"
                                                value="{{ $item->value }}"
                                                class="w-full border border-slate-200 focus:ring-2 focus:ring-blue-400 p-2 rounded-lg text-sm">
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                @endforeach

            </div>

            {{-- ================= RIGHT SIDEBAR ================= --}}
            <div class="xl:sticky xl:top-20 space-y-4">

                {{-- Save Card --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm">
                    <div class="px-5 py-4 border-b border-slate-100 flex items-center gap-2.5">
                        <i class="fa-solid fa-floppy-disk text-blue-500 text-xs"></i>
                        <h2 class="font-bold text-slate-700 text-sm">Simpan Perubahan</h2>
                    </div>
                    <div class="p-5">
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold py-2.5 rounded-lg">
                            Simpan Pengaturan
                        </button>
                    </div>
                </div>

                {{-- Test Buttons --}}
                <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-5 space-y-3">
                    <form method="POST" action="{{ route('admin.settings.test.smtp') }}">
                        @csrf
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg">
                            🔘 Test SMTP
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.settings.test.midtrans') }}">
                        @csrf
                        <button type="submit" class="w-full bg-purple-600 text-white py-2 rounded-lg">
                            🔘 Test Midtrans
                        </button>
                    </form>
                </div>

            </div>

        </div>

    </form>

@endsection
