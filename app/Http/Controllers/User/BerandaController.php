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
    $tipeKamar   = request('tipe_kamar');
    $statusKamar = request('status_kamar');
    $jenisSewa   = request('jenis_sewa');

    $kosQuery = Kos::with(['primaryImage', 'kamars', 'likesUsers'])
        ->withCount('likesUsers');

    // Filter Tipe Kamar
    if ($tipeKamar) {
        $kosQuery->whereHas('kamars', function ($q) use ($tipeKamar) {
            $q->where('tipe_kamar', $tipeKamar);
        });
    }

    // Filter Status Kamar
    if ($statusKamar) {
        if ($statusKamar === 'Tersedia') {
            $kosQuery->whereHas('kamars', function ($q) {
                $q->where('status', 'Tersedia');
            });
        } elseif ($statusKamar === 'tidakTersedia') {
            $kosQuery->whereDoesntHave('kamars', function ($q) {
                $q->where('status', 'Tersedia');
            });
        }
    }

    
    if ($jenisSewa) {
        $kosQuery->where('jenis_sewa', $jenisSewa);
    }





        // Ambil hasil akhir, urut berdasarkan likes terbanyak
        $kosUnggulan = $kosQuery->orderBy('likes_users_count', 'desc')->get();

        // Ambil galeri terbaru
        $galeriTerbaru = Galeri::latest()->take(8)->get();

        // Ambil review terbaru
        $reviewTerbaru = Review::with('user', 'kos')->latest()->take(4)->get();

        // Ambil blog terbaru
        $blogs = Blog::with('author')
            ->whereNotNull('published_at')
            ->latest('published_at')
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
