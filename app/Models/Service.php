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
        'ser_type',
        'ser_photo',
        'description',
        'languages_idlanguages',
        'categories_idcategories',
        'cities_idcities',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class, 'languages_idlanguages');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_idcategories');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'cities_idcities');
    }
    public function star()
    {
        return $this->belongsTo(City::class, 'stars_idstars');
    }

    public function stars()
    {
        return $this->hasMany(Star::class, 'services_idservices');
    }

    // العلاقات التابعة للخدمة (يجب أن تكون hasMany)

    public function users()
    {
        return $this->hasMany(User::class, 'services_idservices');
    }

    public function places()
    {
        return $this->hasMany(Place::class, 'services_idservices');
    }

    public function links()
    {
        return $this->hasMany(Link::class, 'services_idservices');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'services_idservices');
    }

    public function way()
    {
        return $this->hasMany(Way::class, 'services_idservices');
    }
}
