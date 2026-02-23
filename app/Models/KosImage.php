<?php

namespace App\Models;

use App\Models\Kos;
use Illuminate\Database\Eloquent\Model;

class KosImage extends Model
{
    protected $fillable = [
        'kos_id',
        'image_path',
        'is_primary',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function kos()
    {
        return $this->belongsTo(Kos::class);
    }
}
