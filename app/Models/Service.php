<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $primaryKey = 'idservices';
    protected $fillable = [
        'ser_name',
        'ser_type',
        'ser_photo',
        'description',
        'languages_idlanguages',
        'categories_idcategories',
        'cities_idcities'
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
        return $this->belongsTo(User::class, 'services_idservices');
    }

    public function ways() { 
        return $this->belongsTo(Way::class, 'services_idservices');
    }

    public function media() {
        return $this->belongsTo(Media::class, 'media_idmedia');
    }

    public function links() {
        return $this->belongsTo(Link::class, 'links_idlinks');
    }

    public function places() {
        return $this->belongsTo(Place::class, 'places_idplaces');
    }

}
