<?php

Route::group(['prefix' => 'emails', 'middleware' => []], function () {
    Route::get('/', 'EmailController@index')->name('emails.index');
    Route::post('/create', 'EmailController@create')->name('emails.create');
    Route::post('/', 'EmailController@store')->name('emails.store');
    Route::get('/{email}', 'EmailController@show')->name('emails.read');
    Route::get('/edit/{email}', 'EmailController@edit')->name('emails.edit');
    Route::put('/{email}', 'EmailController@update')->name('emails.update');
    Route::delete('/{email}', 'EmailController@destroy')->name('emails.delete');
});