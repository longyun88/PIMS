<?php
namespace App\Repositories;

use App\User;
use App\Models\Item;
use App\Models\UserItem;
use App\Models\Todolist;
use App\Repositories\RelationRepository;
use Auth, Response;

class DisplayRepository {

    private $item;
    private $userItem;
    public function __construct()
    {
        $this->item = new Item;
        $this->userItem = new UserItem;
    }


    public function geter()
    {
        $geters = request("geters");
        $geter = $geters["geter"];
        $page_type = request('page_type');
        if(!in_array($page_type,config('display.geter.page'))) return json_encode(['status' => false, 'msg' => '参数有误']);


        if($page_type == "Home")
        {
            if(Auth::check())
            {
                if(in_array($geter,config('display.geter.home')))
                {
                    $geter_sort = isset($geters["geter_sort"]) ? $geters["geter_sort"] : "";
                    $post_data = $geters;

                    if($geter_sort == "Mine")
                    {
                        if($geter == "All") $post_data["get_sort"] = 0;
                        else if($geter == "Mine") $post_data["get_sort"] = 20;
                        else if($geter == "MyTimer") {$post_data["get_sort"] = 0;$post_data["timer"] = 1;}
                        else if($geter == "MyAskbar") $post_data["get_sort"] = 44;
                        else if($geter == "MyStore") $post_data["get_sort"] = 48;
                        else if($geter == "MyGive") {$post_data["get_sort"] = 48;$post_data["give"] = 1;}

                        $datas = $this->get_mine($post_data);
                    }
                    else if($geter_sort == "Others")
                    {
                        if($geter == "MyCollect") $post_data["type"] = "collect";
                        else if($geter == "MyFavor") $post_data["type"] = "favor";
                        else if($geter == "MyAnswer") $post_data["type"] = "answer";

                        $datas = $this->get_user_item($post_data);
                    }
                    else if($geter_sort == "Friend")
                    {
                        if($geter == config('display.geter.home.friend')) $post_data["get_sort"] = 20;
                        else if($geter == config('display.geter.home.friTimer')) {$post_data["get_sort"] = 20;$post_data["timer"] = 1;}
                        else if($geter == config('display.geter.home.friAsk')) $post_data["get_sort"] = 44;
                        else if($geter == config('display.geter.home.friGoods')) $post_data["get_sort"] = 48;
                        else if($geter == config('display.geter.home.friGive')) {$post_data["get_sort"] = 48;$post_data["give"] = 1;}

                        $datas = $this->get_friend($post_data);
                    }


                    if($geter == "MyWorking") $datas = $this->get_my_working();
                    if($geter == config('display.geter.home.schedule'))
                    {
                        $geter_sort = $geters["geter_sort"];
                        $geter_value = $geters["geter_value"];
                        if(in_array($geter_sort,config('display.geter.schedule.type')))
                        {
                            $interval_unix = return_interval_unix($geter_sort,$geter_value);
                            $start_time = $interval_unix["start_unix"];
                            $end_time = $interval_unix["end_unix"];
                        }
                        else
                        {
                            $start_time = $geters["start_time"];
                            $end_time = $geters["end_time"];
                        }
                        $datas = $this->get_my_interval_schedule($start_time,$end_time);
                    }
                }
                else return json_encode(['status'=>false,'msg'=>'参数有误']);
            }
            else return json_encode(['status'=>false,'msg'=>'请先登录']);
        }
        else if($page_type == "Guest")
        {
            if(in_array($geter,config('display.geter.guest')))
            {
                $post_data = $geters;
                if($geter == "Guest") $post_data["get_sort"] = 0;
                else if($geter == "GuestTimer") {$post_data["get_sort"] = 0;$post_data["timer"] = 1;}
                else if($geter == "GuestAskbar") $post_data["get_sort"] = 44;
                else if($geter == "GuestStore") $post_data["get_sort"] = 48;
                else if($geter == "Give") {$post_data["get_sort"] = 48;$post_data["give"] = 1;}

                if($geter == config('display.geter.guest.schedule'))
                {
                    $geter_sort = $geters["geter_sort"];
                    $geter_value = $geters["geter_value"];
                    if(in_array($geter_sort,config('display.geter.schedule.type')))
                    {
                        $interval_unix = return_interval_unix($geter_sort,$geter_value);
                        $start_time = $interval_unix["start_unix"];
                        $end_time = $interval_unix["end_unix"];
                    }
                    else
                    {
                        $start_time = $geters["start_time"];
                        $end_time = $geters["end_time"];
                    }

                    $datas = $this->get_interval_schedule($start_time,$end_time);
                }
                else $datas = $this->get_guest($post_data);

            }
            else return json_encode(['status'=>false,'msg'=>'参数有误']);
        }
        else if($page_type == "User")
        {
            if(in_array($geter,config('display.geter.user')))
            {
                $post_data = $geters;
                if($geter == "His") $post_data["get_sort"] = 0;
                else if($geter == "HisTimer") {$post_data["get_sort"] = 0;$post_data["timer"] = 1;}
                else if($geter == "HisAskbar") $post_data["get_sort"] = 44;
                else if($geter == "HisStore") $post_data["get_sort"] = 48;
                else if($geter == "HisGive") {$post_data["get_sort"] = 48;$post_data["give"] = 1;}
                $datas = $this->get_user($post_data);
//            else if($geter == "GuestSchedule") {$post_data["get_sort"] = 48;$post_data["give"] = 1;}
            }
            else return json_encode(['status'=>false,'msg'=>'参数有误']);
        }
        else if($page_type == "Item")
        {

        }
        $datas["status"] = true;
        $datas["msg"] = "";

        return json_encode($datas);
    }

    public function get_mine($post_data)
    {
        $my_id = (Auth::check()) ? Auth::user()->id : 0;
        $get_type = isset($post_data["get_type"]) ? $post_data["get_type"] : "init";
        $get_first = isset($post_data["get_first"]) ? $post_data["get_first"] : 0;
        $get_last = isset($post_data["get_last"]) ? $post_data["get_last"] : 0;
        $get_sort = isset($post_data["get_sort"]) ? $post_data["get_sort"] : 0;

        $query = Item::with(['belongUser','sourceUser','originItem','quoteItem',
            'user_item'=>function ($query) use ($my_id) {$query->where('user_id',$my_id);} ]);

        if($get_type == "more") $query->where("id", "<", $get_last);
        else if($get_type == "new") $query->where("id", ">", $get_first);

        if($get_sort == 20) $query->where("sort", '>=', $get_sort);
        if($get_sort > 20)$query->where("sort", $get_sort);
        if(!empty($post_data["timer"])) $query->where("time_type", ">=", 1); // 有时间的信息
        if(!empty($post_data["give"])) $query->where("type", 9); // 闲置物品

        $datas = $query->where("belongId",$my_id)->where("isShared",">=",20)
            ->orderBy("updated_at","desc")->orderBy("id","desc")->limit(30)->get();
//        $return["datas"] = $datas;
        $return["html"] = view('assign.itemtv')->with("datas",$datas)->__toString();
        $count = $datas->count();
        if($count)
        {
            $first = $datas->first();
            $last = $datas->last();
            $return["location_first"] = strtotime($first->updated_at);
            $return["location_last"] = strtotime($last->updated_at);
        }
        else
        {
            $return["location_first"] = 0;
            $return["location_last"] = 0;
        }
        $return["count"] = $count;
        $return["more"] = ($count<30) ? 0 : 1;
        return $return;
    }

    public function get_my_working()
    {
//        $my_id = (Auth::check()) ? Auth::user()->id : 0;
//        $items = Todolist::with(['item'=>function($query) {
//            $query->with(['belongUser','sourceUser','originItem','quoteItem','user_item']);
//        }])->where("user_id",$my_id)->orderBy("importance","DESC")->orderBy("updated_at","DESC")->get();
//        if($items->count())
//        {
//            foreach($items as $k => $v)
//            {
//                $item = $v->item;
//                unset($v->item);
//                $items[$k] = $item;
////                $items[$k]["item_id"] = $item["id"];
//            }
//            return $items;
//        }
//        else return null;


        $user_id = Auth::user()->id;
        $query = UserItem::with(['item'])->where("user_id",$user_id)->where("work_is",1);
        $datas = $query->orderBy("importance","desc")->orderBy("work_time","desc")->get();
        $count = $datas->count();
        if($datas->count())
        {
            foreach($datas as $k => $v)
            {
                $item = $v->item;
                unset($v->item);
                $datas[$k] = $item;
                $datas[$k]->user_item = $v;
                $datas[$k]->order = strtotime($v->updated_at);
            }
        }
        $return["html"] = view('assign.itemtv')->with("datas",$datas)->__toString();
        $return["count"] = $count;
        $return["more"] = ($count<30) ? 0 : 1;
        return $return;
    }

    public function get_guest($post_data)
    {
        $my_id = (Auth::check()) ? Auth::user()->id : 0;
        $get_type = isset($post_data["get_type"]) ? $post_data["get_type"] : "init";
        $get_first = isset($post_data["get_first"]) ? $post_data["get_first"] : 0;
        $get_last = isset($post_data["get_last"]) ? $post_data["get_last"] : 0;
        $get_sort = isset($post_data["get_sort"]) ? $post_data["get_sort"] : 0;

        $query = Item::with(['belongUser','sourceUser','originItem','quoteItem',
            'user_item'=>function ($query) use ($my_id) {$query->where('user_id',$my_id);} ]);

        if($get_type == "more") $query->where("id", "<", $get_last);
        else if($get_type == "new") $query->where("id", ">", $get_first);

        if($get_sort != 0) $query->where("sort", $get_sort);
        if(!empty($post_data["timer"])) $query->where("time_type", ">=", 1); // 有时间的信息
        if(!empty($post_data["give"])) $query->where("type", 9); // 闲置物品

        $datas = $query->where("sort",">=",20)->where("isShared",">=",99)->orderBy("id","desc")->limit(30)->get();
        $return["html"] = view('assign.itemtv')->with("datas",$datas)->__toString();
        $count = $datas->count();
        if($count)
        {
            $first = $datas->first();
            $last = $datas->last();
            $return["location_first"] = $first->id;
            $return["location_last"] = $last->id;
        }
        else
        {
            $return["location_first"] = 0;
            $return["location_last"] = 0;
        }
        $return["count"] = $count;
        $return["more"] = ($count<30) ? 0 : 1;
        return $return;
    }

    public function get_user($post_data)
    {
        $my_id = (Auth::check()) ? Auth::user()->id : 0;

        $his_id = isset($post_data["his_id"]) ? $post_data["his_id"] : 0;
        $get_type = isset($post_data["get_type"]) ? $post_data["get_type"] : "init";
        $get_first = isset($post_data["get_first"]) ? $post_data["get_first"] : 0;
        $get_last = isset($post_data["get_last"]) ? $post_data["get_last"] : 0;
        $get_sort = isset($post_data["get_sort"]) ? $post_data["get_sort"] : 0;

//        $relationRepo = new RelationRepository;
//        $relation = $relationRepo->relation($his_id,$my_id);
//        if($relation == 0) $permission = 99;
//        else if(($relation > 0) && ($relation < 40)) $permission = 40;
//        else $permission = 99;
        $permission = isset($permission) ? $permission : 99;

        $query = Item::with(['belongUser','sourceUser','originItem','quoteItem',
            'user_item'=>function ($query) use ($my_id) {$query->where('user_id',$my_id);} ]);

        if($get_type == "more") $query->where("id", "<", $get_last);
        else if($get_type == "new") $query->where("id", ">", $get_first);

        if($get_sort != 0) $query->where("sort", $get_sort);
        if(!empty($post_data["timer"])) $query->where("time_type", ">=", 1); // 有时间的信息
        if(!empty($post_data["give"])) $query->where("type", 9); // 闲置物品

        $datas = $query->where("belongId",$his_id)->where("sort",">",20)->where("isShared",">=",$permission)
            ->orderBy("id","desc")->limit(30)->get();
//        $return["datas"] = $datas;
        $return["html"] = view('assign.itemtv')->with("datas",$datas)->__toString();
        $count = $datas->count();
        $return["count"] = $count;
        if($count)
        {
            $first = $datas->first();
            $last = $datas->last();
            $return["location_first"] = $first->id;
            $return["location_last"] = $last->id;
        }
        else
        {
            $return["location_first"] = 0;
            $return["location_last"] = 0;
        }
        $return["more"] = ($count<30) ? 0 : 1;
        return $return;
    }

    public function get_friend($post_data)
    {
        $my_id = (Auth::check()) ? Auth::user()->id : 0;
        $get_type = isset($post_data["get_type"]) ? $post_data["get_type"] : "init";
        $get_first = isset($post_data["get_first"]) ? $post_data["get_first"] : 0;
        $get_last = isset($post_data["get_last"]) ? $post_data["get_last"] : 0;
        $get_sort = isset($post_data["get_sort"]) ? $post_data["get_sort"] : 0;

        $query = Item::with(['belongUser','sourceUser','originItem','quoteItem',
            'user_item'=>function ($query) use ($my_id) {$query->where('user_id',$my_id);} ]);
        $tableItem = "users_item";
        $tableRelation = "relations";

        $query = $query->join("{$tableRelation} AS relation", $tableItem.'.belongId', '=', 'relation.object_id')
            ->where('relation.belong_id', $my_id)
            ->where('relation.relationship', '<=', 40);

        if($get_sort == 20) $query->where($tableItem.".sort", '>=', $get_sort);
        if($get_sort > 20)$query->where($tableItem.".sort", $get_sort);
        if(!empty($post_data["timer"])) $query->where($tableItem.".time_type", ">=", 1); // 有时间的信息
        if(!empty($post_data["give"])) $query->where($tableItem.".type", 9); // 闲置物品

        if($get_type == "more") $query->where($tableItem.".id", "<", $get_last);
        else if($get_type == "new") $query->where($tableItem.".id", ">", $get_first);

        $datas = $query->where($tableItem.'.isShared', '>=', 40)
            ->select($tableItem.'.*')->orderBy($tableItem.'.id', 'desc')->limit(30)->get();
        $return["html"] = view('assign.itemtv')->with("datas",$datas)->__toString();
        $count = $datas->count();
        if($count)
        {
            $first = $datas->first();
            $last = $datas->last();
            $return["location_first"] = $first->id;
            $return["location_last"] = $last->id;
        }
        else
        {
            $return["location_first"] = 0;
            $return["location_last"] = 0;
        }
        $return["count"] = $count;
        $return["more"] = ($count<30) ? 0 : 1;
        return $return;
    }

    public function get_user_item($post_data)
    {
        $type = $post_data["type"];
        $get_type = isset($post_data["get_type"]) ? $post_data["get_type"] : "init";
        $get_first = isset($post_data["get_first"]) ? $post_data["get_first"] : 0;
        $get_last = isset($post_data["get_last"]) ? $post_data["get_last"] : 0;
        if(in_array($type,config('item.user_item_type')))
        {
            $user_id = Auth::user()->id;
            $query = UserItem::with(['item'])->where("user_id",$user_id)->where($type."_is",1);

            if($get_type == "more") $query->where("id", "<", $get_last);
            else if($get_type == "new") $query->where("id", ">", $get_first);

            $datas = $query->limit(30)->orderBy($type."_time","desc")->get();
            $count = $datas->count();
            if($datas->count())
            {
                foreach($datas as $k => $v)
                {
                    $item = $v->item;
                    unset($v->item);
                    $datas[$k] = $item;
                    $datas[$k]->user_item = $v;
                    $datas[$k]->order = strtotime($v->updated_at);
                }
            }
            $return["html"] = view('assign.itemtv')->with("datas",$datas)->__toString();
            if($count)
            {
                $first = $datas->first();
                $last = $datas->last();
                $return["location_first"] = $first->order;
                $return["location_last"] = $last->order;
            }
            else
            {
                $return["location_first"] = 0;
                $return["location_last"] = 0;
            }
            $return["count"] = $count;
            $return["more"] = ($count<30) ? 0 : 1;
            return $return;
        }
        else return json_encode(['status'=>false,'msg'=>'参数有误']);
    }



    /* 获取 日程 */
    public function get_my_interval_schedule($start_time,$end_time) // 获取 一个时间段
    {
        if(Auth::check())
        {
            $user_id = Auth::user()->id;
            $query = UserItem::with(['item'])->where("user_id",$user_id)->where("agenda_is",1)->where("time_type", ">=", 1);
            $query->where(function ($query) use($start_time,$end_time) {
                    $query
                        ->where(function ($query) use($start_time,$end_time) {
                            $query->where('start_time', '>=', $start_time)->where('start_time', '<=', $end_time);})
                        ->orWhere(function ($query) use($start_time,$end_time) {
                            $query->where('end_time', '>=', $start_time)->where('end_time', '<=', $end_time);})
                        ->orWhere(function ($query) use($start_time,$end_time) {
                            $query->where('start_time', '<=', $start_time)->where('end_time', '>=', $end_time);});
                });
            $datas = $query->orderBy("end_time","desc")->orderBy("start_time","desc")->get();
            $count = $datas->count();
            if($datas->count())
            {
                foreach($datas as $k => $v)
                {
                    $item = $v->item;
                    unset($v->item);
                    $datas[$k] = $item;
                    $datas[$k]->user_item = $v;
                    $datas[$k]->order = strtotime($v->updated_at);
                }
            }
            $return["count"] = $count;
            $return["html"] = view('assign.itemtv')->with("datas",$datas)->__toString();
            return $return;
        }
        else return json_encode(['status'=>false,'msg'=>'请先登录']);
    }
    public function get_my_moment_schedule($moment) // 获取 一个时间段
    {
        if(Auth::check())
        {
            $user_id = Auth::id();
            $query = UserItem::with(['item'])->where("user_id",$user_id)->where("agenda_is",1)->where("time_type", ">=", 1)
                ->where('start_time', '<=', $moment)->where('end_time', '>=', $moment);
            $datas = $query->orderBy("end_time","desc")->orderBy("start_time","desc")->get();
            $count = $datas->count();
            if($datas->count())
            {
                foreach($datas as $k => $v)
                {
                    $item = $v->item;
                    unset($v->item);
                    $datas[$k] = $item;
                    $datas[$k]->user_item = $v;
                    $datas[$k]->order = strtotime($v->updated_at);
                }
            }
            $return["count"] = $count;
            $return["html"] = view('assign.itemtv')->with("datas",$datas)->__toString();
            return $return;
        }
        else return json_encode(['status'=>false,'msg'=>'请先登录']);
    }


    public function get_interval_schedule($start_time,$end_time) // 获取 一个时间段
    {
        $my_id = (Auth::check()) ? Auth::user()->id : 0;
        $query = Item::with(['belongUser','sourceUser','originItem','quoteItem',
            'user_item'=>function ($query) use ($my_id) {$query->where('user_id',$my_id);} ])
            ->where("time_type", ">=", 1)->where("isShared", ">=", 99);
        $query->where(function ($query) use($start_time,$end_time) {
            $query
                ->where(function ($query) use($start_time,$end_time) {
                    $query->where('start_time', '>=', $start_time)->where('start_time', '<=', $end_time);})
                ->orWhere(function ($query) use($start_time,$end_time) {
                    $query->where('end_time', '>=', $start_time)->where('end_time', '<=', $end_time);})
                ->orWhere(function ($query) use($start_time,$end_time) {
                    $query->where('start_time', '<=', $start_time)->where('end_time', '>=', $end_time);});
        });
        $datas = $query->orderBy("end_time","desc")->orderBy("start_time","desc")->get();
        $count = $datas->count();
        $return["count"] = $count;
        $return["html"] = view('assign.itemtv')->with("datas",$datas)->__toString();
        return $return;
    }
    public function get_moment_schedule($moment) // 获取 一个时间段
    {
        $my_id = (Auth::check()) ? Auth::user()->id : 0;
        $query = Item::with(['belongUser','sourceUser','originItem','quoteItem',
            'user_item'=>function ($query) use ($my_id) {$query->where('user_id',$my_id);} ])
            ->where("time_type", ">=", 1)->where("isShared", ">=", 99)
            ->where('start_time', '<=', $moment)->where('end_time', '>=', $moment);
        $datas = $query->orderBy("end_time","desc")->orderBy("start_time","desc")->get();
        $count = $datas->count();
        $return["count"] = $count;
        $return["html"] = view('assign.itemtv')->with("datas",$datas)->__toString();
        return $return;
    }




}