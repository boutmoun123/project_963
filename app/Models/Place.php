<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $primaryKey = 'idplaces';
    protected $fillable = [
        'place_name',
        'place_type',
        'photo',
        'description',
        'date_created',
        'languages_idlanguages',
        'categories_idcategories',
        'cities_idcities',
       'services_idservices',
        'stars_idstars',
        
    ];
    protected $casts = [
        'date_created' => 'date:Y-m-d',
    ];

    protected $attributes = [
        'photo' => '/storage/places/default.png'
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
  
    public function star()
    {
        return $this->belongsTo(Star::class, 'stars_idstars');
    }

        public function service()
        {
            return $this->belongsTo(Service::class, 'services_idservices');
            
        }
        
public function ways()
{
    return $this->hasMany(Way::class, 'places_idplaces'); 

}
public function links()
{
    return $this->hasMany(link::class, 'places_idplaces'); 

}
public function media()
{
    return $this->hasMany(media::class, 'places_idplaces'); 

}
}
