<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    //
    protected $table = "user_info";
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','nickname','truename','gender','birth','autograph','phone','email',
        'company','company_department','company_position','school','school_department','school_major',
        'present','hometown','permission','space'];
    protected $dateFormat = 'U';

}


