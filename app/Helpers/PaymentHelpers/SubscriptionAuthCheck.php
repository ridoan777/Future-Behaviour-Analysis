<?php

namespace App\Helpers\PaymentHelpers;

use App\Helpers\ExceptionHandling;
use App\Models\Subscription\SubscribedUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SubscriptionAuthCheck
{
	// --------------------------------------
	public static function validityGate(int $userId, int $tierId, int $courseId)
	{
		// user must be logged in
		if (!Auth::check()) {
			ExceptionHandling::bailout(401, "Aborting! You must be logged in to access this feature.");
		}

		// user must be subscriber
		$getSubscribedUser = SubscribedUser::userId($userId)->tierId($tierId)->courseId($courseId)->latest()->first();

		if (!$getSubscribedUser) {
			ExceptionHandling::bailout(401, "Aborting! You must subscribe/purchase this course to access this feature.");
		}
		
		// user must have subscription validity
		if ($getSubscribedUser->duration === 'lifetime') {
			$expiryDate = now()->addYears(100);
		} else {
			$expiryDate = Carbon::parse($getSubscribedUser->created_at)->addDays((int) $getSubscribedUser->duration);
		}

		if (now()->greaterThan($expiryDate)) {
			ExceptionHandling::bailout(403, "Your subscription has expired. Please renew to continue accessing this course.");
		}
		return null;
	}

	// --------------------------------------

}
