<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Get the admin and language
        $admin = Admin::first();
        $language = Language::first();

        // Create social first as it's needed by links and way
        $social = Social::create([
            'social_name' => 'Default Social',
            'social_address' => 'https://example.com',
            'languages_idlanguages' => $language->idlanguages,
            'admin_idadmin' => $admin->idadmin,
        ]);

        // Create media as it's needed by links
        $media = Media::create([
            'med_name' => 'Default Media',
            'med_type' => 1, // 1 for image
            'med_content' => 'default.jpg',
            'admin_idadmin' => $admin->idadmin,
            'languages_idlanguages' => $language->idlanguages,
        ]);

        // Create link
        $link = Link::create([
            'link_name' => 'Default Link',
            'link_http' => 'https://example.com',
            'admin_idadmin' => $admin->idadmin,
            'languages_idlanguages' => $language->idlanguages,
            'media_idmedia' => $media->idmedia,
            'socials_idsocials' => $social->idsocials,
        ]);

        // Create category
        $category = Category::create([
            'cat_name' => 'Default Category',
            'cat_type' => 1,
            'admin_idadmin' => $admin->idadmin,
            'languages_idlanguages' => $language->idlanguages,
            'media_idmedia' => $media->idmedia,
            'links_idlinks' => $link->idlinks,
        ]);

        // Create city
        $city = City::create([
            'city_name' => 'Default City',
            'admin_idadmin' => $admin->idadmin,
            'languages_idlanguages' => $language->idlanguages,
            'media_idmedia' => $media->idmedia,
            'links_idlinks' => $link->idlinks,
            'categories_idcategories' => $category->idcategories,
        ]);

        // Create place
        $place = Place::create([
            'place_name' => 'Default Place',
            'place_type' => 1,
            'admin_idadmin' => $admin->idadmin,
            'languages_idlanguages' => $language->idlanguages,
            'media_idmedia' => $media->idmedia,
            'links_idlinks' => $link->idlinks,
            'categories_idcategories' => $category->idcategories,
            'cities_idcities' => $city->idcities,
        ]);

        // Create service
        $service = Service::create([
            'ser_name' => 'Default Service',
            'admin_idadmin' => $admin->idadmin,
            'languages_idlanguages' => $language->idlanguages,
            'media_idmedia' => $media->idmedia,
            'links_idlinks' => $link->idlinks,
            'places_idplaces' => $place->idplaces,
            'cities_idcities' => $city->idcities,
        ]);

        // Create way
        $way = Way::create([
            'name' => 'Default Way',
            'horizontal' => 0,
            'vertical' => 0,
            'address' => 'Default Address',
            'way_add' => 'Default Way Address',
            'admin_idadmin' => $admin->idadmin,
            'languages_idlanguages' => $language->idlanguages,
            'socials_idsocials' => $social->idsocials,
            'places_idplaces' => $place->idplaces,
            'services_idservices' => $service->idservices,
            'links_idlinks' => $link->idlinks,
            'cities_idcities' => $city->idcities,
        ]);

        // Create the user with all required relationships
        User::create([
            'admin_idadmin' => $admin->idadmin,
            'languages_idlanguages' => $language->idlanguages,
            'socials_idsocials' => $social->idsocials,
            'way_idway' => $way->idway,
            'places_idplaces' => $place->idplaces,
            'media_idmedia' => $media->idmedia,
            'services_idservices' => $service->idservices,
            'categories_idcategories' => $category->idcategories,
            'links_idlinks' => $link->idlinks,
            'cities_idcities' => $city->idcities,
        ]);
    }
}
