<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'phone' => '019XXXXXXXX',
                'email' => 'demo@gmail.com',
                'address' => 'Uttara, Dhaka',
                'facebook' => 'https://www.facebook.com/',
                'twitter' => 'http://x.com/',
                'instragram' => 'https://www.instagram.com/',
                'youtube' => 'https://www.youtube.com/',
                'logo' => 'logo.png',
                'hero_image' => 'hero.png',
                'free_shipping_amount' => 2000
            ]
        ];

        Setting::insert($settings);
    }
}
