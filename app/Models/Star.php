<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Star extends Model
{
    use HasFactory;
protected $primaryKey = 'idstars';
protected $fillable = [
    'star_type',
    'number',
    'languages_idlanguages',
    'categories_idcategories',
    'cities_idcities',
    'places_idplaces',
    'services_idservices',
];

     public function language()
{
    return $this->belongsTo(Language::class, 'languages_idlanguages');
}

public function category()
{
    return $this->belongsTo(Category::class, 'categories_idcategories');
}

public function city()
{
    return $this->belongsTo(City::class, 'cities_idcities');
}

public function users()
{
    return $this->hasMany(User::class, 'media_idmedia');
}

public function service() {
    return $this->belongsTo(Service::class, 'services_idservices');
}

public function places()
{
    return $this->hasMany(Place::class, 'stars_idstars');
}



}
