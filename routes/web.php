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

Route::domain('apply.' . config('app.url'))->group(function () {
    Route::get('start', 'Auth\RegisterController@showRegistrationForm')->name('apply.start');
    Route::get('authenticated', 'User\DashboardController@confirmAuthentication')->name('apply.authenticated');
    Route::get('!t/{uuid}', 'Auth\RegisterController@showTemporaryForm')->name('apply.temp');
    Route::get('with/vatsim', 'Auth\RegisterController@completeAuthenticationWithVATSIM')->name('apply.with.vatsim');
    Route::post('manual', 'Auth\RegisterController@applyManual')->name('apply.manual');
    Route::get('!v/{uuid}', 'Auth\RegisterController@verifyManual')->name('apply.verify.manual');
    Route::post('verify/resend', 'Auth\RegisterController@resendVerificationEmail')->name('apply.verify.resend.manual');
    Route::get('verify/{verifyToken}', 'Auth\RegisterController@verifyEmailToken')->name('apply.verify.email.manual');
    Route::get('!f/{uuid}', 'Auth\RegisterController@showApplicationForm')->name('apply.form');
    Route::post('manual/finalize', 'Auth\RegisterController@finalizeApplication')->name('apply.finalize');
    Route::get('complete', 'Auth\RegisterController@completeApplication')->name('apply.complete');
    Route::get('procedure', function () {
        return view('apply.misc.procedure');
    })->name('apply.procedure');
    Route::get('privacy', function () {
        return view('apply.misc.privacy');
    })->name('apply.privacy');
});

Route::domain('auth.' . config('app.url'))->group(function () {
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login')->name('login.check');

    /**
     * VATSIM Connect API Routes [Do Not Edit Without Lead Dev's Permission]
     *
     */

    Route::get('with/vatsim', 'Auth\LoginController@completeAuthenticationWithVATSIM')->name('login.with.vatsim');
    Route::get('authenticated', 'User\DashboardController@confirmAuthentication')->name('auth.authenticated');

    Route::post('logout', 'Auth\LoginController@logout')->middleware('auth')->name('logout');
});

Route::middleware('auth')->domain('cloud.' . config('app.url'))->group(function () {
    Route::get('dashboard', 'User\DashboardController@index')->name('dashboard');

    /**
     * Profile Routes [Do Not Edit Without Lead Dev's Permission]
     *
     */

    Route::get('profile', 'User\ProfileController@index')->name('profile');
    Route::patch('profile', 'User\ProfileController@updateProfile')->name('profile.update');
    Route::patch('profile/password', 'User\ProfileController@updatePassword')->name('profile.password.update');

    /**
     * CFCDC Routes [Do Not Edit Without Lead Dev's Permission]
     *
     */

    Route::get('cfcdc', 'User\CFCDCController@index')->name('cfcdc');
    Route::post('cfcdc/search', 'User\CFCDCController@search')->name('cfcdc.search');
    Route::get('cfcdc/!fb/{id}', 'User\CFCDCController@preBook')->name('cfcdc.flight');
    Route::post('cfcdc/!fb/confirm/{id}', 'User\CFCDCController@confirmFlight')->name('cfcdc.flight.confirm');
    Route::post('cfcdc/!fb/cancel', 'User\CFCDCController@cancelFlight')->name('cfcdc.flight.cancel');
    Route::post('cfcdc/!pf/generate', 'User\CFCDCController@generatePreFlight')->name('cfcdc.preflight.generate');
    Route::get('cfcdc/!pf/{uuid}', 'User\CFCDCController@preFlight')->name('cfcdc.preflight');
    Route::get('cfcdc/!sb/process', 'User\CFCDCController@processSimbrief')->name('cfcdc.process.simbrief');
    Route::get('cfcdc/!br/{encrypt}', 'User\CFCDCController@briefing')->name('cfcdc.briefing');
});

Route::middleware(['auth', 'staff'])->domain('staff.' . config('app.url'))->group(function () {
    Route::get('dashboard', 'Staff\DashboardController@index')->name('staff.dashboard');

    /**
     * Staff Access Routes // Application Monitoring [Do Not Edit Without Lead Dev's Permission]
     *
     */

    Route::get('pilots/applications', 'Staff\ApplicationController@index')->name('staff.user.applications');
    Route::post('pilots/approve/{id}', 'Staff\ApplicationController@approve')->name('staff.user.approve');
    Route::post('pilots/disapprove/{id}', 'Staff\ApplicationController@disapprove')->name('staff.user.disapprove');

    /**
     * Staff Access Routes // Role Management [Do Not Edit Without Lead Dev's Permission]
     *
     */

    Route::get('roles', 'Staff\RoleController@index')->name('staff.roles');
    Route::post('roles', 'Staff\RoleController@add')->name('staff.roles.add');
    Route::put('roles/update/{id}', 'Staff\RoleController@update')->name('staff.roles.update');
    Route::delete('roles/delete/{id}', 'Staff\RoleController@delete')->name('staff.roles.delete');

    /**
     * Staff Access Routes // Pilot Management [Do Not Edit Without Lead Dev's Permission]
     *
     */

    Route::get('pilots', 'Staff\UserController@index')->name('staff.users');
    Route::get('pilots/edit/{id}', 'Staff\UserController@edit')->name('staff.user.edit');
    Route::put('pilots/update/{id}', 'Staff\UserController@update')->name('staff.user.update');

    /**
     * Staff Access Routes // CFCDC Management // Center [Do Not Edit Without Lead Dev's Permission]
     *
     */

    Route::get('cfcdc', 'Staff\CFCDCController@index')->name('staff.cfcdc');

    /**
     * Staff Access Routes // CFCDC Management // Airports [Do Not Edit Without Lead Dev's Permission]
     *
     */

    Route::get('cfcdc/airports', 'Staff\CFCDC\AirportController@all')->name('staff.airports');
    Route::post('cfcdc/airports/import', 'Staff\CFCDC\AirportController@import')->name('staff.airports.import');
    Route::get('cfcdc/airports/edit/{id}', 'Staff\CFCDC\AirportController@edit')->name('staff.airport.edit');
    Route::patch('cfcdc/airports/update/{id}', 'Staff\CFCDC\AirportController@update')->name('staff.airport.update');

    /**
     * Staff Access Routes // CFCDC Management // Aircrafts [Do Not Edit Without Lead Dev's Permission]
     *
     */

    Route::get('cfcdc/aircraft', 'Staff\CFCDC\AircraftController@all')->name('staff.aircraft');
    Route::post('cfcdc/aircraft/import', 'Staff\CFCDC\AircraftController@import')->name('staff.aircraft.import');
    Route::get('cfcdc/aircraft/edit/{id}', 'Staff\CFCDC\AircraftController@edit')->name('staff.aircraft.edit');
    Route::put('cfcdc/aircraft/update/{id}', 'Staff\CFCDC\AircraftController@update')->name('staff.aircraft.update');

    /**
     * Staff Access Routes // CFCDC Management // Schedules [Do Not Edit Without Lead Dev's Permission]
     *
     */

    Route::get('cfcdc/schedules', 'Staff\CFCDC\ScheduleController@all')->name('staff.schedules');
    Route::post('cfcdc/schedules/import', 'Staff\CFCDC\ScheduleController@import')->name('staff.schedules.import');
    Route::get('cfcdc/schedules/edit/{id}', 'Staff\CFCDC\ScheduleController@edit')->name('staff.schedule.edit');
    Route::put('cfcdc/schedules/update/{id}', 'Staff\CFCDC\ScheduleController@update')->name('staff.schedule.update');
});
