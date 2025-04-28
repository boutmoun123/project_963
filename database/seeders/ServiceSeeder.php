<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        Service::create([
            'ser_name' => 'Sample Service',
            'languages_idlanguages' => 1,
            'admin_idadmin' => 1,
            'media_idmedia' => 1,
            'links_idlinks' => 1,
            'places_idplaces' => 1,
            'cities_idcities' => 1,
            'categories_idcategories' => 1
        ]);
    }
}
