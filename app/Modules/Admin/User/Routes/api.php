<?php

Route::group(['prefix' => 'users', 'middleware' => ['auth:api']], function () {
    Route::get('/', 'Api\UserController@index')->name('api.users.index');
    Route::post('/', 'Api\UserController@store')->name('api.users.create');
    Route::get('/{user}', 'Api\UserController@show')->name('api.users.read');
    Route::put('/{user}', 'Api\UserController@update')->name('api.users.update');
    Route::delete('/{user}', 'Api\UserController@destroy')->name('api.users.delete');

    Route::get('/get/list', 'Api\UserController@usersGate')->name('users-list');
});