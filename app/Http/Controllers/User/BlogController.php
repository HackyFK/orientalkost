<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function index()
    {
        return view('user.blog.index');
    }
}
