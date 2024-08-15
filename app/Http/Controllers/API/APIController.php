<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Api;
use App\Http\Resources\APIResource;
use Illuminate\Support\Facades\Validator;

class APIController extends BaseController
{
    
    public function index(): JsonResponse
    {
        try {
            $api = Api::all();
            return $this->sendResponse($api, 'API retrieved successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while retrieving API.', $e->getMessage());
        }
    }
    
    public function show($id): JsonResponse
    {
        try {
            $api = Api::find($id);
            if (is_null($api)) {
                return $this->sendError('API not found.');
            }
       
            return $this->sendResponse(new APIResource($api), 'API retrieved successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while retrieving API.', $e->getMessage());
        }
    }

    
    public function store(Request $request): JsonResponse
    {
        try {
            $input = $request->all();
       
            $validator = Validator::make($input, [
                'api_name' => 'required',
                'api_value' => 'required'
            ]);
       
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }
       
            $api = Api::create($input);
       
            return $this->sendResponse(new APIResource($api), 'API created successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while creating API.', $e->getMessage());
        }
    } 

    
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $input = $request->all();
       
            $validator = Validator::make($input, [
                'api_name' => 'required',
                'api_value' => 'required'
            ]);
       
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }
            
            $api = Api::find($id);
            
            if (!$address) {
                return $this->sendError('API not found.', [], 404);
            }
        
            $api->api_name = $input['api_name'];
            $api->api_value = $input['api_value'];
            $api->remarks = $input['remarks'];
            $api->update();
    
            return $this->sendResponse(new APIResource($api), 'API updated successfully.');
        
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while updating API.', $e->getMessage());
        }
    }


    public function destroy($id): JsonResponse
    {
        try {
            $api = Api::find($id);
    
            if (!$api) {
                return $this->sendError('API not found.', [], 404);
            }
        
            // Delete the address
            $api->delete();
       
            return $this->sendResponse([], 'API deleted successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while deleting API.', $e->getMessage());
        }
    }

}
