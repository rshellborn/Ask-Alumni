<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AccessReports
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->email != 'rachel@shellborn.com' && Auth::user()->email != 'mfisli2@gmail.com') {
            return redirect('/home');
        }

        return $next($request);
    }
}
