<?php

use App\Http\Controllers\Api\Students\ApiStudentController;
use App\Http\Controllers\Api\Webpage\ApiWebpageController;
use Illuminate\Support\Facades\Route;

// this route file is registered at bootstrap/app.php under api array

// ----------------- FRONT-END:WEBPAGES -----------------
// Route::middleware(['auth:sanctum'])->group(function () {
Route::group([], function () {

   Route::get('/webpages/homepage', [ApiWebpageController::class, 'homepage'])->name('api.frontend_webpage_homepage');
   Route::get('/webpages/aboutUs', [ApiWebpageController::class, 'aboutUs'])->name('api.frontend_webpage_about_us');
   Route::get('/webpages/contactUs', [ApiWebpageController::class, 'contactUs'])->name('api.frontend_webpage_contact_us');

   Route::post('/webpages/forms/contactus/store', [ApiWebpageController::class, 'contactUsFormStore'])->name('api.contact_us_store');

});

// ----------------- FRONT-END:WEBPAGES -----------------


// ----------------- FRONT-END:STUDENT DASHBOARD -----------------
Route::middleware(['auth:sanctum'])->group(function () {

   Route::get('/webpages/student/{id}', [ApiStudentController::class, 'index'])->name('api_frontend_webpage_student_index');

});

// ----------------- FRONT-END:STUDENT DASHBOARD -----------------



// ----------------- FRONT-END:COURSE PAGE -----------------
Route::group([], function () {

   Route::get('/webpages/course_page/index', [ApiWebpageController::class, 'coursePage']);
});
// ----------------- FRONT-END:COURSE PAGE -----------------


// ----------------- FRONT-END:COMMON SECTIONS -----------------
Route::group([], function () {

   Route::get('/webpages/common/banners', [ApiWebpageController::class, 'banner'])->name('api.frontend_webpage_common_banner');

   Route::get('/webpages/common/faqs', [ApiWebpageController::class, 'faq'])->name('api.frontend_webpage_common_faq');

   Route::get('/webpages/common/forms/newsletter', [ApiWebpageController::class, 'newsletter'])->name('api.newsletter');
   Route::post('/webpages/common/forms/newsletter/store', [ApiWebpageController::class, 'newsletterStore'])->name('api.newsletter_store');

   Route::get('/webpages/common/footer', [ApiWebpageController::class, 'footer'])->name('api.frontend_webpage_common_footer');

   Route::get('/webpages/common/policy-condition', [ApiWebpageController::class, 'policyCondition']);

});
// ----------------- FRONT-END:COMMON SECTIONS -----------------
