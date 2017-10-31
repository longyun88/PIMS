<?php
namespace App\Repositories;
use App\Models\User;
use Response;

class UserRepository {

    public function __construct()
    {
    }

    public function info($id)
    {
        return User::where('id',$id)->first();
    }
}