<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'nomor_identitas' => '33030330030003',
                'email' => 'admin@kost.com',
                'password' => Hash::make('admin'),
                'role' => 'admin'
            ],
            [
                'name' => 'Owner Kost',
                'nomor_identitas' => '33030330030004',
                'email' => 'owner@kost.com',
                'password' => Hash::make('owner'),
                'role' => 'owner'
            ],
            [
                'name' => 'Riyel',
                'nomor_identitas' => '33030330030005',
                'email' => 'user@kost.com',
                'password' => Hash::make('user'),
                'role' => 'customer'
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
