<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Classes\App\Http\Controllers\RoomController;
use Modules\Classes\App\Http\Controllers\ClassController;

/*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
*/

Route::prefix('classes')->middleware(['auth:sanctum', 'role:Admin'])->group(function () {
    Route::get('/', [ClassController::class, 'index']);
    Route::post('/', [ClassController::class, 'store']);
    Route::put('/{class}', [ClassController::class, 'update'])->name('classes.update');
    Route::delete('/{class}', [ClassController::class, 'destroy']);
});

Route::prefix('rooms')->middleware(['auth:sanctum', 'role:Admin'])->group(function () {
    Route::get('/', [RoomController::class, 'index']);
    Route::post('/', [RoomController::class, 'store']);
    Route::put('/{room}', [RoomController::class, 'update']);
    Route::delete('/{room}', [RoomController::class, 'destroy']);
});