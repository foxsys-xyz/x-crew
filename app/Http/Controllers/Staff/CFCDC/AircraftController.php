<?php

namespace App\Http\Controllers\Staff\CFCDC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Use Facades Required Additionally
 *
 */
use Carbon\Carbon;
use App\Models\Aircraft;
use Illuminate\Support\Facades\DB;
use App\Imports\Aircraft as ImportAircraft;

class AircraftController extends Controller
{
    /**
    * Display aircraft / fleet page.
    * 
    */
    public function all()
    {
        $aircraft = DB::table('aircraft')->paginate(15);

        return view('main.staff.cfcdc.aircraft.all', [
            'fleet' => $aircraft,
        ]);
    }

    /**
     * Import data for aircraft.
     * 
     */
    public function import(Request $request)
    {
        $request->validate([
            'aircraft' => 'mimes:csv,txt|required',
        ]);

        if (request('location') != null) {
            $request->validate([
                'location' => 'max:4|exists:airports,icao',
            ]);
        }

        $location = strtoupper(request('location'));

        DB::table('aircraft')->truncate();

        (new ImportAircraft($location))->queue($request->file('aircraft'))->chain([
            DB::table('broadcasts')->insert([
                [
                    'title' => 'fleet imports 👌',
                    'description' => 'all aircraft are successfully imported.',
                    'for' => 'S',
                    'created_at' => Carbon::now('UTC'),
                    'updated_at' => Carbon::now('UTC'),
                ],
            ]),
        ]);

        return redirect()->route('staff.aircraft')->with('success', 'data resources are being imported. you\'ll be notified when done.');
    }

    /**
    * Display edit page for aircraft.
    * 
    */
    public function edit($id)
    {
        $aircraft = DB::table('aircraft')->where('id', $id)->first();

        $airport = DB::table('airports')->where('icao', $aircraft->location)->first();

        return view('main.staff.cfcdc.aircraft.edit', [
            'aircraft' => $aircraft,
            'airport' => $airport,
        ]);
    }

    /**
    * Update data for an airport.
    * 
    */
    public function update(Request $request, $id)
    {
        $request->validate([
            'airport_name' => 'required',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'elevation' => 'required|numeric',
        ]);

        $airport = Aircraft::find($id);

        $airport->airport_name = request('airport_name');
        $airport->lat = request('lat');
        $airport->lng = request('lng');
        $airport->elevation = request('elevation');

        if (request('hub') === "on") {
            $airport->hub = true;
        } elseif (request('hub') === null) {
            $airport->hub = false;
        }

        $airport->save();

        return redirect('/cfcdc/airports/edit/' . $id)->with('success', 'airport data updated successfully.');
    }
}
