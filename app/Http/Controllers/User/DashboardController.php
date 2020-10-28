<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Use Facades Required Additionally
 *
 */

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
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
     * Redirect user to dashboard domain when authenticated.
     *
     */
    public function confirmAuthentication() {
        return redirect()->route('dashboard');
    }

    /**
     * Show the application's dashboard.
     *
     */
    public function index() {
        return view('main.user.dashboard');
    }
}
