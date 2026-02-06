<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fasilitas;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fasilitas = [

            /*
            |--------------------------------------------------------------------------
            | DALAM KAMAR
            |--------------------------------------------------------------------------
            */
            ['nama_fasilitas' => 'Tempat Tidur', 'icon' => 'fa-solid fa-bed', 'kategori' => 'dalam_kamar'],
            ['nama_fasilitas' => 'Kasur', 'icon' => 'fa-solid fa-bed', 'kategori' => 'dalam_kamar'],
            ['nama_fasilitas' => 'Lemari', 'icon' => 'fa-solid fa-box-open', 'kategori' => 'dalam_kamar'],
            ['nama_fasilitas' => 'Meja', 'icon' => 'fa-solid fa-table', 'kategori' => 'dalam_kamar'],
            ['nama_fasilitas' => 'Kursi', 'icon' => 'fa-solid fa-chair', 'kategori' => 'dalam_kamar'],
            ['nama_fasilitas' => 'Lampu Kamar', 'icon' => 'fa-solid fa-lightbulb', 'kategori' => 'dalam_kamar'],
            ['nama_fasilitas' => 'AC', 'icon' => 'fa-solid fa-snowflake', 'kategori' => 'dalam_kamar'],
            ['nama_fasilitas' => 'Kipas Angin', 'icon' => 'fa-solid fa-fan', 'kategori' => 'dalam_kamar'],
            ['nama_fasilitas' => 'TV', 'icon' => 'fa-solid fa-tv', 'kategori' => 'dalam_kamar'],
            ['nama_fasilitas' => 'WiFi', 'icon' => 'fa-solid fa-wifi', 'kategori' => 'dalam_kamar'],
            ['nama_fasilitas' => 'Stop Kontak', 'icon' => 'fa-solid fa-plug', 'kategori' => 'dalam_kamar'],
            ['nama_fasilitas' => 'Cermin', 'icon' => 'fa-solid fa-ractangle-tall', 'kategori' => 'dalam_kamar'],
            ['nama_fasilitas' => 'Rak Sepatu', 'icon' => 'fa-solid fa-shoe-prints', 'kategori' => 'dalam_kamar'],
            ['nama_fasilitas' => 'Brankas', 'icon' => 'fa-solid fa-vault', 'kategori' => 'dalam_kamar'],
            ['nama_fasilitas' => 'Kulkas Mini', 'icon' => 'fa-solid fa-temperature-low', 'kategori' => 'dalam_kamar'],

            /*
            |--------------------------------------------------------------------------
            | KAMAR MANDI
            |--------------------------------------------------------------------------
            */
            ['nama_fasilitas' => 'Kamar Mandi Dalam', 'icon' => 'fa-solid fa-shower', 'kategori' => 'kamar_mandi'],
            ['nama_fasilitas' => 'Kamar Mandi Luar', 'icon' => 'fa-solid fa-restroom', 'kategori' => 'kamar_mandi'],
            ['nama_fasilitas' => 'WC Duduk', 'icon' => 'fa-solid fa-toilet', 'kategori' => 'kamar_mandi'],
            ['nama_fasilitas' => 'WC Jongkok', 'icon' => 'fa-solid fa-toilet', 'kategori' => 'kamar_mandi'],
            ['nama_fasilitas' => 'Air Panas', 'icon' => 'fa-solid fa-temperature-high', 'kategori' => 'kamar_mandi'],
            ['nama_fasilitas' => 'Water Heater', 'icon' => 'fa-solid fa-fire', 'kategori' => 'kamar_mandi'],
            ['nama_fasilitas' => 'Wastafel', 'icon' => 'fa-solid fa-sink', 'kategori' => 'kamar_mandi'],
            ['nama_fasilitas' => 'Bathtub', 'icon' => 'fa-solid fa-bath', 'kategori' => 'kamar_mandi'],
            ['nama_fasilitas' => 'Jet Shower', 'icon' => 'fa-solid fa-water', 'kategori' => 'kamar_mandi'],

            /*
            |--------------------------------------------------------------------------
            | DAPUR
            |--------------------------------------------------------------------------
            */
            ['nama_fasilitas' => 'Dapur', 'icon' => 'fa-solid fa-kitchen-set', 'kategori' => 'dapur'],
            ['nama_fasilitas' => 'Kompor', 'icon' => 'fa-solid fa-fire-burner', 'kategori' => 'dapur'],
            ['nama_fasilitas' => 'Rice Cooker', 'icon' => 'fa-solid fa-bowl-rice', 'kategori' => 'dapur'],
            ['nama_fasilitas' => 'Microwave', 'icon' => 'fa-solid fa-microchip', 'kategori' => 'dapur'],
            ['nama_fasilitas' => 'Kulkas', 'icon' => 'fa-solid fa-temperature-low', 'kategori' => 'dapur'],
            ['nama_fasilitas' => 'Dispenser', 'icon' => 'fa-solid fa-water', 'kategori' => 'dapur'],
            ['nama_fasilitas' => 'Meja Makan', 'icon' => 'fa-solid fa-table', 'kategori' => 'dapur'],

            /*
            |--------------------------------------------------------------------------
            | UTILITAS
            |--------------------------------------------------------------------------
            */
            ['nama_fasilitas' => 'Listrik', 'icon' => 'fa-solid fa-bolt', 'kategori' => 'utilitas'],
            ['nama_fasilitas' => 'Air Bersih', 'icon' => 'fa-solid fa-droplet', 'kategori' => 'utilitas'],
            ['nama_fasilitas' => 'Air PDAM', 'icon' => 'fa-solid fa-faucet', 'kategori' => 'utilitas'],
            ['nama_fasilitas' => 'TV Kabel', 'icon' => 'fa-solid fa-tv', 'kategori' => 'utilitas'],
            ['nama_fasilitas' => 'Internet Cepat', 'icon' => 'fa-solid fa-gauge-high', 'kategori' => 'utilitas'],
            ['nama_fasilitas' => 'Genset', 'icon' => 'fa-solid fa-industry', 'kategori' => 'utilitas'],

            /*
            |--------------------------------------------------------------------------
            | LAUNDRY
            |--------------------------------------------------------------------------
            */
            ['nama_fasilitas' => 'Laundry', 'icon' => 'fa-solid fa-shirt', 'kategori' => 'laundry'],
            ['nama_fasilitas' => 'Mesin Cuci', 'icon' => 'fa-solid fa-soap', 'kategori' => 'laundry'],
            ['nama_fasilitas' => 'Setrika', 'icon' => 'fa-solid fa-shirt', 'kategori' => 'laundry'],
            ['nama_fasilitas' => 'Jemuran', 'icon' => 'fa-solid fa-sun', 'kategori' => 'laundry'],
            ['nama_fasilitas' => 'Cleaning Service', 'icon' => 'fa-solid fa-broom', 'kategori' => 'laundry'],
            ['nama_fasilitas' => 'Tempat Sampah', 'icon' => 'fa-solid fa-trash', 'kategori' => 'laundry'],

            /*
            |--------------------------------------------------------------------------
            | PARKIR
            |--------------------------------------------------------------------------
            */
            ['nama_fasilitas' => 'Parkir Motor', 'icon' => 'fa-solid fa-motorcycle', 'kategori' => 'parkir'],
            ['nama_fasilitas' => 'Parkir Mobil', 'icon' => 'fa-solid fa-car', 'kategori' => 'parkir'],
            ['nama_fasilitas' => 'Parkir Sepeda', 'icon' => 'fa-solid fa-bicycle', 'kategori' => 'parkir'],
            ['nama_fasilitas' => 'Akses Jalan Mobil', 'icon' => 'fa-solid fa-road', 'kategori' => 'parkir'],

            /*
            |--------------------------------------------------------------------------
            | KEAMANAN
            |--------------------------------------------------------------------------
            */
            ['nama_fasilitas' => 'CCTV', 'icon' => 'fa-solid fa-video', 'kategori' => 'keamanan'],
            ['nama_fasilitas' => 'Security 24 Jam', 'icon' => 'fa-solid fa-user-shield', 'kategori' => 'keamanan'],
            ['nama_fasilitas' => 'Akses Kartu', 'icon' => 'fa-solid fa-id-card', 'kategori' => 'keamanan'],
            ['nama_fasilitas' => 'Smart Lock', 'icon' => 'fa-solid fa-lock', 'kategori' => 'keamanan'],
            ['nama_fasilitas' => 'APAR', 'icon' => 'fa-solid fa-fire-extinguisher', 'kategori' => 'keamanan'],
            ['nama_fasilitas' => 'Alarm Kebakaran', 'icon' => 'fa-solid fa-bell', 'kategori' => 'keamanan'],

            /*
            |--------------------------------------------------------------------------
            | AREA BERSAMA
            |--------------------------------------------------------------------------
            */
            ['nama_fasilitas' => 'Ruang Tamu', 'icon' => 'fa-solid fa-couch', 'kategori' => 'area_bersama'],
            ['nama_fasilitas' => 'Ruang Santai', 'icon' => 'fa-solid fa-mug-hot', 'kategori' => 'area_bersama'],
            ['nama_fasilitas' => 'Rooftop', 'icon' => 'fa-solid fa-building', 'kategori' => 'area_bersama'],
            ['nama_fasilitas' => 'Taman', 'icon' => 'fa-solid fa-tree', 'kategori' => 'area_bersama'],
            ['nama_fasilitas' => 'Musholla', 'icon' => 'fa-solid fa-mosque', 'kategori' => 'area_bersama'],
            ['nama_fasilitas' => 'Gym', 'icon' => 'fa-solid fa-dumbbell', 'kategori' => 'area_bersama'],
            ['nama_fasilitas' => 'Kolam Renang', 'icon' => 'fa-solid fa-person-swimming', 'kategori' => 'area_bersama'],

            /*
            |--------------------------------------------------------------------------
            | KHUSUS / UNIK
            |--------------------------------------------------------------------------
            */
            ['nama_fasilitas' => 'Pet Friendly', 'icon' => 'fa-solid fa-paw', 'kategori' => 'khusus'],
            ['nama_fasilitas' => 'Bebas Asap Rokok', 'icon' => 'fa-solid fa-ban-smoking', 'kategori' => 'khusus'],
            ['nama_fasilitas' => 'Khusus Putra', 'icon' => 'fa-solid fa-mars', 'kategori' => 'khusus'],
            ['nama_fasilitas' => 'Khusus Putri', 'icon' => 'fa-solid fa-venus', 'kategori' => 'khusus'],
            ['nama_fasilitas' => 'Pasangan Menikah', 'icon' => 'fa-solid fa-ring', 'kategori' => 'khusus'],
            ['nama_fasilitas' => 'Difabel Friendly', 'icon' => 'fa-solid fa-wheelchair', 'kategori' => 'khusus'],
            ['nama_fasilitas' => 'View Kota', 'icon' => 'fa-solid fa-city', 'kategori' => 'khusus'],
            ['nama_fasilitas' => 'View Gunung', 'icon' => 'fa-solid fa-mountain', 'kategori' => 'khusus'],
        ];

        foreach ($fasilitas as $item) {
            Fasilitas::create($item);
        }
    }
}
