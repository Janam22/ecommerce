<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class AdminLoginController extends Controller
{

    public function login(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation Error.',
                    'errors' => $validator->errors()
                ], 400);
            }

            $credentials = $request->only('email', 'password');
            
            if (Auth::guard('admin')->attempt($credentials)) {
                $admin = Auth::guard('admin')->user();
                //$token = Auth::attempt($credentials);
                $token = $admin->createToken('ecommercetoken')->plainTextToken;

                $success = [
                    'user' => $admin,
                    'authorisation' => [
                        'token' => $token,
                        'type' => 'bearer'
                    ]
                ];

                return response()->json([
                    'success' => true,
                    'data' => $success,
                    'message' => 'Admin login successfully.'
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized.',
                    'error' => 'Unauthorized'
                ], 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while logging in.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
