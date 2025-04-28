<?php

namespace Database\Factories;

use App\Models\Way;
use App\Models\Language;
use App\Models\Social;
use App\Models\Place;
use App\Models\Service;
use App\Models\Link;
use App\Models\City;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

class WayFactory extends Factory
{
    protected $model = Way::class;

    public function definition()
    {
        return [
                'name' => $this->faker->company . ' Place',
                'latitude' => $this->faker->latitude(32.0, 37.5),  // تقريبا المجال الجغرافي لسوريا
                'longitude' => $this->faker->longitude(35.5, 42.0),
                'address' => $this->faker->address,

            'languages_idlanguages' => Language::factory(),
            'socials_idsocials'     => Social::factory(),
            'places_idplaces'       => Place::factory(),
            'services_idservices'   => Service::factory(),
            'links_idlinks'         => Link::factory(),
            'cities_idcities'       => City::factory(),
            'admin_idadmin'         => Admin::factory(),
        ];
    }
}

