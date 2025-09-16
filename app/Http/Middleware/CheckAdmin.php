<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role_name !== 'admin') {
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
