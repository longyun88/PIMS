<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Mail;
use Storage;
use App\User;
use App\Jobs\SendReminderEmail;
use Queue;

class MailController extends Controller
{
    //其他方法

    //发送提醒邮件
    public function sendReminderEmail() {
        //$user = App\User::findOrFail($id);
       // $this->dispatch(new SendReminderEmail($user));
    		for($i = 0; $i < 100; $i ++) {
				//Queue::push(new SendReminderEmail("ssss".$i));
				$job = (new SendReminderEmail("sx".$i))->onQueue('XXS');
				$this->dispatch($job);
			}
    }
}