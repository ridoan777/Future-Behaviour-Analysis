<?php

use App\Http\Controllers\Admin\Sidebar\{AboutUsController,ContactUsController, CoursePageController,HomepageController};
use Illuminate\Support\Facades\Route;

# this route will only contain 2nd parent or chiildren (the invisible contents of sidebar) of admin dashboard. The main or visible parents are stored at backend.php

// ------------ SIDEBAR-HOMEPAGE ------------
Route::prefix('admin')->middleware(['auth:web'])->group(function () {

	Route::get('/webpages/homepage/head', [HomepageController::class, 'homepageHead'])->name('backend.webpages_homepage_head');
	Route::get('/webpages/homepage/process', [HomepageController::class, 'homepageProcess'])->name('backend.webpages_homepage_process');
	Route::get('/webpages/homepage/what-sets-us-apart', [HomepageController::class, 'homepageInfoIcons'])->name('backend.webpages_homepage_info_icons');
	Route::get('/webpages/homepage/course-cards', [HomepageController::class, 'homepageCourseCards'])->name('backend.webpages_homepage_course_cards');
	Route::get('/webpages/homepage/starrer', [HomepageController::class, 'homepageStarrer'])->name('backend.webpages_homepage_starrer');
	Route::get('/webpages/homepage/feedback', [HomepageController::class, 'homepageFeedback'])->name('backend.webpages_homepage_feedback');
	Route::get('/webpages/homepage/mission', [HomepageController::class, 'homepageMission'])->name('backend.webpages_homepage_mission');

	Route::post('/webpages/homepage/store', [HomepageController::class, 'homepageStore'])->name('backend.webpages_homepage_store');
});
// ------------ SIDEBAR-HOMEPAGE ------------


// ------------ SIDEBAR-ABOUT-US ------------

Route::prefix('admin')->middleware(['auth:web'])->group(function () {

	Route::get('/webpages/about_us', [AboutUsController::class, 'index'])->name('backend_webpages_about_us_program_info');

	Route::post('/webpages/about_us/store', [AboutUsController::class, 'aboutUsStore'])->name('backend_webpages_about_us_store');
});
// ------------ SIDEBAR-ABOUT-US ------------


// ------------ SIDEBAR-CONTACT ------------

Route::prefix('admin')->middleware(['auth:web'])->group(function () {

	Route::get('/webpages/contact', [ContactUsController::class, 'index'])->name('backend_webpages_contact');

	Route::post('/webpages/contact/store', [ContactUsController::class, 'contactUsViewStore'])->name('backend_webpages_contact_store');
});
// ------------ SIDEBAR-CONTACT ------------


// ------------ COURSE-PAGE ------------

Route::prefix('admin')->middleware(['auth:web'])->group(function () {

	Route::get('/webpages/course-page/index', [CoursePageController::class, 'index'])->name('backend_webpages_coursepage');

	Route::post('/webpages/course-page/store', [CoursePageController::class, 'store'])->name('backend_webpages_coursepage_store');
});
// ------------ COURSE-PAGE ------------


// ------------ COMMON-CONTENTS ------------
# The routes for common contents are stored in routes\Admin\backend.php
// ------------ COMMON-CONTENTS ------------



