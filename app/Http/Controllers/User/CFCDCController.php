<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Use Facades Required Additionally
 *
 */

use App\Models\PIREP;
use App\Models\Airport;
use Illuminate\Support\Facades\Auth;

class CFCDCController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show Centralized Flight Crew Data Center.
     *
     */
    public function index()
    {
        // Current Location Script

        $lastrep = PIREP::where('user_id', Auth::user()->id)->latest()->limit(1)->first();

        if ($lastrep == null) {
            $currentloc = Airport::where('icao', Auth::user()->hub)->first();
        } else {
            $currentloc = Airport::where('icao', $lastrep->arrival)->first();
        }

        // METAR Script

        $url = 'https://www.aviationweather.gov/adds/dataserver_current/httpparam?dataSource=metars&requestType=retrieve&format=xml&hoursBeforeNow=2&mostRecent=true&stationString=' . $currentloc->icao;
        $xml = simplexml_load_file($url);

        $weather = $xml->data->METAR;

        // Booking Script

        $validate = Booking::where('user_id', Auth::user()->id)->first();

        if ($validate != null) {
            $booking = Booking::where('user_id', Auth::user()->id)->first();
            $schedule = Schedule::find($booking->schedule_id);
            $aircraft = Aircraft::find($booking->aircraft_id);
        } else {
            $booking, $schedule, $aircraft = null;
        }

        return view('main.user.cfcdc.center', compact(
            'lastrep',
            'currentloc',
            'weather',
            'booking',
            'schedule',
            'aircraft'
        ));
    }

    // Display the search page
    public function index2()
    {        
        

        return view('user.ops.main', compact('last_report', 'current_location', 'booking', 'booking_schedule', 'booking_aircraft'));
    }

    // Search the input
    public function search(Request $request)
    {
        $last_report = Report::where('user_id', Auth::user()->id)->latest()->limit(1)->get();

        $bookings = Booking::all()->pluck('schedule_id');

        if (request('icao') == null) {
            if ($last_report == "[]") {
                $schedules = Schedule::where('departure', Auth::user()->hub)->whereNotIn('id', $bookings)->get();
            } else {
                $schedules = Schedule::where('departure', $last_report[0]->arrival)->whereNotIn('id', $bookings)->get();
            }
        } else {
            if ($last_report == "[]") {
                $schedules = Schedule::where('departure', Auth::user()->hub)->where('arrival', request('icao'))->whereNotIn('id', $bookings)->get();
            } else {
                $schedules = Schedule::where('departure', $last_report[0]->arrival)->where('arrival', request('icao'))->whereNotIn('id', $bookings)->get();
            }
        }

        if ($last_report == "[]") {
            $current_location = Airport::where('icao', Auth::user()->hub)->get();
        } else {
            $current_location = Airport::where('icao', $last_report[0]->arrival)->get();
        }

        return view('user.ops.results', compact('schedules', 'current_location'));
    }

    // Select Params for Booking
    public function book($id)
    {
        $schedule = Schedule::findorFail($id);

        $last_report = Report::where('user_id', Auth::user()->id)->latest()->limit(1)->get();

        if ($last_report == "[]") {
            $current_location = Airport::where('icao', Auth::user()->hub)->get();
        } else {
            $current_location = Airport::where('icao', $last_report[0]->arrival)->get();
        }

        $departure = Airport::where('icao', $schedule->departure)->first();

        $arrival = Airport::where('icao', $schedule->arrival)->first();

        $aircrafts = Aircraft::where('model', $schedule->aircraft)->where('location', $current_location[0]->icao)->where('state', 'CLD/IDL')->get();

        return view('user.ops.book', compact('schedule', 'current_location', 'departure', 'arrival', 'aircrafts'));
    }

    // Confirm the Booking
    public function booking_confirm(Request $request, $id)
    {
        $this->validate($request, [
            'aircraft' => 'required'
        ]);

        $validate = Booking::where('user_id', Auth::user()->id)->first();

        if ($validate != null) {
            return redirect('/cfcdc')->with('error', 'You cannot book multiple schedules at a time.');
        }

        $bookings = Booking::where('schedule_id', $id)->first();

        if ($bookings != null) {
            return redirect('/cfcdc')->with('error', 'This schedule is already booked.');
        }

        $booking = new Booking;

        $booking->schedule_id = $id;

        $booking->user_id = Auth::user()->id;

        $booking->aircraft_id = request('aircraft');

        $booking->save();

        $update = Aircraft::find(request('aircraft'))->update([
            'state' => 'PRE/BKD'
        ]);

        return redirect('/preflight')->with(['booking' => $booking]);
    }

    public function cancel_booking(Request $request)
    {
        $booking = Booking::where('user_id', Auth::user()->id)->first();

        $update = Aircraft::find($booking->aircraft_id)->update([
            'state' => 'CLD/IDL'
        ]);

        $delete = Booking::destroy($booking->id);

        return redirect('/cfcdc')->with('success', 'Your booking has been cancelled. Always avoid cancellations.');
    }

    public function generate_preflight(Request $request)
    {
        $booking = Booking::where('user_id', Auth::user()->id)->first();

        return redirect('/preflight')->with(['booking' => $booking]);
    }

    public function preflight()
    {
        $booking = Session::get('booking');

        if ($booking == null) {
            return redirect('/cfcdc')->with('error', 'Pre Flight Data was not requested correctly. Make sure you do it via CFCDC.');
        }

        $schedule = Schedule::find($booking->schedule_id);

        $aircraft = Aircraft::find($booking->aircraft_id);

        $departure = Airport::where('icao', $schedule->departure)->first();

        $arrival = Airport::where('icao', $schedule->arrival)->first();

        $departure_runways = DB::table('airport_runways')->where('icao', $departure->icao)->get();

        $arrival_runways = DB::table('airport_runways')->where('icao', $arrival->icao)->get();

        $departure_frequencies = DB::table('airport_frequencies')->where('icao', $departure->icao)->get();

        $arrival_frequencies = DB::table('airport_frequencies')->where('icao', $arrival->icao)->get();

        $deptime = Carbon::now()->addHour();

        $deph = $deptime->hour;

        $depm = $deptime->minute;

        return view('user.ops.preflight', compact(
            'schedule', 
            'aircraft', 
            'departure', 
            'arrival', 
            'departure_runways', 
            'arrival_runways', 
            'departure_frequencies', 
            'arrival_frequencies', 
            'deph', 
            'depm'
        ));
    }

    public function process_simbrief()
    {
        include($_SERVER['DOCUMENT_ROOT'] . '/simbrief/simbrief.apiv1.php');

        $get = $_GET['ofp_id'];

        $encrypt = Crypt::encryptString($get);

        return redirect('/briefing/' . $encrypt);
    }

    public function updateBooking($deptime, $duration, $arrtime)
    {
        $update = Booking::where('user_id', Auth::user()->id)->first();

        $update->departure_at = $deptime;

        $update->duration = $duration;

        $update->arrival_at = $arrtime;

        $update->save();
    }

    public function briefing($encrypt)
    {
        $decrypt = Crypt::decryptString($encrypt);

        $id = $decrypt;

        $url = 'http://www.simbrief.com/ofp/flightplans/xml/' . $id . '.xml';

        $xml = simplexml_load_file($url);

        $depht = $xml->api_params->dephour;
        $ho = new DateTime("@$depht");
        $dephour = $ho->format('H');

        $depmt = $xml->api_params->depmin;
        $mi = new DateTime("@$depmt");
        $depmin = $mi->format('i');

        $deptime = Carbon::createFromFormat('Y-m-d H:i:s', '2005-12-05 ' . $dephour . ':' . $depmin . ':00');

        $durht = $xml->api_params->stehour;
        $dho = new DateTime("@$durht");
        $durhour = $dho->format('H');

        $durmt = $xml->api_params->stemin;
        $dmi = new DateTime("@$durmt");
        $durmin = $dmi->format('i');

        $duration = Carbon::createFromFormat('H:i:s', $durhour . ':' . $durmin . ':00');

        $deptemp = Carbon::createFromFormat('Y-m-d H:i:s', '2005-12-05 ' . $dephour . ':' . $depmin . ':00');

        $arrmin = $deptemp->addMinutes($duration->minute);

        $arrhour = $deptemp->addHours($duration->hour);

        $arrtime = $deptemp;

        $this->updateBooking($deptime, $duration, $arrtime);

        return view('user.ops.briefing', compact('xml'));
    }
}
