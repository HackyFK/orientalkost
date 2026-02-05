<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class AdminFasilitasController extends Controller
{
    public function index()
    {
        $fasilitas = Fasilitas::orderBy('kategori')
            ->orderBy('nama_fasilitas')
            ->get()
            ->groupBy('kategori');

        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    public function create()
    {
        return view('admin.fasilitas.create', [
            'kategoriList' => $this->kategoriList()
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_fasilitas' => 'required|string|max:100',
            'icon'           => 'nullable|string|max:50',
            'kategori'       => 'required|string|max:50',
        ]);

        $data['icon'] = $this->normalizeIcon($data['icon'] ?? null);

        Fasilitas::create($data);

        return redirect()
            ->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil ditambahkan');
    }

    public function edit(Fasilitas $fasilita)
    {
        return view('admin.fasilitas.edit', [
            'fasilita' => $fasilita,
            'kategoriList' => $this->kategoriList()
        ]);
    }

    public function update(Request $request, Fasilitas $fasilita)
    {
        $data = $request->validate([
            'nama_fasilitas' => 'required|string|max:100',
            'icon'           => 'nullable|string|max:50',
            'kategori'       => 'required|string|max:50',
        ]);

        $data['icon'] = $this->normalizeIcon($data['icon'] ?? null);

        $fasilita->update($data);

        return redirect()
            ->route('admin.fasilitas.index')
            ->with('success', 'Fasilitas berhasil diperbarui');
    }

    public function destroy(Fasilitas $fasilita)
    {
        $fasilita->delete();

        return back()->with('success', 'Fasilitas berhasil dihapus');
    }

    /**
     * NORMALISASI ICON FONT AWESOME
     * Input : tv / fa-tv / fa-solid fa-tv
     * Output: fa-solid fa-tv
     */
    private function normalizeIcon(?string $icon): ?string
    {
        if (! $icon) {
            return null;
        }

        $icon = trim($icon);

        if (str_contains($icon, 'fa-solid')) {
            return $icon;
        }

        $icon = str_replace(['fa-solid', 'fa-'], '', $icon);

        return 'fa-solid fa-' . $icon;
    }

    /**
     * DAFTAR KATEGORI (SINGLE SOURCE OF TRUTH)
     */
    private function kategoriList(): array
    {
        return [
            'dalam_kamar'   => 'Fasilitas Dalam Kamar',
            'kamar_mandi'   => 'Kamar Mandi',
            'dapur'         => 'Dapur & Makan',
            'utilitas'      => 'Utilitas & Teknis',
            'laundry'       => 'Laundry & Kebersihan',
            'parkir'        => 'Parkir & Akses',
            'keamanan'      => 'Keamanan',
            'area_bersama'  => 'Area Bersama',
            'khusus'        => 'Khusus & Unik',
        ];
    }
}
