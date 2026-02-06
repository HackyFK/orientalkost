<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class KosController extends Controller
{
    public function index()
    {
        return view('user.kos.index');
    }
}
