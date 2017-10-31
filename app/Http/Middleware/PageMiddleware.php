<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use Response;

class PageMiddleware
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    public function handle($request, Closure $next)
    {
        $page_visitor = $request->get("page_visitor");
        $user_id = Auth::check() ? Auth::id() : 0;
        if($page_visitor != $user_id)
        {
            $return["status"] = false;
            $return["log"] = "page-change";
            $return["msg"] = "用户有变动，请刷新页面";
            return Response::json($return);
        }
        return $next($request);

    }
}
