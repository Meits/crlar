<?php

Route::group(['prefix' => 'roles', 'middleware' => []], function () {
    Route::get('/', 'RoleController@index')->name('roles.index');
    Route::post('/', 'RoleController@store')->name('roles.create');
    Route::get('/{role}', 'RoleController@show')->name('roles.read');
    Route::put('/{role}', 'RoleController@update')->name('roles.update');
    Route::delete('/{role}', 'RoleController@destroy')->name('roles.delete');
});

Route::group(['prefix' => 'permissions', 'middleware' => []], function () {
    Route::get('/', 'PermissionController@index')->name('permissions.index');
    Route::post('/', 'PermissionController@store')->name('permissions.create');
    Route::get('/{permission}', 'PermissionController@show')->name('permissions.read');
    Route::put('/{permission}', 'PermissionController@update')->name('permissions.update');
    Route::delete('/{permission}', 'PermissionController@destroy')->name('permissions.delete');
});