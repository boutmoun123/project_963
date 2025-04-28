<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
//use Laravel\Sanctum\HasApiTokens;

class Admin extends Model
{
    use HasFactory;
   // use HasApiTokens;
    protected $table = 'admins';
    protected $primaryKey = 'idadmin';
    protected $fillable = [
        'name',
        'email',
        'password'
    ];

    // Specify the route key name for model binding
    public function getRouteKeyName()
    {
        return 'idadmin';
    }

    // Hide password from JSON responses
    protected $hidden = [
        'password'
    ];

    // Automatically hash password when setting it
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    // Method to verify password
    public function verifyPassword($password)
    {
        return Hash::check($password, $this->password);
    }

    public function users() {
        return $this->hasMany(User::class, 'admin_idadmin');
    }

    public function languages() {
        return $this->hasMany(Language::class, 'admin_idadmin');
    }

    public function socials() {
        return $this->hasMany(Social::class, 'admin_idadmin');
    }

    public function media() {
        return $this->hasMany(Media::class, 'admin_idadmin');
    }

    public function links() {
        return $this->hasMany(Link::class, 'admin_idadmin');
    }

    public function categories() {
        return $this->hasMany(Category::class, 'admin_idadmin');
    }

    public function services() {
        return $this->hasMany(Service::class, 'admin_idadmin');
    }

    public function places() {
        return $this->hasMany(Place::class, 'admin_idadmin');
    }

    public function cities() {
        return $this->hasMany(City::class, 'admin_idadmin');
    }

    public function ways() {
        return $this->hasMany(Way::class, 'admin_idadmin');
    }
}

