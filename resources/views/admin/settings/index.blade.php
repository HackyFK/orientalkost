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

                            <input type="text" name="settings[{{ $item->key }}]" value="{{ $item->value }}"
                                class="w-full border p-2 rounded">
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach


        <button class="px-4 py-2 bg-blue-600 text-white rounded">
            Simpan Pengaturan
        </button>
    </form>
@endsection
