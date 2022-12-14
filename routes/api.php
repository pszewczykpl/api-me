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

Route::get('/hobbies/search/{keyword}', [App\Http\Controllers\HobbyController::class, 'search']);
Route::get('/hobbies/{hobby}', [App\Http\Controllers\HobbyController::class, 'show']);
Route::get('/hobbies', [App\Http\Controllers\HobbyController::class, 'index']);

Route::get('/projects/search/{keyword}', [App\Http\Controllers\ProjectController::class, 'search']);
Route::get('/projects/{project}', [App\Http\Controllers\ProjectController::class, 'show']);
Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index']);

Route::get('/skills/{skill}', [App\Http\Controllers\SkillController::class, 'show']);
Route::get('/skills', [App\Http\Controllers\SkillController::class, 'index']);


Route::get('/about', [App\Http\Controllers\UserController::class, 'profile']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/experiences', [App\Http\Controllers\ExperienceController::class, 'store']);
    Route::put('/experiences/{experience}', [App\Http\Controllers\ExperienceController::class, 'update']);
    Route::delete('/experiences/{experience}', [App\Http\Controllers\ExperienceController::class, 'destroy']);

    Route::post('/educations', [App\Http\Controllers\EducationController::class, 'store']);
    Route::put('/educations/{education}', [App\Http\Controllers\EducationController::class, 'update']);
    Route::delete('/educations/{education}', [App\Http\Controllers\EducationController::class, 'destroy']);

    Route::post('/hobbies', [App\Http\Controllers\HobbyController::class, 'store']);
    Route::put('/hobbies/{hobby}', [App\Http\Controllers\HobbyController::class, 'update']);
    Route::delete('/hobbies/{hobby}', [App\Http\Controllers\HobbyController::class, 'destroy']);

    Route::post('/projects', [App\Http\Controllers\ProjectController::class, 'store']);
    Route::put('/projects/{project}', [App\Http\Controllers\ProjectController::class, 'update']);
    Route::delete('/projects/{project}', [App\Http\Controllers\ProjectController::class, 'destroy']);

    Route::post('/skills', [App\Http\Controllers\SkillController::class, 'store']);
    Route::put('/skills/{skill}', [App\Http\Controllers\SkillController::class, 'update']);
    Route::delete('/skills/{skill}', [App\Http\Controllers\SkillController::class, 'destroy']);


    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);

});

