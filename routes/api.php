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

Route::post('connect/with/vatsim', 'Auth\VATSIM\ConnectController@connectWithVATSIM')
        ->withoutMiddleware('api')
        ->middleware('web')
        ->name('connect.with.vatsim');

Route::get('verify/with/vatsim', 'Auth\VATSIM\ConnectController@connectWithVATSIM')
        ->withoutMiddleware('api')
        ->middleware('web')
        ->name('verify.with.vatsim');

Route::post('login', 'ACARS\LoginController@login')->name('acars.login');
Route::post('logout', 'ACARS\LoginController@logout')->middleware('auth:sanctum')->name('acars.logout');
Route::get('user', 'ACARS\LoginController@user')->middleware('auth:sanctum')->name('acars.user');
Route::get('dashboard', 'ACARS\LoginController@dashboard')->middleware('auth:sanctum')->name('acars.dashboard');
Route::post('acars', 'ACARS\ConnectionController@trace')->middleware('auth:sanctum')->name('acars.trace');
