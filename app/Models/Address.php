<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'address'; // specify the correct table name
    protected $fillable = [
        'country', 'province', 'district', 'municipality', 'remarks',
    ];
}
