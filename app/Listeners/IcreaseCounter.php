<?php

namespace App\Listeners;

use App\Events\VideoViewer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IcreaseCounter
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(VideoViewer $event)
    {
        if(!session()->has('videoIsVisited')){
            $this->update_view($event->video);
        }else{
            return false;
        }
    }
    public function update_view($video){
        $video->viewers = $video->viewers+1;
       $videoData= $video->save();
        session()->put('videoIsVisited',$video->id);
    }
}
