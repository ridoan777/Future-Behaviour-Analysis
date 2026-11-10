<?php

namespace App\Helpers;

use App\Models\Courses\Course;
use App\Models\Trackers\Gamification;
use App\Models\Trackers\ProgressTracker;

class GamificationHelper
{
	// --------------------------------------
	public static function badgeGenerate($tier_ID, $userId, $courseID)
	{
		// Fetch the course with all active modules and lessons
		$course = Course::with([
			'courseRelationWith_modules' => fn($q) => $q->where('status', 1)->orderBy('id'),
			'courseRelationWith_modules.moduleRelationWith_lessons' => fn($q) => $q->where('status', 1),
		])->find($courseID);

		if (!$course)
			return;

		// Fetch user progress
		$progress = ProgressTracker::where('user_id', $userId)
			->where('course_id', $courseID)
			->first();

		if (!$progress)
			return;

		// Get all modules sorted by ID (this determines the sequence)
		$allModules = $course->courseRelationWith_modules->sortBy('id')->values();

		$totalLessons = 0;
		$completedLessons = 0;
		$foundCurrentLesson = false;

		// Iterate through modules in order
		foreach ($allModules as $module) {
			$moduleLessons = $module->moduleRelationWith_lessons->sortBy('id')->values();

			foreach ($moduleLessons as $lesson) {
				$totalLessons++;

				// If we haven't found the current lesson yet, count this as completed
				if (!$foundCurrentLesson) {
					// Check if this is the user's current lesson
					if ($module->id == $progress->module_id && $lesson->id == $progress->lesson_id) {
						$completedLessons++; // Include current lesson as completed
						$foundCurrentLesson = true;
					}
					// If we're still in a previous module, count all lessons
					elseif ($module->id < $progress->module_id) {
						$completedLessons++;
					}
					// If we're in the current module but haven't reached current lesson yet
					elseif ($module->id == $progress->module_id && $lesson->id < $progress->lesson_id) {
						$completedLessons++;
					}
				}
			}
		}

		if ($totalLessons === 0)
			return;

		$progressPercent = round(($completedLessons / $totalLessons) * 100, 1);

		// Determine badge
		if ($progressPercent >= 100) {
			$badge = 'platinum';
		} elseif ($progressPercent >= 75) {
			$badge = 'gold';
		} elseif ($progressPercent >= 50) {
			$badge = 'silver';
		} elseif ($progressPercent >= 25) {
			$badge = 'bronze'; // Fixed typo: 'bronge' -> 'bronze'
		} else {
			$badge = 'none';
		}

		Gamification::updateOrCreate(
			[
				'tier_id' => $tier_ID,
				'user_id' => $userId,
				'course_id' => $courseID,
			],
			[
				'total_lessons' => $totalLessons,
				'completed_lessons' => $completedLessons,
				'progress' => $progressPercent,
				'current_badge' => $badge,
				'status' => 1,
			]
		);

		return 'void';
	}
	// --------------------------------------
}
