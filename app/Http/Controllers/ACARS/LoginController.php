<?php

namespace App\Http\Controllers\ACARS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Use Facades Required Additionally
 *
 */
use Illuminate\Http\Response;
use App\Models\User;
use App\Models\Booking;
use App\Models\Schedule;
use App\Models\Aircraft;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Validate and send response to x-track for login request.
     *
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', request('username'))->first();

        if (! $user || ! Hash::check(request('password'), $user->password)) {
            return response([
                'message' => 'Invalid Credentials.',
            ], 401);
        }

        $token = $user->createToken('x-track')->plainTextToken;

        $response = [
            'token' => $token,
        ];

        return response($response, 200);
    }

    /**
     * Validate and send response to x-track for logout request.
     *
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        $response = [
            'message' => 'Logged Out.',
        ];

        return response($response, 200);
    }

    /**
     * Send authenticated user details via sanctum token.
     *
     */
    public function user()
    {
        $user = auth()->user();

        return response($user, 200);
    }

    /**
     * Send authenticated user details including current booking via sanctum token.
     *
     */
    public function dashboard()
    {
        $user = auth()->user();

        $validate = Booking::where('user_id', $user->id)->first();

        $booking = null;
        $schedule = null;
        $aircraft = null;

        if ($validate != null) {
            $booking = Booking::where('user_id', $user->id)->first();
            $schedule = Schedule::find($booking->schedule_id);
            $aircraft = Aircraft::find($booking->aircraft_id);
        }

        return response(
            [$user, $booking, $schedule, $aircraft],
            200
        );
    }
}
