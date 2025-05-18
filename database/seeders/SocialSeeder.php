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
            'languages_idlanguages' => 1
        ]);

        Social::create([
            'social_name' => 'Twitter',
            'social_address' => 'https://twitter.com',
            'languages_idlanguages' => 1
        ]);

        Social::create([
            'social_name' => 'Instagram',
            'social_address' => 'https://instagram.com',
            'languages_idlanguages' => 1
        ]);
    }
}
