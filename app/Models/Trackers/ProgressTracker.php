<?php

namespace App\Models\Trackers;

use App\Models\Courses\{Course,CourseModule,CourseLesson};
use App\Models\Subscription\SubscriptionTier;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ProgressTracker extends Model
{
	protected $fillable = [
		'tier_id',
		'user_id',
		'course_id',
		'module_id',
		'lesson_id',
		'this_lesson_done',
		'last_quiz_pass',
		'course_finish',

		'status',
	];

	public function progressRelatingBackTo_tiers()
	{
		return $this->belongsTo(SubscriptionTier::class, 'tier_id');
	}

	public function progressRelatingBackTo_user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function progressRelatingBackTo_course()
	{
		return $this->belongsTo(Course::class, 'course_id');
	}

	public function progressRelatingBackTo_module()
	{
		return $this->belongsTo(CourseModule::class, 'module_id');
	}

	public function progressRelatingBackTo_lesson()
	{
		return $this->belongsTo(CourseLesson::class, 'lesson_id');
	}
}

