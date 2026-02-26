<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // pastikan ada user
        $user = User::first();

        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
            ]);
        }

        $data = [
            [
                'judul' => 'Tips Memilih Kos Nyaman untuk Mahasiswa Baru',
                'ringkasan' => 'Panduan lengkap memilih kos yang nyaman dan aman.',
                'isi' => 'Memilih kos adalah langkah penting bagi mahasiswa baru. Pastikan lokasi strategis, keamanan baik, dan fasilitas lengkap.',
                'gambar' => 'blog/1QgRM4UWIjoX8voAjeURRSpxrtSZwHOQouX5xB8y.jpg',
                'status' => 'published',
            ],
            [
                'judul' => '5 Fasilitas Kos yang Wajib Ada di Tahun 2026',
                'ringkasan' => 'Fasilitas penting seperti WiFi dan keamanan.',
                'isi' => 'Kos modern harus menyediakan WiFi cepat, CCTV, parkir aman, dan fasilitas pendukung lainnya.',
                'gambar' => 'blog/8MnAp9Whg6sfQCxlWoZyGMENhoD3wGKAMGscTK56.jpg',
                'status' => 'published',
            ],
            [
                'judul' => 'Cara Menghemat Biaya Hidup Saat Tinggal di Kos',
                'ringkasan' => 'Tips praktis menghemat pengeluaran.',
                'isi' => 'Memasak sendiri, hemat listrik, dan mengatur keuangan sangat membantu.',
                'gambar' => 'blog/13n9YuwtQX00zJ52t35K4xN2p7qALy3x0Rs49JIP.jpg',
                'status' => 'draft',
            ],
            [
                'judul' => 'Keuntungan Tinggal di Kos Dekat Kampus',
                'ringkasan' => 'Dekat kampus hemat waktu dan tenaga.',
                'isi' => 'Kos dekat kampus sangat memudahkan aktivitas mahasiswa.',
                'gambar' => 'blog/DXPr9xXTnQo5RRTSYRVdzSEV4JH3kWmVGUhLssN6.png',
                'status' => 'published',
            ],
            [
                'judul' => 'Tips Menata Kamar Kos Agar Terlihat Lebih Luas',
                'ringkasan' => 'Gunakan furniture minimalis.',
                'isi' => 'Furniture multifungsi membuat kamar terasa luas.',
                'gambar' => 'blog/KgeLh1ooE75aQopZaDye9ef9nfs1am1bmCnRodoH.jpg',
                'status' => 'published',
            ],
        ];

        foreach ($data as $item) {

            Blog::create([
                'user_id' => $user->id,
                'judul' => $item['judul'],
                'slug' => Str::slug($item['judul']),
                'gambar' => $item['gambar'],
                'ringkasan' => $item['ringkasan'],
                'isi' => $item['isi'],
                'tanggal_terbit' => null,
                'published_at' => Carbon::now(),
                'status' => $item['status'],
                'views' => rand(0, 100),
                'likes' => rand(0, 20),
            ]);

        }
    }
}