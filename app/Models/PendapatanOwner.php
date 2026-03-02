<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendapatanOwner extends Model
{
    protected $table = 'pendapatan_owner';

    protected $fillable = [
        'owner_id',
        'booking_id',
        'total_booking',
        'pendapatan_owner',
        'pendapatan_platform',
         'status',
         'tanggal_kirim',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    // tambahan helper langsung akses kamar
    public function kamar()
    {
        return $this->hasOneThrough(
            Kamar::class,
            Booking::class,
            'id',        // foreign key di bookings
            'id',        // foreign key di kamar
            'booking_id', // foreign key di pendapatan_owner
            'kamar_id'   // foreign key di bookings
        );
    }

    protected $casts = [
    'tanggal_kirim' => 'datetime',
    ];
    
}
