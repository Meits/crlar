<?php

namespace App\Modules\Lead\Policies;

use App\Modules\Admin\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LeadPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user)
    {
        return $user->canDo('DASHBOARD_VIEW');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function save(User $user)
    {
        return $user->canDo('LEADS_CREATE');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function edit(User $user)
    {
        return $user->canDo('LEADS_EDIT');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function delete(User $user)
    {
        return $user->canDo('LEADS_EDIT');
    }
}
