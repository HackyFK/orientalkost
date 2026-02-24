<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function index(Request $request)
{
    $query = Booking::with('kamar');

    // ===============================
    // FILTER STATUS
    // ===============================
    if ($request->filled('status') && $request->status !== 'all') {
        $query->where('status', $request->status);
    }

    // ===============================
    // SEARCH
    // ===============================
    if ($request->filled('search')) {

        $search = $request->search;

        $query->where(function ($q) use ($search) {

            // Jika angka → bisa cari berdasarkan ID
            if (is_numeric($search)) {
                $q->orWhere('id', $search);
            }

            $q->orWhere('nama_penyewa', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('phone', 'like', "%{$search}%")
              ->orWhere('durasi', 'like', "%{$search}%")
              ->orWhere('total_bayar', 'like', "%{$search}%")
              ->orWhereDate('created_at', $search)

              ->orWhereHas('kamar', function ($kamar) use ($search) {
                  $kamar->where('nama_kamar', 'like', "%{$search}%");
              })
                ->orWhereHas('kamar.kos', function ($kos) use ($search) {
              $kos->where('nama_kos', 'like', "%{$search}%");
          });
        });
    }

    $items = $query->latest()->paginate(6)->withQueryString();

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
