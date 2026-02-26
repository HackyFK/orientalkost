@extends('admin.layouts.app')

@section('page-title', 'Data User')

@section('content')

    @if (session('success'))
        <div class="mb-5 px-4 py-3 bg-green-50 border border-green-200 text-green-700 rounded-lg text-sm">
            {{ session('success') }}
        </div>
    @endif

    {{-- ================= STATISTIK ================= --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">

        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
            <p class="text-xs text-slate-400 uppercase tracking-wide">Total Owner</p>
            <h3 class="text-2xl font-bold text-blue-600 mt-1">
                {{ $stats['owner'] ?? 0 }}
            </h3>
        </div>

        <div class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm">
            <p class="text-xs text-slate-400 uppercase tracking-wide">Total Customer</p>
            <h3 class="text-2xl font-bold text-indigo-600 mt-1">
                {{ $stats['customer'] ?? 0 }}
            </h3>
        </div>

    </div>

    {{-- ================= HEADER ================= --}}
    <div class="flex items-center justify-between mb-4">
        <div>
            <h1 class="text-xl font-bold text-slate-800">Data User</h1>
            <p class="text-sm text-slate-400">Kelola owner & customer sistem</p>
        </div>
    </div>

    {{-- ================= SEARCH ================= --}}
    <div class="mb-4">
        <input type="text" id="search" placeholder="Cari nama, email, atau identitas..."
            class="w-full md:w-1/3 px-4 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-blue-200 focus:outline-none">
    </div>

    {{-- ================= TABLE ================= --}}
    <h2 class="text-lg font-bold text-slate-700 mb-2">Owner</h2>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-6">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50 text-xs text-slate-400 uppercase">
                    <tr>
                        <th class="px-5 py-3 text-left">Nama</th>
                        <th class="px-5 py-3 text-left">Email</th>
                        <th class="px-5 py-3 text-left">Status</th>
                        <th class="px-5 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($owners as $user)
                        <tr class="hover:bg-slate-50">
                            <td class="px-5 py-3 font-semibold text-slate-700">{{ $user->name }}</td>
                            <td class="px-5 py-3 text-slate-600">{{ $user->email }}</td>
                            <td class="px-5 py-3">
                                <button onclick="toggleStatus({{ $user->id }})"
                                    class="px-3 py-1 text-xs rounded-full font-semibold
                                {{ $user->is_active ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                    {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </td>
                            <td class="px-5 py-3 text-center">
                                <a href="{{ route('admin.users.show', $user) }}"
                                    class="px-3 py-1.5 bg-slate-100 text-slate-600 text-xs font-semibold rounded-lg hover:bg-slate-200 transition">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-12 text-center text-slate-400">Belum ada owner</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $owners->links() }}
    </div>

    <h2 class="text-lg font-bold text-slate-700 mb-2">Customer</h2>
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-6">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50 text-xs text-slate-400 uppercase">
                    <tr>
                        <th class="px-5 py-3 text-left">Nama</th>
                        <th class="px-5 py-3 text-left">Email</th>
                        <th class="px-5 py-3 text-left">Status</th>
                        <th class="px-5 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($customers as $user)
                        <tr class="hover:bg-slate-50">
                            <td class="px-5 py-3 font-semibold text-slate-700">{{ $user->name }}</td>
                            <td class="px-5 py-3 text-slate-600">{{ $user->email }}</td>
                            <td class="px-5 py-3">
                                <button onclick="toggleStatus({{ $user->id }})"
                                    class="px-3 py-1 text-xs rounded-full font-semibold
                                {{ $user->is_active ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                    {{ $user->is_active ? 'Aktif' : 'Nonaktif' }}
                                </button>
                            </td>
                            <td class="px-5 py-3 text-center flex justify-center gap-2">
                                @if ($user->role == 'customer')
                                    <form action="{{ route('admin.users.updateRole', $user) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button
                                            class="px-3 py-1.5 bg-blue-50 text-blue-600 text-xs font-semibold rounded-lg hover:bg-blue-100 transition">
                                            Jadikan Owner
                                        </button>
                                    </form>
                                @endif
                                <a href="{{ route('admin.users.show', $user) }}"
                                    class="px-3 py-1.5 bg-slate-100 text-slate-600 text-xs font-semibold rounded-lg hover:bg-slate-200 transition">Detail</a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus user ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="px-3 py-1.5 bg-red-50 text-red-500 text-xs font-semibold rounded-lg hover:bg-red-100 transition">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-12 text-center text-slate-400">Belum ada customer</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $customers->links() }}
    </div>

    {{-- ================= SCRIPT ================= --}}
    <script>
        document.getElementById('search').addEventListener('keyup', function() {
            fetch(`?search=${this.value}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(res => res.text())
                .then(data => {
                    document.getElementById('table-body').innerHTML = data;
                });
        });

        function toggleStatus(id) {
            fetch(`/admin/users/${id}/toggle-status`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(() => location.reload());
        }
    </script>

@endsection
