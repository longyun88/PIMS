<?php
namespace App\Repositories;
use Auth, Response;
use App\Models\Dialog;

class DialogRepository {

    private $dialog;
    public function __construct()
    {
        $this->dialog = new Dialog;
    }

    public function add($post_data)
    {
        $user_id = Auth::user()->id;
        $sort = $post_data["sort"];

        $where["user_id"] = $user_id;
        $where["sort"] = $sort;
        $where["dialog_id"] = $post_data["dialog_id"];
        if($sort == 1) $where["item_id"] = $post_data["item_id"];

        $dialogue = Dialog::where($where)->first();

        $data["sort"] = $sort;
        $data["user_id"] = $user_id;
        $data["item_id"] = $post_data["item_id"];
        $data["dialog_id"] = $post_data["dialog_id"];
        $data["alert"] = $post_data["alert"];

        if($dialogue) {
            $unread = $post_data["unread"];
            $num = Dialog::where($where)->increment("unread",$unread,$data);
            if($num) $return["status"] = true;
            else $return["status"] = false;
        } else {
            $data["unread"] = $post_data["unread"];
//            $bool = Dialog::insert($data);
            $bool = $this->dialog->fill($data)->save();
            if($bool) $return["status"] = true;
            else $return["status"] = false;
        }
        return json_encode($return);
    }

    public function delete($post_data)
    {
        $user_id = Auth::user()->id;
        $sort = $post_data["sort"];

        $where["user_id"] = $user_id;
        $where["sort"] = $sort;
        $where["dialog_id"] = $post_data["dialog_id"];
        if($sort == 1) $where["item_id"] = $post_data["item_id"];

        $delete = Dialog::where($where)->delete();dd($delete);
        if($delete) $return["status"] = true;
        else $return["status"] = false;
        return json_encode($return);
    }

    public function get($post_data)
    {
        $user_id = Auth::user()->id;
        $sort = isset($post_data["sort"]) ? $post_data["sort"] : 0;
        $dialog = Dialog::with(['item','dialog'])->where("user_id",$user_id)
            ->orderBy("updated_at","desc")->get();
        if($dialog) $return["status"] = true;
        else $return["status"] = false;
        return json_encode($return);
    }

}