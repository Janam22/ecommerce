<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Admin\ColorResource;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\Color;

class ColorController extends BaseController
{
    
    public function index(): JsonResponse
    {
        try {
            $colors = Color::all();
            return $this->sendResponse($colors, 'Colors retrieved successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while retrieving colors.', $e->getMessage());
        }
    }
    
    public function show($id): JsonResponse
    {
        try {
            $color = Color::find($id);
            if (is_null($color)) {
                return $this->sendError('Color not found.');
            }
       
            return $this->sendResponse(new ColorResource($color), 'Color retrieved successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while retrieving color.', $e->getMessage());
        }
    }
    
    
    public function store(Request $request): JsonResponse
    {
        try {
            $input = $request->all();
       
            $validator = Validator::make($input, [
                'color_name' => 'required|unique:colors',
                'color_code' => 'required',
            ]);
       
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }
       
            $color = Color::create($input);
       
            return $this->sendResponse(new ColorResource($color), 'Color created successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while creating color.', $e->getMessage());
        }
    } 
    
    public function destroy($id): JsonResponse
    {
        try {
            $color = Color::find($id);
    
            if (!$color) {
                return $this->sendError('Color not found.', [], 404);
            }
        
            // Delete the color
            $color->delete();
       
            return $this->sendResponse([], 'Color deleted successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while deleting color.', $e->getMessage());
        }
    }

    
    public function bulkDelete(Request $request)
    {
        $ids = $request->input('ids');

        // Validate the input
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'required|integer|exists:colors,id'
        ]);

        try {
            // Perform bulk delete
            Color::whereIn('id', $ids)->delete();
            return $this->sendResponse([], 'Colors deleted successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while deleting colors.', $e->getMessage());
        }
    }
    

}
