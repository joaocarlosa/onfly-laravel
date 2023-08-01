<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ExpenseController;

#Route::post('users/new', [UserController::class, 'store']);
#Route::get('users/me', [UserController::class, 'show']);

Route::apiResource('users', UserController::class);
Route::apiResource('expense', ExpenseController::class);

Route::middleware('auth:sanctum')->group(function () {    
    //Route::get('users/me', [UserController::class, 'show']);

    
});