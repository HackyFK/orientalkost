<?php

namespace App\Models;
use App\Models\User;
use App\Models\Kamar;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'kamar_id','nama_penyewa','email',
        'phone','tanggal_masuk','pesan','status'
    ];

    public function kamar()
    {
        return $this->belongsTo(kamar::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
