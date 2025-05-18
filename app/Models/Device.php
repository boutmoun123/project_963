<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class Device extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_name',
        'platform',
        'device_token',
        'ip_address',
        'app_version'
    ];  
}
