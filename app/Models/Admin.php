<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $table = 'admins';
    protected $primaryKey = 'idadmin';
    protected $fillable = [
        'name',
        'password'
    ];

    // Specify the route key name for model binding
    public function getRouteKeyName()
    {
        return 'id';
    }

    // Hide password from JSON responses
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Method to verify password
    public function verifyPassword($password)
    {
        return Hash::check($password, $this->password);
    }

    protected $casts = [
        'password' => 'hashed',
    ];
}

