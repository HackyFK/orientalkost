<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('settings')->truncate();

        $settings = [

            /*
            |--------------------------------------------------
            | IDENTITAS WEBSITE
            |--------------------------------------------------
            */
            [
                'key' => 'site_name',
                'value' => 'Oriental Kost',
                'group' => 'general'
            ],
            [
                'key' => 'site_tagline',
                'value' => 'Hunian Nyaman & Strategis',
                'group' => 'general '
            ],
            [
                'key' => 'seo_description',
                'value' => 'Kost eksklusif dengan fasilitas lengkap',
                'group' => 'seo'
            ],
            [
                'key' => 'seo_keywords',
                'value' => 'kost, kamar kos, oriental kost',
                'group' => 'seo'
            ],

            /*
            |--------------------------------------------------
            | KONTAK & ALAMAT
            |--------------------------------------------------
            */
            [
                'key' => 'contact_address',
                'value' => 'Jl. Sudirman No. 12, Kota X',
                'group' => 'contact'
            ],
            [
                'key' => 'contact_phone',
                'value' => '081234567890',
                'group' => 'contact'
            ],
            [
                'key' => 'contact_email',
                'value' => 'info@orientalkost.com',
                'group' => 'contact'
            ],
            [
                'key' => 'contact_whatsapp',
                'value' => '6281234567890',
                'group' => 'contact'
            ],

            /*
            |--------------------------------------------------
            | SOSIAL MEDIA
            |--------------------------------------------------
            */
            [
                'key' => 'social_facebook',
                'value' => 'https://facebook.com/orientalkost',
                'group' => 'social'
            ],
            [
                'key' => 'social_instagram',
                'value' => 'https://instagram.com/orientalkost',
                'group' => 'social'
            ],
            [
                'key' => 'social_tiktok',
                'value' => 'https://tiktok.com/@orientalkost',
                'group' => 'social'
            ],
            [
                'key' => 'social_youtube',
                'value' => null,
                'group' => 'social'
            ],

            /*
            |--------------------------------------------------
            | CTA / BOOKING
            |--------------------------------------------------
            */
            [
                'key' => 'cta_booking_text',
                'value' => 'Booking Sekarang',
                'group' => 'cta'
            ],
            [
                'key' => 'cta_booking_url',
                'value' => 'https://wa.me/6281234567890',
                'group' => 'cta'
            ],

            /*
            |--------------------------------------------------
            | OPERASIONAL
            |--------------------------------------------------
            */
            [
                'key' => 'operational_hours',
                'value' => 'Senin - Minggu | 08:00 - 21:00',
                'group' => 'operational'
            ],
            /*
            |--------------------------------------------------
            | SMTP CONFIG
            |--------------------------------------------------
            */
            [
                'key' => 'smtp_host',
                'value' => 'smtp.gmail.com',
                'group' => 'smtp'
            ],
            [
                'key' => 'smtp_port',
                'value' => '587',
                'group' => 'smtp'
            ],
            [
                'key' => 'smtp_username',
                'value' => 'your@email.com',
                'group' => 'smtp'
            ],
            [
                'key' => 'smtp_password',
                'value' => '',
                'group' => 'smtp'
            ],
            [
                'key' => 'smtp_encryption',
                'value' => 'tls',
                'group' => 'smtp'
            ],

            /*
            |--------------------------------------------------
            | MIDTRANS CONFIG
            |--------------------------------------------------
            */
            [
                'key' => 'midtrans_server_key',
                'value' => '',
                'group' => 'midtrans'
            ],
            [
                'key' => 'midtrans_client_key',
                'value' => '',
                'group' => 'midtrans'
            ],
            [
                'key' => 'midtrans_is_production',
                'value' => 'false',
                'group' => 'midtrans'
            ],

        ];

        DB::table('settings')->insert($settings);
    }
}
