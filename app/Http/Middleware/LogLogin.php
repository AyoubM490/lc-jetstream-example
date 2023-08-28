<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogLogin
{
    public function __construct()
    {
    }

    public function handle($request, $next)
    {
        Log::info("This user is logging in: " . $request->email);
        return $next($request);
    }
}
