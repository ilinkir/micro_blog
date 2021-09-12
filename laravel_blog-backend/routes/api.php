<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

Route::group(['namespace' => 'App\Http\Controllers\Api'], function () {
    Route::group(['namespace' => 'Auth', 'prefix' => 'user'], function () {
        Route::post('register', 'RegisterController@register');
        Route::post('login', 'LoginController@login');
        Route::post('logout', 'LogoutController@logout')->middleware('auth:api');
    });
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/user/info', [Controllers\UserController::class, 'info']);
    Route::get('/posts/my', [Controllers\Api\PostsController::class, 'myPosts']);
});

Route::resource('/post', Controllers\Api\PostsController::class);
