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
            'items' => Kos::with('images')->latest()->get()
        ]);
    }


    public function create()
    {
        return view('admin.kos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kos'   => 'required|min:3',
            'alamat'     => 'required',
            'jenis_sewa' => 'required|in:bulanan,tahunan',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data['slug'] = Str::slug($data['nama_kos']);

        $kos = Kos::create($data);

        // === UPLOAD IMAGE ===
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('kos', 'public');

            KosImage::create([
                'kos_id'     => $kos->id,
                'image_path' => $path,
                'is_primary' => true,
            ]);
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
            'nama_kos' => 'required',
            'alamat' => 'required',
            'jenis_sewa' => 'required',
            'image' => 'nullable|image'
        ]);

        $ko->update($data);

        if ($request->hasFile('image')) {
            // hapus image lama
            if ($old = $ko->images()->where('is_primary', true)->first()) {
                Storage::disk('public')->delete($old->image_path);
                $old->delete();
            }

            $path = $request->file('image')->store('kos', 'public');

            KosImage::create([
                'kos_id' => $ko->id,
                'image_path' => $path,
                'is_primary' => true
            ]);
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
}
