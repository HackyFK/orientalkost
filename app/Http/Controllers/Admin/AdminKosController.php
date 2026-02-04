<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminKosController extends Controller
{
    public function index()
    {
        return view('admin.kos.index', [
            'items' => Kos::latest()->get()
        ]);
    }

    public function create()
    {
        return view('admin.kos.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_kos' => 'required|min:3',
            'alamat' => 'required',
            'jenis_sewa' => 'required|in:bulanan,tahunan'
        ]);

        $data['slug'] = Str::slug($data['nama_kos']);

        Kos::create($data);

        return redirect()->route('kos.index')->with('success', 'Kos berhasil dibuat');
    }

    public function edit(Kos $ko)
    {
        return view('admin.kos.edit', compact('ko'));
    }

    public function update(Request $request, Kos $ko)
    {
        $ko->update($request->all());
        return redirect()->route('admin.kos.index')->with('success', 'Kos berhasil diupdate');
    }

    public function destroy(Kos $ko)
    {
        $ko->delete();
        return back()->with('success', 'Kos berhasil dihapus');
    }
}
