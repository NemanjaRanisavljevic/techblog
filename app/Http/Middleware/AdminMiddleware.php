<?php

namespace App\Http\Middleware;

use Closure;

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
        if(!$request->session()->has('korisnik'))
        {
            \Log::warning("Pokusaj upada na server korisnika koji nije prijavljen sa adrese " .$request->ip());
            return redirect('/');
        }

        $korisnik = $request->session()->get('korisnik');

        if($korisnik->naziv !="Admin" && $korisnik->naziv !="Moderator"){
            \Log::warning("Korisnik je pokusao da pristupi Admin panelu sa ip adresom " .$request->ip());
            return redirect('/');
        }

        return $next($request);
    }
}
