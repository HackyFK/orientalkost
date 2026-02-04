<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kamar extends Model
{
    protected $fillable = [
        'kos_id',
        'nama_kamar',
        'tipe_kamar',
        'lantai',
        'nomor_kamar',
        'deskripsi',
        'harga_bulanan',
        'harga_tahunan',
        'status'
    ];

    public function kos()
    {
        return $this->belongsTo(Kos::class);
    }

    public function images()
    {
        return $this->hasMany(KamarImage::class);
    }

    public function fasilitas()
    {
        return $this->belongsToMany(Fasilitas::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
