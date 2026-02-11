<?php

namespace App\Http\Controllers\User;

use App\Models\Galeri;
use App\Http\Controllers\Controller;

class GaleriController extends Controller
{

public function index()
{
    $galeris = Galeri::latest()->get();

    return view('user.galeri.index', compact('galeris'));
}
}
