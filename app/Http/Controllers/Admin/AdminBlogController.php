<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminBlogController extends Controller
{
    public function index(Request $request)
    {
        $blogs = Blog::when($request->search, function ($q) use ($request) {
            $q->where('judul', 'like', '%' . $request->search . '%');
        })
            ->when($request->status, function ($q) use ($request) {
                $q->where('status', $request->status);
            })
           ->latest()
            ->paginate(4)
            ->withQueryString();

        return view('admin.blog.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'        => 'required|string|max:255',
            'slug'         => 'nullable|string|max:255|unique:blogs,slug',
            'ringkasan'    => 'required|string|max:255',
            'gambar'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'isi'          => 'required',
            'published_at' => 'required|date',
        ]);

        // upload gambar
        $path = null;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('blog', 'public');
        }

        Blog::create([
            'user_id'      => Auth::id(),
            'judul'        => $request->judul,
            'slug'         => $request->slug ?? Str::slug($request->judul),
            'ringkasan'    => $request->ringkasan,
            'gambar'       => $path,
            'isi'          => $request->isi,
            'status' => 'draft',
            'published_at' => $request->published_at,
            'views'        => 0,
        ]);

        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Blog berhasil ditambahkan');
    }

    public function show(Blog $blog)
    {
        return view('admin.blog.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        return view('admin.blog.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'judul'        => 'required|string|max:255',
            'slug'         => 'nullable|string|max:255|unique:blogs,slug,' . $blog->id,
            'ringkasan'    => 'required|string|max:255',
            'gambar'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'isi'          => 'required',
            'published_at' => 'required|date',
        ]);

        $path = $blog->gambar;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('blog', 'public');
        }

        $blog->update([
            'judul'        => $request->judul,
            'slug'         => $request->slug ?? Str::slug($request->judul),
            'ringkasan'    => $request->ringkasan,
            'gambar'       => $path,
            'isi'          => $request->isi,
            'published_at' => $request->published_at,
        ]);

        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Blog berhasil diperbarui');
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return back()->with('success', 'Blog berhasil dihapus');
    }

    public function publish(Blog $blog)
    {
        $blog->update([
            'status' => 'published',
            'published_at' => now(),
        ]);

        return response()->json(['success' => true]);
    }

    public function unpublish(Blog $blog)
    {
        $blog->update([
            'status' => 'draft',
            'published_at' => null,
        ]);

        return response()->json(['success' => true]);
    }
}
