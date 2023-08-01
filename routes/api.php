<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ExpenseController;

Route::middleware('auth:sanctum')->group(function () {
    
    Route::apiResource('expenses', ExpenseController::class);
    Route::get('/users', [UserController::class, 'index']);
    Route::put('/users', [UserController::class, 'update']);
    Route::delete('/users', [UserController::class, 'destroy']);
});
Route::post('users', [UserController::class, 'store']);