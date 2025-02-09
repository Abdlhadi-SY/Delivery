<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;
class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if(Auth::user()->status=="user"){
            return response()->json([
                "message" => "you are not allowed to access this page"
            ]);
        }
        return $next($request);
    }
}
