<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use App\Models\Company;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;

class JwtMiddleware
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
        // Pre-Middleware Action
        if (!$request->header('Authorization')) {
            return response()->json([
                'error' => 'Se requiere el token'
            ], 401);
        }

        $array_token = explode(' ', $request->header('Authorization'));
        if (count($array_token) < 2) {
            return response()->json([
                'error' => 'Formato de token inválido'
            ], 401);
        }
        
        $token = $array_token[1];

        try {
            $credentials = JWT::decode($token, new Key(env('JWT_SECRET'), 'HS256'));
        } catch (ExpiredException $e) {
            return response()->json([
                'error' => 'El token ha expirado'
            ], 400);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'Algo ha ocurrido al decodificar el token'
            ], 400);
        }

        // Asumimos que el 'sub' es el ID de la empresa
        $company = Company::find($credentials->sub);
        if (!$company) {
            return response()->json([
                'error' => 'Empresa no encontrada'
            ], 404);
        }

        // Agregar 'auth' al objeto request
        $request->attributes->set('auth', $company);
        

        return $next($request);
    }
}

