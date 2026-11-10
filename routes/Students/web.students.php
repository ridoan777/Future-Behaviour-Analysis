<?php

use App\Http\Controllers\Profiles\ApiProfileController;
use Illuminate\Support\Facades\Route;

// this route file is registered at bootstrap/app.php under api array

// -----------------  -----------------
Route::middleware(['auth:sanctum'])->group(function () {

   Route::get('/user/my-profile', [ApiProfileController::class, 'myProfile']);

});
// -----------------  -----------------
