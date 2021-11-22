<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Use Facades Required Additionally
 *
 */
use App\Models\Airport;
use App\Models\Schedule;
use App\Models\Aircraft;
use Illuminate\Support\Facades\DB;

class CFCDCController extends Controller
{
    /**
    * Display Staff CFCDC.
    * 
    */
    public function index()
    {
        $airports = DB::table('airports')->count();
        $schedules = DB::table('schedules')->count();
        $aircrafts = DB::table('aircraft')->count();
        $runways = DB::table('runways')->count();
        $frequencies = DB::table('frequencies')->count();

        return view('main.staff.cfcdc.center', compact(
            'airports',
            'schedules',
            'aircrafts',
            'runways',
            'frequencies'
        ));
    }
}
