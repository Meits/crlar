<?php
/**
 * Created by PhpStorm.
 * User: Meits
 * Date: 11-May-19
 * Time: 13:58
 */

namespace App\Providers;

use App\Modules\Admin\User\Models\User;
use App\Modules\Admin\User\Observers\UserObserver;
use Illuminate\Support\ServiceProvider;

/**
 * Class ObserverServiceProvider
 * @package App\Providers
 */
class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap application services.
     */
    public function boot()
    {
        User::observe(UserObserver::class);
    }
}