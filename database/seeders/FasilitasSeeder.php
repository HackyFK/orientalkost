<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'AC',
            'WiFi',
            'Kamar Mandi Dalam',
            'Parkir',
            'Listrik',
            'Laundry'
        ];

        foreach ($fasilitas as $item) {
            Fasilitas::create(['nama_fasilitas' => $item]);
        }
    }
}
