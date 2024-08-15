<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
    use HasFactory;
    protected $table = 'api'; // specify the correct table name
    protected $fillable = [
        'api_name', 'api_value', 'remarks',
    ];
}
