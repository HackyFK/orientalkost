<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use Illuminate\Support\Facades\Auth;

class KosController extends Controller
{
    public function index()
    {
        $kos = Kos::with([
            'primaryImage',
            'kamars' => function ($q) {
                $q->where('status', 'tersedia');
            }
        ])->latest()->get();

        return view('user.kos.index', compact('kos'));
    }

    public function show(Kos $kos)
    {
        $kos->load([
            'kamars.primaryImage',
            'kamars.fasilitas'
        ]);

        return view('user.kos.kamar', [
            'kos'    => $kos,
            'kamars' => $kos->kamars
        ]);
    }

    public function like(Kos $kos)
    {
        $user = Auth::user();

        // Cek apakah user sudah like
        $alreadyLiked = $kos->likesUsers()
            ->where('user_id', $user->id)
            ->exists();

        if ($alreadyLiked) {
            // UNLIKE
            $kos->likesUsers()->detach($user->id);
            $kos->decrement('likes');
            $liked = false;
        } else {
            // LIKE
            $kos->likesUsers()->attach($user->id);
            $kos->increment('likes');
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'likes' => $kos->likes
        ]);
    }
}
