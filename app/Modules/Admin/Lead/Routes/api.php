<?php

Route::group(['prefix' => 'leads', 'middleware' => ['auth:api']], function () {
    Route::get('/', 'Api\LeadsController@index')->name('api.leads.index');
    Route::post('/', 'Api\LeadsController@store')->name('api.leads.store');
    Route::get('/{page}', 'Api\LeadsController@show')->name('api.leads.read');
    Route::put('/{page}', 'Api\LeadsController@update')->name('api.leads.update');
    Route::delete('/{page}', 'Api\LeadsController@destroy')->name('api.leads.delete');
});