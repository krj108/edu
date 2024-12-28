<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Lessons\App\Http\Controllers\LessonController;
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



Route::middleware(['auth:sanctum', 'role:Admin|Teacher'])->group(function () {
  //  Route::get('/lessons', [LessonController::class, 'index']);
    Route::post('/lessons', [LessonController::class, 'store']);
    Route::delete('/lessons/{lesson}', [LessonController::class, 'destroy']);
    Route::put('/lessons/{lesson}', [LessonController::class, 'update'])->name('lessons.update');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/lessons', [LessonController::class, 'index']);
});