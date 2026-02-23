<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use App\Models\Kamar;

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

        public function kos()
{
    return $this->belongsTo(Kos::class);
}
    }
