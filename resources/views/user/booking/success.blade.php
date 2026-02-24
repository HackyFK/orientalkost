@extends('user.layouts.app')

@section('content')
<div class="max-w-xl mx-auto py-20 text-center">
    <h1 class="text-2xl font-bold mb-4">Pembayaran Berhasil 🎉</h1>

    <p>Status Booking:
        <span class="font-bold text-green-600">
            {{ $booking->status }}
        </span>
    </p>
</div>
@endsection
