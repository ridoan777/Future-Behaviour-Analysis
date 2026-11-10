<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\FrontendController;
use App\Http\Controllers\Profiles\WebProfileController;
use Illuminate\Support\Facades\Route;

// ----------------- BREEZE -----------------
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [WebProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [WebProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [WebProfileController::class, 'destroy'])->name('profile.destroy');
});
// ----------------- BREEZE -----------------



// ----------------- FRONT-END (IN DASHBOARD) -----------------
Route::get('/frontend', [FrontendController::class, 'index'])->name('web.frontend');
// ----------------- FRONT-END (IN DASHBOARD) -----------------


require __DIR__.'/Admin/auth.php';
