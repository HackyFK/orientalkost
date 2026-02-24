<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
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

        $query = Kos::with(['primaryImage', 'kamars.fasilitas']);

        if ($request->jenis_kos) {
            $query->where('jenis_kos', $request->jenis_kos);
        }

        if ($request->status) {
            $query->whereHas('kamars', function ($q) use ($request) {
                $q->where('status', $request->status);
            });
        }

        if ($request->fasilitas) {
            $query->whereHas('kamars.fasilitas', function ($q) use ($request) {
                $q->where('nama', $request->fasilitas);
            });
        }

        $kos = $query
            ->latest()
            ->paginate(2)
            ->withQueryString();

        return view('user.kos.index', compact('kos', 'settings'));
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
            ->paginate(2)
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
