<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $primaryKey = 'idcities';
    protected $fillable = ['city_name','languages_idlanguages','admin_idadmin','media_idmedia','links_idlinks','categories_idcategories'];
    public function users() {
        return $this->hasMany(User::class, 'cities_idcities');
    }

    public function services() {
        return $this->hasMany(Service::class, 'cities_idcities');
    }
 
    public function places() {
        return $this->hasMany(Place::class, 'cities_idcities');
    }

    public function ways() {
        return $this->hasMany(Way::class, 'cities_idcities');
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

    public function admin() {
        return $this->belongsTo(Admin::class, 'admin_idadmin');
    }
}
