<?php
namespace App\Repositories;

use App\Models\UserItem;
use App\Models\Item;
use Response, Validator;

class UserItemRepository {

    private $userItem;
    public function __construct()
    {
        $this->userItem = new UserItem;
    }

    public function info($user_id,$item_id)
    {
        $whereData['user_id'] = $user_id;
        $whereData['item_id'] = $item_id;
        return UserItem::where($whereData)->first();
    }

    public function add($user_id,$item_id,$type,$attach = [])
    {
        $type_validate = config('item.user_item_type');
        if(in_array($type,$type_validate))
        {
            $return = ["status" => false, "msg" => "添加失败"];
            $data[$type.'_is'] = 1;
            $data[$type.'_time'] = time();
            if($type == "score") $data[$type.'_num'] = $attach["score"];
            $whereData['user_id'] = $user_id;
            $whereData['item_id'] = $item_id;

            if($type == "work") $data['importance'] = isset($attach["importance"]) ? $attach["importance"] : 0;

            $userItem = $this->userItem->where($whereData)->first();
            if($userItem)
            {
                $bool = $this->userItem->where($whereData)->update($data);
                if ($bool) $return = ["status" => true, "msg" => "添加成功"];
            }
            else
            {
                $itemInfo = Item::where('id',$item_id)->first();

                $data['time_type'] = $itemInfo->time_type;
                if($itemInfo->time_type > 0)
                {
                    $data['start_time'] = $itemInfo->start_time;
                    $data['end_time'] = $itemInfo->end_time;
                }

                $data['user_id'] = $user_id;
                $data['item_id'] = $item_id;
                $data['item_belong_id'] = $itemInfo->belongId;

//                $bool = $this->userItem->fill($data)->save();
                $userItem = UserItem::create($data);
                if ($userItem) $return = ["status" => true, "msg" => "添加成功"];
            }
        }
        else $return = ["status" => false, "code" => 422, "msg" => "参数有误"];
        return json_encode($return);
    }

    public function delete($user_id,$item_id,$type)
    {
        $return = ["status" => false, "msg" => "移除失败"];
        $type_validate = config('item.user_item_type');
        if(in_array($type,$type_validate))
        {
            $whereData['user_id'] = $user_id;
            $whereData['item_id'] = $item_id;
            $userItem = $this->userItem->where($whereData)->first();
            if($userItem) {
                $updateData[$type.'_is'] = 99;
                $updateData[$type.'_time'] = time();
                $bool = $this->userItem->where($whereData)->update($updateData);
                if ($bool) $return = ["status" => true, "msg" => "移除成功"];
            }
            else $return = ["status" => false, "code" => 422, "msg" => "参数有误"];
        }
        return json_encode($return);
    }

    public function store($user_id,$item_id,$type)
    {
        $insertData['user_id'] = $user_id;
        $insertData['item_id'] = $item_id;
        $insertData[$type.'_is'] = $type;
        $insertData[$type.'_time'] = time();
//        $bool = $this->userItem->fill($insertData)->save();
        $userItem = UserItem::create($insertData);
        if ($userItem) return $userItem;
        else return false;
    }

    public function destroy($user_id,$item_id,$type)
    {
        $deleteData['user_id'] = $user_id;
        $deleteData['item_id'] = $item_id;
        $deleteData['type'] = $type;
        $bool = $this->userItem->where($deleteData)->delete();
        if ($bool) return true;
        return false;
    }

}