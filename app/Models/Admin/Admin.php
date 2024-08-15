<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $table = 'admin'; // specify the correct table name
    protected $fillable = [
        'name', 'email', 'password', 'profile_photo_path',
    ];
}
