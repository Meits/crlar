<?php

Route::group(['prefix' => 'leads', 'middleware' => ['auth:api']], function () {
    Route::get('/', 'Api\LeadsController@index')->name('api.leads.index');
    Route::post('/', 'Api\LeadsController@store')->name('api.leads.store');
    Route::get('/{lead}', 'Api\LeadsController@show')->name('api.leads.read');
    Route::put('/{lead}', 'Api\LeadsController@update')->name('api.leads.update');
    Route::delete('/{lead}', 'Api\LeadsController@destroy')->name('api.leads.delete');

    Route::get('/addSale/count', 'Api\LeadsController@getDddSalesCount')->name('leads-add-sales-count');
    Route::post('/create/check', 'Api\LeadsController@checkExist')->name('leads.create.check');
    Route::put('/update/quality/{lead}', 'Api\LeadsController@updateQuality')->name('leads.update.quality');
    Route::get('/archive/index', 'Api\LeadsController@archive')->name('leads.archive.index');
});

