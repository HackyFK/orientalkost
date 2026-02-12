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
        'jenis_sewa',
        'likes',
    ];


    public function likesUsers()
  {
        return $this->belongsToMany(\App\Models\User::class, 'kos_likes', 'kos_id', 'user_id')
                ->withTimestamps();
  }


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
