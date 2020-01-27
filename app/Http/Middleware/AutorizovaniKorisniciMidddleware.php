<?php

namespace App\Http\Middleware;

use Closure;

class AutorizovaniKorisniciMidddleware
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
        if($request->session()->has('korisnik'))
        {
            return redirect('/');
        }

        return $next($request);
    }
}
