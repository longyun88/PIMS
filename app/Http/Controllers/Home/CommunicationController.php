<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\CommunicationRepository;

class CommunicationController extends Controller
{
    private $repo;
    public function __construct()
    {
        $this->repo = new CommunicationRepository;
    }

    public function getAction()
    {
        return $this->repo->get(request("geters"));
    }

    public function addAction()
    {
        return $this->repo->add(request("adder"));
    }
}
