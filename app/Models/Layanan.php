<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $fillable = [
        'kos_id',
        'nama_layanan',
        'harga',
        'deskripsi'
    ];

    public function kos()
    {
        return $this->belongsTo(Kos::class);
    }
}
