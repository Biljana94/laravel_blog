<?php

namespace App\Http\Middleware;

use Closure;

class CheckAge
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
        if($request->age < 18)
        {
            return response(view('register.forbidden-under-18')); //ako korisnik ima manje od 18 godina, vracamo mu stranicu iz foldera register, fajl forbidden-under-18.blade.php
        }

        return $next($request);
    }
}
