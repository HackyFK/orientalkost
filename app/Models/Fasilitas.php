<?php

namespace App\Models;

use App\Models\Kamar;
use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table = 'fasilitas';

    protected $fillable = [
        'nama_fasilitas',
        'icon',
        'kategori',
    ];

    // nanti dipakai waktu pivot kamar
    public function kamars()
    {
        return $this->belongsToMany(
            Kamar::class,
            'fasilitas_kamar'
        );
    }
    
    public function kos()
    {
        return $this->belongsToMany(
            Kos::class,
            'fasilitas_kos'
        );
    }
}
