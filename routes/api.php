<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')
    ->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')
    ->post('/logout-all', [AuthController::class, 'logoutAll']);

Route::middleware('auth:sanctum')
    ->name('api.')
    ->group(function () {

        Route::apiResource('tasks', TaskController::class);
    });
