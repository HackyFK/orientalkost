@extends('admin.layouts.app')

@section('page-title', 'Data User')

@section('content')

    {{-- SUCCESS MESSAGE --}}
    @if (session('success'))
        <div
            class="mb-5 flex items-center gap-3 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm font-medium">
            <i class="fa-solid fa-circle-check text-green-500"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- PAGE HEADER + SEARCH --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

        {{-- LEFT: Title --}}
        <div>
            <h1 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                <i class="fa-solid fa-users text-blue-500"></i>
                Data User
            </h1>
            <p class="text-sm text-slate-400 mt-0.5">
                Kelola semua owner dan customer
            </p>
        </div>

        {{-- RIGHT: Search --}}
        <form method="GET" action="{{ route('admin.users.index') }}" class="relative w-full sm:w-auto">

            {{-- keep role filter --}}
            @if (request('role'))
                <input type="hidden" name="role" value="{{ request('role') }}">
            @endif

            <div class="relative">

                {{-- icon search --}}
                <i class="fa-solid fa-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-sm"></i>

                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama, email, identitas..."
                    class="w-full sm:w-64 lg:w-72
                      pl-10 pr-10 py-2.5
                      text-sm font-medium
                      border border-slate-200
                      rounded-xl
                      bg-white
                      shadow-sm
                      focus:outline-none
                      focus:ring-2 focus:ring-blue-500
                      focus:border-blue-500
                      transition">

                {{-- clear button --}}
                @if (request('search'))
                    <a href="{{ route('admin.users.index') }}"
                        class="absolute right-3 top-1/2 -translate-y-1/2
                      text-slate-400 hover:text-red-500 transition">
                        <i class="fa-solid fa-xmark"></i>
                    </a>
                @endif

            </div>

        </form>

    </div>

    {{-- TABLE CARD --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">

        {{-- Toolbar --}}
        <div
            class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 px-5 py-3.5 border-b border-slate-100">
            <span class="text-sm font-semibold text-slate-600">
                Semua User
                <span class="ml-2 text-xs font-bold bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full">
                    {{ $users->total() }}
                </span>
            </span>

            {{-- Role filter pills --}}
            <div class="hidden sm:flex items-center gap-1.5">
                @foreach (['all' => 'Semua', 'owner' => 'Owner', 'customer' => 'Customer'] as $val => $label)
                    <a href="{{ $val === 'all' ? route('admin.users.index') : route('admin.users.index', ['role' => $val]) }}"
                        class="px-2.5 py-1 text-xs font-semibold rounded-md transition-colors
                          {{ request('role', 'all') === $val
                              ? 'bg-blue-600 text-white'
                              : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Table --}}
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 text-left text-xs font-bold text-slate-400 uppercase tracking-wider">
                        <th class="px-4 py-3">User</th>
                        <th class="px-4 py-3">Role</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3">Terdaftar</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">

                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50/60 transition-colors">

                            {{-- User Info --}}
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-9 h-9 rounded-full bg-gradient-to-br from-indigo-400 to-blue-500 flex items-center justify-center text-white text-xs font-bold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-semibold text-slate-700 text-xs">
                                            {{ $user->name }}
                                        </p>
                                        <p class="text-[11px] text-slate-400">
                                            {{ $user->email }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            {{-- Role --}}
                            <td class="px-4 py-4">
                                <span
                                    class="px-2.5 py-1 text-xs font-semibold rounded-md
                            {{ $user->role == 'owner'
                                ? 'bg-blue-50 text-blue-600 border border-blue-100'
                                : 'bg-indigo-50 text-indigo-600 border border-indigo-100' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>

                            {{-- Status --}}
                            <td class="px-4 py-4 text-center">
                                <form method="POST" action="{{ route('admin.users.toggleStatus', $user) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button
                                        class="px-2.5 py-1 text-xs font-semibold rounded-md border
                                {{ $user->is_active ? 'bg-green-50 text-green-600 border-green-100' : 'bg-red-50 text-red-500 border-red-100' }}">
                                        {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </form>
                            </td>

                            {{-- Tanggal --}}
                            <td class="px-4 py-4">
                                <div class="flex items-center gap-1.5 text-xs text-slate-400">
                                    <i class="fa-regular fa-calendar text-[10px]"></i>
                                    {{ $user->created_at->format('d M Y') }}
                                </div>
                            </td>

                            {{-- Aksi --}}
                            <td class="px-4 py-4">
                                <div class="flex items-center justify-center gap-2">

                                    @if ($user->role == 'customer')
                                        <form method="POST" action="{{ route('admin.users.updateRole', $user) }}"
                                            onsubmit="return confirm('Yakin ingin menjadikan user ini sebagai OWNER?')">
                                            @csrf
                                            @method('PATCH')
                                            <button title="Jadikan Owner"
                                                class="w-7 h-7 flex items-center justify-center rounded-lg bg-blue-50 hover:bg-blue-100 text-blue-500 border border-blue-100">
                                                <i class="fa-solid fa-user-plus text-[11px]"></i>
                                            </button>
                                        </form>
                                    @endif

                                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}"
                                        onsubmit="return confirm('Yakin hapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button title="Hapus"
                                            class="w-7 h-7 flex items-center justify-center rounded-lg bg-red-50 hover:bg-red-100 text-red-500 border border-red-100">
                                            <i class="fa-solid fa-trash text-[11px]"></i>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-16 text-center">
                                <div class="flex flex-col items-center gap-3 text-slate-300">
                                    <i class="fa-solid fa-users text-4xl"></i>
                                    <p class="text-sm font-medium text-slate-400">
                                        Belum ada data user
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if ($users->hasPages())
            <div class="px-5 py-4 border-t border-slate-100">
                {{ $users->links() }}
            </div>
        @endif

    </div>

    {{-- Pagination --}}
    @if ($users->hasPages())
        <div class="px-5 py-4 border-t border-slate-100">
            {{ $users->links() }}
        </div>
    @endif

    </div>

@endsection
