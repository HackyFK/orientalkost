<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function index()
    {
        return view('admin.booking.index', [
            'items' => Booking::with('kamar')->latest()->get()
        ]);
    }

    public function update(Request $request, Booking $booking)
    {
        $booking->update([
            'status' => $request->status
        ]);

        return back()->with('success','Status booking diupdate');
    }
}
