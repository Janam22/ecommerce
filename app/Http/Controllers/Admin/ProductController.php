<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Admin\Product;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Admin\ProductResource;
use Illuminate\Http\JsonResponse;

class ProductController extends BaseController
{

    public function index(): JsonResponse
    {
        try {
            $products = Product::all();
            return $this->sendResponse(ProductResource::collection($products), 'Products retrieved successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while retrieving products.', $e->getMessage());
        }
    }


    public function store(Request $request): JsonResponse
    { 
        try {
            $input = $request->all();
       
            $validator = Validator::make($input, [
                'product_name' => 'required',
                'category_id' => 'required',
                'actual_price' => 'required',
                'sell_price' => 'required',
                'retailer_price' => 'required',
                'wholesaler_price' => 'required',
                'dealer_price' => 'required',
                'img_path' => 'required',
                'primary_image' => 'required',
                'secndary_image' => 'required'
            ]);
       
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }
       
            $product = Product::create($input);
       
            return $this->sendResponse(new ProductResource($product), 'Product created successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while inserting product.', $e->getMessage());
        }
    } 
   

    public function show($id): JsonResponse
    {
        try{
            $product = Product::find($id);
      
            if (is_null($product)) {
                return $this->sendError('Product not found.');
            }
       
            return $this->sendResponse(new ProductResource($product), 'Product retrieved successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while retrieving product.', $e->getMessage());
        }
    }
    

    public function update(Request $request, $id): JsonResponse
    {
        try {
            $input = $request->all();
       
            $validator = Validator::make($input, [
                'product_name' => 'required',
                'category_id' => 'required',
                'actual_price' => 'required',
                'sell_price' => 'required',
                'retailer_price' => 'required',
                'wholesaler_price' => 'required',
                'dealer_price' => 'required',
                'img_path' => 'required',
                'primary_image' => 'required',
                'secndary_image' => 'required'
            ]);
       
            if($validator->fails()){
                return $this->sendError('Validation Error.', $validator->errors());       
            }
       
            $product = Product::find($id);
            
            if (!$product) {
                return $this->sendError('Product not found.', [], 404);
            }
    
            $product->product_code = $input['product_code'];
            $product->product_name = $input['product_name'];
            $product->category_id = $input['category_id'];
            $product->specification = $input['specification'];
            $product->actual_price = $input['actual_price'];
            $product->sell_price = $input['sell_price'];
            $product->retailer_price = $input['retailer_price'];
            $product->wholesaler_price = $input['wholesaler_price'];
            $product->dealer_price = $input['dealer_price'];
            $product->img_path = $input['img_path'];
            $product->primary_image = $input['primary_image'];
            $product->secondary_image = $input['secondary_image'];
            $product->remarks = $input['remarks'];
            $product->update();
    
            return $this->sendResponse(new ProductResource($product), 'Product updated successfully.');
            
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while updating product.', $e->getMessage());
        }

    }


    public function destroy($id): JsonResponse
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                return $this->sendError('Product not found.', [], 404);
            }
        
            // Delete the product
            $product->delete();
       
            return $this->sendResponse([], 'Product deleted successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while deleting product.', $e->getMessage());
        }
    }
}
