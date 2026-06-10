<?php

use App\Http\Controllers\Api\DestinationController;
use App\Http\Controllers\Api\SeedController;
use Illuminate\Support\Facades\Route;

Route::get('/destinations', [DestinationController::class, 'index']);
Route::get('/destinations/{destination}', [DestinationController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/seed', [SeedController::class, 'store']);
});
