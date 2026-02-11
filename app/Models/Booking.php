<?php

namespace App\Models;

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

    protected $dates = [
        'tanggal_mulai',
        'tanggal_selesai',
        'paid_at',
    ];

    public function kamar()
    {
        return $this->belongsTo(kamar::class);
    }
}
