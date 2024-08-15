<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\JsonResponse;
use App\Models\Admin\Category;
use App\Http\Resources\Admin\CategoryResource;

class CategoryController extends BaseController
{
    
    public function index(): JsonResponse
    {
        try{

            $categories = Category::all();
            return $this->sendResponse($categories, 'Categories retrieved successfully.');

        } catch (\Exception $e) {
            return $this->sendError('An error occurred while retrieving categories.', $e->getMessage());
        }
    }
    
    public function show($id): JsonResponse
    {
        try {
            $category = Category::find($id);
            if (is_null($category)) {
                return $this->sendError('Category not found.');
            }
       
            return $this->sendResponse(new CategoryResource($category), 'Category retrieved successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while retrieving category.', $e->getMessage());
        }
    }
    
    public function store(Request $request): JsonResponse
    {
        try {
            $input = $request->all();
       
            $validator = Validator::make($input, [
                'category_name' => 'required',
                'category_type' => 'required',
                'category_id' => 'required|unique:category',
                'image_path' => 'required'
            ]);
       
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }
       
            $category = Category::create($input);
       
            return $this->sendResponse(new CategoryResource($category), 'Category created successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while creating category.', $e->getMessage());
        }
    } 
    
    public function update(Request $request, $id): JsonResponse
    {
        try {
            $input = $request->all();
       
            $validator = Validator::make($input, [
                'category_name' => 'required',
                'category_type' => 'required',
                'category_id' => 'required',
                'image_path' => 'required|image|mimes:jpeg,png,jpg'
            ]);
       
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }
            
            $category = Category::find($id);
            
            if (!$category) {
                return $this->sendError('Category not found.', [], 404);
            }
            
            $category->category_name = $input['category_name'];
            $category->category_type = $input['category_type'];
            $category->category_id = $input['category_id'];

            if ($request-> hasFile('image_path')) {
                $categoryphoto = $request->file('image_path');
                $imagephotoName = $category->id . time() . '_category.' . $categoryphoto->getClientOriginalExtension();
                $categoryphoto->move(public_path('storage/category_image/'), $categoryphotoName);
                $category->image_path = $categoryphotoName;
            } else {
                $category-> image_path = $category->getOriginal('image_path');
            }

            $category->remarks = $input['remarks'] ?? $category->remarks;
            $category->save();
    
            return $this->sendResponse(new CategoryResource($category), 'Category updated successfully.');
        
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while updating category.', $e->getMessage());
        }
    }
    
    public function destroy($id): JsonResponse
    {
        try {
            $category = Category::find($id);
    
            if (!$category) {
                return $this->sendError('Category not found.', [], 404);
            }
        
            // Delete the address
            $category->delete();
       
            return $this->sendResponse([], 'Category deleted successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while deleting category.', $e->getMessage());
        }
    }

}
