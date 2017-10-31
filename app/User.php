<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;
    //
    protected $table = "user_log";
    protected $primaryKey = 'id';
    protected $hidden = ['sort','type','password'];
    protected $fillable = ['sort','type','pass_name','pass_phone','pass_email','password','nickname','truename','ip'];
    protected $dateFormat = 'U';
//    public $timestamps = false;

//    protected $guarded = ['id'];





}
