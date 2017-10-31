<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Todolist extends Model
{
    //
    protected $table = "user_item_todolist";
    protected $fillable = [];
    protected $dateFormat = 'U';

    public function item()
    {
        return $this->belongsTo('App\Models\Item','item_id','id');
    }

}
