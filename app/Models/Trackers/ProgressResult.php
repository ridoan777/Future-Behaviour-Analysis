<?php

namespace App\Models\Trackers;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ProgressResult extends Model
{
	protected $fillable = [
		'cert_id',

		'tier_id',
		'user_id',
		'course_id',

		'course_title',
		'grade',

		'name',
		'email',
		'complete_date',

		'status',
	];

	public function progressResultRelationWith_user()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function progressResultRelationWith_gamification()
	{
		return $this->hasOne(Gamification::class, 'user_id', 'user_id')
			->where(function ($query) {
				$query->whereColumn('gamifications.course_id', 'progress_results.course_id');
			});
	}



}

