<?php
namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use Illuminate\Contracts\Mail\Mailer;
class SendReminderEmail extends Job implements SelfHandling, ShouldQueue
{

    use InteractsWithQueue, SerializesModels;
    protected $user;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */

    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
    	
			//sleep(0.5);
			echo $this->user."\t".date("Y-m-d H:i:s")."\n <br/>";
			$this->delete();

//        $user = $this->user;
//        $mailer->send('emails.reminder',['user'=>$user],function($message) use ($user){
//            $message->to($user->email)->subject('�¹��ܷ���');
//        });
    }
}