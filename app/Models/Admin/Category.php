<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category'; // specify the correct table name
    protected $fillable = [
        'category_name', 'category_type', 'category_id', 'image_path', 'remarks',
    ];
}
