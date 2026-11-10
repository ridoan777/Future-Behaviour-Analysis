<?php

namespace App\Models\Certificates;

use App\Models\Courses\Course;
use App\Models\Subscription\SubscriptionTier;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class CertificateFinal extends Model
{
	protected $fillable = [
		'tier_id',
		'user_id',
		'course_id',

		'header_top',
		'header_middle',
		'header_bottom',

		'applicant_name',
		'applicant_bacb_id',

		'training_start',
		'training_end',
		'training_time',

		'trainer_name',
		'trainer_certification',
		'assist_trainer_name',
		'agency_name',

		'trainer_signature',
		'watermark',

		'footer',
	];

	protected function casts(): array
	{
		return [
			'tier_id' => 'integer',
			'user_id' => 'integer',
			'course_id' => 'integer',
			'status' => 'integer',
		];
	}

	// ----------------- RELATIONSHIPS -----------------
	public function certRelatingBackTo_User()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function certRelatingBackTo_Course()
	{
		return $this->belongsTo(Course::class, 'course_id');
	}

	public function certRelatingBackTo_Tier()
	{
		return $this->belongsTo(SubscriptionTier::class, 'tier_id');
	}
	// ----------------- RELATIONSHIPS -----------------


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
