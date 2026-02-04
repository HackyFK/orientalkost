<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'user_id','judul','slug','gambar',
        'isi','published_at','views'
    ];

    public function author()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
