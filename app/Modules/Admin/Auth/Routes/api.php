<?php
/**
 * Created by PhpStorm.
 * User: MeitsWorkPc
 * Date: 07.11.2019
 * Time: 22:29
 */

Route::group(['prefix' => 'auth', 'middleware' => []], function () {
    Route::post('/login',['uses' => 'Api\LoginController@login']);
});