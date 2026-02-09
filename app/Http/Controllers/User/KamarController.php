<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kamar;

class KamarController extends Controller
{
    public function show(Kamar $kamar)
    {
        $kamar->load([
            'kos',
            'images',
            'fasilitas'
        ]);

        return view('user.kamar.show', compact('kamar'));
    }
}
