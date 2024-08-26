<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVarient extends Model
{
    use HasFactory;
    protected $table = 'productvarient'; // specify the correct table name
    protected $fillable = [
        'product_id', 'color_id', 'stock_in', 'stock_out', 'defective', 'returned', 'available', 'total', 'remarks',
    ];
}
