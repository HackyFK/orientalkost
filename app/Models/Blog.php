<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $fillable = [
        'user_id',
        'judul',
        'slug',
        'ringkasan',
        'gambar',
        'isi',
        'published_at',
        'views',
        'status',
    ];

     protected $casts = [
        'published_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($blog) {
            $blog->slug = Str::slug($blog->judul);
        });
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
