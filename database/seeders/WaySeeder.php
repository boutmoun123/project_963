<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Way;

class WaySeeder extends Seeder
{
    public function run(): void
    {
        Way::create([
            'name' => 'Sample Way',
            'horizontal' => 1.0000000,
            'vertical' => 1.0000000,
            'address' => 'Sample Address',
            'way_add' => 'Sample Way Address',
            'admin_idadmin' => 1,
            'languages_idlanguages' => 1,
            'socials_idsocials' => 1,
            'places_idplaces' => 1,
            'services_idservices' => 1,
            'links_idlinks' => 1,
            'cities_idcities' => 1
        ]);
    }
}
