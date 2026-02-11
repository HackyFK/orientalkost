<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kos extends Model
{
    protected $fillable = [
        'owner_id',
        'nama_kos',
        'slug',
        'deskripsi',
        'alamat',
        'latitude',
        'longitude',
        'jenis_sewa'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function kamars()
    {
        return $this->hasMany(Kamar::class);
    }

    public function images()
    {
        return $this->hasMany(KosImage::class)
            ->orderByDesc('is_primary')
            ->orderBy('id');
    }

    public function primaryImage()
    {
        return $this->hasOne(KosImage::class)
            ->where('is_primary', true);
    }
}
