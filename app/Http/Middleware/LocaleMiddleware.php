<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        //si la sesion tiene la variable lang
        if(session()->has('lang')) {
            //actualizar locale con la variable lang de la sesion
            App::setLocale(session()->get('lang'));
        }

                
        //dejar continuar la peticion
        return $next($request);
    }

    
}
