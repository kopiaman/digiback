<?php

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

    Route::group(['prefix' => 'auth'], function () {

        Route::post('create', 'AuthController@create');
        Route::post('login', 'AuthController@login');
        Route::get('me', 'AuthController@me')->middleware('auth.basic');
        Route::post('logout', 'AuthController@logout')->middleware('auth.basic');
    });

    Route::group(['prefix' => 'users'], function () {

        Route::get('/', 'UserController@index');
    });

});
