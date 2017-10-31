<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Dialog extends Model
{
    //
    protected $table = "dialogs";
    protected $fillable = ['sort','type','user_id','dialog_id','item_id','alert','unread'];
    protected $dateFormat = 'U';

    public function item()
    {
        return $this->belongsTo('App\Models\Item',"item_id","id");
    }
    public function user()
    {
        return $this->belongsTo('App\User',"user_id","id");
    }
    public function dialog()
    {
        return $this->belongsTo('App\User',"dialog_id","id");
    }
}
