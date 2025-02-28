<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->session()->get('token');

        if (empty($token)) {
            return response()->json(['status' => 'error', 'message' => 'Unauthorized, token missing'], 401);
        }

        return $next($request);
    }
}
