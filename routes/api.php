<?php

use App\Http\Controllers\CourseController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('course')->group(function () {
    Route::get('/index', [CourseController::class, 'index']);
    // Route::post('/new', [CourseController::class, 'new']);
    // Route::post('/update', [CourseController::class, 'update']);
    // Route::post('/delete', [CourseController::class, 'delete']);
});
