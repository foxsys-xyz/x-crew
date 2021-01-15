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

Route::domain('apply.' . env('APP_URL'))->group(function () {
    Route::get('/start', 'Auth\RegisterController@showRegistrationForm')->name('apply.start');
    Route::get('/authenticated', 'User\DashboardController@confirmAuthentication')->name('apply.authenticated');
    Route::get('/!t/{uuid}', 'Auth\RegisterController@showTemporaryForm')->name('apply.temp');
    Route::get('/with/vatsim', 'Auth\RegisterController@completeAuthenticationWithVATSIM')->name('apply.with.vatsim');
    Route::post('/manual', 'Auth\RegisterController@applyManual')->name('apply.manual');
    Route::get('/!v/{uuid}', 'Auth\RegisterController@verifyManual')->name('apply.verify.manual');
    Route::post('/verify/resend', 'Auth\RegisterController@resendVerificationEmail')->name('apply.verify.resend.manual');
    Route::get('/verify/{verifyToken}', 'Auth\RegisterController@verifyEmailToken')->name('apply.verify.email.manual');
    Route::get('/!f/{uuid}', 'Auth\RegisterController@showApplicationForm')->name('apply.form');
    Route::post('/manual/finalize', 'Auth\RegisterController@finalizeApplication')->name('apply.finalize');
    Route::get('/complete', 'Auth\RegisterController@completeApplication')->name('apply.complete');
    Route::get('/procedure', function () {
        return view('apply.misc.procedure');
    })->name('apply.procedure');
    Route::get('/privacy', function () {
        return view('apply.misc.privacy');
    })->name('apply.privacy');
});

Route::domain('auth.' . env('APP_URL'))->group(function () {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'Auth\LoginController@login')->name('login.check');
    Route::get('/with/vatsim', 'Auth\LoginController@completeAuthenticationWithVATSIM')->name('login.with.vatsim');
    Route::get('/authenticated', 'User\DashboardController@confirmAuthentication')->name('auth.authenticated');
    Route::post('/logout', 'Auth\LoginController@logout')->middleware('auth')->name('logout');
});

Route::domain('cloud.' . env('APP_URL'))->group(function () {
    Route::get('/dashboard', 'User\DashboardController@index')->name('dashboard');
    Route::get('/profile', 'User\ProfileController@index')->name('profile');
    Route::patch('/profile', 'User\ProfileController@updateProfile')->name('profile.update');
    Route::patch('/profile/password', 'User\ProfileController@updatePassword')->name('profile.password.update');
});
