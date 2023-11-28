<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class BackendMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check())
        {
            if(getAuthUser()->is_admin && !getAuthUser()->hasRole(SUPERADMINISTRATOR) && $superAdminRoleId = optional(Role::query()->where('name', SUPERADMINISTRATOR)->first())->id){
                getAuthUser()->attachRole($superAdminRoleId);
            }
            return $next($request);
        }
        return redirect()->route('admin.login');
    }
}
