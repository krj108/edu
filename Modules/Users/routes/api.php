<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\App\Http\Controllers\AuthController;
use Modules\Users\App\Http\Controllers\AdminController;
use Modules\Users\App\Http\Controllers\TeacherController;

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
});


Route::prefix('admin')->middleware(['auth:sanctum'])->group(function () {

    Route::post('/create', [AdminController::class, 'store'])
        ->middleware('role:Super Admin');

    Route::middleware('role:Super Admin|Admin')->group(function () {
        Route::get('/', [AdminController::class, 'index']);
        Route::get('/{admin}', [AdminController::class, 'show']);
        Route::put('/profile/{admin}', [AdminController::class, 'updateAdmin']);
    });

   
    Route::delete('/{admin}', [AdminController::class, 'destroy'])
        ->middleware('role:Super Admin');
});



Route::prefix('teachers')->middleware('auth:sanctum')->group(function () {
    Route::get('/', [TeacherController::class, 'index'])->middleware('role:Admin|Teacher');
    Route::post('/', [TeacherController::class, 'store'])->middleware('role:Admin');
    Route::put('/{teacher}', [TeacherController::class, 'update'])->middleware('role:Admin');
    Route::delete('/{teacher}', [TeacherController::class, 'destroy'])->middleware('role:Admin');
});
