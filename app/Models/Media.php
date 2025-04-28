<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $primaryKey = 'idmedia';
    protected $fillable = ['med_name','med_type','med_content','languages_idlanguages','admin_idadmin'];
    public function users() {
        return $this->hasMany(User::class, 'media_idmedia');
    }

    public function links() {
        return $this->hasMany(Link::class, 'media_idmedia');
    }

    public function categories() {
        return $this->hasMany(Category::class, 'media_idmedia');
    }
 
    public function services() {
        return $this->hasMany(Service::class, 'media_idmedia');
    } 

    public function places() {
        return $this->hasMany(Place::class, 'media_idmedia');
    }

    public function cities() {
        return $this->hasMany(City::class, 'media_idmedia');
    }

    public function language() {
        return $this->belongsTo(Language::class, 'languages_idlanguages');
    }

    public function admin() {
        return $this->belongsTo(Admin::class, 'admin_idadmin');
    }
}
