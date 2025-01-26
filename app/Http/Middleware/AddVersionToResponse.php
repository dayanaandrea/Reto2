<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddVersionToResponse
{
    public function handle(Request $request, Closure $next)
    {
        // Procesar la solicitud
        $response = $next($request);

        // Agregar información de versión a la respuesta
        if ($response->headers->get('Content-Type') === 'application/json') {
            $content = $response->getContent();
            $data = json_decode($content, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $data['version'] = '2.0';
                $response->setContent(json_encode($data));
            }
        }

        return $response;
    }
}

