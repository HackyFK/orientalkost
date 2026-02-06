<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use App\Models\KosImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminKosController extends Controller
{
    public function index()
    {
        return view('admin.kos.index', [
            'items' => Kos::with('primaryImage')->latest()->get()
        ]);
    }


    public function create()
    {
        return view('admin.kos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kos'   => 'required|min:3|unique:kos,nama_kos',
            'alamat'     => 'required',
            'jenis_sewa' => 'required|in:bulanan,tahunan',
            'images.*'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ], [
            'nama_kos.required' => 'Nama kos wajib diisi.',
            'nama_kos.min'      => 'Nama kos minimal 3 karakter.',
            'nama_kos.unique'   => 'Nama kos sudah digunakan, silakan gunakan nama lain.'
        ]);

        $data['slug'] = Str::slug($data['nama_kos']);

        $kos = Kos::create($data);

        // === MULTI IMAGE UPLOAD ===
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('kos', 'public');

                KosImage::create([
                    'kos_id'     => $kos->id,
                    'image_path' => $path,
                    'is_primary' => $index === 0 // gambar pertama = primary
                ]);
            }
        }

        return redirect()
            ->route('admin.kos.index')
            ->with('success', 'Kos berhasil dibuat');
    }


    public function edit(Kos $ko)
    {
        $ko->load('images');
        return view('admin.kos.edit', compact('ko'));
    }


    public function update(Request $request, Kos $ko)
    {
        $data = $request->validate([
            'nama_kos'   => 'required|unique:kos,nama_kos,' . $ko->id,
            'alamat'     => 'required',
            'jenis_sewa' => 'required',
            'images.*'   => 'nullable|image'
        ], [
            'nama_kos.required' => 'Nama kos wajib diisi.',
            'nama_kos.min'      => 'Nama kos minimal 3 karakter.',
            'nama_kos.unique'   => 'Nama kos sudah digunakan, silakan gunakan nama lain.'
        ]);

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

        return redirect()
            ->route('admin.kos.index')
            ->with('success', 'Kos berhasil diupdate');
    }

    public function destroy(Kos $ko)
    {
        $ko->delete();
        return back()->with('success', 'Kos berhasil dihapus');
    }

    public function deleteImage(KosImage $image)
    {
        $kos = $image->kos;

        // hapus file
        Storage::disk('public')->delete($image->image_path);

        $wasPrimary = $image->is_primary;

        // hapus db
        $image->delete();

        // jika primary dihapus → set primary baru
        if ($wasPrimary) {
            $newPrimary = $kos->images()->first();
            if ($newPrimary) {
                $newPrimary->update(['is_primary' => true]);
            }
        }

        return back()->with('success', 'Gambar berhasil dihapus');
    }

    public function setPrimaryImage(KosImage $image)
    {
        $image->kos->images()->update(['is_primary' => false]);
        $image->update(['is_primary' => true]);

        return back()->with('success', 'Primary image diubah');
    }
}
