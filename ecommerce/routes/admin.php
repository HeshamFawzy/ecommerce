<?php

Route::group(['namespace' => 'Admin'], function () {
    // Dashboard
    Route::get('/', 'HomeController@index')->name('admin.home');

    // Login
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Auth\LoginController@login')->name('admin.plogin');
    Route::get('logout', 'Auth\LoginController@logout')->name('admin.logout');

    // Register
    /*Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('admin.register');
    Route::post('register', 'Auth\RegisterController@register');

    // Reset Password
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('admin.password.update');

    // Confirm Password
    Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')->name('admin.password.confirm');
    Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');*/

    // Verify Email
    // Route::get('email/verify', 'Auth\VerificationController@show')->name('admin.verification.notice');
    // Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('admin.verification.verify');
    // Route::post('email/resend', 'Auth\VerificationController@resend')->name('admin.verification.resend');

    Route::resource('categories', 'CategoryController');
    Route::resource('products', 'ProductController');
    Route::get('slider', 'PublicController@slider')->name('public.slider');
    Route::post('sliderUpload', 'PublicController@sliderUpload')->name('public.sliderUpload');
    Route::get('sliderDelete/{id}', 'PublicController@sliderDelete')->name('public.sliderDelete');
    Route::get('about', 'PublicController@about')->name('public.about');
    Route::post('aboutUpload', 'PublicController@aboutUpload')->name('public.aboutUpload');
    Route::get('contact', 'PublicController@contact')->name('public.contact');
    Route::post('contactUpload', 'PublicController@contactUpload')->name('public.contactUpload');
    //Route::resource('systemRoles', 'SystemRolesController');
    Route::resource('systemUsers', 'SystemUsersController');
    Route::get('orders/done/{id}', 'OrderController@done')->name('orders.done');
    Route::resource('orders', 'OrderController');
});
