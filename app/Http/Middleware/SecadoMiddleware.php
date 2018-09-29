<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SecadoMiddleware
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
        if(Auth::user()->area->descripcion == 'administrador' || Auth::user()->area->descripcion == 'secado' || Auth::user()->area->descripcion == 'gerencia'){
            return $next($request);
        }

        return redirect('/');
    }
}
