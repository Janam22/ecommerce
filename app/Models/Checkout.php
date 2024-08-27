<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    protected $table = 'checkouts'; // specify the correct table name
    protected $fillable = [
        'cart_id', 'product_v_id', 'quantity', 'rate', 'discount', 'total', 'dpd_id', 
        'delivery_status', 'modify_date', 'display', 'remarks',
    ];
}
