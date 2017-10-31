<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use Response;

class LoginMiddleware
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }



    public function handle($request, Closure $next)
    {
        if(!Auth::check()) // 登陆不成功
        {
            $return["status"] = false;
            $return["log"] = "no-login";
            $return["msg"] = "请先登录";
            return Response::json($return);
        }
        return $next($request);

    }
}
