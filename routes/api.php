<?php

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

Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);

Route::get('/experiences/search/{keyword}', [App\Http\Controllers\ExperienceController::class, 'search']);
Route::get('/experiences/{experience}', [App\Http\Controllers\ExperienceController::class, 'show']);
Route::get('/experiences', [App\Http\Controllers\ExperienceController::class, 'index']);

Route::get('/educations/search/{keyword}', [App\Http\Controllers\EducationController::class, 'search']);
Route::get('/educations/{education}', [App\Http\Controllers\EducationController::class, 'show']);
Route::get('/educations', [App\Http\Controllers\EducationController::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/experiences', [App\Http\Controllers\ExperienceController::class, 'store']);
    Route::put('/experiences/{experience}', [App\Http\Controllers\ExperienceController::class, 'update']);
    Route::delete('/experiences/{experience}', [App\Http\Controllers\ExperienceController::class, 'destroy']);

    Route::post('/educations', [App\Http\Controllers\EducationController::class, 'store']);
    Route::put('/educations/{education}', [App\Http\Controllers\EducationController::class, 'update']);
    Route::delete('/educations/{education}', [App\Http\Controllers\EducationController::class, 'destroy']);

    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);

});

