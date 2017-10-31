<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use Response;

class HomeMiddleware
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    public function handle($request, Closure $next)
    {
        $page_type = $request->get("page_type");
        if($page_type != "Home")
        {
            $return["status"] = false;
            $return["log"] = "page-not-home";
            $return["msg"] = "非法操作，请刷新页面重试";
            return Response::json($return);
        }
        return $next($request);

    }
}
