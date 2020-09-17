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
    Route::resource('products', 'ProductController');
    Route::get('slider', 'PublicController@slider');
    Route::get('about', 'PublicController@about');
    Route::get('contact', 'PublicController@contact');
});
