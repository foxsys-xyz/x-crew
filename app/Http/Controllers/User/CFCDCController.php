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
use App\Models\Booking;
use App\Models\Schedule;
use App\Models\Aircraft;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class CFCDCController extends Controller
{
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

        // Booking Script

        $validate = Booking::where('user_id', Auth::user()->id)->first();

        $booking = null;
        $schedule = null;
        $aircraft = null;

        if ($validate != null) {
            $booking = Booking::where('user_id', Auth::user()->id)->first();
            $schedule = Schedule::find($booking->schedule_id);
            $aircraft = Aircraft::find($booking->aircraft_id);
        }

        return view('main.user.cfcdc.center', [
            'lastrep' => $lastrep,
            'currentloc' => $currentloc,
            'booking' => $booking,
            'schedule' => $schedule,
            'aircraft' => $aircraft,
        ]);
    }

    /**
     * Search schedules available for booking.
     *
     */
    public function search(Request $request)
    {
        $request->validate([
            'icao' => 'required',
        ]);

        $lastrep = PIREP::where('user_id', Auth::user()->id)->latest()->limit(1)->first();

        $bookings = Booking::all()->pluck('schedule_id');

        if (request('icao') == null) {
            if ($lastrep == null) {
                $schedules = Schedule::where('departure', Auth::user()->hub)->whereNotIn('id', $bookings)->get();
            } else {
                $schedules = Schedule::where('departure', $lastrep->arrival)->whereNotIn('id', $bookings)->get();
            }
        } else {
            if ($lastrep == null) {
                $schedules = Schedule::where('departure', Auth::user()->hub)->where('arrival', request('icao'))->whereNotIn('id', $bookings)->get();
            } else {
                $schedules = Schedule::where('departure', $lastrep->arrival)->where('arrival', request('icao'))->whereNotIn('id', $bookings)->get();
            }
        }

        if ($lastrep == null) {
            $currentloc = Airport::where('icao', Auth::user()->hub)->get();
        } else {
            $currentloc = Airport::where('icao', $lastrep->arrival)->get();
        }

        return view('main.user.cfcdc.search', [
            'schedules' => $schedules,
            'currentloc' => $currentloc,
            'lastrep' => $lastrep,
        ]);
    }

    /**
     * Render pre booking page with aircrafts available.
     *
     */
    public function preBook($id)
    {
        $schedule = Schedule::findorFail($id);

        $lastrep = PIREP::where('user_id', Auth::user()->id)->latest()->limit(1)->first();

        if ($lastrep == null) {
            $currentloc = Airport::where('icao', Auth::user()->hub)->first();
        } else {
            $currentloc = Airport::where('icao', $lastrep->arrival)->first();
        }

        $departure = Airport::where('icao', $schedule->departure)->first();

        $arrival = Airport::where('icao', $schedule->arrival)->first();

        $aircraft = Aircraft::where('icao', $schedule->aircraft_icao)->where('location', $currentloc->icao)->where('state', 'CLD/IDL')->get();

        //dd($aircraft, $schedule, $currentloc);

        return view('main.user.cfcdc.prebook', [
            'schedule' => $schedule,
            'currentloc' => $currentloc,
            'departure' => $departure,
            'arrival' => $arrival,
            'aircraft' => $aircraft,
        ]);
    }

    /**
     * Confirm the booking with the airframe selected.
     *
     */
    public function confirmFlight(Request $request, $id)
    {
        $request->validate([
            'aircraft' => 'required',
        ]);

        $validate = Booking::where('user_id', Auth::user()->id)->first();

        if ($validate != null) {
            return redirect('/cfcdc')->with('error', 'you cannot book multiple schedules at a time.');
        }

        $bookings = Booking::where('schedule_id', $id)->first();

        if ($bookings != null) {
            return redirect('/cfcdc')->with('error', 'this schedule is already booked.');
        }

        $booking = new Booking;

        $booking->schedule_id = $id;

        $booking->user_id = Auth::user()->id;

        $booking->aircraft_id = request('aircraft');

        $booking->save();

        Aircraft::find(request('aircraft'))->update([
            'state' => 'PRE/BKD',
        ]);

        return redirect('/preflight')->with(['booking' => $booking]);
    }

    /**
     * Cancel the booking and free aircraft.
     *
     */
    public function cancelFlight()
    {
        $booking = Booking::where('user_id', Auth::user()->id)->first();

        Aircraft::find($booking->aircraft_id)->update([
            'state' => 'CLD/IDL',
        ]);

        Booking::destroy($booking->id);

        return redirect('/cfcdc')->with('success', 'your booking has been cancelled. please try to avoid cancellations.');
    }

    public function generate_preflight(Request $request)
    {
        $booking = Booking::where('user_id', Auth::user()->id)->first();

        return redirect('/preflight')->with(['booking' => $booking]);
    }

    public function preflight(Request $request)
    {
        $booking = $request->session()->get('booking');

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

        return view('user.ops.preflight', [
            'schedule' => $schedule, 
            'aircraft' => $aircraft, 
            'departure' => $departure, 
            'arrival' => $arrival, 
            'departure_runways' => $departure_runways, 
            'arrival_runways' => $arrival_runways, 
            'departure_frequencies' => $departure_frequencies, 
            'arrival_frequencies' => $arrival_frequencies, 
            'deph' => $deph, 
            'depm' => $depm,
        ]);
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
        $ho = new DateTime("@{$depht}");
        $dephour = $ho->format('H');

        $depmt = $xml->api_params->depmin;
        $mi = new DateTime("@{$depmt}");
        $depmin = $mi->format('i');

        $deptime = Carbon::createFromFormat('Y-m-d H:i:s', '2005-12-05 ' . $dephour . ':' . $depmin . ':00');

        $durht = $xml->api_params->stehour;
        $dho = new DateTime("@{$durht}");
        $durhour = $dho->format('H');

        $durmt = $xml->api_params->stemin;
        $dmi = new DateTime("@{$durmt}");
        $durmin = $dmi->format('i');

        $duration = Carbon::createFromFormat('H:i:s', $durhour . ':' . $durmin . ':00');

        $deptemp = Carbon::createFromFormat('Y-m-d H:i:s', '2005-12-05 ' . $dephour . ':' . $depmin . ':00');

        $arrmin = $deptemp->addMinutes($duration->minute);

        $arrhour = $deptemp->addHours($duration->hour);

        $arrtime = $deptemp;

        $this->updateBooking($deptime, $duration, $arrtime);

        return view('user.ops.briefing', [
            'xml' => $xml,
        ]);
    }
}
