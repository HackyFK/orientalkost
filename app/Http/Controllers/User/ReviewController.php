<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Review;
use App\Models\Kamar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Simpan review & rating user
     */
    public function store(Request $request, $kamarId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'nullable|string'
        ]);

        // Cek apakah user sudah pernah review kamar ini
        $sudahReview = Review::where('user_id', auth()->id())
            ->where('kamar_id', $kamarId)
            ->exists();

        if ($sudahReview) {
            return back()->with('error', 'Anda sudah memberi rating kamar ini sebelumnya.');
        }

        Review::create([
            'user_id'   => auth()->id(),
            'kamar_id'  => $kamarId,
            'rating'    => $request->rating,
            'ulasan'  => $request->ulasan,
            'status' => 'pending',
        ]);

        return back()->with('review_success', 'Review berhasil dikirim dan menunggu persetujuan admin.');
    }

    /**
     * Daftar review milik user
     */
    public function myReviews()
{
    $reviews = Review::with([
            'kamar.kos' // sekalian kalau mau tampil nama kos
        ])
        ->where('user_id', Auth::id())
        ->orderByDesc('created_at')
        ->paginate(10);

    return view('user.reviews.index', compact('reviews'));
}


    /**
     * Form edit review
     */
    public function edit(Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        return view('user.reviews.edit', compact('review'));
    }

    /**
     * Update review
     */
    public function update(Request $request, Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'nullable|string|max:1000',
        ]);

        $review->update([
            'rating' => $request->rating,
            'ulasan' => $request->ulasan,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('user.reviews.mine')
            ->with('success', 'Review berhasil diperbarui ✨');
    }

    /**
     * Hapus review user
     */
    public function destroy(Review $review)
    {
        if ($review->user_id !== Auth::id()) {
            abort(403);
        }

        $review->delete();

        return back()->with('success', 'Review berhasil dihapus 🗑️');
    }
}
