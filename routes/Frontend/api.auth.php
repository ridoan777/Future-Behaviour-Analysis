<?php

use App\Http\Controllers\Api\Auth\ApiAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// this route file is registered at bootstrap/app.php under api array

// Route::post('/register', [ApiAuthController::class, 'register'])->middleware('throttle:5,1');
// Route::post('/login', [ApiAuthController::class, 'login'])->name('api.login')->middleware('throttle:5,1');
// Route::post('/logout', [ApiAuthController::class, 'logout'])->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {
   // Public routes
   Route::post('/register', [ApiAuthController::class, 'register'])->middleware('throttle:5,1');
   Route::post('/verify-email', [ApiAuthController::class, 'verifyEmail'])->middleware('throttle:5,1');
   Route::post('/resend-otp', [ApiAuthController::class, 'resendOTP'])->middleware('throttle:3,1');

   Route::post('/login', [ApiAuthController::class, 'login'])->middleware('throttle:5,1');

   Route::post('/forgot-password', [ApiAuthController::class, 'forgotPassword'])->middleware('throttle:3,1');
   Route::post('/verify-password-reset-otp', [ApiAuthController::class, 'verifyPasswordResetOTP'])->middleware('throttle:5,1');
   Route::post('/reset-password', [ApiAuthController::class, 'resetPassword'])->middleware('throttle:5,1');

   // Protected routes
   Route::post('/logout', [ApiAuthController::class, 'logout'])->middleware('auth:sanctum');
});