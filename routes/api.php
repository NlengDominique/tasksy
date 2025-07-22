<?php


use Illuminate\Support\Facades\Route;

//Routes protegees
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
    Route::get('/profile', [\App\Http\Controllers\Api\ProfileController::class,'getUserProfile']);
    Route::patch('/profile', [\App\Http\Controllers\Api\ProfileController::class,'update']);
    Route::post('/tasks', [\App\Http\Controllers\Api\TaskController::class,'store']);
});

//Routes publiques
Route::post('/signup', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/signin', [\App\Http\Controllers\Api\AuthController::class, 'login']);

