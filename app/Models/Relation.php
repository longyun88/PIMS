<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    //
    protected $table = "relations";
    protected $fillable = ['type','belong_id','object_id','relationship'];
    protected $dateFormat = 'U';

    public function object()
    {
        return $this->belongsTo('App\Models\UserInfo',"object_id","user_id");
    }

}
