<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasFactory;
    use HasApiTokens;
    protected $primaryKey = 'iduser';
    protected $fillable = [
        'languages_idlanguages', 'socials_idsocials', 'way_idway',
        'places_idplaces', 'media_idmedia', 'services_idservices',
        'categories_idcategories', 'links_idlinks', 'cities_idcities'
    ];

    public function language() {
        return $this->belongsTo(Language::class, 'languages_idlanguages');
    }

    public function social() {
        return $this->belongsTo(Social::class, 'socials_idsocials');
    }

    public function way() {
        return $this->belongsTo(Way::class, 'way_idway');
    }

    public function place() {
        return $this->belongsTo(Place::class, 'places_idplaces');
    }

    public function media() {
        return $this->belongsTo(Media::class, 'media_idmedia');
    }

    public function service() {
        return $this->belongsTo(Service::class, 'services_idservices');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'categories_idcategories');
    }

    public function link() {
        return $this->belongsTo(Link::class, 'links_idlinks');
    }

    public function city() {
        return $this->belongsTo(City::class, 'cities_idcities');
    }
}
