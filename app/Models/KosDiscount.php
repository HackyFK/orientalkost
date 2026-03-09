<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KosDiscount extends Model
{
    protected $fillable = [
        'kos_id',
        'nama',
        'type',
        'value',
        'max_discount',
        'min_durasi',
        'min_total',
        'jenis_sewa',
        'days',
        'start_date',
        'end_date',
        'is_active'
    ];

    protected $casts = [
        'days' => 'array'
    ];

    public function kos()
    {
        return $this->belongsTo(Kos::class);
    }
}
