<?php
namespace App\Repositories;
use App\Models\Relation;
use Auth, Response;

class RelationRepository {

    private $relation;
    public function __construct()
    {
        $this->relation = new Relation;
    }

    public function relation($belong_id,$object_id)
    {
        $relation = Relation::where("belong_id",$belong_id)->where("object_id",$object_id)->first();
        if($relation) return $relation["relationship"];
        return 0;
    }

    public function add_relation($belong_id,$object_id,$relationship,$type)
    {
        $where["belong_id"] = $belong_id;
        $where["object_id"] = $object_id;
        $relation = Relation::where($where)->first();

        if($relation)
        {
            if($relation->relationship > $relationship)
            {
                $update["relationship"] = $relationship;
                $bool = Relation::where($where)->update($update);
                if($bool) return true;
                else return false;
            }
            else return true;
        }
        else
        {
            $insert["type"] = $type;
            $insert["belong_id"] = $belong_id;
            $insert["object_id"] = $object_id;
            $insert["relationship"] = $relationship;
//            $bool = $this->relation->insert($insert);
//            $bool = $this->relation->fill($insert)->save();
            $bool = Relation::create($insert);
            return $bool;
        }
    }

    public function add_follow($belong_id,$object_id)
    {
        $belong_relation = $this->add_relation($belong_id,$object_id,51,1);
//        dd($belong_relation);
        if($belong_relation)
        {
            $object_relation = $this->add_relation($object_id,$belong_id,81,1);
            if($object_relation) $return = ['status' => true,'msg' => ''];
            else $return = ['status' => false,'msg' => '添加失败'];
        }
        else $return = ['status' => false,'msg' => '添加失败'];
        return json_encode($return);
    }
    public function cansel_follow($belong_id,$object_id)
    {
        $his_relation = $this->relation($object_id,$belong_id);
        if($his_relation != 0 && $his_relation < 60) $update["relationship"] = 81;
        else $update["relationship"] = 99;

        $where["belong_id"] = $belong_id;
        $where["object_id"] = $object_id;

        $my_bool = Relation::where($where)->update($update);
        if($my_bool)
        {
            if($his_relation > 80)
            {
                $object_where["belong_id"] = $object_id;
                $object_where["object_id"] = $belong_id;
                $object_update["relationship"] = 99;
                $his_bool = Relation::where($object_where)->update($object_update);
                if($his_bool) return json_encode(['status' => true,'msg' => '']);
                else return json_encode(['status' => false,'msg' => '操作失败!']);
            }
            return json_encode(['status' => true,'msg' => '']);
        }
        else return json_encode(['status' => false,'msg' => '操作失败!']);
    }

    public function operate($post_data)
    {
        $my_id = Auth::id();
        $his_id = $post_data["object_id"];
        if($my_id != $his_id)
        {
            $operate = $post_data["operate"];
            if($operate == config('relation.operate.follow.add'))
            {
                return $this->add_follow($my_id,$his_id);
            }
            else if($operate == config('relation.operate.follow.cansel'))
            {
                return $this->cansel_follow($my_id,$his_id);
            }
            else return json_encode(['status' => false,'msg' => '参数有误!']);
        }
        else return json_encode(['status' => false,'msg' => '不能关注/取消关注自己！']);
    }



    public function get($post_data)
    {
        $my_id = Auth::id();
        $get_sort = $post_data["get_sort"];
        if(in_array($get_sort,config('relation.get.sort')))
        {
            $query = Relation::with(['object']);

            if($get_sort == config('relation.get.sort.friend')) $query->where("relationship", "<=", 41);
            else if($get_sort == config('relation.get.sort.follow')) $query->where("relationship", "=", 51);
            else if($get_sort == config('relation.get.sort.fans')) $query->where("relationship", "=", 81);

            $datas = $query->orderBy("id","desc")->get();
//            return view('assign.people')->with("datas",$datas);
//            dd($datas->toArray());
            $return["html"] = view('assign.people')->with("datas",$datas)->__toString();
            $return["status"] = true;
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
            return json_encode($return);
        }
        else return json_encode(['status' => false,'msg' => '参数有误！']);
    }

}