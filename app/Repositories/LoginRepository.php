<?php
namespace App\Repositories;
use App\User;
use App\Models\UserInfo;
use App\Models\UserLogin;
use Auth, Response, Session, Validator;

class LoginRepository {

    private $user;
    public function __construct()
    {
        $this->user = new User;
    }

    public function login()
    {
        $return = [];
        $account = request('account');
        $password = request('password');
        $user = $this->user->where(function ($query) use($account)
                { $query->where('id', $account)->orWhere('pass_name', $account)->orWhere('pass_phone', $account)->orWhere('pass_email', $account); })
            ->where('password', $password)->first();

        if($user)
        {
            $user_id = $user->id;
            $ip = Get_IP();

            Auth::login($user,true);
            Session::put('isLog','iamloged');
            Session::put('mine',$user_id);
            Session::put('myID',$user_id);
            Session::put('myDB',"db".$user_id);

            $this->user->where('id',$user_id)->increment('log', 1, ['ip' => $ip]);

            $loginData["user_id"] = $user->id;
            $loginData["type"] = 1;
            $loginData["ip"] = $ip;
            UserLogin::create($loginData);

            $return["status"] = true;
            $return["log"] = "success";
            $return["myID"] = $user_id;
        }
        else
        {
            $return["status"] = false;
            $return["fail"] = "success";
        }
        return json_encode($return);

    }

    public function logout()
    {
        if(Auth::check())
        {
            Auth::logout();
        }
        Session::forget('isLog');
        Session::forget('mine');
        Session::forget('myID');
        Session::forget('myDB');
        Session::forget('alert');
    }

    public function reset_password()
    {
    }

    public function register($post_data)
    {

        $message = array(
            "required" => ":attribute 不能为空",
            "between" => ":attribute 长度有误",
            "email" => ":attribute 格式有误",
            "unique" => ":attribute 已存在",
        );
        $attributes = array(
            "pass_email" => '电子邮件',
            'password' => '用户密码',
            'nickname' => '昵称',
        );

        $validator = Validator::make($post_data, [
            'pass_email' => 'required|email|unique:user_log',
            'password' => 'required|between:1,20',
            'password_confirm' => 'required|between:1,20',
            'nickname' => 'required|between:1,64',
            'gender' => 'required',
        ],$message, $attributes);
//        dd($validator->errors()->toArray());

        if ($validator->fails()) {
            return json_encode(['status'=>false,'msg'=>'数据有误，请重新填写！']);
        }

        $nickname = $post_data["nickname"];
        $gender = $post_data["gender"];

        $register["pass_email"] = $post_data["pass_email"];
        $register["password"] = $post_data["password"];
        $register["nickname"] = $nickname;
        $register["gender"] = $gender;

        $user = User::create($register);
        if($user)
        {
            $id = $user->id;
            $registerInfo["user_id"] = $user->id;
            $registerInfo["nickname"] = $nickname;
            $user_info = UserInfo::create($registerInfo);
            if($user_info)
            {
                $this->create_my_image($id,$gender);
                return json_encode(['status'=>true,'msg'=>'注册成功，请登录！']);
            }
            return json_encode(['status'=>false,'msg'=>'注册失败，请重试！']);
        }
        return json_encode(['status'=>false,'msg'=>'注册失败，请重试！']);


    }

    public function check_name($name)
    {
        $user = User::where("pass_name",$name)->first();
        if($user) return json_encode(['status' => true]);
        else return json_encode(['status' => false]);
    }

    public function check_phone($phone)
    {
        $user = User::where("pass_phone",$phone)->first();
        if($user) return json_encode(['status' => true]);
        else return json_encode(['status' => false]);
    }

    public function check_email($email)
    {
        $user = User::where("pass_email",$email)->first();
        if($user) return json_encode(['status' => true]);
        else return json_encode(['status' => false]);
    }



    public function create_my_image($id,$gender) // 创建我的图片文件夹
    {
        $url = "images/portrait/user".$id.".jpg";
        if($gender == 1) copy("images/avatar_male.jpg",$url);
        else if($gender == 2) copy("images/avatar_female.jpg",$url);
        else copy("images/portrait.jpg",$url);

        $imgageDir = "images/user".$id;
        mkdir($imgageDir);
    }

    public function create_my_DB($id) // 创建 我的数据库
    {
        $sql = 'create database if not exists db'.$id;
        DB::statement($sql);
    }


}