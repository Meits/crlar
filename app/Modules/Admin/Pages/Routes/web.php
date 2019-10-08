<?php

Route::group(['prefix' => 'pages', 'middleware' => []], function () {
    Route::get('/', 'PagesController@index')->name('pages.index');
    Route::post('/', 'PagesController@store')->name('pages.create');
    Route::get('/{page}', 'PagesController@show')->name('pages.read');
    Route::put('/{page}', 'PagesController@update')->name('pages.update');
    Route::delete('/{page}', 'PagesController@destroy')->name('pages.delete');
});