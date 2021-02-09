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

    /**
     * VATSIM Connect API Routes [Do Not Edit Without Lead Dev's Permission]
     *
     */

    Route::get('/with/vatsim', 'Auth\LoginController@completeAuthenticationWithVATSIM')->name('login.with.vatsim');
    Route::get('/authenticated', 'User\DashboardController@confirmAuthentication')->name('auth.authenticated');

    Route::post('/logout', 'Auth\LoginController@logout')->middleware('auth')->name('logout');
});

Route::domain('cloud.' . env('APP_URL'))->group(function () {
    Route::get('/dashboard', 'User\DashboardController@index')->name('dashboard');

    /**
     * Profile Routes [Do Not Edit Without Lead Dev's Permission]
     *
     */

    Route::get('/profile', 'User\ProfileController@index')->name('profile');
    Route::patch('/profile', 'User\ProfileController@updateProfile')->name('profile.update');
    Route::patch('/profile/password', 'User\ProfileController@updatePassword')->name('profile.password.update');

    /**
     * CFCDC Routes [Do Not Edit Without Lead Dev's Permission]
     *
     */

    Route::get('/cfcdc', 'User\CFCDCController@index')->name('cfcdc');
    Route::post('/cfcdc/search', 'User\CFCDCController@search')->name('cfcdc.search');
    Route::get('/cfcdc/!fb/{id}', 'User\CFCDCController@preBook')->name('cfcdc.flight');
    Route::post('/cfcdc/!fb/confirm/{id}', 'User\CFCDCController@confirmFlight')->name('cfcdc.flight.confirm');
    Route::post('/cfcdc/!fb/cancel', 'User\CFCDCController@cancelFlight')->name('cfcdc.flight.cancel');
    Route::post('/cfcdc/!pf/generate', 'User\CFCDCController@generatePreFlight')->name('cfcdc.preflight.generate');
    Route::get('/cfcdc/!pf/{uuid}', 'User\CFCDCController@preFlight')->name('cfcdc.preflight');
    Route::get('/cfcdc/!sb/process', 'User\CFCDCController@processSimbrief')->name('cfcdc.process.simbrief');
    Route::get('/cfcdc/!br/{encrypt}', 'User\CFCDCController@briefing')->name('cfcdc.briefing');
});

Route::domain('staff.' . env('APP_URL'))->group(function () {
    Route::get('/dashboard', 'Staff\DashboardController@index')->name('staff.dashboard');

    /**
     * Staff Access Routes // Application Monitoring [Do Not Edit Without Lead Dev's Permission]
     *
     */

    Route::get('/pilots/applications', 'Staff\ApplicationController@index')->name('staff.user.applications');
    Route::post('/pilots/approve/{id}', 'Staff\ApplicationController@approve')->name('staff.user.approve');
    Route::post('/pilots/disapprove/{id}', 'Staff\ApplicationController@disapprove')->name('staff.user.disapprove');

    /**
     * Staff Access Routes // Role Management [Do Not Edit Without Lead Dev's Permission]
     *
     */

    Route::get('/roles', 'Staff\RoleController@index')->name('staff.roles');
    Route::post('/roles', 'Staff\RoleController@add')->name('staff.roles.add');
    Route::put('/roles/update/{id}', 'Staff\RoleController@update')->name('staff.roles.update');
    Route::delete('/roles/delete/{id}', 'Staff\RoleController@delete')->name('staff.roles.delete');

    /**
     * Staff Access Routes // Pilot Management [Do Not Edit Without Lead Dev's Permission]
     *
     */

    Route::get('/pilots', 'Staff\UserController@index')->name('staff.users');
    Route::get('/pilots/edit/{id}', 'Staff\UserController@edit')->name('staff.user.edit');
    Route::put('/pilots/update/{id}', 'Staff\UserController@update')->name('staff.user.update');

    /**
     * Staff Access Routes // CFCDC Management // Airports [Do Not Edit Without Lead Dev's Permission]
     *
     */

    Route::get('/airports', 'Staff\AirportController@index')->name('staff.airports');
    Route::get('/airports/all', 'Staff\AirportController@all')->name('staff.airports.all');
    Route::post('/airports', 'Staff\AirportController@add')->name('staff.airport.add');
    Route::post('/airports/import', 'Staff\AirportController@import')->name('staff.airports.import');
    Route::get('/airports/ops/{id}', 'Staff\AirportController@edit')->name('staff.airport.edit');
    Route::put('/airports/update/{id}', 'Staff\AirportController@update')->name('staff.airport.update');
    Route::delete('/airports/delete/{id}', 'Staff\AirportController@delete')->name('staff.airport.delete');
    Route::post('/airports/runways/import', 'Staff\AirportController@import_r')->name('staff.airports.runways.import');
    Route::post('/airports/frequencies/import', 'Staff\AirportController@import_f')->name('staff.airports.frequencies.import');

    /**
     * Staff Access Routes // CFCDC Management // Aircrafts [Do Not Edit Without Lead Dev's Permission]
     *
     */

    Route::get('/aircrafts', 'Staff\AircraftController@index')->name('staff.aircrafts');
    Route::get('/aircrafts/all', 'Staff\AircraftController@all')->name('staff.aircrafts.all');
    Route::post('/aircrafts', 'Staff\AircraftController@add')->name('staff.aircraft.add');
    Route::post('/aircrafts/import', 'Staff\AircraftController@import')->name('staff.aircrafts.import');
    Route::get('/aircrafts/ops/{id}', 'Staff\AircraftController@edit')->name('staff.aircraft.edit');
    Route::put('/aircrafts/update/{id}', 'Staff\AircraftController@update')->name('staff.aircraft.update');
    Route::delete('/aircrafts/delete/{id}', 'Staff\AircraftController@delete')->name('staff.aircraft.delete');

    /**
     * Staff Access Routes // CFCDC Management // Schedules [Do Not Edit Without Lead Dev's Permission]
     *
     */

    Route::get('/schedules', 'Staff\ScheduleController@index')->name('staff.schedules');
    Route::get('/schedules/all', 'Staff\ScheduleController@all')->name('staff.schedules.all');
    Route::post('/schedules', 'Staff\ScheduleController@add')->name('staff.schedule.add');
    Route::post('/schedules/import', 'Staff\ScheduleController@import')->name('staff.schedules.import');
    Route::get('/schedules/ops/{id}', 'Staff\ScheduleController@edit')->name('staff.schedule.edit');
    Route::put('/schedules/update/{id}', 'Staff\ScheduleController@update')->name('staff.schedule.update');
    Route::delete('/schedules/delete/{id}', 'Staff\ScheduleController@delete')->name('staff.schedule.delete');
});
