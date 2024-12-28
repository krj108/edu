<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Subjects\App\Http\Controllers\SubjectController;
use Modules\Subjects\App\Http\Controllers\StudyTermController;

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

Route::prefix('subjects')->middleware(['auth:sanctum', 'role:Admin'])->group(function () {
    Route::get('/', [SubjectController::class, 'index']);
    Route::post('/', [SubjectController::class, 'store']);
    Route::put('/{subject}', [SubjectController::class, 'update']);
    Route::delete('/{subject}', [SubjectController::class, 'destroy']);
});


Route::prefix('study-terms')->middleware(['auth:sanctum', 'role:Admin'])->group(function () {
    Route::get('/', [StudyTermController::class, 'index']);
    Route::post('/', [StudyTermController::class, 'store']);
    Route::put('/{study_term}', [StudyTermController::class, 'update']);
    Route::delete('/{study_term}', [StudyTermController::class, 'destroy']);
});
