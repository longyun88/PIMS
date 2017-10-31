<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\SettingRepository;

class SettingController extends Controller
{
    //
    private $repo;
    public function __construct()
    {
        $this->repo = new SettingRepository;
    }


    public function getAction()
    {
        return $this->repo->get();
    }

    public function setAction()
    {
        return $this->repo->set(request()->all());
    }

}
