<?php

Route::group(['prefix' => 'auth', 'middleware' => []], function () {

    Route::get('/login',['uses' => 'LoginController@showLoginForm','as' => 'login']);
    Route::post('/login',['uses' => 'LoginController@login']);

    Route::get('/register',['uses' => 'RegisterController@showRegistrationForm','as' => 'register']);
    Route::post('/register',['uses' => 'RegisterController@register']);

    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');


    //Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
    //Route::get('email/verify/{id}/{hash}', 'VerificationController@verify')->name('verification.verify');
    //Route::post('email/resend', 'VerificationController@resend')->name('verification.resend');


});