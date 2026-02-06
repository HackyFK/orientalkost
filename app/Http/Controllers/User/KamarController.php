<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class KamarController extends Controller
{
    public function index()
    {
        return view('user.kamar.index');
    }

    public function detail()
    {
        return view('user.kamar.detail');
    }


    
}
