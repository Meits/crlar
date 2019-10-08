<?php
/**
 * Created by PhpStorm.
 * User: Meits
 * Date: 13-May-19
 * Time: 10:17
 */

namespace App\Services\Localization;
use Illuminate\Support\Facades\Facade;


class LocalizationService extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Localization';
    }
}