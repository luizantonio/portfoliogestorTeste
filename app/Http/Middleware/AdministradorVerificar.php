<?php

namespace App\Http\Middleware;

use Closure;

class AdministradorVerificar
{
	/*
    |--------------------------------------------------------------------------
    | Middleware AdministradorVerificar			04/08/2017 14:30
    |--------------------------------------------------------------------------
    |
    | Este Middleware � usado para a autentica��o e controle de rotas do Admin
    | usadas para a cria��o , registro e administra��o de usu�rios.
    |
    */

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
		//var_dump($request->user());

		//if (! $request->user()->hasRole($role)) {
            // Redirect...
        //}
		
        return $next($request);
    }
}
