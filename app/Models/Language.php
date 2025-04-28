<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $primaryKey = 'idlanguages';
   protected $primaryKey1='language_package';
   protected $fillable = ['language_package','lang_name','lang_type','admin_idadmin'];
    public function users() {
        return $this->hasMany(User::class, 'languages_idlanguages');
    }

    public function media() {
        return $this->hasMany(Media::class, 'languages_idlanguages');
    }
 
    public function socials() {
        return $this->hasMany(Social::class, 'languages_idlanguages');
    }

    public function links() {
        return $this->hasMany(Link::class, 'languages_idlanguages');
    }

    public function categories() {
        return $this->hasMany(Category::class, 'languages_idlanguages');
    }

    public function services() {
        return $this->hasMany(Service::class, 'languages_idlanguages');
    }

    public function places() {
        return $this->hasMany(Place::class, 'languages_idlanguages');
    }

    public function cities() {
        return $this->hasMany(City::class, 'languages_idlanguages');
    }

    public function ways() {
        return $this->hasMany(Way::class, 'languages_idlanguages');
    }

    public function admin() {
        return $this->belongsTo(Admin::class, 'admin_idadmin', 'idadmin');
    }
}

#
