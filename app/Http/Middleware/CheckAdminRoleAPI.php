<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdminRoleAPI
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user->role || ($user->role->role != 'administrador' && $user->role->role != 'god')) {
            return response()->json(['message' => 'You are not authorized.'], Response::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}
