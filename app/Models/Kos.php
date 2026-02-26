<?php

namespace App\Models;

use App\Models\Kamar;
use App\Models\KosImage;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Fasilitas;

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
        'gender',
        'likes',
    ];


    public function likesUsers()
    {
        return $this->belongsToMany(User::class, 'kos_likes', 'kos_id', 'user_id')
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

    public function fasilitas()
    {
        return $this->belongsToMany(
            Fasilitas::class,
            'kos_fasilitas'
        );
    }

    public function primaryImage()
    {
        return $this->hasOne(KosImage::class)
            ->where('is_primary', true);
    }

    // jumlah semua kamar
    public function getJumlahKamarAttribute()
    {
        return $this->kamars()->count();
    }

    // jumlah kamar tersedia
    public function getKamarTersediaAttribute()
    {
        return $this->kamars()
            ->where('status', 'tersedia')
            ->count();
    }

    // Status kos
    public function getStatusAttribute()
    {
        $adaKamarTersedia = $this->kamars()
            ->where('status', 'tersedia') // sesuaikan dengan field status kamar
            ->exists();

        return $adaKamarTersedia ? 'Tersedia' : 'Tidak tersedia';
    }
    public function getFasilitasAttribute()
    {
        return $this->kamars
            ->flatMap->fasilitas
            ->unique('id')
            ->groupBy('kategori');
    }
}
