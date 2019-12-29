<?php 
namespace App\Services\Date;

use Illuminate\Support\ServiceProvider;


class DateCheckServiceProvider extends ServiceProvider{
    public function register()
    {
        $this->app->bind('dateCheck', 'App\Services\Date\DateCheck' );
    }
}