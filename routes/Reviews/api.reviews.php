<?php

use App\Http\Controllers\Api\Reviews\ApiReviewsController;
use Illuminate\Support\Facades\Route;

// ----------------- COURSE REVIEW -----------------
Route::prefix('course')->middleware(['auth:sanctum'])->group(function () {

   Route::post('/review/store', [ApiReviewsController::class, 'store']);
   Route::delete('/review/{review}/delete', [ApiReviewsController::class, 'delete']);
});

Route::prefix('public')->group(function () {

   Route::get('/reviews/index', [ApiReviewsController::class, 'indexAll']);
   Route::get('/course/{course}/reviews/index', [ApiReviewsController::class, 'indexCourse']);
   Route::get('/review/{review}/show', [ApiReviewsController::class, 'show']);

});

// ----------------- COURSE REVIEW -----------------
