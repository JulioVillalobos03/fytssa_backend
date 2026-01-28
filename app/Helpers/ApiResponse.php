<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    /**
     * Respuesta exitosa
     */
    public static function success(string $code, $data = null, int $status = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'code' => $code,
            'data' => $data,
        ], $status);
    }

    /**
     * Respuesta de error
     */
    public static function error(string $code, $errors = null, int $status = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'code' => $code,
            'errors' => $errors,
        ], $status);
    }
}
