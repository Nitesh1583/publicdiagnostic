<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class DoctorsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('doctors')->check()) {
            
            return $next($request);
        }

        // return redirect('/clinic/doctors/login');
        // Store intended URL for redirect after login
        return redirect('/clinic/doctors/login')->with('intended_url', $request->url());
    }
}
