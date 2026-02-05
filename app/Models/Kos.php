<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kos extends Model
{
    protected $fillable = [
        'nama_kos',
        'slug',
        'deskripsi',
        'alamat',
        'latitude',
        'longitude',
        'jenis_sewa'
    ];

    public function kamar()
    {
        return $this->hasMany(Kamar::class);
    }

    public function images()
    {
        return $this->hasMany(KosImage::class);
    }

    public function primaryImage()
    {
        return $this->hasOne(KosImage::class)->where('is_primary', true);
    }
}
