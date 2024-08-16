<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'product_code' => $this->product_code,
            'product_name' => $this->product_name,
            'category_id' => $this->category_id,
            'specification' => $this->specification,
            'actual_price' => $this->actual_price,
            'sell_price' => $this->sell_price,
            'retailer_price' => $this->retailer_price,
            'wholesaler_price' => $this->wholesaler_price,
            'dealer_price' => $this->dealer_price,
            'img_path' => $this->img_path,
            'primary_image' => $this->primary_image,
            'secondary_image' => $this->secondary_image,
            'remarks' => $this->remarks,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
