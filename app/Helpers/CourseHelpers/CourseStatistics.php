<?php

namespace App\Helpers\CourseHelpers;

use App\Models\Subscription\SubscribedUser;

class CourseStatistics
{
   public static function calculate($course)
   {
      if(!$course){
         return null;
      }

      $course->load('courseRelationWith_Review');

      $reviews = $course->courseRelationWith_Review;
      $avg = $reviews->avg('rating');
      $averageRating = number_format((float)$avg, 1, '.', '');

      $totalEnrolled = SubscribedUser::courseId($course->id)->count();

      $lastUpdated = $course->courseRelationWith_lessons->max('updated_at');

      $data = [
         'total_reviews' => $reviews->count(),
         'average_rating' => $averageRating,
         'total_enrolled' => $totalEnrolled,
         'last_updated' => $lastUpdated,
      ];
      return $data;
   }
}
/*
   $stats = CourseStatistics::calculate($course);
*/