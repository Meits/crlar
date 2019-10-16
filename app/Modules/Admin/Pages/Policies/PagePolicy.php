<?php

namespace App\Modules\Admin\Pages\Policies;

use App\Modules\Admin\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
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

    public function create(User $user) {
        return $user->canDo(['SUPER_ADMINISTRATOR','PAGES_ACCESS']);
    }

    public function view(User $user)
    {
        return $user->canDo(['SUPER_ADMINISTRATOR','PAGES_ACCESS']);
    }

    public function update(User $user)
    {
        return $user->canDo(['SUPER_ADMINISTRATOR','PAGES_ACCESS']);
    }

    public function delete(User $user)
    {
        return $user->canDo(['SUPER_ADMINISTRATOR','PAGES_ACCESS']);
    }
}
