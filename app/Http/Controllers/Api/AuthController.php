<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Login multi-empresa
     */
    public function login(Request $request)
    {
        $request->validate([
            'company_code' => 'required|string|exists:companies,code',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $company = Company::where('code', $request->company_code)->first();

        $user = User::where('email', $request->email)
            ->where('company_id', $company->id)
            ->first();

        if (!$user || !Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return response()->json([
                'message' => 'Credenciales incorrectas'
            ], 401);
        }

        return response()->json([
            'message' => 'Login exitoso',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'company' => [
                    'code' => $company->code,
                    'name' => $company->name,
                    'primary_color' => $company->primary_color,
                ]
            ]
        ]);
    }
}
