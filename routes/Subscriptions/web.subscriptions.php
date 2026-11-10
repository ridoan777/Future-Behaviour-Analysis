<?php

use App\Http\Controllers\Subscription\TransactionsController;
use App\Http\Controllers\Subscription\WebSubscriptionController;
use Illuminate\Support\Facades\Route;

// ------------------------ SIDEBAR TIERS ------------------------

Route::prefix('admin')->middleware(['auth:web'])->group(function () {

	Route::get('/webpages/transactions/pricing/index', [WebSubscriptionController::class, 'index'])->name('backend.webpages_transactions_pricing');

	Route::post('transactions/pricing/tier/store', [WebSubscriptionController::class, 'store'])->name('backend_transactions_tiers_store');

	Route::post('/subscription/set-keys', [WebSubscriptionController::class, 'storeStripeKeys'])->name('backend_subscriptions_keys_store');

	Route::get('/webpages/transactions/{singleTier}/show', [WebSubscriptionController::class, 'show'])->name('backend_transactions_payment_edit');

	Route::delete('/webpages/transactions/{singleTier}/delete', [WebSubscriptionController::class, 'delete'])->name('backend_transactions_payment_delete');
});
// ------------------------ SIDEBAR TIERS ------------------------

// ------------------------ SIDEBAR SUBSCRIBERS ------------------------
Route::prefix('admin')->middleware(['auth:web'])->group(function () {

	Route::get('/subscription/all-subscribers', [WebSubscriptionController::class, 'allSubscribers'])->name('backend_subscription_all_subscribers');

	Route::get('/subscription/single-subscribers/{id}', [WebSubscriptionController::class, 'singleSubscriber'])->name('backend_subscription_single_subscriber');

	Route::get('/subscription/{id}/delete', [WebSubscriptionController::class, 'subscriberDelete'])->name('backend_subscription_delete');

	Route::post('/all-subscribers/table', [WebSubscriptionController::class, 'all_subscribers_dataTable'])->name('backend_dataTable_all_subscribers');

});
// ------------------------ SIDEBAR SUBSCRIBERS ------------------------



// ------------ FRONTEND TEST-PURCHASE ------------
Route::prefix('admin')->middleware(['auth:web'])->group(function () {

	Route::get('public/webpages/transactions/frontend-test', [WebSubscriptionController::class, 'frontend'])->name('backend_webpages_transactions_frontend');

	Route::get('/public/webpages/transactions/{tier}/payment_confirmation', [WebSubscriptionController::class, 'paymentConfirm'])->name('backend_transactions_payment_confirm');

	Route::post('/webpages/transactions/checkout/{plan?}', [TransactionsController::class, 'checkout'])->name('backend_webpages_transactions_checkout');

	Route::get('checkout-success', [TransactionsController::class, 'success'])
		->name('backend_checkout_success');

	Route::get('checkout-cancel', [TransactionsController::class, 'cancel'])
		->name('backend_checkout_cancel');

});
// ------------ FRONTEND TEST-PURCHASE ------------