<?php

Route::group(['prefix' => 'roles', 'middleware' => []], function () {
    Route::get('/', 'Api\RoleController@index')->name('api.roles.index');
    Route::post('/', 'Api\RoleController@store')->name('api.roles.create');
    Route::get('/{role}', 'Api\RoleController@show')->name('api.roles.read');
    Route::put('/{role}', 'Api\RoleController@update')->name('api.roles.update');
    Route::delete('/{role}', 'Api\RoleController@destroy')->name('api.roles.delete');
});

Route::group(['prefix' => 'permissions', 'middleware' => []], function () {
    Route::get('/', 'Api\PermissionController@index')->name('api.permissions.index');
    Route::post('/', 'Api\PermissionController@store')->name('api.permissions.create');
    Route::get('/{permission}', 'Api\PermissionController@show')->name('api.permissions.read');
    Route::put('/{permission}', 'Api\PermissionController@update')->name('api.permissions.update');
    Route::delete('/{permission}', 'Api\PermissionController@destroy')->name('api.permissions.delete');
});