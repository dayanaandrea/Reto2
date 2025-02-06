<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerificarIP
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();
/*
        if (substr($ip, 0, 4) !== '10.5.') {
            return redirect()->route('login');
        }
*/
        
        if ($ip !== '192.168.1.135') {
            return redirect()->route('login');
        }
        

        return $next($request);
    }
}
