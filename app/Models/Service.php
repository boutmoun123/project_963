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
        'languages_idlanguages',
        'admin_idadmin',
        'media_idmedia',
        'links_idlinks',
        'places_idplaces',
        'cities_idcities',
        'categories_idcategories'
    ];
    public function users() {
        return $this->hasMany(User::class, 'services_idservices');
    }

    public function ways() { 
        return $this->hasMany(Way::class, 'services_idservices');
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

    public function place() {
        return $this->belongsTo(Place::class, 'places_idplaces');
    }

    public function city() {
        return $this->belongsTo(City::class, 'cities_idcities');
    }

    public function admin() {
        return $this->belongsTo(Admin::class, 'admin_idadmin');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'categories_idcategories');
    }
}
