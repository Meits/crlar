<?php

Route::group(['prefix' => 'settings', 'middleware' => []], function () {
    Route::get('/', 'Api\SettingController@index')->name('api.settings.index');
    Route::post('/', 'Api\SettingController@store')->name('api.settings.create');
    Route::get('/{setting}', 'Api\SettingController@show')->name('api.settings.read');
    Route::put('/{setting}', 'Api\SettingController@update')->name('api.settings.update');
    Route::delete('/{setting}', 'Api\SettingController@destroy')->name('api.settings.delete');
});