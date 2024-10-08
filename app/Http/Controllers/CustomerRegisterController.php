<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController as BaseController;
use App\Models\Admin\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class CustomerRegisterController extends BaseController
{
        // Register API
        public function register(Request $request): JsonResponse {
            $input = $request->all();
            $validator = Validator::make($input, [
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users',
                'password' => 'required',
                'c_password' => 'required|same:password',
                'profile_photo_path' => 'nullable'
            ]);
    
            if ($validator -> fails()){
                return $this->sendError('Validation Error.', $validator->errors());
            }
    
            try {

                $user = User::create([
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'password' => bcrypt($input['password']),
                ]);
                
            // Handle file upload
            if ($request->hasFile('profile_photo_path')) {
                $profilephoto = $request->file('profile_photo_path');
                $profilephotoName = $user->id . time() . $input['name'] . $profilephoto->getClientOriginalExtension();
                $profilephoto->move(public_path('storage/users_profile/'), $profilephotoName);

                // Update category with the new image path
                $user->profile_photo_path = $profilephotoName;
                $user->createToken('ecommerce')->plainTextToken;
                $user->save();
            }
                $success['name'] = $user->name;

                return $this->sendResponse($success, 'User registered successfully.');
            } catch (\Exception $e) {
                return $this->sendError('An error occurred while registering to the system.', $e->getMessage());
            }
        }

    public function login(Request $request): JsonResponse {
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);
            
            if ($validator -> fails()){
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $credentials = $request->only('email', 'password');
            if(Auth::guard('user')->attempt($credentials)){ 

                $user = Auth::guard('user')->user(); 
                $data['id'] =  $user->id;
                $data['name'] =  $user->name;
                $data['email'] =  $user->email;
                $data['profile_photo_path'] =  $user->profile_photo_path;

                $success = [
                    'customer' => $data,
                    'authorisation' => [
                        'token' => $token,
                        'type' => 'bearer'
                    ]
                ];
       
                return $this->sendResponse($success, 'Customer login successfully.');
            } 
            else{ 
                return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
            }
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while logged in to the system.', $e->getMessage());
        }
    }
}
