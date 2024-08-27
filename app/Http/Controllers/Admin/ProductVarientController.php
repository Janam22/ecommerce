<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\Admin\ProductVarientResource;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin\ProductVarient;

class ProductVarientController extends BaseController
{
    
    public function index(): JsonResponse
    {
        try {
            $productvarient = ProductVarient::all();
            return $this->sendResponse($productvarient, 'Product Varient retrieved successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while retrieving product varient.', $e->getMessage());
        }
    }
}
