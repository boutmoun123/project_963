<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'idcategories';
    protected $fillable = [
        'cat_name',
        'cat_type',
        'cat_photo',    
        'languages_idlanguages',
        'description',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class, 'languages_idlanguages');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'categories_idcategories');
    }

    public function ways()
    {
        return $this->hasMany(Way::class, 'categories_idcategories');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'categories_idcategories');
    }

    public function links()
    {
        return $this->hasMany(Link::class, 'categories_idcategories');
    }
    
    public function media()
    {
        return $this->hasMany(Media::class, 'categories_idcategories');
    }

    public function places()
    {
        return $this->hasMany(Place::class, 'categories_idcategories');
    }

    public function cities()
    {
        return $this->hasMany(City::class, 'categories_idcategories');
    }

}
