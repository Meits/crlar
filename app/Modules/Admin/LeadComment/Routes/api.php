<?php

Route::group(['prefix' => 'comments', 'middleware' => ['auth:api']], function () {
    Route::post('/', 'Api\LeadCommentsController@store');
});

