<?php

Route::group(['prefix' => 'settings', 'middleware' => []], function () {
    Route::get('/', 'SettingController@index')->name('settings.index');
    Route::get('/create', 'SettingController@create')->name('settings.create');
    Route::post('/', 'SettingController@store')->name('settings.store');
    Route::get('/{setting}', 'SettingController@show')->name('settings.read');
    Route::put('/{setting}', 'SettingController@update')->name('settings.update');
    Route::delete('/{setting}', 'SettingController@destroy')->name('settings.delete');
});