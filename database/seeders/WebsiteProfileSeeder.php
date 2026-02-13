<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WebsiteProfile;

class WebsiteProfileSeeder extends Seeder
{
    public function run(): void
    {
        // Cek dulu supaya tidak double data
        if (!WebsiteProfile::first()) {

            WebsiteProfile::create([
                'description' => 'Oriental Kos adalah platform penyedia kos terbaik dengan fasilitas modern dan harga terjangkau untuk mahasiswa dan pekerja.',

                'advantage_1_title' => 'WiFi Cepat',
                'advantage_1_icon'  => 'wifi',

                'advantage_2_title' => 'Keamanan 24 Jam',
                'advantage_2_icon'  => 'shield-halved',

                'advantage_3_title' => 'Lokasi Strategis',
                'advantage_3_icon'  => 'location-dot',
            ]);
        }
    }
}
