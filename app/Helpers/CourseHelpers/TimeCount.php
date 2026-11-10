<?php

namespace App\Helpers\CourseHelpers;

use App\Helpers\ExceptionHandling;
use App\Models\Trackers\ProgressLesson;

class TimeCount
{
   public static $minimumLessonTime = 5; // minutes

   public static function timeToFinishCourse($userId, $lessonId)
   {
      $existingLessonProgress = ProgressLesson::userId($userId)->lessonId($lessonId)->first();
      if($existingLessonProgress->is_complete){
         return true;
      }
      
      $spentTime = $existingLessonProgress->created_at->diffInMinutes(now());
      if ($spentTime < self::$minimumLessonTime) {
         $remaining = (int)(self::$minimumLessonTime - $spentTime);

         ExceptionHandling::bailout(403, "You have not spent sufficient time in this lesson! Remining: '{$remaining}' mins.");
      }

      return true;
   }
}