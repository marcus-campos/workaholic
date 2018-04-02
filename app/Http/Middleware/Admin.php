<?php

namespace App\Http\Middleware;

use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        if(!auth()->user()->role == 'admin') {
            throw new \Exception("Somente administradores tem acesso a esta função.");
        }
        return $next($request);
    }
}
