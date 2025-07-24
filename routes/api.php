<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/status', function () {
    return response()->json(['status' => 'ok', 'message' => 'Server is running'], 200);
});

Route::post('/login', [AuthController::class, 'login']);

Route::apiResource('clients', ClientController::class);
