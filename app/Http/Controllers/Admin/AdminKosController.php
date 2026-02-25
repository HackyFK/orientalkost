<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use App\Models\KosImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminKosController extends Controller
{
    public function index()
    {
          $items = Kos::with(['primaryImage', 'owner'])
         ->latest()
        ->paginate(2)
        ->withQueryString();

    return view('admin.kos.index', compact('items'));
    }

    public function create()
    {
        $owners = User::where('role', 'owner')->get();
        return view('admin.kos.create', compact('owners'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kos'   => 'required|min:3|unique:kos,nama_kos',
            'deskripsi'  => 'nullable',
            'alamat'     => 'required',
            'latitude'   => 'nullable|numeric',
            'longitude'  => 'nullable|numeric',
            'jenis_sewa' => 'required|in:bulanan,tahunan',
             // TAMBAHAN
            'gender'     => 'required|in:putra,putri,campuran',
            'owner_id'   => 'nullable|exists:users,id',
            'images.*'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data['slug'] = Str::slug($data['nama_kos']);

        $kos = Kos::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $i => $image) {
                $path = $image->store('kos', 'public');

                KosImage::create([
                    'kos_id'     => $kos->id,
                    'image_path' => $path,
                    'is_primary' => $i === 0
                ]);
            }
        }

        return redirect()->route('admin.kos.index')->with('success', 'Kos berhasil dibuat');
    }

    public function edit(Kos $ko)
    {
        $ko->load('images');
        $owners = User::where('role', 'owner')->get();
        return view('admin.kos.edit', compact('ko', 'owners'));
    }

    public function update(Request $request, Kos $ko)
    {
        $data = $request->validate([
            'nama_kos'   => 'required|min:3|unique:kos,nama_kos,' . $ko->id,
            'deskripsi'  => 'nullable',
            'alamat'     => 'required',
            'latitude'   => 'nullable|numeric',
            'longitude'  => 'nullable|numeric',
            'jenis_sewa' => 'required|in:bulanan,tahunan',
            'owner_id'   => 'nullable|exists:users,id',
             // TAMBAHAN
            'gender'     => 'required|in:putra,putri,campuran',
            'images.*'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data['slug'] = Str::slug($data['nama_kos']);

        $ko->update($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('kos', 'public');

                KosImage::create([
                    'kos_id'     => $ko->id,
                    'image_path' => $path,
                    'is_primary' => false
                ]);
            }
        }

        return redirect()->route('admin.kos.index')->with('success', 'Kos berhasil diperbarui');
    }

    public function destroy(Kos $ko)
    {
        $ko->delete();
        return back()->with('success', 'Kos berhasil dihapus');
    }

    public function deleteImage(KosImage $image)
    {
        Storage::disk('public')->delete($image->image_path);

        $kos = $image->kos;
        $wasPrimary = $image->is_primary;

        $image->delete();

        if ($wasPrimary) {
            $kos->images()->first()?->update(['is_primary' => true]);
        }

        return back()->with('success', 'Gambar dihapus');
    }

    public function setPrimaryImage(KosImage $image)
    {
        $image->kos->images()->update(['is_primary' => false]);
        $image->update(['is_primary' => true]);

        return back()->with('success', 'Primary image diubah');
    }

   
}
