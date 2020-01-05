<?php

namespace App\Modules\Admin\User\Lesteners;

use App\Events\Moderate;
use App\Jobs\User\SendModerateEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ModerateSubscriber
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Moderate  $event
     * @return void
     */
    public function handle(Moderate $event)
    {
        if (! app()->runningInConsole()) {
            //\dispatch(new SendModerateEmail($event->user));
        }
    }
}
