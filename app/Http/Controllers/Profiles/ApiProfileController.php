<?php

namespace App\Http\Controllers\Profiles;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Storage, Validator, Hash, Notification, Auth, DB, Log, Redirect};
use App\Helpers\{ApiJsonReturnHelper, ExceptionHandling, FileManagement, ImageManagement};
use App\Http\Requests\Profiles\ApiProfileUpdateRequest;
use App\Models\{User, UserVerification};
use App\Notifications\SendOTPNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Exception;
use Throwable;

class ApiProfileController extends Controller
{
	private int $OTP_EXPIRY_DURATION = 15; // in minutes

	public function myProfile(Request $request)
	{
		try {
			$USER = $request->user();

			return ApiJsonReturnHelper::handle(true, 200, "User data have been fetched sucessfully!", $USER);
		} catch (Throwable $e) {
			return ExceptionHandling::handle('fetching user data', $e);
		}
	}

	public function store(ApiProfileUpdateRequest $request)
	{
		try {
			$user = $request->user();
			// dd($request->all());
			$DISK_FOLDER = config('filesystems.default');
			$validated = $request->validated();

			// ------------------- PASSWORD CHANGE -------------------
			if ($request->filled('password') || $request->filled('password_confirmation')) {
				$pwdValidator = Validator::make($request->only('password', 'password_confirmation'), [
					'password' => ['required', 'string', 'min:8', 'confirmed'],
				]);

				if ($pwdValidator->fails()) {
					return ApiJsonReturnHelper::handle(false, 422, 'Validation error.', null);
				}

				if (!Hash::check($request->current_password, $user->password)) {
					return ApiJsonReturnHelper::handle(false, 422, 'Current password is incorrect.', null);
				}

				$user->password = Hash::make($request->input('password'));
			}
			// ------------------- PASSWORD CHANGE -------------------

			// ------------------- IMAGE HANDLING -------------------
			$imageFields = [
				'avatar' => 'user-avatars',
			];

			foreach ($imageFields as $field => $IMAGE_FOLDER) {
				$oldPath = $user->{$field};
				$newPath = $oldPath;
				$REMOVE_FILE = $request->boolean("remove_{$field}");

				if ($request->hasFile($field) || $REMOVE_FILE) {
					$result = FileManagement::handleFile(
						$REMOVE_FILE ? null : $request->file($field),
						($field !== 'avatar' ? $field : null) . "-[" . ($user->id) . ']-' . ($validated['first_name'] ?? $user->first_name),
						$oldPath,
						$IMAGE_FOLDER,
						$DISK_FOLDER,
						$REMOVE_FILE
					);
					$newPath = $result['path'] ?? null;
				}
				$user->{$field} = $newPath;
			}

			// ------------------- IMAGE HANDLING -------------------

			$user->fill([
				'first_name' => $validated['first_name'] ?? $user->first_name,
				'last_name' => $validated['last_name'] ?? $user->last_name,
				'phone' => $validated['phone'] ?? $user->phone,
			]);

			$user->save();

			// ------------------- EMAIL UPDATE + SEND OTP -------------------
			$emailChanged = isset($validated['email']) && $validated['email'] !== $user->email;

			if ($emailChanged) {
				$existingUser = User::where('email', $validated['email'])->where('id', '!=', $user->id)->first();

				if ($existingUser) {
					return ApiJsonReturnHelper::handle(false, 422, 'This email is already taken.', null);
				}
			}

			if ($emailChanged) {
				$newEmail = $validated['email'];

				// Delete any existing email change verification
				UserVerification::where('user_id', $user->id)->where('type', 'email_change')->delete();

				$otp = UserVerification::generateOTP();

				UserVerification::create([
					'user_id' => $user->id,
					'type' => 'email_change',
					'otp' => $otp,
					'new_value' => $newEmail,
					'expires_at' => now()->addMinutes(10),
				]);

				// Send OTP to the NEW email using Notification facade
				Notification::route('mail', $newEmail)->notify(new SendOTPNotification($otp, 'email_verification', $this->OTP_EXPIRY_DURATION));
			}
			// ------------------- EMAIL UPDATE + SEND OTP -------------------

			$user->avatar_url = $user->avatar ? Storage::url($user->avatar) : null;

			$MESSAGE = $emailChanged ? 'Profile updated. Please verify your new email using the OTP sent to ' . $validated['email']
				: 'Profile updated successfully.';

			return ApiJsonReturnHelper::handle(true, 200, $MESSAGE, [
				'user' => $user,
				'email_verification_required' => $emailChanged,
			]);
		} catch (Throwable $e) {
			return ExceptionHandling::handle('updating profile', $e);
		}
	}


	public function userProfileDelete(Request $request)
	{
		$request->validate([
			'password' => 'required|string',
		]);

		$name = '';
		$user = $request->user();
		$DISK_FOLDER = config('filesystems.default');

		if (!$user || strtolower($user->user_role) === 'admin') {
			return ApiJsonReturnHelper::handle(false, 401, 'Unauthorized! The user does not exist or does not have permission to perform this action from here.', null);
		}

		if (!Hash::check($request->password, $user->password)) {
			return ApiJsonReturnHelper::handle(false, 401, 'Password confirmation failed.', null);
		}

		try {
			DB::beginTransaction();

			$name = $user->name;

			if ($user->avatar) {
				ImageManagement::deleteFile($user->avatar, $DISK_FOLDER);
			}

			$user->tokens()->delete(); // removes API tokens

			$user->delete();

			DB::commit();

			return ApiJsonReturnHelper::handle(true, 200, "The account of {$name} and associated avatar have been deleted successfully.", null);
		} catch (Exception $e) {
			DB::rollBack();
			return ExceptionHandling::handle('deleting account.', $e);
		}
	}

	// ----------------- UPDATE EMAIL ------------------
	public function verifyOtp(Request $request)
	{
		try {
			$validated = $request->validate([
				'otp' => 'required|string',
			]);

			$user = $request->user();

			// Find the verification record
			$verification = UserVerification::where('user_id', $user->id)
				->where('type', 'email_change')
				->where('otp', $validated['otp'])
				->first();

			if (!$verification) {
				return ApiJsonReturnHelper::handle(false, 422, 'Invalid OTP.', null);
			}

			if ($verification->isExpired()) {
				return ApiJsonReturnHelper::handle(false, 409, 'Invalid OTP.', null);
			}

			// Check if the new email is still available
			$newEmail = $verification->new_value;
			$existingUser = User::where('email', $newEmail)->where('id', '!=', $user->id)->first();

			if ($existingUser) {
				$verification->delete();
				return ApiJsonReturnHelper::handle(false, 422, 'This email is no longer available.', null);
			}

			// Update user's email
			$user->update([
				'email' => $newEmail,
				'email_verified_at' => now(),
			]);

			// Delete the verification record
			$verification->delete();

			return ApiJsonReturnHelper::handle(true, 200, 'Email updated successfully', null);
		} catch (Throwable $e) {
			return ExceptionHandling::handle('updating email.', $e);
		}
	}


	public function resendUpdateOTP(Request $request)
	{
		// dd($request->all());
		try {
			$validated = $request->validate([
				'honeypot' => 'nullable|string|in:',
				'email' => 'required|email|exists:users,email',
				'type' => 'required|in:email_change',
			], [
				'honeypot.in' => 'Bot attack prevention activated! Wait for a while!',
			]);

			$userInUser = $request->user();
			$userInVerification = UserVerification::where('user_id', $userInUser->id)->where('type', $validated['type'])->first();

			// ------------- OTP Spam Handling ------------- 
			// if ($userInVerification && $userInVerification->created_at->diffInSeconds(now()) < 60) {
			// 	return ApiJsonReturnHelper::handle(false, 429, 'Please wait a minute before requesting a new OTP.', null);
			// }
			// ------------- OTP Spam Handling ------------- 

			// Generate new OTP
			$otp = UserVerification::generateOTP();

			$userInVerification->update([
				'user_id' => $userInUser->id,
				'type' => $validated['type'],
				'otp' => $otp,
				'expires_at' => Carbon::now()->addMinutes(10),
			]);
			$update = $userInVerification;

			Notification::route('mail', $userInVerification->new_value)->notify(new SendOTPNotification($otp, $validated['type'], $this->OTP_EXPIRY_DURATION));

			return ApiJsonReturnHelper::handle(true, 200, 'OTP sent successfully.', $update);
		} catch (Throwable $e) {
			return ExceptionHandling::handle('sending update email OTP', $e);
		}
	}

}
