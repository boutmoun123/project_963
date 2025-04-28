<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\User;
use App\Models\Social;
use App\Models\Language;
use App\Models\Category;
use App\Models\Place;
use App\Models\City;
use App\Models\Service;
use App\Models\Link;
use App\Models\Media;
use App\Models\Way;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            LanguageSeeder::class,
            SocialSeeder::class,
            MediaSeeder::class,
            LinkSeeder::class,
            CategorySeeder::class,
            CitySeeder::class,
            PlaceSeeder::class,
            ServiceSeeder::class,
            WaySeeder::class,
            UserSeeder::class,
        ]);
    }
}
