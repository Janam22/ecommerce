<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'cart'; // specify the correct table name
    protected $fillable = [
        'tmp_id', 'customer_id', 'remarks',
    ];
}
