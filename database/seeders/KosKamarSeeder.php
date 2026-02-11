<?php

namespace Database\Seeders;

use App\Models\Kos;
use App\Models\Kamar;
use App\Models\Fasilitas;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KosKamarSeeder extends Seeder
{
    public function run(): void
    {
        $fasilitasIds = Fasilitas::pluck('id')->toArray();

        $dataKos = [
            [
                'nama_kos'   => 'Kos Harmoni',
                'alamat'     => 'Jl. Melati No. 10, Jakarta',
                'jenis_sewa' => 'bulanan',
            ],
            [
                'nama_kos'   => 'Kos Sejahtera',
                'alamat'     => 'Jl. Kenanga No. 5, Bandung',
                'jenis_sewa' => 'tahunan',
            ],
            [
                'nama_kos'   => 'Kos Amanah',
                'alamat'     => 'Jl. Mawar No. 21, Yogyakarta',
                'jenis_sewa' => 'bulanan',
            ],
        ];

        foreach ($dataKos as $index => $kosData) {
            $kos = Kos::create([
                'nama_kos'   => $kosData['nama_kos'],
                'slug'       => Str::slug($kosData['nama_kos']),
                'deskripsi'  => 'Kos nyaman dan strategis',
                'alamat'     => $kosData['alamat'],
                'latitude'   => -6.200000 + ($index * 0.01),
                'longitude'  => 106.816666 + ($index * 0.01),
                'jenis_sewa' => $kosData['jenis_sewa'],
            ]);

            // 3 kamar per kos
            for ($i = 1; $i <= 3; $i++) {
                $kamar = Kamar::create([
                    'kos_id'         => $kos->id,
                    'nama_kamar'     => "Kamar $i",
                    'tipe_kamar'     => $i % 2 === 0 ? 'VIP' : 'Standar',
                    'lantai'         => ceil($i / 2),
                    'nomor_kamar'    => $i,
                    'deskripsi'      => 'Kamar bersih dan nyaman',
                    'harga_bulanan'  => 750000 + ($i * 100000),
                    'harga_tahunan'  => 8000000 + ($i * 500000),
                    'deposit'  => 50,
                    'status'         => 'tersedia',
                ]);

                // Ambil 5–8 fasilitas acak
                $randomFasilitas = collect($fasilitasIds)
                    ->random(rand(5, 8))
                    ->toArray();

                $kamar->fasilitas()->attach($randomFasilitas);
            }
        }
    }
}
