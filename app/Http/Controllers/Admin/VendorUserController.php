<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use App\Http\Resources\Admin\VendorUserResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use App\Models\Admin\VendorUser;

class VendorUserController extends BaseController
{
    
    public function index(): JsonResponse
    {
        try{

            $vendorusers = VendorUser::all();
            return $this->sendResponse($vendorusers, 'Vendor Users retrieved successfully.');

        } catch (\Exception $e) {
            return $this->sendError('An error occurred while retrieving vendor users.', $e->getMessage());
        }
    }
    
    public function show($id): JsonResponse
    {
        try {
            $vendoruser = VendorUser::find($id);
            if (is_null($vendoruser)) {
                return $this->sendError('Vendor User not found.');
            }
       
            return $this->sendResponse(new VendorUserResource($vendoruser), 'Vendor User retrieved successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while retrieving vendor user.', $e->getMessage());
        }
    }
    
    public function store(Request $request): JsonResponse
    {
        try {
            $input = $request->all();
       
            $validator = Validator::make($input, [
                'user_type' => 'required',
                'vendor_company_name' => 'required',
                'vendor_email' => 'required|unique:vendor_users',
                'vendor_password' => 'required',
                'vendor_contact' => 'required',
                'vendor_address' => 'required'
            ]);
       
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }
       
            // Create the vendor user
            $vendoruser = VendorUser::create([
                'active_state' => $input['active_state'],
                'user_type' => $input['user_type'],
                'vendor_company_name' => $input['vendor_company_name'],
                'vendor_email' => $input['vendor_email'],
                'vendor_password' => $input['vendor_password'],
                'vendor_contact' => $input['vendor_contact'],
                'vendor_pan' => $input['vendor_pan'],
                'vendor_vat' => $input['vendor_vat'],
                'discount_percent' => $input['discount_percent'],
                'vendor_address' => $input['vendor_address'],
                'remarks' => $input['remarks'],
                'deactivated_date' => $input['deactivated_date']
            ]);

            $vendoruser->save();
       
            return $this->sendResponse(new VendorUserResource($vendoruser), 'Vendor User created successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while creating vendor user.', $e->getMessage());
        }
    } 
    
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $input = $request->all();
       
            $validator = Validator::make($input, [
                'user_type' => 'required',
                'vendor_company_name' => 'required',
                'vendor_email' => 'required|unique:vendor_users',
                'vendor_password' => 'required',
                'vendor_contact' => 'required',
                'vendor_address' => 'required'
            ]);
       
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }
            
            $vendoruser = VendorUser::find($id);
            
            if (!$category) {
                return $this->sendError('Vendor User not found.', [], 404);
            }
       
            $vendoruser->active_state = $input['active_state'];
            $vendoruser->user_type = $input['user_type'];
            $vendoruser->vendor_company_name = $input['vendor_company_name'];
            $vendoruser->vendor_email = $input['vendor_email'];
            $vendoruser->vendor_password = $input['vendor_password'];
            $vendoruser->vendor_contact = $input['vendor_contact'];
            $vendoruser->vendor_pan = $input['vendor_pan'];
            $vendoruser->vendor_vat = $input['vendor_vat'];
            $vendoruser->discount_percent = $input['discount_percent'];
            $vendoruser->vendor_address = $input['vendor_address'];
            $vendoruser->remarks = $input['remarks'];
            $vendoruser->deactivated_date = $input['deactivated_date'];

            $vendoruser->save();
       
            return $this->sendResponse(new VendorUserResource($vendoruser), 'Vendor User updated successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while updating vendor user.', $e->getMessage());
        }
    } 
    
    public function destroy($id): JsonResponse
    {
        try {
            $vendoruser = VendorUser::find($id);
    
            if (!$vendoruser) {
                return $this->sendError('Vendor User not found.', [], 404);
            }
        
            // Delete the address
            $vendoruser->delete();
       
            return $this->sendResponse([], 'Vendor User deleted successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while deleting vendor user.', $e->getMessage());
        }
    }

}
