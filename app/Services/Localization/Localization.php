<?php
/**
 * Created by PhpStorm.
 * User: Meits
 * Date: 13-May-19
 * Time: 10:18
 */

namespace App\Services\Localization;


use Illuminate\Support\Facades\App;

class Localization
{


    private $app;

    private $segmentIndex;

    public function __construct()
    {
        $this->app = app();
    }

    public function locale() {

        $locale = request()->segment(1, ''); // `ua` or `ru`

        if($locale && in_array($locale, config('app.locales'))) {
            App::setLocale($locale);
            return $locale;
        }

        return "";
    }
}