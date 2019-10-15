<?php

Route::group(['prefix' => 'languages', 'middleware' => []], function () {
    Route::get('/', 'LanguageController@index')->name('languages.index');
    Route::get('/create', 'LanguageController@create')->name('languages.create');
    Route::post('/', 'LanguageController@store')->name('languages.store');
    Route::get('/{language}', 'LanguageController@show')->name('languages.read');
    Route::get('/edit/{language}', 'LanguageController@edit')->name('languages.edit');
    Route::put('/{language}', 'LanguageController@update')->name('languages.update');
    Route::delete('/{language}', 'LanguageController@destroy')->name('languages.delete');
});