<?php

namespace App\Modules\Admin\User\Lesteners;

use App\Events\ModerateConfirm;
use App\Jobs\User\SendModerateConfirmEmail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ModerateConfirmSubscriber
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
     * @param  ModerateConfirm  $event
     * @return void
     */
    public function handle(ModerateConfirm $event)
    {
        if (! app()->runningInConsole()) {
            \dispatch(new SendModerateConfirmEmail($event->user));
        }
    }
}
