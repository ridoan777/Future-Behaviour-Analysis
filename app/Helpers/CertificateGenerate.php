<?php

namespace App\Helpers;

use App\Models\Certificates\{CertificateFinal, CertificateMeta};
use App\Models\Courses\{Course, CourseModule};
use App\Models\Quizzes\QuizAnswers;
use App\Models\Subscription\{SubscribedUser, SubscriptionTier};
use App\Models\Trackers\ProgressResult;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/* Usage:


*/
class CertificateGenerate
{
	// --------------------------------------
	// public static function certificateGenerate($progressTracker)
	public static function certificateGenerate($progressTracker)
	{
		// dd($progressTracker);
		$tier = SubscriptionTier::findOrFail($progressTracker->tier_id);
		$user = User::findOrFail($progressTracker->user_id);
		$course = Course::findOrFail($progressTracker->course_id);
		$subscriber = SubscribedUser::where('user_id', $progressTracker->user_id)->where('course_id', $progressTracker->course_id)->get()->first();

		// /* ---------- Prevent Users from getting duplicate certificate ----------
		$alreadyHasCertificate = ProgressResult::where('tier_id', $tier->id)
			->where('user_id', $user->id)
			->where('course_id', $course->id)
			->whereNotNull('cert_id')
			->exists();

		if ($alreadyHasCertificate) {
			return response()->json([
				'message' => 'You already have a certificate for this course. For any issue, contact support.',
				'already_has_certificate' => true,
			], 200);
		}
		// ---------- Prevent Users from getting duplicate certificate ---------- */

		$userData = [
			'name' => $user->first_name . " " . $user->last_name,
			'email' => $user->email,
		];

		$courseData = [
			'title' => $course->title,
			'modules' => (int)$course->total_modules,
			'lessons' => (int)$course->total_lessons,
			'video_length' => round((float)$course->total_video_length, 1),
			'completed_at' => $progressTracker->updated_at
		];

		// ------------- Generate Certificate ID -------------
		$coursePrefix = strtoupper(substr(Str::slug($course->title, ''), 0, 4)); // remove spaces/symbols
		$year = now()->year;
		$initials = strtoupper(substr($user->first_name, 0, 1) . substr($user->last_name, 0, 1));
		$random = strtoupper(Str::random(7));

		$certId = "{$coursePrefix}-{$year}-{$initials}{$random}";
		// ------------- Generate Certificate ID -------------


		// ------------- Result Generate -------------
		$quizIds = CourseModule::where('course_id', $course->id)->whereNotNull('quiz_id')->pluck('quiz_id')->unique()->toArray();

		if (empty($quizIds)) {
			return [
				'grade_percentage' => 0,
				'correct_answers' => 0,
				'attempted' => 0,
				'message' => 'No quizzes found for this course.'
			];
		}

		$answers = QuizAnswers::where('user_id', $user->id)->whereIn('quiz_id', $quizIds)
			->select(DB::raw('SUM(is_correct = 1) as correct_answers'), DB::raw('COUNT(*) as attempted'))
			->first();

		$correct = (int)($answers->correct_answers ?? 0);
		$attempted = (int)($answers->attempted ?? 0);
		$grade = $attempted > 0 ? round(($correct / $attempted) * 100, 2) : 0;
		// ------------- Result Generate -------------

		$progressResult = ProgressResult::updateOrCreate(
			[
				'user_id' => $user->id,
				'course_id' => $course->id,
				'tier_id' => $subscriber->tier_id ?? null,
			],
			[
				'cert_id' => $certId,
				'course_title' => $course->title,
				'grade' => $grade,

				'name' => trim($user->first_name . ' ' . $user->last_name),
				'email' => $user->email,
				'complete_date' => now(),
				'status' => 1,
			]
		);

		// ----------- Generate CertificateFinal -----------
		$meta = CertificateMeta::first();

		if ($meta) {
			$startTime = Carbon::parse($progressResult->created_at)->timezone('Asia/Dhaka');
			$endTime = Carbon::now('Asia/Dhaka');
			$totalHours = round(abs($endTime->diffInMinutes($startTime)) / 60, 1);

			CertificateFinal::updateOrCreate(
				[
					'tier_id' => $tier->id,
					'user_id' => $user->id,
					'course_id' => $course->id,
					'applicant_bacb_id' => $certId ?? null,
				],
				[
					'header_top' => $meta->header_top,
					'header_middle' => $meta->header_middle,
					'header_bottom' => $meta->header_bottom,

					'applicant_name' => trim($user->first_name . ' ' . $user->last_name),

					'training_start' => $startTime,
					'training_end' => $endTime,
					'training_time' => $totalHours,

					'trainer_name' => $meta->trainer_name,
					'trainer_certification' => $meta->trainer_certification,
					'assist_trainer_name' => $meta->assist_trainer_name,
					'agency_name' => $meta->agency_name,

					'trainer_signature' => $meta->trainer_signature,
					'watermark' => $meta->watermark,

					'footer' => $meta->footer,
				]
			);
		}
		// ----------- Generate CertificateFinal -----------

		return [
			'certificate' => [
				'cert_id' => $progressResult->cert_id,
				'complete_date' => $progressResult->complete_date,
			],
			'user' => [
				'name' => trim($user->first_name . ' ' . $user->last_name),
				'email' => $user->email,
			],
			'course' => [
				'title' => $course->title,
				'modules' => (int)$course->total_modules,
				'lessons' => (int)$course->total_lessons,
				'video_length' => round((float)$course->total_video_length, 1),
				'completed_at' => $progressTracker->updated_at,
			],
		];
	}

	// --------------------------------------

}
