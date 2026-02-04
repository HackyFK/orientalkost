<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $fillable = ['judul','slug','deskripsi_singkat'];

    public function images()
    {
        return $this->hasMany(GaleriImage::class);
    }
}
