<?php

namespace App\Models\Trackers;

use App\Models\Courses\{CourseLesson};
use App\Models\Subscription\SubscriptionTier;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ProgressLesson extends Model
{
	protected $table = 'progress_lessons';

	protected $fillable = [
		'user_id',
		'tier_id',
		'lesson_id',

		'is_complete',
		'time_taken',	// minutes in integer

		'status',
	];

	protected function casts(): array
	{
		return [
			'user_id' => 'integer',
			'tier_id' => 'integer',
			'lesson_id' => 'integer',
			'is_complete' => 'integer',
			'time_taken' => 'integer',
			'status' => 'integer',
		];
	}

	public function progressLessonRelatingBackTo_User()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function progressLessonRelatingBackTo_Tier()
	{
		return $this->belongsTo(SubscriptionTier::class, 'tier_id');
	}

	public function progressLessonRelatingBackTo_lesson()
	{
		return $this->belongsTo(CourseLesson::class, 'lesson_id');
	}

	// ----------------- QUERY SCOPING -----------------
	public function scopeUserId($query, $user_id)
	{
		return $query->where('user_id', $user_id);
	}
	
	public function scopeTierId($query, $tier_id)
	{
		return $query->where('tier_id', $tier_id);
	}
	
	public function scopeLessonId($query, $lesson_id)
	{
		return $query->where('lesson_id', $lesson_id);
	}
	
	public function scopeIsComplete($query, $is_complete)
	{
		return $query->where('is_complete', $is_complete);
	}

	public function scopeStatus($query, $status)
	{
		return $query->where('status', $status);
	}
	// ----------------- QUERY SCOPING -----------------
}

