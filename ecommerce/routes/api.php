<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['namespace' => 'API'], function () {
    Route::resource('categories', 'CategoryController');
    Route::get('productsByCategory/{id}', 'ProductController@productsByCategory');
    Route::get('latestProducts', 'ProductController@latestProducts');
    Route::get('ratedProducts', 'ProductController@ratedProducts');
    Route::resource('products', 'ProductController');
    Route::get('slider', 'PublicController@slider');
    Route::get('about', 'PublicController@about');
    Route::get('contact', 'PublicController@contact');

    Route::group([
        'middleware' => 'api',
        'prefix' => 'auth',
    ], function ($router) {
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        Route::post('refresh', 'AuthController@refresh');
        Route::get('user-profile', 'AuthController@userProfile');
        Route::post('edit-profile', 'AuthController@editProfile');
        Route::post('logout', 'AuthController@logout');
        Route::post('/password/email', 'ForgotPasswordController@sendResetLinkEmail');
        Route::post('/password/reset', 'ResetPasswordController@reset');
        Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify');
        Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');
    });

    Route::group([
        'middleware' => 'api',
    ], function ($router) {
        Route::post('order', 'OrderController@store');
        Route::get('my-orders', 'OrderController@my_orders');
    });
});


