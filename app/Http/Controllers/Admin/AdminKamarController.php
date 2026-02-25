<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use App\Models\Kamar;
use App\Models\KamarImage;
use App\Models\Kos;
use Illuminate\Http\Request;

class AdminKamarController extends Controller
{

    public function index(Request $request)
    {
        $kosId = $request->kos_id;
        $sort  = $request->sort;

        // ambil semua kos untuk dropdown
        $allKos = Kos::orderBy('nama_kos')->get();

        // query dasar → tampilkan semua kamar dulu
        $query = Kamar::with(['kos', 'fasilitas']);

        // filter kos jika dipilih
        if ($kosId) {
            $query->where('kos_id', $kosId);
        }

        // sort kamar
        if ($sort == 'harga_asc') {
            $query->orderBy('harga_bulanan', 'asc');
        } elseif ($sort == 'harga_desc') {
            $query->orderBy('harga_bulanan', 'desc');
        } elseif ($sort == 'nama') {
            $query->orderBy('nama_kamar', 'asc');
        } else {
            $query->latest();
        }

        // ambil data
        $items = $query
        ->latest()
        ->paginate(9)
        ->withQueryString();

        return view('admin.kamar.index', compact('items', 'allKos'));
    }


    public function create()
    {
        return view('admin.kamar.create', [
            'kos' => Kos::orderBy('nama_kos')->get(),
            'fasilitas' => Fasilitas::orderBy('nama_fasilitas')
                ->get()
                ->groupBy('kategori'),
        ]);
    }



    public function store(Request $request)
    {
        // 1️⃣ VALIDASI
        $data = $request->validate([
            'kos_id'         => 'required|exists:kos,id',
            'nama_kamar'     => 'required|min:3',
            'tipe_kamar'     => 'required',
            'lantai'         => 'nullable|integer',
            'nomor_kamar'    => 'nullable|string',
            'deskripsi'      => 'nullable|string',
            'panjang'        => 'nullable|numeric|min:1|max:50',
            'lebar'          => 'nullable|numeric|min:1|max:50',
            'harga_harian'  => 'nullable|numeric',
            'harga_bulanan'  => 'nullable|numeric',
            'harga_tahunan'  => 'nullable|numeric',
            'fasilitas' => 'nullable|array',
            'status'         => 'required|in:tersedia,terisi',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // 2️⃣ SIMPAN KAMAR
        $kamar = Kamar::create($data);

        // 3️⃣ UPLOAD GAMBAR UTAMA
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('kamar', 'public');

            KamarImage::create([
                'kamar_id'  => $kamar->id,
                'image_path' => $path,
                'is_primary' => true
            ]);
        }

        // 4️⃣ SIMPAN FASILITAS (PIVOT)
        if ($request->has('fasilitas')) {
            $kamar->fasilitas()->sync($request->fasilitas);
        }


        return redirect()
            ->route('admin.kamar.index')
            ->with('success', 'Kamar berhasil ditambahkan');
    }

    public function edit(Kamar $kamar)
    {
        return view('admin.kamar.edit', [
            'kamar' => $kamar->load('fasilitas'),
            'kos'   => Kos::orderBy('nama_kos')->get(),
            'fasilitas' => Fasilitas::orderBy('nama_fasilitas')
                ->get()
                ->groupBy('kategori'),
        ]);
    }



    public function update(Request $request, Kamar $kamar)
    {
        $data = $request->validate([
            'kos_id'         => 'required|exists:kos,id',
            'nama_kamar'     => 'required|min:3',
            'tipe_kamar'     => 'required',
            'lantai'         => 'nullable|integer',
            'nomor_kamar'    => 'nullable|string',
            'deskripsi'      => 'nullable|string',
            'panjang'        => 'nullable|numeric|min:1|max:50',
            'lebar'          => 'nullable|numeric|min:1|max:50',
            'harga_harian'  => 'nullable|numeric',
            'harga_bulanan'  => 'nullable|numeric',
            'harga_tahunan'  => 'nullable|numeric',
            'fasilitas' => 'nullable|array',
            'status'         => 'required|in:tersedia,terisi',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $kamar->update($data);
        $kamar->fasilitas()->sync($request->fasilitas ?? []);

        // GANTI GAMBAR UTAMA JIKA ADA
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('kamar', 'public');

            $kamar->images()->update(['is_primary' => false]);

            $kamar->images()->create([
                'image_path' => $path,
                'is_primary' => true
            ]);
        }

        return redirect()
            ->route('admin.kamar.index')
            ->with('success', 'Kamar berhasil diupdate');
    }

    public function destroy(Kamar $kamar)
    {
        $kamar->delete();

        return back()->with('success', 'Kamar berhasil dihapus');
    }

    public function show(Kamar $kamar)
{
    $kamar->load([
        'kos',
        'fasilitas',
        'images'
    ]);

    return view('admin.kamar.show', compact('kamar'));
}
}
