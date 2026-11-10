<?php

use App\Http\Controllers\Api\Students\ApiStudentController;
use Illuminate\Support\Facades\Route;

// this route file is registered at bootstrap/app.php under api array

// -----------------  -----------------
Route::middleware(['auth:sanctum'])->group(function () {

   Route::get('/student/my-dashboard/index', [ApiStudentController::class, 'index']);

});
// -----------------  -----------------
