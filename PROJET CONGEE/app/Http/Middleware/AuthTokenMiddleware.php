<?php

namespace App\Http\Middleware;

use Closure;
use App\Employee;
use App\Admin;

class AuthTokenMiddleware
{
    public function handle($request, Closure $next)
    {
        $token = $request->header('Authorization');

        if (!$token || !(Employee::where('api_token', $token)->exists() || Admin::where('api_token', $token)->exists())) {
            return response()->json(['message' => 'Non autorisé'], 401);
        }

        return $next($request);
    }
}
