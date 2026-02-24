<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
