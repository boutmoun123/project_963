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
        'vertical',
        'address',
        'way_add',
        'admin_idadmin',
        'languages_idlanguages',
        'socials_idsocials',
        'places_idplaces',  
        'services_idservices',
        'links_idlinks',
        'cities_idcities'
    ];
    public function users() {
        return $this->hasMany(User::class, 'way_idway');
    }

    public function language() {
        return $this->belongsTo(Language::class, 'languages_idlanguages');
    }

    public function social() {
        return $this->belongsTo(Social::class, 'socials_idsocials');
    }

    public function place() {
        return $this->belongsTo(Place::class, 'places_idplaces');
    }

    public function service() {
        return $this->belongsTo(Service::class, 'services_idservices');
    }

    public function link() {
        return $this->belongsTo(Link::class, 'links_idlinks');
    }

    public function city() {
        return $this->belongsTo(City::class, 'cities_idcities');
    }

    public function admin() {
        return $this->belongsTo(Admin::class, 'admin_idadmin');
    }
}
