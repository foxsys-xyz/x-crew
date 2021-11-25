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
}
