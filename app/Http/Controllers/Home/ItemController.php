<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\ItemRepository;

class ItemController extends Controller
{
    //
    private $request;
    private $itemRepo;

    public function __construct()
    {
        $this->request = request();
        $this->itemRepo = new ItemRepository;
    }




    /**
     * 添加关系
     */
    public function adderAction()
    {
        return $this->itemRepo->add_item(request()->all());
    }


    public function item_delete()
    {
        return $this->itemRepo->item_delete(request()->all());
    }

    public function item_share()
    {
        return $this->itemRepo->item_share(request()->all());
    }

    public function item_favor()
    {
        return $this->itemRepo->item_favor(request()->all());
    }
    public function item_score()
    {
        return $this->itemRepo->item_score(request()->all());
    }
    public function item_collect()
    {
        return $this->itemRepo->item_collect(request()->all());
    }
    public function item_work()
    {
        return $this->itemRepo->item_work(request()->all());
    }
    public function item_agenda()
    {
        return $this->itemRepo->item_agenda(request()->all());
    }



    /**
     * 添加关系
     */
    public function add_item_relation()
    {
        return $this->itemRepo->add_item_relation(request()->all());
    }

    /**
     * 删除关系
     */
    public function remove_item_relation()
    {
        return $this->itemRepo->remove_item_relation(request()->all());
    }

    /**
     * 处理关系
     */
    public function handle_item_relation()
    {
        return dd($this->itemRepo->handle_item_relation(request()->all()));
    }






}
