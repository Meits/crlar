<?php

Route::group(['prefix' => 'emails', 'middleware' => []], function () {
    Route::get('/', 'Api\EmailController@index')->name('api.emails.index');
    Route::post('/', 'Api\EmailController@store')->name('api.emails.create');
    Route::get('/{email}', 'Api\EmailController@show')->name('api.emails.read');
    Route::put('/{email}', 'Api\EmailController@update')->name('api.emails.update');
    Route::delete('/{email}', 'Api\EmailController@destroy')->name('api.emails.delete');
});