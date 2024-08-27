<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders'; // specify the correct table name
    protected $fillable = [
        'quantity', 'product_variant_id', 'cart_id', 'remarks',
    ];
}
