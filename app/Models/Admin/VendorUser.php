<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorUser extends Model
{
    use HasFactory;
    protected $table = 'vendor_users'; // specify the correct table name
    protected $fillable = [
        'active_state', 'user_type', 'vendor_company_name', 'vendor_email', 'vendor_password',
        'vendor_contact', 'vendor_pan', 'vendor_vat', 'discount_percent', 'vendor_address', 'remarks', 'deactivated_date',
    ];
}
