<?php

Route::group(['prefix' => 'analitics', 'middleware' => ['auth:api']], function () {
    Route::post('/', 'Api\AnaliticsController@index')->name('api.analitics.index');
});

