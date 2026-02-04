<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'kamar_id','nama_penyewa','email',
        'phone','tanggal_masuk','pesan','status'
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}
