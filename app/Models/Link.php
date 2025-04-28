<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $primaryKey = 'idlinks';
    protected $fillable = ['link_name','link_http','languages_idlanguages','admin_idadmin','media_idmedia','socials_idsocials'];
    public function users() {
        return $this->hasMany(User::class, 'links_idlinks');
    }

    public function categories() {
        return $this->hasMany(Category::class, 'links_idlinks');
    }
  
    public function services() {
        return $this->hasMany(Service::class, 'links_idlinks');
    }

    public function places() {
        return $this->hasMany(Place::class, 'links_idlinks');
    }

    public function cities() {
        return $this->hasMany(City::class, 'links_idlinks');
    }

    public function ways() {
        return $this->hasMany(Way::class, 'links_idlinks');
    }

    public function media() {
        return $this->belongsTo(Media::class, 'media_idmedia');
    }

    public function social() {
        return $this->belongsTo(Social::class, 'socials_idsocials');
    }

    public function language() {
        return $this->belongsTo(Language::class, 'languages_idlanguages');
    }

    public function admin() {
        return $this->belongsTo(Admin::class, 'admin_idadmin');
    }
}
