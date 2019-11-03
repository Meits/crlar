<?php
declare(strict_types = 1);

namespace App\Modules\Admin\User\Observers;

use App\Modules\Admin\User\Events\Moderate;
use App\Modules\Admin\User\Models\User;
use Illuminate\Auth\Events\Registered;

class UserObserver
{
    /**
 * Handle the user "created" event.
 *
 * @param  \App\Models\User  $user
 * @return void
 */
    public function created(User $user)
    {
        if($user->is_register) {
            event(new Registered($user));
        }
        if(!$user->is_moderate) {
            event(new Moderate($user));
        }
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
