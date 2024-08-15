<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Admin\CustomerResource;
use App\Models\Admin\User;

class CustomerController extends BaseController
{
    
    public function index(): JsonResponse
    {
        try {
            $customers = User::all();
            return $this->sendResponse($customers, 'Customers retrieved successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while retrieving customers.', $e->getMessage());
        }
    }

    public function show($id): JsonResponse
    {
        try {
            $customer = User::find($id);
            if (is_null($customer)) {
                return $this->sendError('Customer not found.');
            }
       
            return $this->sendResponse(new CustomerResource($customer), 'Customer retrieved successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while retrieving customer.', $e->getMessage());
        }
    }

    
    public function store(Request $request): JsonResponse
    {
        try {
            $input = $request->all();
       
            $validator = Validator::make($input, [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
            ]);
       
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }
       
            $customer = User::create($input);
       
            return $this->sendResponse(new CustomerResource($customer), 'Customer created successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while creating customer.', $e->getMessage());
        }
    } 
    
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $input = $request->all();
       
            $validator = Validator::make($input, [
                'name' => 'required',
                'email' => 'required|email'
            ]);
       
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }
            
            $customer = User::find($id);
            
            if (!$customer) {
                return $this->sendError('Customer not found.', [], 404);
            }
        
            $customer->name = $input['name'];
            $customer->email = $input['email'];
            $customer->update();
    
            return $this->sendResponse(new CustomerResource($customer), 'Customer updated successfully.');
        
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while updating customer.', $e->getMessage());
        }
    }

    public function destroy($id): JsonResponse
    {
        try {
            $customer = User::find($id);
    
            if (!$customer) {
                return $this->sendError('Customer not found.', [], 404);
            }
        
            // Delete the address
            $customer->delete();
       
            return $this->sendResponse([], 'Customer deleted successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while deleting customer.', $e->getMessage());
        }
    }

}
