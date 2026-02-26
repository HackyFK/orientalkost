<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WebsiteProfile;

class WebsiteProfileSeeder extends Seeder
{
    public function run(): void
    {
        WebsiteProfile::updateOrCreate(
            ['id' => 1], // supaya tidak duplicate
            [

                'description' => 'KosKu adalah penyedia layanan kos modern terpercaya dengan fasilitas lengkap dan lokasi strategis untuk mahasiswa dan pekerja.',

                'image' => 'website-profile/PWj9rJQSSHyUW6G79wKsc4kiJhU0y3obLCigCrro.jpg',

                'iframe_1' => 'https://youtu.be/aFeyh0cvBSc',
                'iframe_2' => 'https://youtu.be/o95awKNftsE',

                'advantage_1_title' => 'WiFi Cepat',
                'advantage_1_icon'  => 'wifi',
                'advantage_1_desc'  => 'WiFi cepat dan stabil untuk belajar dan bekerja.',

                'advantage_2_title' => 'Keamanan 24 Jam',
                'advantage_2_icon'  => 'shield-halved',
                'advantage_2_desc'  => 'Sistem keamanan modern dengan CCTV dan security.',

                'advantage_3_title' => 'Lokasi Strategis',
                'advantage_3_icon'  => 'location-dot',
                'advantage_3_desc'  => 'Dekat kampus, pusat kota, dan transportasi umum.',

                'latitude'  => -6.1970244,
                'longitude' => 106.6739845,

            ]
        );
    }
}
