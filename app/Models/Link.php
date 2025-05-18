<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $primaryKey = 'idlinks';
    protected $fillable = [
        'link_name',
        'link_http',
        'link_type',
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
}
