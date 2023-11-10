<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class auth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if(auth()->guest())
        {
              return redirect('/login')->withErrors([  
                  'email'=> 'vous devez vous connecter pour voir cette page'
              ]);
        }
        return $next($request);
    }
}
