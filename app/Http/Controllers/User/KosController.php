<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kos;

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
}
