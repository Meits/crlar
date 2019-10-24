<?php

Route::group(['prefix' => 'faqs', 'middleware' => []], function () {
    Route::get('/', 'FaqController@index')->name('faqs.index');
    Route::get('/create', 'FaqController@create')->name('faqs.create');
    Route::post('/', 'FaqController@store')->name('faqs.store');
    Route::get('/{faq}', 'FaqController@show')->name('faqs.read');
    Route::get('/edit/{faq}', 'FaqController@edit')->name('faqs.edit');
    Route::put('/{faq}', 'FaqController@update')->name('faqs.update');
    Route::delete('/{faq}', 'FaqController@destroy')->name('faqs.delete');
});