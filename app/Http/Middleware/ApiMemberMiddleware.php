<?php

namespace App\Http\Middleware;

use Closure;

class ApiMemberMiddleware
{
    public function handle($request, Closure $next)
    {
        $token = $request->header('Authorization');
        $member = getUserFromToken($token);
        if(!$token || !$member){
            return response()->json(responseJSON_EMPTY_OBJECT(false, 'Lỗi xác thực, vui lòng đăng nhập lại', ERROR_CODE_UNAUTHORIZED));
        }
        \DataSingleton::getInstance()->setUser($member);
        \DataSingleton::getInstance()->setToken($token);
        return $next($request);
    }
}
