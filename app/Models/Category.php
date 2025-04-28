<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'idcategories';
    protected $fillable = ['cat_name','cat_type','languages_idlanguages','admin_idadmin','media_idmedia','links_idlinks'];
    public function users() {
        return $this->hasMany(User::class, 'categories_idcategories');
    }
 
    public function places() {
        return $this->hasMany(Place::class, 'categories_idcategories');
    }

    public function cities() {
        return $this->hasMany(City::class, 'categories_idcategories');
    }
 
    public function services() {
        return $this->hasMany(Service::class, 'categories_idcategories');
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

    public function admin() {
        return $this->belongsTo(Admin::class, 'admin_idadmin');
    }
}
