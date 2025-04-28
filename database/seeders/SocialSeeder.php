<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Social;

class SocialSeeder extends Seeder
{
    public function run(): void
    {
        Social::create([
            'social_name' => 'Facebook',
            'social_address' => 'https://facebook.com',
            'languages_idlanguages' => 1,
            'admin_idadmin' => 1
        ]);
    }
}
