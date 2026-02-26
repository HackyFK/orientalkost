@extends('user.layouts.app')

@section('page-title', 'Profil Saya')

@section('content')

<div class="max-w-2xl mx-auto my-8">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-blue-50 flex items-center justify-center">
                <i class="fa-solid fa-user text-blue-500 text-sm"></i>
            </div>
            <div>
          
            </div>
        </div>
    </div>

    <div class="bg-slate-50 border border-slate-200 rounded-2xl shadow-lg p-6 space-y-5">

        {{-- Update Profile --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-5 py-3.5 border-b border-slate-100 flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-blue-50 flex items-center justify-center">
                    <i class="fa-solid fa-pen text-blue-500 text-xs"></i>
                </div>
                <h3 class="font-semibold text-slate-700 text-sm">Informasi Profil</h3>
            </div>
            <div class="p-5">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        {{-- Update Password --}}
        <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
            <div class="px-5 py-3.5 border-b border-slate-100 flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-amber-50 flex items-center justify-center">
                    <i class="fa-solid fa-lock text-amber-500 text-xs"></i>
                </div>
                <h3 class="font-semibold text-slate-700 text-sm">Ubah Password</h3>
            </div>
            <div class="p-5">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        {{-- Delete Account --}}
        <div class="bg-white rounded-xl border border-red-100 shadow-sm overflow-hidden">
            <div class="px-5 py-3.5 border-b border-red-50 flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-lg bg-red-50 flex items-center justify-center">
                    <i class="fa-solid fa-triangle-exclamation text-red-500 text-xs"></i>
                </div>
                <h3 class="font-semibold text-red-600 text-sm">Hapus Akun</h3>
            </div>
            <div class="p-5">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
        <a href="{{ route('user.beranda') }}"
            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-slate-200 bg-white hover:bg-slate-50 active:scale-[0.98] transition-all duration-150 text-sm font-medium text-slate-600 shadow-sm">
            <i class="fa-solid fa-arrow-left text-xs"></i>
            Batal
        </a>

    </div>

</div>

@endsection