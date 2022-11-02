<?php

use App\Http\Controllers\ApptSlotController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->prefix('user')->group(function () {
    Route::get('/auth', [AuthController::class, 'showAuthUser']);
});

Route::prefix('course')->group(function () {
    Route::get('/index', [CourseController::class, 'index']);
    Route::post('/new', [CourseController::class, 'new']);
    Route::post('/update', [CourseController::class, 'update']);
    Route::post('/delete', [CourseController::class, 'delete']);
});

Route::prefix('appt-slot')->group(function () {
    Route::get('/index/{courseId?}', [ApptSlotController::class, 'index']);
    Route::post('/new', [ApptSlotController::class, 'new']);
    Route::post('/update', [ApptSlotController::class, 'update']);
    Route::post('/delete', [ApptSlotController::class, 'delete']);
    Route::post('/reserve', [ApptSlotController::class, 'reserve']);
});
