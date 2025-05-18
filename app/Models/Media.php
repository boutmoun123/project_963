<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $primaryKey = 'idmedia';
    protected $fillable = [
        'med_name',
        'med_type',
        'med_content',
        'languages_idlanguages',
        'categories_idcategories',
        'cities_idcities',
        'places_idplaces',
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

    public function place()
    {
        return $this->belongsTo(Place::class, 'places_idplaces');
    }

    public function star()
    {
        return $this->belongsTo(Star::class, 'stars_idstars');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'services_idservices');
    }




}
