<?php

namespace App\Models\Trackers;

use App\Models\Courses\Course;
use App\Models\Quizzes\Quiz;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ProgressQuiz extends Model
{
	protected $table = 'progress_quizzes';

	protected $fillable = [
		'user_id',
		'course_id',
		'quiz_id',

		'is_complete',	// 0/1 in integer
		'is_passed',	// 0/1 in integer

		'total_mark',
		'required_mark',

		'status',
	];

	protected function casts(): array
	{
		return [
			'user_id' => 'integer',
			'course_id' => 'integer',
			'quiz_id' => 'integer',
			'is_complete' => 'integer',
			'is_passed' => 'integer',
			'total_mark' => 'float',
			'required_mark' => 'float',
			'status' => 'integer',
		];
	}

	public function progressQuizRelatingBackTo_User()
	{
		return $this->belongsTo(User::class, 'user_id');
	}

	public function progressQuizRelatingBackTo_Course()
	{
		return $this->belongsTo(Course::class, 'course_id');
	}

	public function progressQuizRelatingBackTo_Quiz()
	{
		return $this->belongsTo(Quiz::class, 'quiz_id');
	}

	// ----------------- QUERY SCOPING -----------------
	public function scopeUserId($query, $user_id)
	{
		return $query->where('user_id', $user_id);
	}
	
	public function scopeCourseId($query, $course_id)
	{
		return $query->where('course_id', $course_id);
	}
	
	public function scopeQuizId($query, $quiz_id)
	{
		return $query->where('quiz_id', $quiz_id);
	}
	
	public function scopeIsComplete($query, $is_complete)
	{
		return $query->where('is_complete', $is_complete);
	}
	
	public function scopeIsPassed($query, $is_passed)
	{
		return $query->where('is_passed', $is_passed);
	}
	
	public function scopeTotalMark($query, $total_mark)
	{
		return $query->where('total_mark', $total_mark);
	}

	public function scopeStatus($query, $status)
	{
		return $query->where('status', $status);
	}
	// ----------------- QUERY SCOPING -----------------
}

