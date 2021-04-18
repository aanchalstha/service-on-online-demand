<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\User;
class AdminMiddleware
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
        $customerData = User::where('id', Auth::user()->id)->get()->first();

        if (Auth::user()->usertype=='admin') {
            # code...
        return $next($request);

        }

        else {

            return redirect('/customer')->with('message', 'Welcome to Service on Online Demand.');

    }


    }

}
