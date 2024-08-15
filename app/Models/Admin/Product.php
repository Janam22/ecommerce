<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_code','product_name', 'category_id', 'specification', 'actual_price', 
        'sell_price', 'retailer_price', 'wholesaler_price', 'dealer_price', 'img_path',
        'primary_image', 'secondary_image', 'remarks',
    ];
}
