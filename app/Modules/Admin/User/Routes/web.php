<?php

Route::group(['prefix' => 'users', 'middleware' => []], function () {
    Route::get('/', 'UserController@index')->name('users.index');
    Route::post('/', 'UserController@store')->name('users.create');
    Route::get('/{user}', 'UserController@show')->name('users.read');
    Route::put('/{user}', 'UserController@update')->name('users.update');
    Route::delete('/{user}', 'UserController@destroy')->name('users.delete');
});