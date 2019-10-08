<?php

Route::group(['prefix' => 'dashboard', 'middleware'=> ['auth']], function () {
    Route::get('/',['uses' => 'DashboardController@index','as' => 'dashboard.index']);
});