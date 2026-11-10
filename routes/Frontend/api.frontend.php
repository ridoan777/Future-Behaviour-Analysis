<?php

use App\Http\Controllers\Api\FrontendController;
use App\Http\Controllers\Api\Progress\ProgressTrackerController;
use App\Http\Controllers\Api\Webpage\ApiWebpageController;
use Illuminate\Support\Facades\Route;

// this route file is registered at bootstrap/app.php under api array

// ----------------- FRONT-END TEST PAGE -----------------
Route::get('/frontend', [FrontendController::class, 'index'])->name('api.frontend')->middleware('auth:sanctum');
// ----------------- FRONT-END TEST PAGE -----------------


// ----------------- GAMIFICATION-BADGE -----------------
Route::prefix('badge')->middleware(['auth:sanctum'])->group(function () {

   Route::get('/{tierID}/{courseID}/{userID}/get-badge', [ApiWebpageController::class, 'getQuiz'])->name('api_course_quiz');

   Route::post('/{tierID}/{courseID}/{moduleID}/submit-answer', [ApiWebpageController::class, 'submitQuizAnswer'])->name('api_quiz_submit_answer');

   Route::post('/{tierID}/{courseID}/{moduleID}/finish-quiz', [ApiWebpageController::class, 'finishQuiz'])->name('api_quiz_finish');

});
// ----------------- GAMIFICATION-BADGE -----------------





