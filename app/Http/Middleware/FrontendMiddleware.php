<?php

namespace App\Http\Middleware;

use Closure;

class FrontendMiddleware
{
    public function handle($request, Closure $next)
    {
        if(getAuthMember()){
            app()->setLocale(getAuthMember()->lang);
        }
        return $next($request);
    }
}
