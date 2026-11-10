<?php

namespace App\Helpers;

use App\Models\Courses\Course;
use App\Models\Subscription\SubscribedUser;
use App\Models\Trackers\Gamification;
use App\Models\Trackers\ProgressTracker;
use App\Models\User;
use Carbon\Carbon;

class CheckoutProcess
{
	// --------------------------------------
	public static function process($request)
	{
		dd("hello", $request->all());
		$validated = $request->validate([
			'id' => 'nullable|integer|exists:subscribed_users,id',
			'flag' => 'required|string|in:create,update',
			'status' => 'nullable|boolean|in:0,1',
			'user_id' => 'required|integer|exists:users,id',
			'tier_id' => 'required|integer|exists:subscription_tiers,id',
			'course_id' => 'required|integer|exists:courses,id',
			'paid_amount' => 'required|numeric|min:0',
			'duration' => 'required|string',
			'age_consent' => 'accepted',
			'education_consent' => 'accepted',
		]);
		$user = User::findOrFail($validated['user_id']);
		if ($user->status != 1) {
			return back()->with('error', 'You are blacklisted. Cannot subscribe.');
		}

		// Check for existing subscription
		$existingSub = SubscribedUser::where([
			'user_id' => $validated['user_id'],
			'tier_id' => $validated['tier_id'],
			'course_id' => $validated['course_id']
		])->latest()->first();

		if ($existingSub) {
			$expiryDate = null;

			if ($existingSub->duration === 'lifetime') {
				$expiryDate = now()->addYears(100); // Effectively never expires
			} else {
				// Add months from created_at date
				$expiryDate = Carbon::parse($existingSub->created_at)
					->addMonths((int) $existingSub->duration);
			}

			// Check if subscription is still valid
			if (now()->lessThan($expiryDate)) {
				return back()->with('error', 'You already have an active subscription for this course/tier. Valid until ' . $expiryDate->format('d M Y') . '.');
			}
		}

		return 'void';
	}
	// --------------------------------------
}
