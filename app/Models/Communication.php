<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Communication extends Model
{
    //
    protected $table = "users_communication";
    protected $fillable = ['sort', 'type', 'item_id', 'item_version',
        'belong_id', 'source_id', 'object_id',
        'dialog', 'point_id', 'quote_item_id', 'quote_belong_id', 'content', 'tip',
        'favor_num', 'dislike_num', 'reply_num',
        'isShared', 'permission',
    ];
    protected $dateFormat = 'U';

    public function item()
    {
        return $this->belongsTo('App\Models\Item','item_id','id');
    }

    public function source()
    {
        return $this->belongsTo('App\Models\UserInfo','source_id','user_id');
    }

    public function object()
    {
        return $this->belongsTo('App\Models\UserInfo','object_id','user_id');
    }

}
