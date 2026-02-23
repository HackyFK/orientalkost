@extends('admin.layouts.app')

@section('content')
    <h1 class="text-xl font-bold mb-6">Pengaturan Website</h1>

    @if (session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        @method('PUT')

        @php
            $groupLabels = config('settings.groups');
            $fieldLabels = config('settings.labels');
        @endphp

        @foreach ($settings as $group => $items)
            <div class="bg-white rounded shadow p-5 mb-6">
                <h2 class="text-lg font-semibold mb-4">
                    {{ $groupLabels[$group] ?? ucfirst($group) }}
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($items as $item)
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">
                                {{ $fieldLabels[$item->key] ?? ucfirst(str_replace('_', ' ', $item->key)) }}
                            </label>

                            @php
                                $sensitiveFields = ['smtp_password', 'midtrans_server_key'];
                            @endphp

                            @if (in_array($item->key, $sensitiveFields))
                                <input type="password" name="settings[{{ $item->key }}]"
                                    placeholder="Kosongkan jika tidak ingin mengubah" class="w-full border p-2 rounded">
                            @else
                                <input type="text" name="settings[{{ $item->key }}]" value="{{ $item->value }}"
                                    class="w-full border p-2 rounded">
                            @endif

                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach


        <button class="px-4 py-2 bg-blue-600 text-white rounded">
            Simpan Pengaturan
        </button>
    </form>

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-3">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-3">
            {{ session('error') }}
        </div>
    @endif

    <div class="flex gap-3 mb-4">

        <form method="POST" action="{{ route('admin.settings.test.smtp') }}">
            @csrf
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                🔘 Test SMTP
            </button>
        </form>

        <form method="POST" action="{{ route('admin.settings.test.midtrans') }}">
            @csrf
            <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded">
                🔘 Test Midtrans
            </button>
        </form>

    </div>
@endsection
