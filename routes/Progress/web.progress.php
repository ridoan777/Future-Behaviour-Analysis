<?php

use App\Http\Controllers\Admin\Sidebar\Certificates\WebCertificateController;
use App\Http\Controllers\Admin\Sidebar\Progress\WebProgressController;
use Illuminate\Support\Facades\Route;

// ------------ CERTIFICATES ------------

Route::prefix('admin')->middleware(['auth:web'])->group(function () {

	Route::get('/certificates/make-certs', [WebCertificateController::class, 'create'])->name('backend_certs_create');

	Route::get('/certificates/all-certs', [WebCertificateController::class, 'index'])->name('backend_all_certs');

	Route::post('/certificates/meta/store', [WebCertificateController::class, 'store'])->name('backend_cert_meta_store');

	Route::delete('/certificates/{cert}/delete', [WebCertificateController::class, 'delete'])->name('backend_certs_users_delete');

	Route::post('/certificates/all-eligible-users/datatables', [WebCertificateController::class, 'certificate_holder_dataTable'])->name('backend_dataTable_cert_users');
});
// ------------ CERTIFICATES ------------


// ------------ PROGRESS ------------

Route::prefix('admin')->middleware(['auth:web'])->group(function () {
	Route::get('/progress/all-results', [WebProgressController::class, 'index'])->name('backend_all_results');

	Route::post('/progress/all-results/datatables', [WebProgressController::class, 'progressDataTable'])->name('backend_dataTable_all_results');
});
// ------------ PROGRESS ------------