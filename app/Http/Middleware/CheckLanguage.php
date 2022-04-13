<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

use Closure;

class CheckLanguage
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
        // return $next($request);

        if (Session::has('language')) {
           if (App::getLocale()!= Session::get('language')) {
                App::setLocale(Session::get('language'));
           }
         }else {
            Session::put('language', 'es');
            App::setLocale('es');
        }
         return $next($request);
    }
}
