<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class AdminFasilitasController extends Controller
{
    public function index()
    {
        return view('admin.fasilitas.index', [
            'items' => Fasilitas::all()
        ]);
    }

    public function store(Request $request)
    {
        Fasilitas::create($request->all());
        return back()->with('success','Fasilitas ditambahkan');
    }

    public function destroy(Fasilitas $fasilita)
    {
        $fasilita->delete();
        return back();
    }
}
