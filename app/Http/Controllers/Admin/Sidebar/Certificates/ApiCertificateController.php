<?php
// namespace App\Http\Controllers\Api\Progress;
namespace App\Http\Controllers\Admin\Sidebar\Certificates;


use App\Helpers\{ApiJsonReturnHelper, CertificateGenerate, ExceptionHandling, GamificationHelper, ProgressLessonHelper, SubscriptionAuthCheck};
use App\Http\Controllers\Controller;
use App\Models\Certificates\{CertificateFinal,CertificateMeta};
use App\Models\Courses\Course;
use App\Models\Trackers\{ProgressLesson,ProgressQuiz};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Throwable;

class ApiCertificateController extends Controller
{
	public function makeCertificate(Request $request, $tierId, $courseId)
	{
		try {
			$USER = $request->user();

			$courseStatus = ProgressLessonHelper::checkCourseFinish($USER->id, $tierId, $courseId);

			if (!$courseStatus['is_course_completed']) {
				ExceptionHandling::bailout(409, "You must complete the course to generate the certificate!");
			}

			$quizzes = ProgressQuiz::userId($USER->id)->courseId($courseId)->get();
			$certMetadata = CertificateMeta::first();

			$course = Course::findOrFail($courseId);

			// ----------------------- EXISTING -----------------------
			$existingCert = CertificateFinal::tierId($tierId)->userId($USER->id)->courseId($courseId)->first() ?? null;

			// ----------------------- EXISTING -----------------------

			// ----------------------- TIMELINE -----------------------
			$firstAct = ProgressLesson::userId($USER->id)->tierId($tierId)->first();
			$lastAct = ProgressQuiz::userId($USER->id)->courseId($courseId)->latest()->first();

			if ($firstAct && $lastAct) {
				$start = Carbon::parse($firstAct->created_at);
				$end = Carbon::parse($lastAct->updated_at);

				$days = $start->diffInDays($end);
				$hours = $start->diffInHours($end);
			}
			// ----------------------- TIMELINE -----------------------

			// ----------------------- ID -----------------------
			$coursePrefix = strtoupper(substr(Str::slug($course->title, ''), 0, 4));
			$year = now()->year;
			$initials = strtoupper(substr($USER->first_name, 0, 1) . substr($USER->last_name, 0, 1));
			$random = strtoupper(Str::random(7));

			$certId = $existingCert ? $existingCert?->applicant_bacb_id : "{$coursePrefix}-{$year}-{$initials}{$random}";
			// ----------------------- ID -----------------------

			// ----------------------- PARTICIPANT -----------------------
			$fullName = ($USER->last_name ?? null) . ", " . ($USER->first_name ?? null);
			// ----------------------- PARTICIPANT -----------------------

			// ----------------------- CERT PAGE -----------------------
			$total_modules = $course?->courseRelationWith_modules?->count();
			$total_lessons = $course?->courseRelationWith_modules?->flatMap->moduleRelationWith_lessons->count();
			$total_quizzes = $course?->courseRelationWith_ProgressQuiz?->count();
			// ----------------------- CERT PAGE -----------------------

			$certificate = [
				'course_status' => $courseStatus,
				'certificate_data' => [
					'cert_id' => $certId ?? "N/A",
					'starting_date' => $firstAct->created_at ?? "N/A",
					'ending_date' => $lastAct->updated_at ?? "N/A",
					'total_completion_day' => $days ?? "N/A",
					'total_completion_hour' => $hours ?? "N/A",
				],
				'participant' => [
					'name' => $fullName ?? "N/A",
					'email' => $USER->email ?? "N/A",
					'avatar' => $USER->avatar_url ?? "N/A",
				],
				'summary' => [
					'total_modules' => $total_modules ?? "N/A",
					'total_lessons' => $total_lessons ?? "N/A",
					'total_quizzes' => $total_quizzes ?? "N/A",
				],
				'quiz_status' => $quizzes,
				'metadata' => $certMetadata,
				'course_details' => $course->withoutRelations(),
			];

			$generated = self::saveCertificate($tierId, $courseId, $USER->id, $fullName, $certificate);

			return ApiJsonReturnHelper::handle(true, 200, "Course certificate have been fetched sucessfully!", $certificate);

		} catch (Throwable $e) {
			return ExceptionHandling::handle('fetching users', $e);
		}
	}
	// ---------------------------------------

	public static function saveCertificate(int $tierId, int $courseId, int $userId, $fullName, $certificate)
	{
		return CertificateFinal::updateOrCreate(
			[
				'user_id' => $userId,
				'tier_id' => $tierId,
				'course_id' => $courseId,
			],
			[
				'applicant_bacb_id' => $certificate['certificate_data']['cert_id'] ?? "N/A",
				'header_top' => $certificate['metadata']['header_top'] ?? "N/A",
				'header_middle' => $certificate['metadata']['header_middle'] ?? "N/A",
				'header_bottom' => $certificate['metadata']['header_bottom'] ?? "N/A",

				'applicant_name' => $fullName,

				'training_start' => $certificate['certificate_data']['starting_date'] ?? "N/A",
				'training_end' => $certificate['certificate_data']['ending_date'] ?? "N/A",
				'training_time' => $certificate['certificate_data']['total_completion_day'] ?? "N/A",

				'trainer_name' => $certificate['metadata']['trainer_name'] ?? "N/A",
				'trainer_certification' => $certificate['metadata']['trainer_certification'] ?? "N/A",
				'assist_trainer_name' => $certificate['metadata']['assist_trainer_name'] ?? "N/A",
				'agency_name' => $certificate['metadata']['agency_name'] ?? "N/A",

				'trainer_signature' => $certificate['metadata']['trainer_signature'] ?? "N/A",
				'watermark' => $certificate['metadata']['watermark'] ?? "N/A",

				'footer' => $certificate['metadata']['footer'] ?? "N/A",
			]
		);
	}
}