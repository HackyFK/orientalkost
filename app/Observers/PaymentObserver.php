<?php

namespace App\Observers;

use App\Models\Payment;
use App\Models\Keuangan;

class PaymentObserver
{

    public function created(Payment $payment)
    {

        // hanya jika status paid / settlement
        if (!in_array($payment->status, ['paid', 'settlement'])) {
            return;
        }

        // ambil saldo terakhir
        $saldoTerakhir = Keuangan::latest()->value('saldo') ?? 0;

        Keuangan::create([

            'reference' => $payment->reference,

            'admin_id' => null,

            'kategori' => 'pemasukan',

            'payment_method' => $payment->payment_method,

            'pemasukan' => $payment->amount,

            'pengeluaran' => 0,

            'saldo' => $saldoTerakhir + $payment->amount,

            'keterangan' => 'Transaksi kamar',

        ]);

    }

}