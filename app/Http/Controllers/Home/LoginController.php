<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\LoginRepository;

class LoginController extends Controller
{
    private $loginRepo;
    public function __construct()
    {
        $this->loginRepo = new LoginRepository;
    }


    public function login()
    {
        return $this->loginRepo->login(request()->all());
    }

    public function logout()
    {
        $this->loginRepo->logout();
        return redirect('/login');
    }

    public function check_name()
    {
        $name = request("name");
        return $this->loginRepo->check_phone($name);
    }

    public function check_phone()
    {
        $phone = request("phone");
        return $this->loginRepo->check_phone($phone);
    }

    public function check_email()
    {
        $email = request("email");
        return $this->loginRepo->check_email($email);
    }

    public function registerAction()
    {
        $post_data = request()->all();
        return $this->loginRepo->register($post_data);
    }

}
