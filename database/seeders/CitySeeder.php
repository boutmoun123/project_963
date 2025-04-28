<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    public function run(): void
    {
        City::create([
            'city_name' => 'Sample City',
            'languages_idlanguages' => 1,
            'admin_idadmin' => 1,
            'media_idmedia' => 1,
            'links_idlinks' => 1,
            'categories_idcategories' => 1
        ]);
    }
}
