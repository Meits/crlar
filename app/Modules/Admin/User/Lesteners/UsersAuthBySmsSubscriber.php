<?php

namespace App\Modules\Admin\User\Lesteners;

use App\Events\UsersAuthBySms;
use App\Jobs\User\SendAuthSmsCode;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UsersAuthBySmsSubscriber
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
     * @param  UsersAuthBySms  $event
     * @return void
     */
    public function handle(UsersAuthBySms $event)
    {
        if (! app()->runningInConsole()) {
            \dispatch(new SendAuthSmsCode($event->getUser()));
        }
    }
}
