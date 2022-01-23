<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return redirect(url('/user'));
});

Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
    Route::post('/save', 'App\Http\Controllers\UserController@saveUserData');

    Route::get('/', 'App\Http\Controllers\UserController@userHome');

    Route::get('/{userId}', 'App\Http\Controllers\UserController@getPhoneAndVkId');

    Route::get('/{user}/data', 'App\Http\Controllers\UserController@getData');
});

