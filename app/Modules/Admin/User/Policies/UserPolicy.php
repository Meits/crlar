<?php

namespace App\Modules\Admin\User\Policies;

use App\Modules\Admin\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param User $user
     * @return bool
     */
    public function save(User $user)
    {
        return $user->canDo('ADMIN_VIEW');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function edit(User $user)
    {
        return $user->canDo('ADMIN_VIEW');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return $user->canDo('ADMIN_VIEW');
    }
    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        return $user->canDo('ADMIN_VIEW') || $user->canDo('TASKS_CREATE');
    }
}
