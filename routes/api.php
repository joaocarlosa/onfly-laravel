<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\ExpenseController;

Route::apiResource('users/new', UserController::class);

Route::middleware('auth:sanctum')->group(function () {    
    Route::get('users/me', [UserController::class, 'show']);

    Route::apiResource('expense', ExpenseController::class);
});