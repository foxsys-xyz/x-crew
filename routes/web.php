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

Auth::routes();

Route::domain('apply.' . env('APP_URL'))->group(function () {
    Route::get('/!t/{uuid}', 'Auth\RegisterController@showTemporaryForm')->name('apply');
    Route::post('/with/vatsim', 'Auth\RegisterController@applyWithVATSIM')->name('apply.with.vatsim');
    Route::get('/check/with/vatsim', 'Auth\RegisterController@applyWithVATSIM')->name('apply.check.with.vatsim');
    Route::post('/manual', 'Auth\RegisterController@applyManual')->name('apply.manual');
    Route::get('/!v/{uuid}', 'Auth\RegisterController@verifyManual')->name('apply.verify.manual');
    Route::post('/verify/resend', 'Auth\RegisterController@resendVerificationEmail')->name('apply.verify.resend.manual');
    Route::get('/verify/{verifyToken}', 'Auth\RegisterController@verifyEmailToken')->name('apply.verify.email.manual');
    Route::get('/!f/{uuid}', 'Auth\RegisterController@showApplicationForm')->name('apply.form');
    Route::post('/manual/finalize', 'Auth\RegisterController@finalizeManual');
    Route::get('/procedure', function () {
        return view('apply.misc.procedure');
    })->name('apply.procedure');
    Route::get('/privacy', function () {
        return view('apply.misc.privacy');
    })->name('apply.privacy');
});

Route::get('/home', 'HomeController@index')->name('home');
