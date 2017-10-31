<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\RelationRepository;

class RelationController extends Controller
{
    //
    private $request;
    private $repo;

    public function __construct()
    {
        $this->request = request();
        $this->repo = new RelationRepository;
    }


    /**
     *
     */
    public function getAction()
    {
        return $this->repo->get(request()->all());
    }
    /**
     * 添加关系
     */
    public function operateAction()
    {
        return $this->repo->operate(request()->all());
    }





}
