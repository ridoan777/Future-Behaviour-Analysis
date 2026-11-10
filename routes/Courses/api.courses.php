<?php

use App\Http\Controllers\Api\Courses\ApiCourseController;
use Illuminate\Support\Facades\Route;

// ----------------- COURSE LANDING -----------------
Route::prefix('course')->group(function () {

   Route::get('/index', [ApiCourseController::class, 'index']);
   Route::get('/my-courses/index', [ApiCourseController::class, 'allMyCourses'])->middleware(['auth:sanctum']);

   Route::get('/{courseId}/public/show', [ApiCourseController::class, 'showPublic']);
   Route::get('/{courseId}/private/private', [ApiCourseController::class, 'showPrivate'])->middleware(['auth:sanctum']);

   Route::get('/{tierId}/{courseId}/landing', [ApiCourseController::class, 'landing'])->middleware(['auth:sanctum']);

});
// ----------------- COURSE LANDING -----------------



// ----------------- COURSE NAVIGATION-----------------
Route::prefix('course')->middleware(['auth:sanctum'])->group(function () {

   Route::post('/navigation/{tierID}/{courseID}/{lessonID}/complete', [ApiCourseController::class, 'complete']);

   Route::get('/navigation/{tierID}/{courseID}/{moduleID}/{lessonID}/back', [ApiCourseController::class, 'previousCourseContent'])->name('api_course_navigation_back');

   Route::get('/navigation/{tierID}/{courseID}/{moduleID}/{lessonID}/next', [ApiCourseController::class, 'nextCourseContent'])->name('api_course_navigation_next');

   Route::get('/navigation/goto/{tierID}/{courseID}/{moduleID}/{lessonID}', [ApiCourseController::class, 'randomCourseContent'])->name('api_course_navigation_random');

});
// ----------------- COURSE NAVIGATION -----------------


// ----------------- COURSE NAVIGATION-----------------
Route::prefix('course')->middleware(['auth:sanctum'])->group(function () {

   Route::get('/{tierID}/{courseID}/check/course-ending', [ApiCourseController::class, 'finishCourse']);

});
// ----------------- COURSE NAVIGATION -----------------



// ----------------- QUIZ -----------------
Route::prefix('exam')->middleware(['auth:sanctum'])->group(function () {

   Route::get('/{tierID}/{courseID}/{moduleID}/get-quiz-with-answers', [ApiCourseController::class, 'getQuizWithAnswer'])->name('api_course_quiz_with_ans');

   Route::get('/{tierID}/{courseID}/{moduleID}/get-quiz', [ApiCourseController::class, 'getQuiz'])->name('api_course_quiz');

   Route::post('/{tierID}/{courseID}/{moduleID}/submit-answer', [ApiCourseController::class, 'submitQuizAnswer'])->name('api_quiz_submit_answer');

   Route::post('/{tierID}/{courseID}/{moduleID}/finish-quiz', [ApiCourseController::class, 'finishQuiz'])->name('api_quiz_finish');

});
// ----------------- QUIZ -----------------



// ----------------- COURSE STATISTICS -----------------
Route::prefix('statistics')->group(function () {

   Route::get('/course/{course}/index', [ApiCourseController::class, 'statistics']);

});
// ----------------- COURSE STATISTICS -----------------