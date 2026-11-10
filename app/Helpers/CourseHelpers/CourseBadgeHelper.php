<?php

namespace App\Helpers\CourseHelpers;

use App\Helpers\ApiJsonReturnHelper;
use App\Models\Courses\Course;
use App\Models\Trackers\ProgressCourse;
use App\Models\Trackers\ProgressQuiz;

class CourseBadgeHelper
{
   public static function singleCourseBadge(int $userId, int $tierId, int $courseId, $allProgress, $existingLessonProgress, bool $completeLesson = true)
   {
      $course = Course::courseId($courseId)->first();
      $totalLessons = $course->courseRelationWith_lessons->count();
      $completeLessons = $allProgress->where('is_complete', 1)->count();

      $progressLessonPercentage = ($totalLessons !== 0) ? ((100 * $completeLessons) / $totalLessons) : 0;

      $badges = [
         90 => 'platinum',
         75 => 'gold',
         50 => 'silver',
         1 => 'bronze',
         0 => 'no_badge'
      ];

      $badge = 'no_badge';

      foreach ($badges as $threshold => $name) {
         if ($progressLessonPercentage >= $threshold) {
            $badge = $name;
            break;
         }
      }

      $badge = ProgressCourse::updateOrCreate([
         'user_id' => $userId,
         'tier_id' => $tierId,
         'course_id' => $courseId,
      ], [
         'total_lessons' => $totalLessons,
         'completed_lessons' => $completeLessons,
         'progress_lessons' => $progressLessonPercentage,
         'current_badge' => $badge,
         'status' => 1,
      ]);

      return $badge;
   }

   public static function allCourseBadge(int $userId)
   {
      $allCourseProgress = ProgressCourse::userId($userId)->get();
      $totalCourseBadges = $allCourseProgress->count();

      $averageResult = 0;
      $badge = 'no_badge';

      $badges = [
         90 => 'platinum',
         75 => 'gold',
         50 => 'silver',
         1 => 'bronze',
         0 => 'no_badge'
      ];

      if ($allCourseProgress && $totalCourseBadges >= 0) {
         $averageResult = $allCourseProgress->avg('progress_lessons');

         foreach ($badges as $threshold => $name) {
            if ($averageResult >= $threshold) {
               $badge = $name;
               break;
            }
         }
      }

      return [
         'average_course_progress' => $averageResult,
         'average_course_badge' => $badge,
      ];
   }
}