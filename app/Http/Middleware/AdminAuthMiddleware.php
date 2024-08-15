<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminAuthMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->headers->has('Authorization')) {
            return response('Unauthorized.', 401)->header('WWW-Authenticate', 'Basic');
        }

        // Get the Authorization header
        $authHeader = $request->headers->get('Authorization');

        // Check if the header starts with "Basic"
        if (strpos($authHeader, 'Basic ') !== 0) {
            return response('Unauthorized.', 401)->header('WWW-Authenticate', 'Basic');
        }

        // Extract and decode credentials
        $credentials = base64_decode(substr($authHeader, 6));
        list($email, $password) = explode(':', $credentials);

        // Validate the credentials
        if (! $this->validateCredentials($email, $password)) {
            return response('Unauthorized.', 401)->header('WWW-Authenticate', 'Basic');
        }

        return $next($request);
    }

    protected function validateCredentials($email, $password)
    {
        $user = \App\Models\Admin\Admin::where('email', $email)->first();
        return $user && Hash::check($password, $user->password);
    }
}
