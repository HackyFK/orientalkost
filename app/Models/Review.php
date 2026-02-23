<?php

    namespace App\Models;

use App\Models\Kamar;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

    class Review extends Model
    {
        protected $fillable = [
            'kamar_id',
            'user_id',
            'rating',
            'ulasan',
            'status',
        ];

        public function kamar()
        {
            return $this->belongsTo(Kamar::class);
        }

        public function user()
        {
            return $this->belongsTo(User::class);
        }
    }
