<?php

namespace App\Models;

use App\Models\Kamar;
use Illuminate\Database\Eloquent\Model;

class KamarImage extends Model
{
    protected $fillable = [
        'kamar_id',
        'image_path',
        'is_primary'
    ];

    public function kamar()
    {
        return $this->belongsTo(Kamar::class);
    }
}
