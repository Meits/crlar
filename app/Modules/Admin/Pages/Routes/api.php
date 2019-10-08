<?php

Route::group(['prefix' => 'pages', 'middleware' => []], function () {
    Route::get('/', 'Api\PagesController@index')->name('api.pages.index');
    Route::post('/', 'Api\PagesController@store')->name('api.pages.create');
    Route::get('/{page}', 'Api\PagesController@show')->name('api.pages.read');
    Route::put('/{page}', 'Api\PagesController@update')->name('api.pages.update');
    Route::delete('/{page}', 'Api\PagesController@destroy')->name('api.pages.delete');
});