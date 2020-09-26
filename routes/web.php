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
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::domain('apply.' . env('APP_URL'))->group(function () {
    Route::get('/!t/{uuid}', 'Auth\RegisterController@showTemporaryForm')->name('apply');
    Route::post('/with/vatsim', 'Auth\RegisterController@applyWithVATSIM')->name('apply.with.vatsim');
    Route::get('/check/with/vatsim', 'Auth\RegisterController@applyWithVATSIM')->name('apply.check.with.vatsim');
    Route::get('/!f/{uuid}', 'Auth\RegisterController@showApplicationForm')->name('apply.form');
    Route::get('/privacy', function () {
        return view('apply.misc.privacy');
    })->name('privacy');
});

Route::get('/home', 'HomeController@index')->name('home');
