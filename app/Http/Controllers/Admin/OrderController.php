<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use App\Models\Admin\Order;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Admin\OrderResource;
use Illuminate\Http\JsonResponse;

class OrderController extends BaseController
{
    
    public function index(): JsonResponse
    {
        try {
            $orders = Order::all();
            return $this->sendResponse(OrderResource::collection($orders), 'Orders retrieved successfully.');
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while retrieving orders.', $e->getMessage());
        }
    }
}
