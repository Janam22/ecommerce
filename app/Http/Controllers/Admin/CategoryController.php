<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\JsonResponse;
use App\Models\Admin\Category;

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
}
