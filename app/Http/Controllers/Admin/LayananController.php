<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Models\Kos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LayananController extends Controller
{

    public function index()
    {
        $layanan = Layanan::whereHas('kos', function ($q) {
            $q->where('owner_id', Auth::id());
        })
        ->with('kos')
        ->latest()
        ->get();

        return view('admin.layanan.index', compact('layanan'));
    }


    public function create()
    {
        $kos = Kos::where('owner_id', Auth::id())->get();

        return view('admin.layanan.create', compact('kos'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'kos_id' => 'required',
            'nama_layanan' => 'required',
            'harga' => 'required|numeric'
        ]);

        Layanan::create([
            'kos_id' => $request->kos_id,
            'nama_layanan' => $request->nama_layanan,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()->route('admin.layanan.index')
            ->with('success','Layanan berhasil ditambahkan');
    }


    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);

        if ($layanan->kos->owner_id != Auth::id()) {
            abort(403);
        }

        $kos = Kos::where('owner_id', Auth::id())->get();

        return view('admin.layanan.edit', compact('layanan','kos'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'kos_id' => 'required',
            'nama_layanan' => 'required',
            'harga' => 'required|numeric'
        ]);

        $layanan = Layanan::findOrFail($id);

        if ($layanan->kos->owner_id != Auth::id()) {
            abort(403);
        }

        $layanan->update([
            'kos_id' => $request->kos_id,
            'nama_layanan' => $request->nama_layanan,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('admin.layanan.index')
            ->with('success','Layanan berhasil diupdate');
    }


    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);

        if ($layanan->kos->owner_id != Auth::id()) {
            abort(403);
        }

        $layanan->delete();

        return redirect()->route('admin.layanan.index')
            ->with('success','Layanan berhasil dihapus');
    }

}