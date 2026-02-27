<?php

namespace App\Models;

use App\Models\Fasilitas;
use App\Models\KamarImage;
use App\Models\Kos;
use App\Models\Review;
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
        'panjang',
        'lebar',
        'harga_harian',
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
        return $this->belongsToMany(
            Fasilitas::class,
            'fasilitas_kamar'
        );
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(KamarImage::class)->where('is_primary', true);
    }

    public function getKamarTersediaAttribute()
    {
        return $this->kamars()
            ->where('status', 'tersedia')
            ->count();
    }
}
