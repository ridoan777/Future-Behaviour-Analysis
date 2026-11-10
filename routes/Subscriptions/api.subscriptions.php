<?php

use App\Http\Controllers\Subscription\{TransactionsController,ApiSubscriptionController,StripeWebhookController};
use Illuminate\Support\Facades\Route;

// ----------------- SUBSCRIPTION -----------------
Route::prefix('subscription')->group(function () {

   Route::get('/all-tiers/index', [ApiSubscriptionController::class, 'pricingTierApi']);

   Route::post('/payment/checkout', [TransactionsController::class, 'createCheckoutSession'])->middleware(['auth:sanctum']);

   Route::get('/payment/success', [TransactionsController::class, 'successApi'])->name('api_payment_success');

   Route::get('/payment/cancel', [TransactionsController::class, 'cancelApi'])->name('api_payment_cancel');

   Route::post('/cancellation', [TransactionsController::class, 'cancelSubscription'])->name('api_subcription_cancel');
});
// ----------------- SUBSCRIPTION -----------------


// ----------------- SUBSCRIBERS -----------------
Route::middleware(['auth:sanctum'])->group(function (){

   Route::get('subscribtions/index', [ApiSubscriptionController::class, 'index']);

   Route::get('subscribtions/{subscribtion}/show', [ApiSubscriptionController::class, 'show']);

});
// ----------------- SUBSCRIBERS -----------------

Route::post('/fba/stripe/webhook', [StripeWebhookController::class, 'handleWebhook'])->name('stripe.webhook');