<?php
/**
 * Created by PhpStorm.
 * User: Meits
 * Date: 13-May-19
 * Time: 10:15
 */

namespace App\Services\Localization;
use Illuminate\Support\ServiceProvider;


class LocalizationServiceProvider extends ServiceProvider{
    public function register()
    {
        $this->app->singleton('Localization', function ($app) {

            return new Localization();
        });
    }
}