<?php

Route::group(['prefix' => 'pages', 'middleware' => []], function () {
    Route::get('/', 'PagesController@index')->name('pages.index');
    Route::get('/create', 'PagesController@create')->name('pages.create');
    Route::post('/', 'PagesController@store')->name('pages.store');
    Route::get('/{page}', 'PagesController@show')->name('pages.read');
    Route::get('/edit/{page}', 'PagesController@edit')->name('pages.edit');
    Route::put('/{page}', 'PagesController@update')->name('pages.update');
    Route::delete('/{page}', 'PagesController@destroy')->name('pages.delete');
});