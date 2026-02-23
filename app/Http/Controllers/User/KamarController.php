<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Kamar;
use Illuminate\Support\Facades\Auth;

class KamarController extends Controller
{
    public function show(Kamar $kamar)
    {
        $user = Auth::user();
        $hasBooked = false;

        $hasBooked = $user
            ? Booking::where('user_id', $user->id)
            ->where('kamar_id', $kamar->id)
            ->exists()
            : false;
            
        $kamar->load([
            'kos',
            'images',
            'fasilitas',
            'reviews' => function ($query) {
                $query->where('status', 1); // Hanya yang disetujui
            }
        ]);

        $averageRating = $kamar->reviews->avg('rating') ?: 0;
        $totalReviews = $kamar->reviews->count();

        // Hitung jumlah review per rating
        $ratingCounts = [];
        for ($i = 1; $i <= 5; $i++) {
            $ratingCounts[$i] = $kamar->reviews->where('rating', $i)->count();
        }

        // Hitung persentase per rating
        $ratingPercentages = [];
        foreach ($ratingCounts as $star => $count) {
            $ratingPercentages[$star] = $totalReviews ? ($count / $totalReviews) * 100 : 0;
        }

        return view('user.kamar.show', compact(
            'kamar',
            'averageRating',
            'totalReviews',
            'ratingCounts',
            'ratingPercentages',
            'hasBooked' // kirim ke view
        ));
    }
}
