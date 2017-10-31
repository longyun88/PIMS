<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\DialogRepository;

class DialogController extends Controller
{
    //
    private $request;
    private $repo;

    public function __construct()
    {
        $this->request = request();
        $this->repo = new DialogRepository;
    }


    /**
     * 添加关系
     */
    public function addAction()
    {
        return $this->repo->add(request()->all());
    }

    public function deleteAction()
    {
        return $this->repo->delete(request()->all());
    }

    public function getAction()
    {
        return $this->repo->get(request()->all());
    }




}
