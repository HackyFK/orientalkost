<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Keuangan;
use Illuminate\Support\Facades\Auth;

class Payment extends Model
{
    protected $fillable = [
        'booking_id',
        'transaction_id',
        'amount',
        'status',
        'payment_type',
        'payment_method',
        'reference',
        'paid_at',
        'snap_token',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    protected static function booted()
{
    static::created(function ($payment) {

        if ($payment->status !== 'paid') return;

        $saldoTerakhir = Keuangan::latest()->value('saldo') ?? 0;

        Keuangan::create([

            'reference' => $payment->reference,

            'admin_id' => null,

            'kategori' => 'pemasukan',

            'payment_method' => $payment->payment_method,

            'pemasukan' => $payment->amount,

            'pengeluaran' => 0,

            'saldo' => $saldoTerakhir + $payment->amount,

            'keterangan' => 'Transaksi kamar'

        ]);

    });
}
}
