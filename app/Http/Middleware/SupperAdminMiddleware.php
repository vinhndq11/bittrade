<?php

namespace App\Http\Middleware;

use Closure;
use Laratrust\Middleware\LaratrustMiddleware;

class SupperAdminMiddleware extends LaratrustMiddleware
{
    public function handle($request, Closure $next, $roles, $team = null, $options = '')
    {
        $roles2Array = explode(',', $roles) ?? [];
        if (!$this->authorization('roles', $roles, $team, $options) && !hasRoleSuperAdminAndEtc($roles2Array)) {
            return $this->unauthorized();
        }
        return $next($request);
    }
}
