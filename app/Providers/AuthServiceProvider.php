<?php

namespace App\Providers;

use App\Modules\Admin\Email\Models\Email;
use App\Modules\Admin\Email\Policies\EmailPolicy;
use App\Modules\Admin\Lead\Policies\LeadPolicy;
use App\Modules\Admin\Pages\Models\Page;
use App\Modules\Admin\Pages\Policies\PagePolicy;
use App\Modules\Admin\Role\Models\Role;
use App\Modules\Admin\Role\Policies\RolePolicy;
use App\Modules\Admin\User\Models\User;
use App\Modules\Admin\User\Policies\UserPolicy;
use App\Modules\Lead\Models\Lead;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Role::class => RolePolicy::class,
        Page::class => PagePolicy::class,
        Email::class => EmailPolicy::class,
        Lead::class => LeadPolicy::class,
        User::class => UserPolicy::class

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
