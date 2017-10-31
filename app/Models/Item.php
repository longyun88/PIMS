<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $table = "users_item";
    protected $fillable = [
        'sort', 'type', 'form', 'isRevisable', 'time', 'modified', 'flag', 'version',
        'belongType', 'belongId', 'sourceId', 'objectId', 'receiverIds',
        'origin_item_id', 'origin_belong_id', 'quote_item_id', 'quote_belong_id', 'quote_content',
        'theme', 'content', 'attaching', 'attachment', 'tag', 'price', 'tip',
        'time_type', 'start_type', 'start_time', 'end_type', 'end_time',
        'read_is', 'read_time', 'complete_is', 'complete_time', 'finish_is', 'finish_time',
        'isWorked', 'importance',
        'comment_num', 'comment_best_id', 'forward_num',
        'work_num', 'agenda_num', 'favor_num', 'dislike_num', 'collect_num', 'focus_num', 'track_num', 'attention_num',
        'score_num', 'score_total', 'score_AVG', 'isShared', 'permission'
    ];
    protected $dateFormat = 'U';



    public function belongUser()
    {
        return $this->belongsTo('App\Models\UserInfo','belongId','user_id');
    }
    public function sourceUser()
    {
        return $this->belongsTo('App\Models\UserInfo','sourceId','user_id');
    }

    public function user_item()
    {
        return $this->belongsTo('App\Models\UserItem','id','item_id');
    }


    public function communications()
    {
        return $this->hasMany('App\Models\Communication','item_id','id');
    }

    public function originItem()
    {
        return $this->hasMany('App\Models\Item','origin_item_id','id');
    }

    public function quoteItem()
    {
        return $this->hasMany('App\Models\Item','quote_item_id','id');
    }

}
