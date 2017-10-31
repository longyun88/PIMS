<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use Cookie;

class AccessMiddleware
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    public function handle($request, Closure $next)
    {

        if(Auth::check()) // 登陆成功
        {
            session()->put("id",Auth::user()->id);
            $return["status"] = false;
            $return["msg"] = "请先登录";
        } else {
            session()->put("id",0);
        }

        return $next($request);
    }
}
