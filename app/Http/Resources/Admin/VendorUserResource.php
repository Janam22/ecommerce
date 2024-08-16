<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'active_state' => $this->active_state,
            'user_type' => $this->user_type,
            'vendor_company_name' => $this->vendor_company_name,
            'vendor_email' => $this->vendor_email,
            'vendor_password' => $this->vendor_password,
            'vendor_contact' => $this->vendor_contact,
            'vendor_pan' => $this->vendor_pan,
            'vendor_vat' => $this->vendor_vat,
            'discount_percent' => $this->discount_percent,
            'vendor_address' => $this->vendor_address,
            'remarks' => $this->remarks,
            'deactivated_date' => $this->deactivated_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
