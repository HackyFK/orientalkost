@extends('user.layouts.app')

@section('content')

<div class="max-w-xl mx-auto py-20">

    <div class="bg-white p-8 rounded-3xl shadow-lg text-center">
        <h1 class="text-2xl font-bold mb-6">Pembayaran DP</h1>

        <p class="mb-4">
            Total Bayar:
            <span class="font-bold text-lg">
                Rp {{ number_format($payment->amount) }}
            </span>
        </p>

        <button id="pay-button"
            class="w-full bg-accent hover:bg-orange-600 text-white py-3 rounded-xl font-bold">
            Bayar Sekarang
        </button>
    </div>

</div>

<script src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ setting('midtrans_client_key') }}"></script>

<script>
document.getElementById('pay-button').onclick = function () {
    snap.pay('{{ $snapToken }}', {
        onSuccess: function(result){
            window.location.href = "/booking/success/{{ $payment->booking_id }}";
        },
        onPending: function(result){
            alert("Menunggu pembayaran");
        },
        onError: function(result){
            alert("Pembayaran gagal");
        }
    });
};
</script>

@endsection
