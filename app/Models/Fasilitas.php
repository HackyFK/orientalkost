<?php

namespace App\Models;

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
}
