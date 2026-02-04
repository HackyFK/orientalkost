<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;

class AdminReviewController extends Controller
{
    public function index()
    {
        return view('admin.review.index', [
            'items' => Review::with('kamar')->latest()->get()
        ]);
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return back()->with('success','Review dihapus');
    }
}
