<?php
/**
 * Created by PhpStorm.
 * User: MeitsWorkPc
 * Date: 29.12.2019
 * Time: 17:37
 */

Route::group(['prefix' => 'analitics'], function () {
    Route::get('/export/{user}/{dateStart}/{dateEnd}', 'AnaliticsController@export')->name('analitics.export');
});