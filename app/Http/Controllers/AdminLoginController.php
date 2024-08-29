<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class AdminLoginController extends BaseController
{

    public function login(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator -> fails()){
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $credentials = $request->only('email', 'password');
            
            if (Auth::guard('admin')->attempt($credentials)) {
                $admin = Auth::guard('admin')->user();
                $token = $admin->createToken('ecommercetoken')->plainTextToken;

                $success = [
                    'user' => $admin,
                    'authorisation' => [
                        'token' => $token,
                        'type' => 'bearer'
                    ]
                ];

                return $this->sendResponse($success, 'Admin login successfully.');

            } else {
                return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
            }
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while logged in to the system.', $e->getMessage());
        }
    }
}
