<?php

namespace App\Http\Middleware;

use Closure;

class User
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
        if (auth()->check()) {
            if(auth()->user()->role == 'user') {
                auth()->logout();
                return redirect('auth/login')->withErrors(['Eiii, você ainda não tem acesso esta página, se você está participando de um processo seletivo para se tornar um freelancer, aguarde até ser ativado.']);
            }
        }

        return $next($request);
    }
}
