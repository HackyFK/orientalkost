<?php

namespace App\Http\Controllers\User;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingHistoryController extends Controller
{
    // History semua booking user
    public function index(Request $request)
    {
        $query = Booking::with(['kamar.kos'])
            ->where('user_id', Auth::id())
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->paginate(10);

        return view('user.booking.history', compact('bookings'));
    }

    // Tampilkan detail booking
    public function show(Booking $booking)
    {
        $user = Auth::user();

        // 🔒 Pastikan hanya user booking ini yang bisa lihat
        if ($booking->user_id !== $user->id) {
            abort(403, 'Akses ditolak');
        }

        // Eager load kamar, kos, layanan, fasilitas
        $booking->load([
            'kamar.kos.layanan',
            'kamar.kos.fasilitas'
        ]);

        return view('user.booking.show', compact('booking'));
    }

    // Cetak struk PDF
    public function strukPdf(Booking $booking)
    {
        $user = Auth::user();

        // 🔒 Pastikan hanya user booking ini yang bisa cetak
        if ($booking->user_id !== $user->id) {
            abort(403, 'Akses ditolak');
        }

        // Eager load kamar dan kos, termasuk layanan
        $booking->load('kamar.kos.layanan');

        $pdf = Pdf::loadView('user.booking.struk', [
            'booking' => $booking
        ])->setPaper('A5', 'portrait');

        $filename = 'struk-booking-' . $booking->id . '.pdf';

        return $pdf->stream($filename);
    }
}
