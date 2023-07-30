<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;

//Route::apiResource('users', UserController::class)->middleware('auth:sanctum');
//Route::post('/login', [UserController::class, 'login']);

// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/me', function (Request $request) {
//         return $request->user();
//     });
// });


Route::apiResource('users/new', UserController::class);

Route::middleware('auth:sanctum')->group(function () {    
    Route::get('users/me', [UserController::class, 'show']);
});
#Route::get('/me', [UserController::class, 'show']);