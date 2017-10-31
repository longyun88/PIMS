<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class UserItem extends Model
{
    //
    protected $table = 'user_item';
    protected $fillable = ['user_id','item_id','item_belong_id','type',
        'favor_is','favor_time',
        'collect_is','collect_time',
        'focus_is','focus_time',
        'work_is','work_time','importance',
        'agenda_is','agenda_time','time_type','start_time','end_time','remind_time',
        'answer_is','answer_time'];
    protected $dateFormat = 'U';

    public function item()
    {
        return $this->belongsTo('App\Models\Item','item_id','id');
    }

}
