<?php
namespace App\Repositories;
use App\Models\Item;
use App\Models\Communication;
use Auth, Response, DB, Validator;

class CommunicationRepository {

    public function __construct()
    {

    }


    public function insert($post_data)
    {
        $my_id = Auth::id();

        $create["source_id"] = $my_id;
        $create["sort"] = $post_data["sort"];
        $create["type"] = $post_data["type"];
        $create["item_id"] = $post_data["item_id"];
        $create["item_belong_id"] = $post_data["item_belong"];
        $create["object_id"] = isset($post_data["object"]) ? $post_data["object"] : 0;
        $create["point_id"] = isset($post_data["point"]) ? $post_data["point"] : NULL;
        $create["isShared"] = isset($post_data["share"]) ? $post_data["share"] : 21;
        $create["content"] = isset($post_data["content"]) ? $post_data["content"] : NULL;
        $create["item_version"] = isset($post_data["version"]) ? $post_data["version"] : NULL;
//        $create["score"] = isset($post_data["score"]) ? $post_data["score"] : 0;

        $commu = Communication::create($create);
        if($commu) return $commu;
        else return false;
    }

    public function add($post_data)
    {
        $v = Validator::make($post_data, [
            'operate' => 'required',
            'item_id' => 'required',
            'item_belong' => 'required',
        ]);
        if ($v->fails()) return json_encode(['success' => false, "code" => 422, 'msg' => "参数提交有误"]);

        $item_id = $post_data["item_id"];
        $operate = $post_data["operate"];
        if($operate == "comment")
        {
            $post_data["sort"] = 1;
            $post_data["type"] = 0;
            $msg = "添加评论";
        }
        else if($operate == "reply")
        {
            $post_data["sort"] = 2;
            $post_data["type"] = 0;
            $msg = "添加回复";
        }

        DB::beginTransaction();
        try {
            $commu = $this->insert($post_data);
            if ($commu)
            {
                if($operate == "comment") $dialog = $commu->id;
                else if($operate == "reply")
                {
                    $point_commu = Communication::whereId($post_data["point"])->first();
                    $dialog = $point_commu->dialog;
                }
                $update = $commu->update(['dialog' => $dialog]);
                if(!$update) throw new Excepiton("communication-dialog-false");

                $bool = Item::where('id',$item_id)->increment('comment_num');
                if ($bool)
                {
                    $datas = Communication::with(['source', 'object'])->where("id", $commu->id)->get();
                    $html = view('assign.commenttv')->with("datas", $datas)->__toString();
                }
                else throw new Excepiton("item-comment-num-false");
            }
            else throw new Excepiton("communication-false");

            DB::commit();
            return json_encode(['success' => true, 'code' => 200, 'msg' => $msg . '成功', 'html' => $html]);
        }
        catch (Excepiton $e)
        {
            DB::rollback();
//            $msg = $e->getMessage();
//            exit($e->getMessage());
            return json_encode(["success" => false, 'code' => 500, "msg" => $msg."失败"]);
        }
    }


    public function get($post_data)
    {
        //DB::enableQueryLog();
        $T_commu = "users_communication";
        $T_relation = "relations";

        $my_id = (Auth::check()) ? Auth::id() : 0;
        $item_id = isset($post_data["item_id"]) ? $post_data["item_id"] : 0;
        $geter_sort = isset($post_data["geter_sort"]) ? $post_data["geter_sort"] : "all";
        $get_type = isset($post_data["get_type"]) ? $post_data["get_type"] : "init";
        $get_first = isset($post_data["get_first"]) ? $post_data["get_first"] : 0;
        $get_last = isset($post_data["get_last"]) ? $post_data["get_last"] : 0;
        $get_limit = isset($post_data["get_limit"]) ? $post_data["get_limit"] : 20;
        $get_display = isset($post_data["get_display"]) ? $post_data["get_display"] : "comment";

        $query = Communication::with(['source','object'])->where($T_commu.".item_id",$item_id);

        if($geter_sort != "all")
        {
            if(!Auth::check()) return json_encode(['status' => false, 'msg'=>'请先登录']);
        }

        if($geter_sort == "all")
        {
            $query->where(function ($query) use($my_id) {
                $query->where('isShared', '>=', 99)
                    ->orWhere(function($query) use($my_id) { $query->where('source_id', $my_id)->orWhere('object_id', $my_id); });
                });
        }
        else if($geter_sort == "mine")
        {
            $query->where(function($query) use($my_id) { $query->where('source_id', $my_id)->orWhere('object_id', $my_id);});
        }
        else if($geter_sort == "friend")
        {
            $query->join("{$T_relation} AS r1", $T_commu.'.source_id', '=', 'r1.object_id')
                ->join("{$T_relation} AS r2", function ($join) use($T_commu,$my_id)
                    {
                        $join->on($T_commu.'.object_id', '=', 'r2.object_id')
                            ->orOn($T_commu.'.object_id', '=', DB::raw(0));
                    })
                ->where('r1.belong_id', '=', $my_id)->where('r1.relationship', '<=', 40)
                ->where('r2.belong_id', '=', $my_id)->where('r2.relationship', '<=', 40)
                ->where($T_commu.'.isShared', '>=', 40)
                ->distinct();

//            $query->join("{$T_relation} AS relation", function ($joinX) use($T_commu) {
//                $joinX->on($T_commu.'.source_id', '=', 'relation.object_id');
//                $joinX->on(function ($joinY) use($T_commu) {
//                        $joinY->on($T_commu.'.object_id', '=', DB::raw(0));
//                        $joinY->orOn($T_commu.'.object_id', '=', 'relation.object_id');
//                    });
//            })
//                ->where('relation.belong_id', '=', $my_id)
//                ->where('relation.relationship', '<=', 40)
//                ->where($T_commu.'.isShared', '>=', 40)->distinct();

        }
        else if($geter_sort == "follow")
        {
            $query->join("{$T_relation} AS r1", $T_commu.'.source_id', '=', 'r1.object_id')
                ->join("{$T_relation} AS r2", function ($join) use($T_commu,$my_id)
                {
                    $join->on($T_commu.'.object_id', '=', 'r2.object_id')
                        ->orOn(function ($joinY) use($T_commu,$my_id) {
                            $joinY->where($T_commu.'.object_id', '=', 0);
                        });
                })
                ->where('r1.belong_id', '=', $my_id)
                ->where('r1.relationship', '=', 81)
                ->where('r2.belong_id', '=', $my_id)
                ->where('r2.relationship', '=', 81)
                ->where($T_commu.'.isShared', '>=', 81)
                ->distinct();

        }

        if($get_type == "more") $query->where($T_commu.'.id', '<', $get_last);
        else if($get_type == "new") $query->where($T_commu.'.id', '>', $get_first);

        $datas = $query->select($T_commu.'.*')->orderBy($T_commu.'.id', 'desc')->limit($get_limit)->get();
        //dd(DB::getQueryLog());
        $count = $datas->count();
        if($count)
        {
            $first = $datas->first();
            $last = $datas->last();
            $return["location_first"] = $first->id;
            $return["location_last"] = $last->id;
            if($get_display == "comment")
            {
                $return["html"] = view('assign.commenttv')->with("datas",$datas)->__toString();
            }
            else if($get_display == "communication")
            {
                $datas = $datas->sortByDesc('id');
                $return["html"] = view('assign.communicationtv')->with("datas",$datas)->__toString();
            }
        }
        else
        {
            $return["location_first"] = 0;
            $return["location_last"] = 0;
            $return["html"] = "";
        }

        $return["status"] = true;
        $return["count"] = $count;
        return json_encode($return);
//        return view('item.comment')->with("datas",$datas);
    }




}