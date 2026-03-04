<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingHistoryController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['kamar.kos'])
            ->where('user_id', Auth::id())
            ->latest();

        // Optional filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->paginate(10);

        return view('user.booking.history', compact('bookings'));
    }
}
