<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use App\Employee;

class AuthTokenEmployeeMiddleware
{
    public function handle($request, Closure $next)
    {
        // Vérifie si la route nécessite une authentification d'employé
        if ($request->is('employee/*')) {
            $apiToken = $request->session()->get('api_token');
    
        // Affiche la valeur de l'api_token
            // Récupère le token de la session
            $sessionToken = $apiToken ;
            // Vérifie si le token de session correspond à l'api_token de l'employé dans la base de données
            $employee = Employee::where('api_token', $sessionToken)->first();

            if (!$employee) {
                return redirect('/error404');
            }

            // Si l'employé est authentifié, passez à la prochaine étape de la requête
            return $next($request);
        }

        // Si la route ne nécessite pas d'authentification d'employé, passez simplement à la prochaine étape de la requête
        return $next($request);
    }
}