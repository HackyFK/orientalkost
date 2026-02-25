<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use App\Models\Galeri;
use App\Models\Review;
use App\Models\Blog;
use App\Models\Fasilitas;
use App\Models\Kamar;
use App\Models\WebsiteProfile;

class BerandaController extends Controller
{
    public function index()
    {
        // Ambil filter dari request
        $ownerId    = request('owner_id');
        $namaKos    = request('nama_kos');
        $alamat     = request('alamat');
        $jenisSewa  = request('jenis_sewa');
        $gender     = request('gender');

        $search = request('q');

        $kosQuery = Kos::with(['primaryImage', 'kamars', 'likesUsers'])
            ->withCount('likesUsers');

        if ($search) {
            $kosQuery->where(function ($query) use ($search) {
                $query->where('nama_kos', 'like', "%{$search}%")
                    ->orWhere('alamat', 'like', "%{$search}%")
                    ->orWhere('jenis_sewa', 'like', "%{$search}%")
                    ->orWhere('gender', 'like', "%{$search}%")
                    ->orWhereHas('owner', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        }

        $kosUnggulan = $kosQuery->orderBy('likes_users_count', 'desc')->paginate(10)->withQueryString();
        $noResult = $kosUnggulan->isEmpty();

        // Ambil hasil akhir
        $kosUnggulan = $kosQuery->orderBy('likes_users_count', 'desc')->paginate(10)->withQueryString();

        $noResult = $kosUnggulan->isEmpty(); // jika tidak ada hasil

        // Ambil galeri terbaru
        $galeriTerbaru = Galeri::latest()->take(8)->get();

        // Ambil review terbaru
        $reviewTerbaru = Review::with(['user', 'kamar.kos'])
            ->where('status', 'approved')
            ->latest()
            ->take(4)
            ->get();

        // Ambil blog terbaru yang sudah published
        $blogs = Blog::with('author')
            ->where('status', 'published')
            ->latest()
            ->take(6)
            ->get();

        // Rating global
        $averageRating = Review::avg('rating') ?? 0;
        $totalReview   = Review::count();

        // Website profile
        $profile = WebsiteProfile::first();

        // Fasilitas
        $fasilitasTampil = [
            'AC',
            'WiFi',
            'Parkir',
            'Water Heater',
            'Kulkas Mini',
            'TV',
            'Kamar Mandi Luar',
            'Kamar Mandi Dalam',
            'Bathtub'
        ];

        $jumlahFasilitas = Fasilitas::whereIn('nama_fasilitas', $fasilitasTampil)
            ->withCount('kamars')
            ->get()
            ->keyBy('nama_fasilitas');

        // Tipe kamar unik
        $tipeKamarAll = Kamar::select('tipe_kamar')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('tipe_kamar')
            ->get();

        $iframe1 = $this->youtubeEmbed($profile->iframe_1 ?? null);
        $iframe2 = $this->youtubeEmbed($profile->iframe_2 ?? null);

        return view('user.beranda.index', compact(
            'kosUnggulan',
            'galeriTerbaru',
            'reviewTerbaru',
            'blogs',
            'averageRating',
            'totalReview',
            'profile',
            'tipeKamarAll',
            'jumlahFasilitas',
            'iframe1',
            'iframe2',
            'noResult' // tambah ini untuk pesan "Data Kos tidak ditemukan"
        ));
    }

    private function youtubeEmbed($url)
    {
        if (!$url) return null;

        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/', $url, $matches);

        if (!isset($matches[1])) return null;

        return "https://www.youtube.com/embed/" . $matches[1];
    }
}
