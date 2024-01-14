<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\SupportController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// 1|8F0blcCMaxDWa5IUUEYdjGyqxrp7sYFkiFpJ4WZQ240f7462
Route::post('/login', [AuthController::class, 'auth']);

Route::middleware(['auth:sanctum'])->group(function() {
    Route::apiResource('/supports', SupportController::class);
});

// Route::apiResource('/supports', SupportController::class);
