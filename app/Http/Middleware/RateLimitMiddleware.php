<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class RateLimitMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $key = $request->ip();

        if (!RateLimiter::tooManyAttempts($key, 3)) {
            RateLimiter::hit($key, 60);
            return $next($request);
        }

        // 制限を超えた場合
        $seconds = RateLimiter::availableIn($key);
        return response('しばらくお待ちください', 429)
            ->header('Retry-After', $seconds);
    }
}