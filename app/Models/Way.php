<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Way extends Model
{
    use HasFactory;
    protected $table = 'way';
    protected $primaryKey = 'idway';
    protected $fillable = [
        'name',
        'horizontal',
        'way_type',
        'vertical',
        'address',
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

    public function users()
    {
        return $this->hasMany(User::class, 'way_idway');
    }
}
