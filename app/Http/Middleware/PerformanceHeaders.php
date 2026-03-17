<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PerformanceHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $startTime = microtime(true);
        
        $response = $next($request);
        
        $executionTime = round((microtime(true) - $startTime) * 1000, 2);
        
        // Add performance headers
        $response->headers->set('X-Response-Time', $executionTime . 'ms');
        $response->headers->set('X-Server-Timing', 'total;dur=' . $executionTime);
        
        // Log slow responses
        if ($executionTime > 1000) { // Log responses taking more than 1 second
            \Log::warning('Slow response detected', [
                'url' => $request->fullUrl(),
                'method' => $request->method(),
                'execution_time' => $executionTime . 'ms',
                'user_agent' => $request->userAgent()
            ]);
        }
        
        return $response;
    }
}
