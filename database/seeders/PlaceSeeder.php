<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Place;

class PlaceSeeder extends Seeder
{
    public function run(): void
    {
        Place::create([
            'place_name' => 'Sample Place',
            'place_type' => 1,
            'languages_idlanguages' => 1,
            'admin_idadmin' => 1,
            'media_idmedia' => 1,
            'links_idlinks' => 1,
            'categories_idcategories' => 1,
            'cities_idcities' => 1
        ]);
    }
}
