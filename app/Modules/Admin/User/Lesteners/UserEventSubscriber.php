<?php
declare(strict_types=1);

namespace App\Modules\Admin\User\Lesteners;

use App\Jobs\User\SendRegisterEmail;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;

class UserEventSubscriber
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
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        //
    }

    /**
     * Send email with account e-mail confirmation link
     *
     * @param Registered $event
     * @return void
     */
    public function onUserRegistered(Registered $event)
    {
        if (! app()->runningInConsole()) {
            \dispatch(new SendRegisterEmail($event->user));
        }
    }

    public function onUserReset(PasswordReset $event)
    {
        $event->user->is_register = "1";
        $event->user->api_token = Str::random(60);
        $event->user->save();
    }

    /**
     * @param Dispatcher $events
     */
    public function subscribe($events)
    {

        $events->listen(
            'Illuminate\Auth\Events\Registered',
            '\App\Listeners\User\UserEventSubscriber@onUserRegistered'
        );
        $events->listen(
            'Illuminate\Auth\Events\PasswordReset',
            '\App\Listeners\User\UserEventSubscriber@onUserReset'
        );
    }
}
