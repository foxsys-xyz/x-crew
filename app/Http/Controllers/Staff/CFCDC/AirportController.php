<?php

namespace App\Http\Controllers\Staff\CFCDC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Use Facades Required Additionally
 *
 */
use Carbon\Carbon;
use App\Models\Airport;
use Illuminate\Support\Facades\DB;
use App\Imports\Airports\Airports;
use App\Imports\Airports\Runways;
use App\Imports\Airports\Frequencies;

class AirportController extends Controller
{
    /**
    * Display airports page.
    * 
    */
    public function all()
    {
        $airports = DB::table('airports')->paginate(15);

        return view('main.staff.cfcdc.airports.all', [
            'airports' => $airports,
        ]);
    }

    /**
     * Import data for airports.
     * 
     */
    public function import(Request $request)
    {
        $request->validate([
            'airports' => 'mimes:csv,txt',
            'runways' => 'mimes:csv,txt',
            'frequencies' => 'mimes:csv,txt',
        ]);

        if ($request->hasFile('airports')) {
            DB::table('airports')->truncate();

            (new Airports)->queue($request->file('airports'))->chain([
                DB::table('broadcasts')->insert([
                    [
                        'title' => 'airport imports 👌',
                        'description' => 'all airports are successfully imported.',
                        'for' => 'S',
                        'created_at' => Carbon::now('UTC'),
                        'updated_at' => Carbon::now('UTC'),
                    ],
                ]),
            ]);
        }

        if ($request->hasFile('runways')) {
            DB::table('runways')->truncate();

            (new Runways)->queue($request->file('runways'))->chain([
                DB::table('broadcasts')->insert([
                    [
                        'title' => 'runway imports 👌',
                        'description' => 'all runways are successfully imported.',
                        'for' => 'S',
                        'created_at' => Carbon::now('UTC'),
                        'updated_at' => Carbon::now('UTC'),
                    ],
                ]),
            ]);
        }

        if ($request->hasFile('frequencies')) {
            DB::table('frequencies')->truncate();

            (new Frequencies)->queue($request->file('frequencies'))->chain([
                DB::table('broadcasts')->insert([
                    [
                        'title' => 'frequency imports 👌',
                        'description' => 'all frequencies are successfully imported.',
                        'for' => 'S',
                        'created_at' => Carbon::now('UTC'),
                        'updated_at' => Carbon::now('UTC'),
                    ],
                ]),
            ]);
        }

        return redirect()->route('staff.airports')->with('success', 'data resources are being imported. you\'ll be notified when done.');
    }

    /**
    * Display edit page for airport.
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
            'frequencies' => $frequencies,
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

        $airport = Airport::find($id);

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
