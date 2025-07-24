<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Services\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/status', function () {
        return ApiResponse::success('API is running');
    });

    // Route::apiResource('clients', ClientController::class);
    Route::prefix('clients')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->middleware('ability:clients:list');
        Route::post('/', [ClientController::class, 'store']);
        Route::get('/{client}', [ClientController::class, 'show'])->middleware('ability:clients:detail');
        Route::put('/{client}', [ClientController::class, 'update']);
        Route::delete('/{client}', [ClientController::class, 'delete']);
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/login', [AuthController::class, 'login']);
