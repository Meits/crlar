<?php
/**
 * Created by PhpStorm.
 * User: MeitsWorkPc
 * Date: 18.11.2019
 * Time: 22:05
 */
Route::group(['prefix' => 'menus', 'middleware' => []], function () {
    Route::get('/', 'MenuController@index')->name('menus.index');
});