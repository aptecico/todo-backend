<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next):Response
    {
        $response = $next($request);

        // Set the necessary headers for CORS
        $response->headers->set('Access-Control-Allow-Origin', '*'); // Permitir desde cualquier origen, o especificar un dominio
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT,PATCH, DELETE, OPTIONS'); // Métodos permitidos
        $response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization, X-Requested-With, Application'); // Cabeceras permitidas

        // Permitir solicitudes OPTIONS antes de una solicitud real (preflight)
        if ($request->getMethod() === 'OPTIONS') {
            $response->setStatusCode(200);
        }

        return $response;
    }
}
