<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class AdminReviewController extends Controller

{
    public function index(Request $request)
    {
        $query = Review::with(['user', 'kamar.kos']);

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->whereHas('user', function ($uq) use ($request) {
                    $uq->where('name', 'like', '%' . $request->search . '%');
                })
                    ->orWhereHas('kamar', function ($kq) use ($request) {
                        $kq->where('nama_kamar', 'like', '%' . $request->search . '%');
                    });
            });
        }

        $reviews = $query->latest()->paginate(10);

        return view('admin.reviews.index', compact('reviews'));
    }


   public function updateStatus(Review $review)
{
    $review->update([
        'status' => $review->status === 'approved'
            ? 'pending'
            : 'approved'
    ]);

    return back()->with('success', 'Status review berhasil diperbarui');
}


    public function destroy(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Review berhasil dihapus');
    }
}
