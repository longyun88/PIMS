<?php
namespace App\Repositories;
use App\User;
use App\Models\UserInfo;
use Auth, Response;

class SettingRepository {

    private $user;
    private $user_info;
    public function __construct()
    {
        $this->user = new User;
        $this->user_info = new UserInfo;
    }

    public function get()
    {
        $my_id = Auth::id();
        $user = User::where("id",$my_id)->first();
        $user_info = UserInfo::where("user_id",$my_id)->first();
        $return['html'] = view('assign.setting')->with("info",$user_info)->__toString();
        $return['status'] = true;
        return $return;
    }

    public function set($post_data)
    {
        $my_id = Auth::id();
        $update = $post_data;
        $user = User::where("id",$my_id)->first();
        $user_info = UserInfo::where("user_id",$my_id)->first();

        if($post_data["password_new"] != "")
        {
            if($post_data["password_new"] != $post_data["password_confirm"]) return json_encode(['status' => false, 'msg' => '两次密码不一致']);

            $user = User::where("id",$my_id)->where("password",$post_data["password_pre"])->first();
            if(!$user) return json_encode(['status' => false, 'msg' => '密码有误']);
            else User::where("id",$my_id)->update("password",$post_data["password_new"]);
        }

        $update["birth"] = strtotime($update["birth"]);
        unset($update["_token"]);
        unset($update["page_type"]);
        unset($update["page_visitor"]);
        unset($update["password_pre"]);
        unset($update["password_new"]);
        unset($update["password_confirm"]);

        $bool = UserInfo::where("user_id",$my_id)->update($update);
        if($bool) return json_encode(['status' => true, 'msg' => '修改成功！']);
        else return json_encode(['status' => false, 'msg' => '修改失败！']);


    }



}