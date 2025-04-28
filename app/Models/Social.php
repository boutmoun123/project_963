<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $primaryKey = 'idsocials';
    protected $fillable = ['social_name','social_address','languages_idlanguages','admin_idadmin'];
    public function users() {
        return $this->hasMany(User::class, 'socials_idsocials');
    }

    public function links() {
        return $this->hasMany(Link::class, 'socials_idsocials');
    }
    
    public function ways() {
        return $this->hasMany(Way::class, 'socials_idsocials');
    }
 
    public function language() {
        return $this->belongsTo(Language::class, 'languages_idlanguages');
    }

    public function admin() {
        return $this->belongsTo(Admin::class, 'admin_idadmin');
    }
}
