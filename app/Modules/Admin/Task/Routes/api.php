<?php

Route::group(['prefix' => 'tasks', 'middleware' => ['auth:api']], function () {
    Route::get('/', 'Api\TasksController@index')->name('api.tasks.index');
    Route::post('/', 'Api\TasksController@store')->name('api.tasks.store');
    Route::get('/{task}', 'Api\TasksController@show')->name('api.tasks.read');
    Route::put('/{task}', 'Api\TasksController@update')->name('api.tasks.update');
    Route::delete('/{task}', 'Api\TasksController@destroy')->name('api.tasks.delete');

    Route::get('/archive/index', 'Api\TasksController@archive')->name('tasks.archive.index');

});