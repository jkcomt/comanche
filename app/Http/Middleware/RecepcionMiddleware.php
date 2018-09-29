<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RecepcionMiddleware
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
        if(Auth::user()->area->descripcion == 'administrador' || Auth::user()->area->descripcion == 'recepcion' ||  Auth::user()->area->descripcion == 'gerencia'){
            return $next($request);
        }

        return redirect('/');

    }
}
