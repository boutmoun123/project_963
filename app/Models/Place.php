<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    protected $primaryKey = 'idplaces';
    protected $fillable = ['place_name','place_type','languages_idlanguages','admin_idadmin','media_idmedia','links_idlinks','categories_idcategories','cities_idcities'];
    public function users() {
        return $this->hasMany(User::class, 'places_idplaces');
    }

    public function services() {
        return $this->hasMany(Service::class, 'places_idplaces');
    }

    public function ways() {
        return $this->hasMany(Way::class, 'places_idplaces');
    } 

    public function language() {
        return $this->belongsTo(Language::class, 'languages_idlanguages');
    }

    public function media() {
        return $this->belongsTo(Media::class, 'media_idmedia');
    }

    public function link() {
        return $this->belongsTo(Link::class, 'links_idlinks');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'categories_idcategories');
    }

    public function city() {
        return $this->belongsTo(City::class, 'cities_idcities');
    }

    public function admin() {
        return $this->belongsTo(Admin::class, 'admin_idadmin');
    }
}
