<?php

namespace App\Http\Controllers\Staff\CFCDC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Use Facades Required Additionally
 *
 */
use Illuminate\Support\Facades\DB;

class AirportController extends Controller
{
    /**
    * Display Airports Page.
    * 
    */
    public function index()
    {
        $airports = DB::table('airports')->paginate(15);

        return view('main.staff.cfcdc.airports.all', [
            'airports' => $airports
        ]);
    }

    /**
    * Display Edit Page for Airport.
    * 
    */
    public function edit($id)
    {
        $airport = DB::table('airports')->where('id', $id)->first();
        $runways = DB::table('runways')->where('icao', $airport->icao)->get();
        $frequencies = DB::table('frequencies')->where('icao', $airport->icao)->get();

        return view('main.staff.cfcdc.airports.edit', [
            'airport' => $airport,
            'runways' => $runways,
            'frequencies' => $frequencies
        ]);
    }
}
