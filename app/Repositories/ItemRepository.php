<?php
namespace App\Repositories;
use App\Models\Item;
use App\Models\Communication;
use App\Repositories\UserItemRepository;
use Response, Auth, Validator, DB, Excepiton;

class ItemRepository {

    private $userItemRepo;
    public function __construct()
    {
        $this->item = new Item;
        $this->userItemRepo = new UserItemRepository;
    }

    public function info($id)
    {
        return Item::where('id',$id)->first();
    }

    public function add_item($post_data)
    {

        $my_id = Auth::check() ? Auth::id() : 0;
        if($my_id == 0) return json_encode(["status" => false, "msg" => "添加失败"]);

        $adder = $post_data["adder"];
        $time = time();

        $insert["time"] = $time;
        $insert["modified"] = $time;
        $insert["sort"] = $adder["sort"];
        $insert["type"] = $adder["type"];
        $insert["form"] = $adder["form"];
        $insert["belongId"] = $my_id;
        $insert["sourceId"] = $my_id;
        $insert["objectId"] = isset($adder["object"]) ? $adder["object"] : NULL;  // 对象
        $insert["theme"] = isset($adder["theme"]) ? $adder["theme"] : NULL; // 主题
        $insert["content"] = isset($adder["content"]) ? $adder["content"] : NULL; // 内容
        $insert["tag"] = isset($adder["tag"]) ? $adder["tag"] : NULL; // 关键字
        $insert["attaching"] = isset($adder["attaching"]) ? $adder["attaching"] : NULL; // 附图
        $insert["attachment"] = isset($adder["attachment"]) ? $adder["attachment"] : NULL; // 附件
        $insert["isShared"] = $adder["share"];
        $insert["time_type"] = isset($adder["time_type"]) ? $adder["time_type"] : 0;
        $insert["working"] = isset($adder["working"]) ? $adder["working"] : 0;
        $insert["importance"] = isset($adder["importance"]) ? $adder["importance"] : 0;
        $insert["price"] = isset($adder["price"]) ? $adder["price"] : 0;

        $working = $insert["working"];
        $importance = $insert["importance"];
        $time_type = $insert["time_type"];
        if($time_type)
        {
            $start_type = isset($adder["start_type"]) ? $adder["start_type"] : 0;
            $start_time = isset($adder["start_time"]) ? $adder["start_time"] : NULL;
            $end_type = isset($adder["end_type"]) ? $adder["end_type"] : 0;
            $end_time = isset($adder["end_time"]) ? $adder["end_time"] : NULL;
        }

        if($time_type == 1) // 一次性日程
        {
            if($start_type == 0) $start_time = get_today_start_unix();
            else if($start_type == 1) $start_time = strtotime($start_time);
            else if($start_type == 2) $start_time = strtotime($start_time);

            if($end_type == 0)
            {
                if($start_type == 0) $end_time = get_today_ended_unix();
                else $end_time = get_day_ended_unix($start_time);
            }
            else if($end_type == 1) $end_time = strtotime($end_time);
            else if($end_type == 2) $end_time = strtotime($end_time) + (3600*24-1);
        }
        else if($time_type == 2) // 周期型日程
        {
            $week = date("w");
            $starts = explode("-",$start_time);
            $start_week = $starts[0];
            $endeds = explode("-",$end_time);
            $ended_week = $endeds[0];

            if($start_type == 1)
            {
                $start = strtotime($starts[1]);
                $start = $start + 60*60*24*($start_week - $week);
            }
            else if($start_type == 2) $start = get_today_start_unix() + 60*60*24*($start_week - $week);

            if($end_type == 1)
            {
                $ended = strtotime($endeds[1]);
                if($ended_week >= $start_week) $ended = $ended + 60*60*24*($ended_week - $week);
                else $ended = $ended + 60*60*24*($ended_week + 7 - $week);
            }
            else if($end_type == 2)
            {
                if($ended_week >= $start_week) $ended = get_today_ended_unix() + 60*60*24*($ended_week - $week);
                else $ended = get_today_ended_unix() + 60*60*24*($ended_week + 7 - $week);
                //$ended = strtotime($ended) + (3600*24-1);
            }
            else if($end_type == 0) {
                if($start_type == 0) $ended = get_today_ended_unix();
                else $ended = get_day_ended_unix($start);
            }

            if($start_type == 0)
            {
                //$start = _get_today_start_unix();
                if($end_type == 0) $ended = get_today_start_unix();
                else $start = get_day_start_unix($ended);
            }
        }

        if($time_type)
        {
            $insert["start_type"] = $start_type;
            $insert["start_time"] = $start_time;
            $insert["end_type"] = $end_type;
            $insert["end_time"] = $end_time;
        }


        // 是否引用

        if( !isset($adder["quoteIS"]) )  $quoteIS = 0;
        else $quoteIS = $adder["quoteIS"];
        // 引用（转发）
        if($quoteIS == 1)
        {
            $quote_id = $adder["quote_item_id"];
            $quote_belong = $adder["quote_belong"];

            if($adder["sort"] == 41) $this->setINC($quote_id,"forwardNum",1);

            $infos = $this->info($quote_id);
            if( isset($infos["origin_belong"]) )
            {
                $origin_id = $infos["origin_id"];
                $origin_belong = $infos["origin_belong"];
                if( !isset($infos->theme) && !isset($infos->content) )
                {
                    $quote_content = "@".$quote_belong.'.'.$quote_id." // ".$infos->quote_content;
                }
                else
                {
                    if( !isset($infos["quoteContent"]) )
                    {
                        $quote_content = "@".$quote_belong.'.'.$quote_id.": ".$infos->theme." ".$infos->content."".$infos->quote_content;
                    }
                    else
                    {
                        $quote_content = "@".$quote_belong.'.'.$quote_id.": ".$infos->theme." ".$infos->content."// ".$infos["quoteContent"];
                    }
                }
            }
            else
            {
                $origin_id = $quote_id;
                $origin_belong = $quote_belong;
                $quoteContent = NULL;
            }
            $insert["quote_item_id"] = $quote_id;
            $insert["quote_belong"] = $quote_belong;
            $insert["quote_content"] = $quote_content;
            $insert["origin_item_id"] = $origin_id;
            $insert["origin_belong"] = $origin_belong;

        }


        DB::beginTransaction();
        try
        {
            $item = Item::create($insert);
            if($item)
            {
                $user_item["operate"] = "add";
                $user_item["user_id"] = $my_id;
                $user_item["item_id"] = $item->id;
                if($working == 1)
                {
                    $user_item["type"] = "work";
                    $user_item["attach"]["importance"] = $importance;
                    $working_result = $this->handle_item_relation($user_item);
                    $working_result = json_decode($working_result);
                   if(!$working_result->status) throw new Excepiton("working-false");
                }
                if($time_type > 0)
                {
                    $user_item["type"] = "agenda";
//                    $user_item["attach"]["time_type"] = $time_type;
//                    $user_item["attach"]["start_time"] = $start_time;
//                    $user_item["attach"]["end_time"] = $end_time;
                    $agenda_result = $this->handle_item_relation($user_item);
                    $agenda_result = json_decode($agenda_result);
                    if(!$agenda_result->status) throw new Excepiton("agenda-false");
                }
            }
            DB::commit();
            return json_encode(["status" => true, "msg" => "添加成功"]);
        }
        catch (Excepiton $e)
        {
            DB::rollback();
            $msg = $e->getMessage();
            return json_encode(["status" => false, "msg" => "添加失败"]);
//            exit($e->getMessage());
        }
    }

    public function update_item($post_data)
    {
        $id = $post_data['id'];
        $dataIn['theme'] = $post_data['theme'];
        $dataIn['content'] = $post_data['content'];
        $dataIn['tag'] = $post_data['tag'];
        $this->item->where("id",$id)->update($dataIn);
    }

    public function update_tag($id,$tag)
    {
        $this->item->where("id",$id)->update(["tag"=>$tag]);
    }


    public function get_the_item($id,$permission)
    {
        return Item::with(['belongUser','sourceUser','originItem','quoteItem',
            'user_item'=>function ($query) use ($id) {$query->where('user_id',$id);} ])
            ->where("id",$id)->where("isShared",">=",$permission)->get();
    }
    public function get_the_item_html($id,$permission)
    {
        $item = $this->get_the_item($id,$permission);
        $html = view('assign.itemtv')->with("datas",$item)->__toString();
        return $html;
    }

    public function item_delete($post_data)
    {
        $item_id = $post_data["item_id"];

        if ($this->item->where("id", $item_id)->delete()) $return['status'] = true;
        else $return = ['status' => false, 'log' => "item-delete-fail", 'msg' => "删除失败"];
        return json_encode($return);
    }
    public function item_share($post_data)
    {
        $item_id = $post_data["item_id"];
        $update["isShared"] = $post_data["share"];
        $item = $this->item->where("id", $item_id)->update($update);

        if ($item)
        {
            $return['status'] = true;
            $return["html"] = $this->get_the_item_html($item_id,21);
        }
        else $return = ['status' => false, 'log' => "item-share-fail", 'msg' => "操作失败"];
        return json_encode($return);
    }
    public function item_favor($post_data)
    {
        $operate = $post_data["operate"];
        $item_id = $post_data["item_id"];

        $post["user_id"] = Auth::id();
        $post["item_id"] = $item_id;
        $post["type"] = "favor";

        if($operate == config('item.operate.favor.add'))
        {
            $post["operate"] = "add";
            $item = $this->item->where("id", $item_id)->increment("favor_num",1);
        }
        else if($operate == config('item.operate.favor.cansel'))
        {
            $post["operate"] = "delete";
            $item = $this->item->where("id", $item_id)->decrement("favor_num",1);
        }
        else $return = ['status' => false, 'log' => "item-favor-fail", 'msg' => "参数有误"];

        if($item)
        {
            $userItem = $this->handle_item_relation($post);
            $userItem = json_decode($userItem,true);
            if($userItem['status'])
            {
                $return['status'] = true;
                $return["html"] = $this->get_the_item_html($item_id,21);
            }
            else $return = ['status' => false, 'log' => "item-favor-fail", 'msg' => '操作失败'];
        }
        else $return = ['status' => false, 'log' => "item-favor-fail", 'msg' => '操作失败', 'fail' => 'item'];

        return json_encode($return);
    }
    public function item_score($post_data)
    {
        $user_id = Auth::id();
        $item_id = $post_data["item_id"];
        $score = (int)$post_data["score"];

        $post["user_id"] = $user_id;
        $post["item_id"] = $item_id;
        $post["operate"] = "add";
        $post["type"] = "score";
        $post["attach"]["score"] = $score;

        $userItem = $this->userItemRepo->info($user_id,$item_id);
        if($userItem->score_is == 1)
        {
            $score_num = (int)$userItem->score_num;
            if($score > $score_num)
            {
                $difference = (int)($score - $score_num);
                $item = $this->item->where("id", $item_id)->increment("score_total",$difference);
            }
            else if($score < $score_num)
            {
                $difference = (int)($score_num - $score);
                $item = $this->item->where("id", $item_id)->decrement("score_total",$difference);
            }
        }
        else
        {
            $item = $this->item->where("id", $item_id)->increment("score_num",1);
            if($item)
            {
                $item = $this->item->where("id", $item_id)->increment("score_total",$score);
            }
        }

        if($item)
        {
            $userItem = $this->handle_item_relation($post);
            $userItem = json_decode($userItem,true);
            if($userItem['status'])
            {
                $return['status'] = true;
                $return["html"] = $this->get_the_item_html($item_id,21);
            }
            else $return = ['status' => false, 'log' => "item-score-fail", 'msg' => '操作失败', 'fail' => 'user_item'];
        }
        else $return = ['status' => false, 'log' => "item-score-fail", 'msg' => '操作失败', 'fail' => 'item'];

        return json_encode($return);
    }
    public function item_collect($post_data)
    {
        $operate = $post_data["operate"];
        $item_id = $post_data["item_id"];

        $post["user_id"] = Auth::id();
        $post["item_id"] = $item_id;
        $post["type"] = "collect";

        if($operate == config('item.operate.collect.add'))
        {
            $post["operate"] = "add";
            $item = $this->item->where("id", $item_id)->increment("collect_num",1);
        }
        else if($operate == config('item.operate.collect.cansel'))
        {
            $post["operate"] = "delete";
            $item = $this->item->where("id", $item_id)->decrement("collect_num",1);
        }
        else $return = ['status' => false, 'log' => "item-collect-fail", 'msg' => "参数有误"];

        if($item)
        {
            $userItem = $this->handle_item_relation($post);
            $userItem = json_decode($userItem,true);
            if($userItem['status'])
            {
                $return['status'] = true;
                $return["html"] = $this->get_the_item_html($item_id,21);
            }
            else $return = ['status' => false, 'log' => "item-collect-fail", 'msg' => '操作失败', 'fail' => 'user_item'];
        }
        else $return = ['status' => false, 'log' => "item-collect-fail", 'msg' => '操作失败', 'fail' => 'item'];

        return json_encode($return);
    }
    public function item_work($post_data)
    {
        $operate = $post_data["operate"];
        $item_id = $post_data["item_id"];

        $post["user_id"] = Auth::id();
        $post["item_id"] = $item_id;
        $post["type"] = "work";

        if($operate == config('item.operate.work.add'))
        {
            $post["operate"] = "add";
            $item = $this->item->where("id", $item_id)->increment("work_num",1);
        }
        else if($operate == config('item.operate.work.cansel'))
        {
            $post["operate"] = "delete";
            $item = $this->item->where("id", $item_id)->decrement("work_num",1);
        }
        else $return = ['status' => false, 'log' => "item-work-fail", 'msg' => "参数有误"];

        if($item)
        {
            $userItem = $this->handle_item_relation($post);
            $userItem = json_decode($userItem,true);
            if($userItem['status'])
            {
                $return['status'] = true;
                $return["html"] = $this->get_the_item_html($item_id,21);
            }
            else $return = ['status' => false, 'log' => "item-work-fail", 'msg' => '操作失败'];
        }
        else $return = ['status' => false, 'log' => "item-work-fail", 'msg' => '操作失败', 'fail' => 'item'];

        return json_encode($return);
    }
    public function item_agenda($post_data)
    {
        $operate = $post_data["operate"];
        $item_id = $post_data["item_id"];

        $post["user_id"] = Auth::id();
        $post["item_id"] = $item_id;
        $post["type"] = "agenda";

        if($operate == config('item.operate.agenda.add'))
        {
            $post["operate"] = "add";
            $item = $this->item->where("id", $item_id)->increment("agenda_num",1);
        }
        else if($operate == config('item.operate.agenda.cansel'))
        {
            $post["operate"] = "delete";
            $item = $this->item->where("id", $item_id)->decrement("agenda_num",1);
        }
        else $return = ['status' => false, 'log' => "item-agenda-fail", 'msg' => "参数有误"];

        if($item)
        {
            $userItem = $this->handle_item_relation($post);
            $userItem = json_decode($userItem,true);
            if($userItem['status'])
            {
                $return['status'] = true;
                $return["html"] = $this->get_the_item_html($item_id,21);
            }
            else $return = ['status' => false, 'log' => "item-agenda-fail", 'msg' => '操作失败'];
        }
        else $return = ['status' => false, 'log' => "item-agenda-fail", 'msg' => '操作失败', 'fail' => 'item'];

        return json_encode($return);
    }



    public function handle_item_relation($post_data)
    {
        $v = Validator::make($post_data, [
            'operate' => 'required',
            'user_id' => 'required',
            'item_id' => 'required',
            'type' => 'required',
        ]);
        if ($v->fails()) return json_encode(['status' => false, "code" => 422, 'msg' => "参数提交有误"]);

        $operate = $post_data["operate"];
        $user_id = $post_data["user_id"];
        $item_id = $post_data["item_id"];
        $type = $post_data["type"];
        $attach = isset($post_data["attach"]) ? $post_data["attach"] : [];
        if($operate == "add") return $this->userItemRepo->add($user_id,$item_id,$type,$attach);
        else if($operate == "delete") return $this->userItemRepo->delete($user_id,$item_id,$type);
        else return json_encode(['status' => false, 'msg' => "未知错误"]);
    }


    public function add_item_relation($post_data)
    {
        $user_id = $post_data["user_id"];
        $item_id = $post_data["item_id"];
        $type = $post_data["type"];
        return $this->userItemRepo->store($user_id,$item_id,$type);
    }
    public function remove_item_relation($post_data)
    {
        $user_id = $post_data["user_id"];
        $item_id = $post_data["item_id"];
        $type = $post_data["type"];
        return $this->userItemRepo->destroy($user_id,$item_id,$type);
    }





    public function get_item_html($item_id)
    {
        $item = $this->item->where("id", $item_id)->first();
        return $item;
    }



}