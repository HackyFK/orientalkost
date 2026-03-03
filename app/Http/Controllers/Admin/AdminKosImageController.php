<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use App\Models\KosImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminKosImageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $items = Kos::with(['owner', 'images'])
            ->when($user->role === 'owner', function ($q) use ($user) {
                $q->where('owner_id', $user->id);
            })
            ->latest()
            ->paginate(10);

        return view('admin.kos-images.index', compact('items'));
    }

    public function show(Kos $kos)
    {
        if (Auth::user()->role === 'owner' && $kos->owner_id !== Auth::id()) {
            abort(403);
        }

        $kos->load('images', 'owner');

        return view('admin.kos-images.show', compact('kos'));
    }

    public function store(Request $request, Kos $kos)
    {
        if (Auth::user()->role === 'owner' && $kos->owner_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'images.*' => 'required|image|max:2048'
        ]);

        foreach ($request->file('images') as $image) {

            $path = $image->store('kos', 'public');

            $hasPrimary = $kos->images()->where('is_primary', true)->exists();

            KosImage::create([
                'kos_id' => $kos->id,
                'image_path' => $path,
                'is_primary' => !$hasPrimary
            ]);
        }

        return back()->with('success', 'Gambar berhasil ditambahkan');
    }

    public function setPrimary(Kos $kos, KosImage $image)
    {
        if ($image->kos_id !== $kos->id) abort(404);

        KosImage::where('kos_id', $kos->id)
            ->update(['is_primary' => false]);

        $image->update(['is_primary' => true]);

        return back()->with('success', 'Primary image diperbarui');
    }

    public function destroy(Kos $kos, KosImage $image)
    {
        if ($image->kos_id !== $kos->id) abort(404);

        $wasPrimary = $image->is_primary;

        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        if ($wasPrimary) {
            $next = KosImage::where('kos_id', $kos->id)->first();
            if ($next) {
                $next->update(['is_primary' => true]);
            }
        }

        return back()->with('success', 'Gambar dihapus');
    }
}
