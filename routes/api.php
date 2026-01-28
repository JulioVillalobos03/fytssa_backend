<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/companies', [CompanyController::class, "index"]);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/profile/me', [ProfileController::class, 'me']);
    Route::post('/profile/me', [ProfileController::class, 'updateMe']);
});


