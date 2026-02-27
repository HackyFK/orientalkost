<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Keuangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;



class MidtransController extends Controller
{

    private function initMidtrans()
    {
        Config::$serverKey = setting('midtrans_server_key');
        Config::$isProduction = filter_var(setting('midtrans_is_production'), FILTER_VALIDATE_BOOLEAN);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    private function markAsPaid($payment, $type)
{
    $payment->update([
        'status' => 'paid',
        'payment_method' => $type,
        'paid_at' => now(),
    ]);

    $booking = $payment->booking;

    if ($payment->payment_type === 'dp') {
        $booking->update([
            'status' => 'paid',
            'payment_method' => $type,
            'paid_at' => now(),
        ]);
    }

    if ($payment->payment_type === 'pelunasan') {
        $booking->update([
            'status' => 'confirmed'
        ]);

        $booking->kamar->update([
            'status' => 'terisi'
        ]);
    }

    // ✅ MASUKKAN KE KEUANGAN
    if (!Keuangan::where('reference', $payment->reference)->exists()) {

        $saldoTerakhir = Keuangan::latest()->value('saldo') ?? 0;

        Keuangan::create([
            'reference' => $payment->reference,
            'admin_id' => 1, // default admin
            'kategori' => 'pemasukan',
            'payment_method' => $type,
            'pemasukan' => $payment->amount,
            'pengeluaran' => 0,
            'saldo' => $saldoTerakhir + $payment->amount,
            'keterangan' => 'Transaksi kamar',
        ]);
    }
}

    public function show(Payment $payment)
    {
        $this->initMidtrans();

        // Jika sudah pernah dibuat snap token, jangan generate ulang
        if (!$payment->reference) {

            $orderId = 'PAY-' . $payment->id . '-' . now()->timestamp;

            $payment->update([
                'reference' => $orderId,
            ]);
        } else {
            $orderId = $payment->reference;
        }

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $payment->amount,
            ],
            'customer_details' => [
                'first_name' => $payment->booking->nama_penyewa,
                'email' => $payment->booking->email,
                'phone' => $payment->booking->phone,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('user.payment.show', compact('payment', 'snapToken'));
    }

    public function callback(Request $request)
    {
        Log::info('MIDTRANS CALLBACK RAW', $request->all());

        $data = $request->all();

        $serverKey = setting('midtrans_server_key');

        $hashed = hash(
            'sha512',
            $data['order_id'] .
                $data['status_code'] .
                $data['gross_amount'] .
                $serverKey
        );

        if ($hashed !== $data['signature_key']) {
            Log::warning('Invalid signature');
            return response()->json(['success' => true]); // tetap 200
        }

        $orderId = $data['order_id'];
        $transactionStatus = $data['transaction_status'];

        $payment = \App\Models\Payment::where('reference', $orderId)->first();

        if (!$payment) {
            Log::warning('Payment not found', ['order_id' => $orderId]);
            return response()->json(['success' => true]);
        }

        if (in_array($transactionStatus, ['capture', 'settlement'])) {

            $this->markAsPaid($payment, $data['payment_type']);
        }

        if (in_array($transactionStatus, ['expire', 'cancel', 'deny'])) {

            $payment->update([
                'status' => 'failed',
            ]);

            $payment->booking->update([
                'status' => 'expired',
            ]);
        }

        return response()->json(['success' => true]);
    }



public function notification(Request $request)
{
    Log::info('MIDTRANS RAW:', $request->all());

    $orderId = $request->order_id;
    $transactionStatus = $request->transaction_status;
    $paymentType = $request->payment_type;

    $payment = Payment::where('reference', $orderId)->first();

    if (!$payment) {
        Log::warning('PAYMENT TIDAK DITEMUKAN: ' . $orderId);
        return response()->json(['success' => true]);
    }

    if (in_array($transactionStatus, ['capture', 'settlement'])) {

    $this->markAsPaid($payment, $paymentType);

}

    if (in_array($transactionStatus, ['expire', 'cancel', 'deny'])) {

        $payment->update([
            'status' => 'failed',
        ]);

        $payment->booking->update([
            'status' => 'expired',
        ]);
    }

    return response()->json(['success' => true]);
}
}
