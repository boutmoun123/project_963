<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Link;

class LinkSeeder extends Seeder
{
    public function run(): void
    {
        Link::create([
            'link_name' => 'Sample Link',
            'link_http' => 'https://example.com',
            'languages_idlanguages' => 1,
            'admin_idadmin' => 1,
            'media_idmedia' => 1,
            'socials_idsocials' => 1
        ]);
    }
}
