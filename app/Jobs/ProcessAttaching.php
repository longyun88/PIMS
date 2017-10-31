<?php

namespace App\Jobs;

use App\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Image;

class ProcessAttaching extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    
    protected $para;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($para)
    {
        $this->para = $para;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $attaching = $this->para;
        $attachingOptions = explode("<|>",$attaching);
        $attachingNum = count($attachingOptions);
        for($n=0;$n < $attachingNum;$n++)
        {
				$thisAttaching = explode("-/",$attachingOptions[$n]);
				if(count($thisAttaching) == 1)
				{
					$thisAttachingType = "origin";
					$thisAttachingUrl = $thisAttaching[0];
				} else 
				{
					$thisAttachingType = $thisAttaching[0];
					$thisAttachingUrl = $thisAttaching[1];
				}
;
				if($thisAttachingType == "qingbo") 
				{
					$imageUrl = public_path("/images/origin/".$thisAttachingUrl);
					$img = Image::make($imageUrl);
					$width = $img->width();
			   		$height = $img->height();
			   		if($width >$height)
			   		{
			   			$img->heighten(160);
			   		} else 
			   		{
			   			$img->widen(160);
			   		}
			   		$img->resizeCanvas(160,160);
							
		   			$img->save(public_path("/images/img160/".$thisAttachingUrl));
				} 
        }
    }
}
