<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $table = 'colors'; // specify the correct table name
    protected $fillable = [
        'color_name', 'color_code', 'remarks',
    ];
}
