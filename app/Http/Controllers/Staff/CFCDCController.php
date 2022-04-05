<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Use Facades Required Additionally
 *
 */
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
        $aircraft = DB::table('aircraft')->count();
        $runways = DB::table('runways')->count();
        $frequencies = DB::table('frequencies')->count();

        return view('main.staff.cfcdc.center', [
            'airports' => $airports,
            'schedules' => $schedules,
            'aircraft' => $aircraft,
            'runways' => $runways,
            'frequencies' => $frequencies,
        ]);
    }
}
