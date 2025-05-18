<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'idcities';
    protected $fillable = [
        'city_name',
        'city_type',
        'photo',
        'description',
        'languages_idlanguages',
        'categories_idcategories'
    ];

    public function language()
    {
        return $this->belongsTo(Language::class, 'languages_idlanguages');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_idcategories');
    }

    public function ways()
    {
        return $this->hasMany(Way::class, 'cities_idcities');
    }

    public function links()
    {
        return $this->hasMany(Link::class, 'cities_idcities');
    }

    public function places()
    {
        return $this->hasMany(Place::class, 'cities_idcities');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'cities_idcities');
    }

    public function media()
    {
        return $this->hasMany(Media::class, 'cities_idcities');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'cities_idcities');
    }
}
