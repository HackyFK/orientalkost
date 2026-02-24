<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

    class BlogController extends Controller
{
   public function index(Request $request)
{
    $search = $request->search;
    $sort   = $request->sort;

    // Featured blog (paling banyak likes)
    $featuredBlog = Blog::with('author')
        ->orderByDesc('likes')
        ->first();

    $query = Blog::with('author')
        ->when($featuredBlog, function ($q) use ($featuredBlog) {
            $q->where('id', '!=', $featuredBlog->id);
        });

    // 🔎 SEARCH
    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('judul', 'like', "%{$search}%")
              ->orWhere('ringkasan', 'like', "%{$search}%")
              ->orWhere('isi', 'like', "%{$search}%");
        });
    }

    // 🔽 SORT
    if ($sort == 'popular') {
        $query->orderByDesc('likes');
    } elseif ($sort == 'oldest') {
        $query->orderBy('tanggal_terbit');
    } else {
        $query->orderByDesc('tanggal_terbit');
    }

    $blogs = $query->paginate(3)->withQueryString();

    return view('user.blog.index', compact('blogs', 'featuredBlog'));
}

    public function show($slug)
    {
        $blog = \App\Models\Blog::with('author')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Session key unik per blog
        $sessionKey = 'blog_viewed_' . $blog->id;

        if (!session()->has($sessionKey)) {
            $blog->increment('views');
            session()->put($sessionKey, true);
        }

        return view('user.blog.show', compact('blog'));
    }

    public function toggleLike(\App\Models\Blog $blog)
    {
        $user = auth::user();

        $like = DB::table('blog_likes')
            ->where('blog_id', $blog->id)
            ->where('user_id', $user->id)
            ->first();

        if ($like) {
            DB::table('blog_likes')
                ->where('blog_id', $blog->id)
                ->where('user_id', $user->id)
                ->delete();

            $blog->decrement('likes');
            $status = 'unliked';
        } else {
            DB::table('blog_likes')->insert([
                'blog_id' => $blog->id,
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $blog->increment('likes');
            $status = 'liked';
        }

        return response()->json([
            'likes' => $blog->likes,
            'status' => $status
        ]);
    }
}

