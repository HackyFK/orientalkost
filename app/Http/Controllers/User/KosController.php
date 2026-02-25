<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use App\Models\Kos;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KosController extends Controller
{
    public function index(Request $request)
{
    $settingsRaw = Setting::all();
    $settings = new \stdClass();
    foreach ($settingsRaw as $item) {
        $settings->{$item->key} = $item->value;
    }

    $query = Kos::with([
        'primaryImage',
        'kamars.fasilitas',
        'owner' // pastikan ada relasi owner
    ])
    ->withCount([
        'kamars as jumlah_kamar',
        'kamars as kamar_tersedia' => function ($q) {  
            $q->where('status', 'tersedia');
        }
    ]);

    // 🔎 GLOBAL SEARCH
    if ($request->filled('q')) {
        $search = $request->q;

        $query->where(function($q) use ($search) {
            $q->where('nama_kos', 'like', "%{$search}%")
              ->orWhere('alamat', 'like', "%{$search}%")
              ->orWhere('jenis_sewa', 'like', "%{$search}%")
              ->orWhere('gender', 'like', "%{$search}%")
              ->orWhereHas('owner', function ($q2) use ($search) {
                  $q2->where('name', 'like', "%{$search}%");
              });
        });
    }

    // 🔎 FILTER LAIN (jenis_kos/gender, status, fasilitas)
    if ($request->filled('jenis_kos')) {
        $query->where('gender', $request->jenis_kos);
    }

    if ($request->filled('status')) {
        if ($request->status == 'tersedia') {
            $query->whereHas('kamars', fn($q) => $q->where('status', 'tersedia'));
        }
        if ($request->status == 'penuh') {
            $query->whereDoesntHave('kamars', fn($q) => $q->where('status', 'tersedia'));
        }
    }

    if ($request->filled('fasilitas1')) {
        $query->whereHas('kamars.fasilitas', fn($q) => $q->where('nama_fasilitas', $request->fasilitas1));
    }

    if ($request->filled('fasilitas2')) {
        $query->whereHas('kamars.fasilitas', fn($q) => $q->where('nama_fasilitas', $request->fasilitas2));
    }

    $kos = $query->latest()->paginate(10)->withQueryString();
    $fasilitasList = Fasilitas::orderBy('nama_fasilitas')->get();

    $noResult = $kos->isEmpty(); // untuk pesan "Data Kos tidak ditemukan"

    return view('user.kos.index', compact('kos', 'settings', 'fasilitasList', 'noResult'));
}


    public function show(Request $request, Kos $kos)
    {
        $settingsRaw = Setting::all();

        $settings = new \stdClass();

        foreach ($settingsRaw as $item) {
            $settings->{$item->key} = $item->value;
        }
        $query = $kos->kamars()->with(['primaryImage', 'fasilitas']);

        // 🔎 Filter tipe kamar
        if ($request->filled('tipe')) {
            $query->where('tipe_kamar', $request->tipe);
        }

        // 🔎 Filter status kamar
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // 🔎 Filter harga bulanan
        if ($request->harga == 1) {
            $query->where('harga_bulanan', '<', 1000000);
        }

        if ($request->harga == 2) {
            $query->whereBetween('harga_bulanan', [1000000, 2000000]);
        }

        if ($request->harga == 3) {
            $query->whereBetween('harga_bulanan', [2000000, 3000000]);
        }

        if ($request->harga == 4) {
            $query->where('harga_bulanan', '>', 3000000);
        }

        $kamars = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('user.kos.kamar', compact('kos', 'kamars', 'settings'));
    }
    public function like(Kos $kos)
    {
        $user = Auth::user();

        // Cek apakah user sudah like
        $alreadyLiked = $kos->likesUsers()
            ->where('user_id', $user->id)
            ->exists();

        if ($alreadyLiked) {
            // UNLIKE
            $kos->likesUsers()->detach($user->id);
            $kos->decrement('likes');
            $liked = false;
        } else {
            // LIKE
            $kos->likesUsers()->attach($user->id);
            $kos->increment('likes');
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'likes' => $kos->likes
        ]);
    }
}
