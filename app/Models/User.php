<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $table = "user_log";
    protected $primaryKey = 'id';
    protected $hidden = ['password'];
    protected $fillable = [];
    protected $dateFormat = 'U';



}


