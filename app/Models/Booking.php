<?php

namespace App\Models;

use App\Models\User;
use App\Models\Kamar;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'kamar_id',
        'user_id',
        'nama_penyewa',
        'email',
        'phone',
        'nomor_identitas',
        'alamat',
        'jenis_sewa',
        'durasi',
        'tanggal_mulai',
        'tanggal_selesai',
        'harga_per_bulan',
        'dp_nominal',
        'subtotal',
        'deposit',
        'total_bayar',
        'status',
        'payment_method',
        'payment_reference',
        'paid_at',
    ];

    protected $casts = [
    'tanggal_mulai' => 'datetime',
    'tanggal_selesai' => 'datetime',
    'paid_at' => 'datetime',
];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function layanans()
{
    return $this->belongsToMany(Layanan::class, 'booking_layanan');
}

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'kamar_id');
    }

    public function payments()
    {
        return $this->hasOne(Payment::class, 'booking_id');
    }
}
