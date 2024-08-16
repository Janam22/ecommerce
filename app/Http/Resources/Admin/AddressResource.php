<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'country' => $this->country,
            'province' => $this->province,
            'district' => $this->district,
            'municipality' => $this->municipality,
            'remarks' => $this->remarks,
            'created_at' => $this->created_at ? $this->created_at->format('d/m/Y') : null,
            'updated_at' => $this->updated_at ? $this->updated_at->format('d/m/Y') : null,
        ];
    }
}
