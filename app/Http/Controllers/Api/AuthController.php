<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        $user = User::where('company_id', $company->id)
            ->where('email', $request->email)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }

        $token = $user->createToken('mobile')->plainTextToken;

        return response()->json([
            'message' => 'Login exitoso',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'company' => [
                    'code' => $company->code,
                    'name' => $company->name,
                    'primary_color' => $company->primary_color,
                ]
            ],
        ]);
    }


    /**
     * Register multi-empresa
     */

    public function register(Request $request)
    {
        $request->validate([
            'company_code' => 'required|string|exists:companies,code',
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $company = Company::where('code', $request->company_code)->first();

        // opcional: email único por empresa (si lo necesitas)
        $exists = User::where('company_id', $company->id)->where('email', $request->email)->exists();
        if ($exists) {
            return response()->json(['message' => 'El email ya existe en esta empresa'], 422);
        }

        $user = User::create([
            'company_id' => $company->id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('mobile')->plainTextToken;

        return response()->json([
            'message' => 'Registro exitoso',
            'token' => $token,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'company' => [
                    'code' => $company->code,
                    'name' => $company->name,
                    'primary_color' => $company->primary_color,
                ]
            ],
        ], 201);
    }

    /**
     * Logout multi-empresa
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sesión cerrada correctamente'
        ]);
    }
}
