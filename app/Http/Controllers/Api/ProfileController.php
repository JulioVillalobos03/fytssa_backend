<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Obtener perfil del usuario
     */
    public function me(Request $request)
    {
        $user = $request->user();

        return ApiResponse::success('PROFILE_ME_SUCCESS', [
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar
                    ? url('storage/' . $user->avatar)
                    : null,
                'company' => [
                    'code' => $user->company->code,
                    'name' => $user->company->name,
                    'primary_color' => $user->company->primary_color,
                ],
            ]
        ]);
    }


    /**
     * Actualizar perfil del usuario
     */
    public function updateMe(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'avatar' => 'nullable|image|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return ApiResponse::success('PROFILE_UPDATE_ME_SUCCESS', [
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => $user->avatar
                    ? url('storage/' . $user->avatar)
                    : null,
            ]
        ]);
    }
}
