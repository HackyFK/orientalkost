<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\KamarImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminKamarImageController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $items = Kamar::with(['kos'])
            ->when($user->role === 'owner', function ($q) use ($user) {
                $q->whereHas('kos', function ($sub) use ($user) {
                    $sub->where('owner_id', $user->id);
                });
            })
            ->latest()
            ->paginate(10);

        return view('admin.kamar-images.index', compact('items'));
    }

    public function show(Kamar $kamar)
    {
        if (
            Auth::user()->role === 'owner' &&
            $kamar->kos->owner_id !== Auth::id()
        ) {
            abort(403);
        }

        $kamar->load('images', 'kos');

        return view('admin.kamar-images.show', compact('kamar'));
    }

    public function store(Request $request, Kamar $kamar)
    {
        if (
            Auth::user()->role === 'owner' &&
            $kamar->kos->owner_id !== Auth::id()
        ) {
            abort(403);
        }

        $currentCount = $kamar->images()->count();
        $maxImages = 9;

        // Kalau sudah 9, langsung tolak
        if ($currentCount >= $maxImages) {
            return back()->with('error', 'Maksimal 9 gambar per kamar.');
        }

        $request->validate([
            'images'   => 'required|array',
            'images.*' => 'image|max:2048'
        ]);

        $uploadCount = count($request->file('images'));
        $remaining = $maxImages - $currentCount;

        // Kalau upload melebihi sisa slot
        if ($uploadCount > $remaining) {
            return back()->with(
                'error',
                "Sisa slot gambar hanya {$remaining}. Maksimal 9 gambar per kamar."
            );
        }

        foreach ($request->file('images') as $image) {

            $path = $image->store('kamar', 'public');

            $hasPrimary = $kamar->images()
                ->where('is_primary', true)
                ->exists();

            KamarImage::create([
                'kamar_id'  => $kamar->id,
                'image_path' => $path,
                'is_primary' => !$hasPrimary
            ]);
        }

        return back()->with('success', 'Gambar berhasil ditambahkan');
    }

    public function setPrimary(Kamar $kamar, KamarImage $image)
    {
        if ($image->kamar_id !== $kamar->id) abort(404);

        KamarImage::where('kamar_id', $kamar->id)
            ->update(['is_primary' => false]);

        $image->update(['is_primary' => true]);

        return back()->with('success', 'Primary image diperbarui');
    }

    public function destroy(Kamar $kamar, KamarImage $image)
    {
        if ($image->kamar_id !== $kamar->id) abort(404);

        $wasPrimary = $image->is_primary;

        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        if ($wasPrimary) {
            $next = KamarImage::where('kamar_id', $kamar->id)->first();
            if ($next) {
                $next->update(['is_primary' => true]);
            }
        }

        return back()->with('success', 'Gambar dihapus');
    }
}
