<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use App\Models\Kamar;
use App\Models\Booking;
use App\Models\Review;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'kos' => Kos::count(),
            'kamar' => Kamar::count(),
            'booking' => Booking::where('status','pending')->count(),
            'review' => Review::count(),
        ]);
    }
}
