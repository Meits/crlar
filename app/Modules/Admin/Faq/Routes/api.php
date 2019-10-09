<?php

Route::group(['prefix' => 'faqs', 'middleware' => []], function () {
    Route::get('/', 'Api\FaqController@index')->name('api.faqs.index');
    Route::post('/', 'Api\FaqController@store')->name('api.faqs.create');
    Route::get('/{faq}', 'Api\FaqController@show')->name('api.faqs.read');
    Route::put('/{faq}', 'Api\FaqController@update')->name('api.faqs.update');
    Route::delete('/{faq}', 'Api\FaqController@destroy')->name('api.faqs.delete');
});