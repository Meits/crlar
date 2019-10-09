<?php

Route::group(['prefix' => 'emails', 'middleware' => []], function () {
    Route::get('/', 'EmailController@index')->name('emails.index');
    Route::post('/', 'EmailController@store')->name('emails.create');
    Route::get('/{email}', 'EmailController@show')->name('emails.read');
    Route::put('/{email}', 'EmailController@update')->name('emails.update');
    Route::delete('/{email}', 'EmailController@destroy')->name('emails.delete');
});