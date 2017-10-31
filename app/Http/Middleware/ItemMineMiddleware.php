<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Auth;
use Response;

class ItemMineMiddleware
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }


    public function handle($request, Closure $next)
    {
        $item_id = $request->get("item_id");
        $item = \App\Models\Item::where("id",$item_id)->first();
        if($item)
        {
            $item_belong = $item->belongId;
            $user_id = Auth::user()->id;
            if($item_belong != $user_id)
            {
                $return["status"] = false;
                $return["log"] = "item-no-right";
                $return["msg"] = "没有权限操作别人的信息";
                return Response::json($return);
            }
        }
        else
        {
            $return["status"] = false;
            $return["log"] = "item-no-exist";
            $return["msg"] = "信息有误";
            return Response::json($return);
        }
        return $next($request);
    }
}
