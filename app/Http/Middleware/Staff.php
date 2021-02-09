<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Use Facades Required Additionally
 *
 */

use Illuminate\Support\Facades\Auth;

class Staff
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->staff != true) {

            $status = 'Unauthorized Access. Code #UA1' . rand(40, 49) . '.';

            return response()->view('layouts.status', compact('status'));
        }

        return $next($request);
    }
}
