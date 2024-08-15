<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController as BaseController;
use App\Models\Admin\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class CustomerRegisterController extends BaseController
{
        // Register API
        public function register(Request $request): JsonResponse {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string',
                'email' => 'required|string|email|unique:users',
                'password' => 'required',
                'c_password' => 'required|same:password',
            ]);
    
            if ($validator -> fails()){
                return $this->sendError('Validation Error.', $validator->errors());
            }
    
            try {

                $input = $request->all();
                $input['password'] = bcrypt($input['password']);
                $user = User::create($input);
                $success['name'] = $user->name;

                return $this->sendResponse($success, 'User register successfully.');
            } catch (\Exception $e) {
                return $this->sendError('An error occurred while registering to the system.', $e->getMessage());
            }
        }

    public function login(Request $request): JsonResponse {
        try {
            $credentials = $request->only('email', 'password');
            if(Auth::attempt($credentials)){ 
            //if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
                $user = Auth::user(); 
                $success['name'] =  $user->name;
                $success['email'] =  $user->email;
                $success['id'] =  $user->id;
       
                return $this->sendResponse($success, 'User login successfully.');
            } 
            else{ 
                return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
            }
        } catch (\Exception $e) {
            return $this->sendError('An error occurred while logged in to the system.', $e->getMessage());
        }
    }
}
