<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Barryvdh\Debugbar\Facade as Debugbar;
class Admin
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
        if (!Auth::check()){
            return redirect()->route('admin-login');
        }
        else{
            if (Auth::user()->admin == 1){
                return $next($request);
            }
            else{
                Auth::logout();
                return redirect()->route('admin-login');
            }
        }
    }
}
