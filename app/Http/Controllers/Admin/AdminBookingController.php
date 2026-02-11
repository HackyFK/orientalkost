<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function index()
    {
        $items = Booking::with('kamar')
            ->latest()
            ->paginate(10);

        return view('admin.booking.index', compact('items'));
    }

    public function show(Booking $booking)
    {
        return view('admin.booking.show', compact('booking'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:draft,pending,paid,confirmed,cancelled,expired'
        ]);

        $booking->update([
            'status' => $request->status
        ]);

        return redirect()
            ->route('admin.booking.index')
            ->with('success', 'Status booking berhasil diupdate.');
    }

    public function destroy(Booking $booking)
    {
        $booking->delete();

        return redirect()
            ->route('admin.booking.index')
            ->with('success', 'Booking berhasil dihapus.');
    }
}
