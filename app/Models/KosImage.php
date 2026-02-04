<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KosImage extends Model
{
    protected $fillable = [
        'kos_id',
        'image_path',
        'is_primary',
    ];

    public function kos()
    {
        return $this->belongsTo(Kos::class);
    }
}
