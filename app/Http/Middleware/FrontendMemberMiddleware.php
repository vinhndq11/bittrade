<?php

namespace App\Http\Middleware;

use Closure;

class FrontendMemberMiddleware
{
    public function handle($request, Closure $next)
    {
        if(auth(GUARD_MEMBER)->check()){
            return $next($request);
        }
        return redirect()->route('frontend.login.get');
    }
}
