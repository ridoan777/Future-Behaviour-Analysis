<?php

use App\Http\Controllers\Admin\Sidebar\Certificates\ApiCertificateController;
use App\Http\Controllers\Api\Progress\{ApiProgressTrackerController};
use Illuminate\Support\Facades\Route;


// ----------------- PROGRESS & RESULTS (REUSING OLD CODE) -----------------
Route::prefix('progress')->middleware(['auth:sanctum'])->group(function () {

   Route::get('/{tierID}/{userID}/{courseID}/get-result', [ApiProgressTrackerController::class, 'getResults'])->name('api_progress_result');
});
// ----------------- PROGRESS & RESULTS (REUSING OLD CODE) -----------------


// ----------------- PROGRESS -----------------
Route::prefix('progress')->middleware(['auth:sanctum'])->group(function () {
   Route::get('/{tierId}/{courseId}/course-lessons', [ApiProgressTrackerController::class, 'allLessonProgress']);

   Route::get('/all-quiz-results', [ApiProgressTrackerController::class, 'allQuizProgress']);

   Route::get('/{tierId}/{courseId}/course-results', [ApiProgressTrackerController::class, 'courseQuizProgress']);
});
// ----------------- PROGRESS -----------------


// ----------------- BADGES -----------------
Route::prefix('progress')->middleware(['auth:sanctum'])->group(function () {

   Route::get('/all-courses', [ApiProgressTrackerController::class, 'allCourseProgress']);
   Route::get('/badges/index', [ApiProgressTrackerController::class, 'badgeIndex']);
});
// ----------------- BADGES -----------------


// ----------------- CERTIFICATE -----------------
Route::prefix('result')->middleware(['auth:sanctum'])->group(function () {

   Route::get('/{tierID}/{courseID}/certificate/generate', [ApiCertificateController::class, 'makeCertificate']);
});
// ----------------- CERTIFICATE -----------------