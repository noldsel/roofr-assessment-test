<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('parking-spot/{parking_spot}/park', [App\Http\Controllers\ParkingSpotController::class, 'park'])->name('park');
Route::post('parking-spot/{parking_spot}/unpark', [App\Http\Controllers\ParkingSpotController::class, 'unpark'])->name('unpark');
Route::get('parking-lot', [App\Http\Controllers\ParkingSpotController::class, 'list'])->name('list');
