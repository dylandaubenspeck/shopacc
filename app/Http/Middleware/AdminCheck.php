<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            // Redirect or abort as per your requirement
            return redirect()->route('login');
        }

        // Check if the authenticated user has admin role
        if (auth()->user()->admin !== 1) {
            // Redirect or abort as per your requirement
            return redirect()->back();
        }
        return $next($request);
    }
}
