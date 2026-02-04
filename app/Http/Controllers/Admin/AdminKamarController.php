<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Kos;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class AdminKamarController extends Controller
{
    public function index()
    {
        return view('admin.kamar.index', [
            'items' => Kamar::with('kos')->latest()->get()
        ]);
    }

    public function create()
    {
        return view('admin.kamar.create', [
            'kos' => Kos::all(),
            'fasilitas' => Fasilitas::all()
        ]);
    }

    public function store(Request $request)
    {
        $kamar = Kamar::create($request->all());
        $kamar->fasilitas()->sync($request->fasilitas);

        return redirect()->route('admin.kamar.index')->with('success','Kamar ditambahkan');
    }
}
