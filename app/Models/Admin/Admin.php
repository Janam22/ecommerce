<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasFactory, HasApiTokens, \Illuminate\Auth\Authenticatable;
    protected $table = 'admin'; // specify the correct table name
    protected $fillable = [
        'name', 'email', 'password', 'profile_photo_path',
    ];
}
