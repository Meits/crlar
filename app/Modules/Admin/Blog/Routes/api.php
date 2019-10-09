<?php

Route::group(['prefix' => 'blogs', 'middleware' => []], function () {
    Route::get('/', 'Api\BlogController@index')->name('api.blogs.index');
    Route::post('/', 'Api\BlogController@store')->name('api.blogs.create');
    Route::get('/{blog}', 'Api\BlogController@show')->name('api.blogs.read');
    Route::put('/{blog}', 'Api\BlogController@update')->name('api.blogs.update');
    Route::delete('/{blog}', 'Api\BlogController@destroy')->name('api.blogs.delete');
});