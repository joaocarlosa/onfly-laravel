<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;

Route::apiResource('users', UserController::class);

//Route::apiResource('users', UserController::class)->middleware('auth:sanctum');
//Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', function (Request $request)  {
        return $request->user();
    });
});
