<?php

namespace App\Http\Middleware;

use Closure;
use App\Admin;

class AuthTokenAdminMiddleware
{
    public function handle($request, Closure $next)
    {
        
        // Vérifie si la route nécessite une authentification d'administrateur
    if ($request->is('admin/*')) {

            $apiToken = $request->session()->get('api_token');
    
        // Affiche la valeur de l'api_token
            // Récupère le token de la session
            $sessionToken = $apiToken ;

            // Vérifie si le token de session correspond à l'api_token de l'administrateur dans la base de données
            $admin = Admin::where('api_token', $sessionToken)->first();

            if (!$admin) {
                return redirect('/error404');
            }

            // Si l'administrateur est authentifié, passez à la prochaine étape de la requête
            return $next($request);
        }

        // Si la route ne nécessite pas d'authentification d'administrateur, passez simplement à la prochaine étape de la requête
        return $next($request);
    }
}
