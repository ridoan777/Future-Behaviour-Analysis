<?php

namespace App\Helpers\CourseHelpers;

use App\Models\Trackers\ProgressQuiz;

class ProgressQuizHelper
{
   public static function recordQuizProgress(int $userId, int $courseId, int $quizId, int $isComplete, int $isPassed, $score, $passScore)
   {
      $progressQuiz = null;
      $progressQuiz = ProgressQuiz::updateOrCreate([
         'user_id' => $userId,
         'course_id' => $courseId,
         'quiz_id' => $quizId,
      ], [
         'is_complete' => $isComplete,
         'is_passed' => $isPassed,
         'total_mark' => round($score, 2),
         'required_mark' => round($passScore ?? 70, 2),
      ]);

      return $progressQuiz;
   }
}