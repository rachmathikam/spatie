<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\AuthorizationException;

class CheckPermission
{


    public function handle(Request $request, Closure $next, $permission)
    {
        if (!Auth::user()->hasPermissionTo($permission)) {
            throw new AuthorizationException('Anda tidak memiliki hak akses !');
        }
        
        return $next($request);
    }
}
