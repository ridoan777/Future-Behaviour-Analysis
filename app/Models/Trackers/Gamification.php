<?php

namespace App\Models\Trackers;

use App\Models\Courses\Course;
use App\Models\Subscription\SubscriptionTier;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Gamification extends Model
{
	protected $fillable = [
		'tier_id',
		'user_id',
		'course_id',

		'total_lessons',
		'completed_lessons',
		'progress',

		'current_badge',

		'status',
	];

	protected function casts(): array
	{
		return [
			'user_id' => 'integer',
			'tier_id' => 'integer',
			'course_id' => 'integer',
			'total_lessons' => 'integer',
			'completed_lessons' => 'integer',
			'status' => 'integer',
		];
	}

	public function course()
	{
		return $this->belongsTo(Course::class, 'course_id');
	}

	public function tier()
	{
		return $this->belongsTo(SubscriptionTier::class, 'tier_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class, 'user_id');
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

	public function scopeCourseId($query, $course_id)
	{
		return $query->where('course_id', $course_id);
	}

	public function scopeStatus($query, $status)
	{
		return $query->where('status', $status);
	}
	// ----------------- QUERY SCOPING -----------------
}

