@extends('admin.layouts.app')

@section('page-title', 'Detail User')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.users.index') }}"
        class="text-sm text-blue-500 hover:underline">
        ← Kembali ke Data User
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 max-w-2xl">

    <h2 class="text-lg font-bold text-slate-800 mb-6">
        Informasi User
    </h2>

    <div class="space-y-4 text-sm">

        <div>
            <span class="text-slate-400">Nama</span>
            <div class="font-semibold text-slate-700">{{ $user->name }}</div>
        </div>

        <div>
            <span class="text-slate-400">Email</span>
            <div class="font-semibold text-slate-700">{{ $user->email }}</div>
        </div>

        <div>
            <span class="text-slate-400">Tipe Identitas</span>
            <div class="font-semibold text-slate-700 uppercase">
                {{ $user->tipe_identitas }}
            </div>
        </div>

        <div>
            <span class="text-slate-400">Nomor Identitas</span>
            <div class="font-semibold text-slate-700">
                {{ $user->nomor_identitas }}
            </div>
        </div>

        <div>
            <span class="text-slate-400">No. HP</span>
            <div class="font-semibold text-slate-700">
                {{ $user->phone ?? '-' }}
            </div>
        </div>

        <div>
            <span class="text-slate-400">Alamat</span>
            <div class="font-semibold text-slate-700">
                {{ $user->alamat ?? '-' }}
            </div>
        </div>

        <div>
            <span class="text-slate-400">Role</span>
            <div class="font-semibold text-slate-700 capitalize">
                {{ $user->role }}
            </div>
        </div>

        <div>
            <span class="text-slate-400">Terdaftar</span>
            <div class="font-semibold text-slate-700">
                {{ $user->created_at->format('d M Y H:i') }}
            </div>
        </div>

    </div>

</div>

@endsection
