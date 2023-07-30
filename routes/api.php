<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;



Route::apiResource('users', UserController::class);

//Route::apiResource('users', UserController::class)->middleware('auth:sanctum');
//Route::post('/login', [UserController::class, 'login']);


