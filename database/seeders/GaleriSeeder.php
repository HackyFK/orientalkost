<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Galeri;
use Illuminate\Support\Str;

class GaleriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [

            [
                'judul' => 'Kamar Minimalis 2x3',
                'deskripsi_singkat' => 'Kamar sederhana ukuran 2x3 meter, cocok untuk mahasiswa.',
                'gambar' => 'galeri/2WL7g6vrv9Le5oB2ZsASRYsVSGUDUyCMglRolZrj.jpg',
            ],

            [
                'judul' => 'Kamar Standar 3x3',
                'deskripsi_singkat' => 'Kamar ukuran standar dengan pencahayaan alami.',
                'gambar' => 'galeri/bfgH090z88GND8ZBenlRZ9hW4hrt1iH0T0jDiJfq.jpg',
            ],

            [
                'judul' => 'Kamar + Kamar Mandi Dalam',
                'deskripsi_singkat' => 'Kamar dengan kamar mandi pribadi.',
                'gambar' => 'galeri/DPtWQ09Eontsd9BB5ufWhkEWJiV5Zhui62nDa1zc.jpg',
            ],

            [
                'judul' => 'Kamar Ekonomis Hemat',
                'deskripsi_singkat' => 'Pilihan kamar harga terjangkau.',
                'gambar' => 'galeri/GQR5ixw6FpwBWnMRNpZ5NX5UbewSx9NyPXsjkwPD.jpg',
            ],

            [
                'judul' => 'Kamar Premium',
                'deskripsi_singkat' => 'Kamar luas dengan fasilitas lengkap.',
                'gambar' => 'galeri/KDMGKr3cdPFblnUG8HLj38tx01zisqAFYO2FEzsn.jpg',
            ],

            [
                'judul' => 'Kamar Kosongan Siap Isi',
                'deskripsi_singkat' => 'Kamar kosong siap diisi sesuai kebutuhan.',
                'gambar' => 'galeri/LYiCb2YtSvkBUOlwoa0QMT0xTxPMUvbMPtOwMlB6.jpg',
            ],

            [
                'judul' => 'Kamar Balkon View Taman',
                'deskripsi_singkat' => 'Kamar dengan balkon dan view taman.',
                'gambar' => 'galeri/sIzjU8G6aCSnjWUHR5Jnsj61cw60rx7iH8r9KJMQ.jpg',
            ],

            [
                'judul' => 'Kamar Berdua Twin Bed',
                'deskripsi_singkat' => 'Kamar luas dengan dua tempat tidur.',
                'gambar' => 'galeri/YSZMRqnequXv3rP1GTNIED6QgmIMLrrEvd37cgHa.png',
            ],

        ];

        foreach ($data as $item) {

            Galeri::updateOrCreate(
                ['slug' => Str::slug($item['judul'])],
                [
                    'judul' => $item['judul'],
                    'slug' => Str::slug($item['judul']),
                    'deskripsi_singkat' => $item['deskripsi_singkat'],
                    'gambar' => $item['gambar'],
                ]
            );

        }
    }
}