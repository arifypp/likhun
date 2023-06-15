<?php

namespace App\Listeners;

use App\Events\LyricViewed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncreaseLyricHitCount
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle($event): void
    {
        //
        $lyric = $event->lyric;
        // if lyrics is not null and is published
        if ($lyric && $lyric->status == 'published') {
            // increase the hit count
            $lyric->increment('hits');
        }
    }
}
