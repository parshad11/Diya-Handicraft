<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'site_title' => 'Diya HandiCraft',
            'site_address' => 'Kathmandu',
            'site_phone' => '014******',
            'site_mobile' => '986*****',
            'site_email' => 'info@DiyaHandicraft.com',
            'lat' => '45452.36',
            'long' => '452.02',
            'social_links' => json_encode([
            'facebook' => 'www.facebook.com',
                'instagram' => 'www.instagram.com',
            ])
        ]);
    }
}
