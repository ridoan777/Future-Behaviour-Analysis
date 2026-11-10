<?php

namespace App\Helpers;

use App\Models\Subscription\SubscribedUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ExceptionHandling;
use Throwable;

class SubscriptionAuthCheck
{
	public static function isUserSubscriber($USER_ID)
	{
		$subscription = SubscribedUser::userId($USER_ID)->exists();

		if (!$subscription) {
			ExceptionHandling::bailout(403, "Aborting! You must be a subscriber or purchase this course to access it");
		}
		return true;
	}
	// --------------------------------------
	
	public static function validityGate($tierId, $courseId)
	{
		if (!Auth::check()) {
			ExceptionHandling::bailout(401, "Aborting! You must be logged in to access this feature");
		}

		$userId = Auth::id();

		// ------------ Must have at least one subscription record ------------
		$subscription = SubscribedUser::userId($userId)->tierId((int)$tierId)->courseId((int)$courseId)->latest()->first();

		if (!$subscription) {
			ExceptionHandling::bailout(403, "Aborting! You must be a subscriber or purchase this course to access it");
		}
		//------------ Must have an active, paid subscription ------------
		if ((int)$subscription->status !== 1 || !in_array(strtolower($subscription->status_note), ['sub_renewed', 'paid'], true)) {
			ExceptionHandling::bailout(500, "Your payment is still pending or inactive. Please complete payment to access this course");
		}

		//------------ Lifetime access → always valid ------------
		if (strtolower($subscription->duration) === 'lifetime') {
			return null;
		}

		//------------ Compute validity based on `valid_until` ------------
		$validUntil = $subscription->valid_until ? Carbon::parse($subscription->valid_until) : null;

		if (!$validUntil) {
			// Defensive fallback (should not happen)
			ExceptionHandling::bailout(500, "Subscription validity could not be determined. Please contact support.");
		}

		//------------ Check expiry ------------
		if (now()->greaterThan($validUntil)) {
			$subscription->update([
				'status' => 0,
				'status_note' => 'expired'
			]);

			ExceptionHandling::bailout(403, "Your subscription has expired. Please renew to continue accessing this course.");
		}

		return null;
	}

}
