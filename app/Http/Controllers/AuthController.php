<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Firebase\JWT\JWT;
use Laravel\Lumen\Routing\Controller as BaseController;

class AuthController extends BaseController
{
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function jwt(Company $company)
    {
        $payload = [
            "iss" => "api-estadias-jwt",
            "sub" => $company->id,
            "iat" => time(),
            "exp" => time() + 60 * 60
        ];
        return JWT::encode($payload, env('JWT_SECRET'), 'HS256');
    }

    public function authenticate()
    {
        $this->validate($this->request, [
            'mail' => 'required|email',
            'password' => 'required'
        ]);

        $company = Company::where('mail', $this->request->input('mail'))->first();
        if (!$company) {
            return response()->json([
                'error' => 'El correo no existe'
            ], 400);
        }

        if ($this->request->input('password') === $company->password) {
            return response()->json([
                'token' => $this->jwt($company)
            ], 200);
        }

        return response()->json([
            'error' => 'El correo o la contraseña son incorrectos'
        ], 400);
    }
}

