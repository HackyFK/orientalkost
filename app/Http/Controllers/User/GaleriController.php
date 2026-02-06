<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class GaleriController extends Controller
{
    public function index()
    {
        return view('user.galeri.index');
    }
}
