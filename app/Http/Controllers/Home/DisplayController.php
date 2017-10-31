<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\DisplayRepository;

class DisplayController extends Controller
{
    private $displayRepo;
    public function __construct()
    {
        $this->displayRepo = new DisplayRepository();
    }

    public function geterAction() // get Display
    {
        return $this->displayRepo->geter();
    }


    public function geter()
    {
        $type = "collect";
        return $this->get_user_item($type);
    }

    public function get_user_item($type)
    {
        $return = ['count'=>0,'order_max'=>0,'order_min'=>0,'html'=>''];
        $datas = $this->displayRepo->get_user_item($type);
        if($datas){
            $return['count'] = $datas->count();
            $return['order_max'] = $datas->first()->order;
            $return['order_min'] = $datas->last()->order;
            $return['html'] = view('assign.itemtv')->with("datas",$datas)->__toString();
        }
        return json_encode($return);
    }



}
