<?php

Route::group(['prefix' => 'languages', 'middleware' => []], function () {
    Route::get('/', 'Api\LanguageController@index')->name('api.languages.index');
    Route::post('/', 'Api\LanguageController@store')->name('api.languages.store');
    Route::get('/{language}', 'Api\LanguageController@show')->name('api.languages.read');
    Route::put('/{language}', 'Api\LanguageController@update')->name('api.languages.update');
    Route::delete('/{language}', 'Api\LanguageController@destroy')->name('api.languages.delete');
});