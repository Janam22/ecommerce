<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Http\Resources\Admin\AddressResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;
use App\Models\Admin\Address;

class AddressController extends BaseController
{
    public function index(): JsonResponse
    {
        try {
            $addresses = Address::all();
            return $this->sendResponse($addresses, 'Addresses retrieved successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while retrieving addresses.', $e->getMessage());
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $address = Address::find($id);
            if (is_null($address)) {
                return $this->sendError('Address not found.');
            }
       
            return $this->sendResponse(new AddressResource($address), 'Address retrieved successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while retrieving address.', $e->getMessage());
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $input = $request->all();
       
            $validator = Validator::make($input, [
                'country' => 'required',
                'province' => 'required',
                'district' => 'required',
                'municipality' => 'required',
                'remarks' => 'required'
            ]);
       
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }
       
            $address = Address::create($input);
       
            return $this->sendResponse(new AddressResource($address), 'Addreess created successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while creating address.', $e->getMessage());
        }
    } 

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $input = $request->all();
       
            $validator = Validator::make($input, [
                'country' => 'required',
                'province' => 'required',
                'district' => 'required',
                'municipality' => 'required',
                'remarks' => 'required'
            ]);
       
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }
            
            $address = Address::find($id);
            
            if (!$address) {
                return $this->sendError('Product not found.', [], 404);
            }
        
            $address->country = $input['country'];
            $address->province = $input['province'];
            $address->district = $input['district'];
            $address->municipality = $input['municipality'];
            $address->remarks = $input['remarks'];
            $address->update();
    
            return $this->sendResponse(new AddressResource($address), 'Address updated successfully.');
        
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while updating address.', $e->getMessage());
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $address = Address::find($id);
    
            if (!$address) {
                return $this->sendError('Address not found.', [], 404);
            }
        
            // Delete the address
            $address->delete();
       
            return $this->sendResponse([], 'Address deleted successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while deleting address.', $e->getMessage());
        }
    }

}
