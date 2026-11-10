<?php

use App\Http\Controllers\Admin\BackendController;
use App\Http\Controllers\Admin\CommonContents\CommonController;
use App\Http\Controllers\Admin\Sidebar\ContactUsController;
use Illuminate\Support\Facades\Route;

# this route will only contain 1st parent (or, visible contents) of admin dashboard. For nested or children, they should have separate controllers and route files

Route::middleware(['auth:web'])->group(function () {

	Route::get('/test', function () {
		return view('test'); })->name('test');
	Route::get('/preline', function () {
		return view('preline'); });
	Route::post('/test', [BackendController::class, 'index'])->name('backend.index');
});


// ------------ SIDEBAR::FORMS ------------

Route::prefix('admin')->middleware(['auth:web'])->group(function () {

	// -------- NESWLETTER ------------
	Route::get('/forms/newsletter', [CommonController::class, 'newsletterFormData'])->name('backend.forms_newsletter');

	Route::get('/forms/newsletter/{mail}/edit', [CommonController::class, 'newsletterEdit'])->name('backend_forms_newsletter_edit');

	Route::delete('/forms/newsletter/{mail}/delete', [CommonController::class, 'newsletterDelete'])->name('backend_forms_newsletter_delete');

	Route::post('/forms/newsletters/table', [CommonController::class, 'newsletterTableData'])->name('backend.dataTable_newsletters');
	/* The newsletter post route is placed at 'routes\Frontend\Webpages\api.webpage.php'
		-------- NESWLETTER ------------ */


	// -------- CONTACT_US ------------
	Route::get('/forms/contact-us', [ContactUsController::class, 'contactUsFormData'])->name('backend_forms_contact_us');

	Route::get('/forms/contact-us/{contact}/edit', [ContactUsController::class, 'contactUsEdit'])->name('backend_forms_contact_us_edit');

	Route::delete('/forms/contact-us/{contact}/delete', [ContactUsController::class, 'contactUsDelete'])->name('backend_forms_contact_us_delete');

	Route::post('/forms/contact-us/table', [ContactUsController::class, 'contactUsTableData'])->name('backend.dataTable_contact_us');

	Route::delete('/forms/contact-us/table/{id}/delete', [ContactUsController::class, 'contactUsFormDelete'])->name('backend.dataTable_contact_us_delete');
	/* The contact post route is placed at 'routes\Frontend\Webpages\api.webpage.php'
		 -------- CONTACT_US ------------ */
});
// ------------ SIDEBAR::FORMS ------------



// ------------ SIDEBAR::USERS ------------

Route::prefix('admin')->middleware(['auth:web'])->group(function () {
	
	Route::get('/components', [BackendController::class, 'components'])->name('backend.components');

	Route::get('/all-users', [BackendController::class, 'all_users'])->name('backend_all_user');
	Route::get('/blacklisted-users', [BackendController::class, 'indexBlackList'])->name('backend_user_blacklist');

	Route::post('/user/{id}/blacklist', [BackendController::class, 'blacklistUserToggle'])
    ->name('backend_user_blacklist_store');

	Route::post('/user/{id}/delete', [BackendController::class, 'deleteUser'])->name('backend_user_delete');

	Route::post('/all-users/table', [BackendController::class, 'all_users_dataTable'])
	->name('backend_dataTable_all_users'); // datatable ajax

	Route::post('/blacklisted-users/table', [BackendController::class, 'blacklisted_users_dataTable'])
	->name('backend_dataTable_blacklisted_users'); // datatable ajax
});

// ------------ SIDEBAR::USERS ------------



// ------------ COMMON CONTENTS ------------

Route::prefix('admin')->middleware(['auth:web'])->group(function () {

	Route::get('/common-section/banner', [CommonController::class, 'banner'])->name('backend.common_section_banner');
	Route::get('/common-section/faq', [CommonController::class, 'faq'])->name('backend.common_section_faq');
	Route::get('/common-section/newsletter', [CommonController::class, 'newsletter'])->name('backend.common_section_newsletter');
	Route::get('/common-section/footer', [CommonController::class, 'footer'])->name('backend.common_section_footer');
	Route::get('/common-section/privacy-conditions', [CommonController::class, 'policyConditions'])->name('backend.common_section_privacy_conditions');


	Route::post('/common-section/store', [CommonController::class, 'commonSectionStore'])->name('backend.common_section_store');

	Route::delete('/common-section/{commonSection}delete', [CommonController::class, 'commonSectionDelete'])->name('backend.common_section_delete');
});

// ------------ COMMON CONTENTS ------------

