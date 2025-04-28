<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Admin;
use App\Models\Language;
use App\Models\Social;
use App\Models\Way;
use App\Models\Place;
use App\Models\Media;
use App\Models\Service;
use App\Models\Category;
use App\Models\Link;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'admin_idadmin' => Admin::factory(),
            'languages_idlanguages' => Language::factory(),
            'socials_idsocials' => Social::factory(),
            'way_idway' => Way::factory(),
            'places_idplaces' => Place::factory(),
            'media_idmedia' => Media::factory(),
            'services_idservices' => Service::factory(),
            'categories_idcategories' => Category::factory(),
            'links_idlinks' => Link::factory(),
            'cities_idcities' => City::factory(),
        ];
    }
}
