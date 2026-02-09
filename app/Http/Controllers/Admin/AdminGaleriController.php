<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class AdminGaleriController extends Controller
{
    public function index(Request $request)
    {
        $galeris = Galeri::when($request->search, function ($q) use ($request) {
            $q->where('judul', 'like', '%' . $request->search . '%');
        })
            ->latest()
            ->paginate(10);

        return view('admin.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'             => 'required|string|max:255',
            'slug'              => 'nullable|string|max:255|unique:galeris,slug',
            'deskripsi_singkat' => 'required|string|max:255',
            'gambar'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $galeri = new Galeri();
        $galeri->judul = $request->judul;
        $galeri->slug = $request->slug ?? Str::slug($request->judul);
        $galeri->deskripsi_singkat = $request->deskripsi_singkat;

        if ($request->hasFile('gambar')) {
            $galeri->gambar = $request->file('gambar')->store('galeri', 'public');
        }

        $galeri->save();

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil ditambahkan');
    }

    public function show(Galeri $galeri)
    {
        return view('admin.galeri.show', compact('galeri'));
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'judul'             => 'required|string|max:255',
            'slug'              => 'nullable|string|max:255|unique:galeris,slug,' . $galeri->id,
            'deskripsi_singkat' => 'required|string|max:255',
            'gambar'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Jika upload gambar baru
        if ($request->hasFile('gambar')) {

            // hapus gambar lama
            if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
                Storage::disk('public')->delete($galeri->gambar);
            }

            $galeri->gambar = $request->file('gambar')->store('galeri', 'public');
        }

        $galeri->update([
            'judul'             => $request->judul,
            'slug'              => $request->slug ?? Str::slug($request->judul),
            'deskripsi_singkat' => $request->deskripsi_singkat,
        ]);

        return redirect()
            ->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil diperbarui');
    }

    public function destroy(Galeri $galeri)
    {
        // hapus file gambar
        if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
            Storage::disk('public')->delete($galeri->gambar);
        }

        $galeri->delete();

        return back()->with('success', 'Galeri berhasil dihapus');
    }
}
