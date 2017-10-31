<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Working extends Model
{
    //
    protected $table = "user_item_todolist";
    protected $primaryKey = 'id';
    protected $hidden = ['password'];
    protected $fillable = [];
    protected $dateFormat = 'U';

    public function item()
    {
        return $this->belongsTo('App\Models\Item','item_id','id');
    }
}


