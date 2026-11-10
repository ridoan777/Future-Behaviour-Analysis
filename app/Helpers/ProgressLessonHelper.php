<?php
namespace App\Helpers;

use App\Helpers\CourseHelpers\ProgressQuizHelper;
use App\Models\Courses\{Course, CourseLesson};
use App\Models\Subscription\{SubscribedUser, SubscriptionTier};
use App\Models\Trackers\{ProgressLesson, ProgressQuiz, ProgressTracker};
use Illuminate\Http\JsonResponse;

class ProgressLessonHelper
{
   public static function firstCoursePortionToShow(int $userId, int $tierId, int $courseId): array|JsonResponse
   {
      // ----------------- Tier -----------------
      $tier = SubscriptionTier::find((int)$tierId)->courseId($courseId)->latest()->first();
      if (!$tier) {
         ExceptionHandling::bailout(404, "The tier or associated course is not found!");
      }
      // ----------------- Tier -----------------

      // ----------------- Course -----------------
      $course = Course::with([
         'courseRelationWith_modules.moduleRelationWith_lessons.courseLessonRelatonWith_resource',
      ])->find($courseId);

      if (!$course) {
         ExceptionHandling::bailout(404, "Course not found!");
      }
      $course->total_video_length_in_min = $course->total_video_length ?? 0;
      // ----------------- Course -----------------

      // ----------------- Module -----------------
      $firstModule = $course->courseRelationWith_modules()->status(1)->orderBy('id')->first();

      if (!$firstModule) {
         ExceptionHandling::bailout(404, "First module not found! Try another course or come back again!");
      }
      $firstModule->total_video_length_in_min = $firstModule->total_video_length ?? 0;
      // ----------------- Module -----------------

      // ----------------- Lesson -----------------
      $firstLesson = $firstModule?->moduleRelationWith_lessons()->status(1)->orderBy('id')->first();
      $lessonResources = $firstLesson?->courseLessonRelatonWith_resource ?? collect();
      if (!$firstModule || !$firstLesson) {
         ExceptionHandling::bailout(500, "Course content is incomplete. Try other courses or contact support!");
      }
      $firstLesson->total_video_length_in_min = $firstLesson->total_video_length ?? 0;
      // ----------------- Lesson -----------------

      // ----------------- Progress -----------------
      $progress = ProgressTracker::where('user_id', $userId)->where('course_id', $courseId)->first();
      $subscribedUser = SubscribedUser::where('user_id', $userId)->where('course_id', $courseId)->first();
      if (!$progress) {
         self::firstProgressLessonEntry($userId, $tierId, $firstLesson->id);
      }
      // ----------------- Progress -----------------

      // ----------------- FIRST PROGRESS ENTRY -----------------
      $currentLessonProgress = ProgressLesson::userId($userId)?->tierId($tierId)?->lessonId($firstLesson->id)->first();
      $isComplete = (isset($currentLessonProgress->is_complete) && $currentLessonProgress->is_complete) ? true : false;
      $currentLessonProgress = self::firstProgressLessonEntry($userId, $tierId, $firstLesson->id, $isComplete ? 1 : 0);
      // ----------------- FIRST  PROGRESS ENTRY -----------------

      return [
         'tier_details' => $tier,
         'is_first_landing' => true,
         'course_details' => $course->makeHidden(['courseRelationWith_modules', 'total_video_length']),
         'module_details' => $firstModule->makeHidden(['moduleRelationWith_lessons', 'total_video_length']),
         'lesson_details' => $firstLesson->makeHidden(['courseLessonRelatonWith_resource', 'total_video_length']),
         'resource_details' => $lessonResources,
      ];
   }
   // ----------------------------------------

   public static function navigationAllowance(int $userId, int $tierId, int $courseId, int $moduleId, int $lessonId)
   {
      // --------------- GAMIFICATION BADGE CHECKING ---------------
      GamificationHelper::badgeGenerate($tierId, $userId, $courseId);
      // --------------- GAMIFICATION BADGE CHECKING ---------------

      // ----------------- TIER -----------------
      $tierDetails = SubscriptionTier::where('id', $tierId)->courseId($courseId)->first();
      // ----------------- TIER -----------------

      // ----------------- COURSE -----------------
      $course = Course::with([
         'courseRelationWith_modules.moduleRelationWith_lessons.courseLessonRelatonWith_resource',
      ])->courseId($courseId)->first();

      if (!$course) {
         ExceptionHandling::bailout(404, "Course not found!");
      }
      $course->total_video_length_in_min = $course->total_video_length ?? 0;
      // ----------------- COURSE -----------------


      // ----------------- MODULES -----------------
      $totalModules = $course->courseRelationWith_modules()->count();

      if ($totalModules === 0) {
         ExceptionHandling::bailout(404, "This course currently has no modules! Try another course or contact support!");
      }

      $moduleIDs = [];
      $modules = $course->courseRelationWith_modules()->status(1)->orderBy('id')->get();
      $moduleIDs = $modules->pluck('id')->toArray();

      $targetModule = $modules->find($moduleId);
      $targetModuleIndex = array_search($moduleId, $moduleIDs);

      $previousModule = ($targetModuleIndex > 0) ? $modules->find($moduleIDs[$targetModuleIndex - 1]) : $modules->find($moduleIDs[$targetModuleIndex]);

      $nextModule = ($targetModuleIndex < count($moduleIDs) - 1) ? $modules->find($moduleIDs[$targetModuleIndex + 1]) : $modules->find($moduleIDs[$targetModuleIndex]);

      if ($modules->isEmpty() || !$targetModule) {
         ExceptionHandling::bailout(404, "Module cannot be found! Try another or come back later!");
      }
      // ----------------- MODULES -----------------


      // ----------------- LESSONS -----------------
      $lessonIDs = [];
      $lessons = $targetModule?->moduleRelationWith_lessons()->status(1)->orderBy('id')->get();
      $lessonIDs = $lessons->pluck('id')->toArray();

      $currentLesson = $lessons->find($lessonId);
      $currentLessonIndex = array_search($lessonId, $lessonIDs);

      if ($currentLessonIndex === false || !$currentLesson) {
         ExceptionHandling::bailout(404, "Lesson not found! Try another or come back later!");
      }

      $previousLessonId = $currentLessonIndex > 0 ? $lessonIDs[$currentLessonIndex - 1] : null;
      $nextLessonId = $currentLessonIndex < count($lessonIDs) - 1 ? $lessonIDs[$currentLessonIndex + 1] : null;
      // ----------------- LESSONS -----------------

      $markPreviousComplete = false;
      $markCurrentComplete = false;
      $previousLessonProgress = null;

      // ----------------- PREVIOUS -----------------
      if ($previousLessonId) { // previous lesson in the same module exists
         $previousLessonProgress = ProgressLesson::userId($userId)?->tierId($tierId)?->lessonId($previousLessonId)->first();

         $markPreviousComplete = $previousLessonProgress?->is_complete ? true : false;
      } else if (!$previousLessonId && (int)$targetModule->id !== (int)$previousModule->id) {
         // this is the first lesson in the module. Previous lesson = the last lesson in the previous module
         $previousModuleLessons = $previousModule?->moduleRelationWith_lessons()->status(1)->orderBy('id')->get();
         $previousLastLessonId = $previousModuleLessons->last()->id;
         $previousLessonProgress = ProgressLesson::userId($userId)?->tierId($tierId)?->lessonId($previousLastLessonId)->first();

         $previousLessonId = $previousLastLessonId;

         $markPreviousComplete = $previousLessonProgress?->is_complete ? true : false;
      } else { // this is the very first lesson of the course
         $previousLessonId = $currentLesson->id;
         $markPreviousComplete = true;
      }

      if (!$markPreviousComplete && (!$previousLessonProgress || !$previousLessonProgress->is_complete)) {
         ExceptionHandling::bailout(403, "You have to complete previous lessons to advance.");
      }
      // ----------------- PREVIOUS -----------------


      // ----------------- NEXT -----------------
      $QUIZ = $targetModule->courseModuleRelationWith_quiz;
      $QUIZ_PROGRESS = $QUIZ?->quizRelatingBackTo_ProgressQuiz()->userId($userId)->first();
      $nextLesson = null;
      $triggerQuiz = false;
      $courseEnd = false;

      if ($nextLessonId) {
         // next lesson exists in the same module
         $nextLesson = $lessons->find($nextLessonId);
         // dd("if=", $nextLesson);
      } else if (!$nextLessonId && (int)$nextModule->id !== (int)$targetModule->id) {
         // next lesson = first lesson of the next module
         $triggerQuiz = $QUIZ ? true : false;
         $nextLessons = $nextModule?->moduleRelationWith_lessons()->status(1)->orderBy('id')->get();
         $nextLesson = $nextLessons->first();
         // dd("else if=", $triggerQuiz, $QUIZ_PROGRESS);
         if (!$QUIZ || $QUIZ_PROGRESS?->is_passed) {
            $triggerQuiz = false;
         }
      } else {
         // this is the very last lesson of the course
         $triggerQuiz = $QUIZ ? true : false;
         if (!$nextLessonId && (int)$nextModule->id === (int)$targetModule->id) {
            $nextLesson = $currentLesson;
            $courseEnd = true;
         }
      }
      // ----------------- NEXT -----------------

      // ----------------- NEXT PROGRESS TRACK -----------------
      $currentLessonProgress = ProgressLesson::userId($userId)?->tierId($tierId)?->lessonId($currentLesson->id)->first();
      $nextLessonProgress = ProgressLesson::userId($userId)?->tierId($tierId)?->lessonId($nextLesson->id)->first();

      $markCurrentComplete = (isset($currentLessonProgress->is_complete) && $currentLessonProgress->is_complete) ? true : false;
      $markNextComplete = (isset($nextLessonProgress->is_complete) && $nextLessonProgress->is_complete) ? true : false;

      if ($currentLessonProgress && $nextLesson && !$markNextComplete) {
         $newLessonProgress = self::firstProgressLessonEntry($userId, $tierId, $nextLesson->id, 0);
      }
      // if (!$currentLessonProgress?->is_complete) {
      //    ExceptionHandling::bailout(403, "You have to complete the current lesson to advance.");
      // }
      if (!$markPreviousComplete && !$markCurrentComplete) {
         ExceptionHandling::bailout(403, "You have to complete all previous and current lesson(s) to proceed.");
      }
      // ----------------- NEXT PROGRESS TRACK -----------------
      return [
         'triggerQuiz' => $triggerQuiz ?? null,
         'QUIZ_PROGRESS' => $QUIZ_PROGRESS ?? null,
         'QUIZ' => $QUIZ ?? null,
         'course' => $course ?? null,
         'tierDetails' => $tierDetails ?? null,
         'courseEnd' => $courseEnd ?? null,
         'nextModule' => $nextModule ?? null,
         'nextLesson' => $nextLesson ?? null,
         'targetModule' => $targetModule ?? null,
         'markPreviousComplete' => $markPreviousComplete ?? null,
         'previous_lesson_id' => $previousLessonId ?? $previousLastLessonId,
         'markCurrentComplete' => $markCurrentComplete ?? null,
         'currentLessonProgress' => $currentLessonProgress ?? null,
      ];
   }
   // ----------------------------------------

   public static function previousCourseContent(int $userId, int $tierId, int $courseId, int $moduleId, int $lessonId)
   {
      $navigated = self::navigationAllowance($userId, $tierId, $courseId, $moduleId, $lessonId);
      if (!$navigated['markPreviousComplete']) {
         ExceptionHandling::bailout(403, "You have to complete that lesson to go back there.");
      }
      // ----------------- TIER -----------------
      $tierDetails = SubscriptionTier::where('id', $tierId)->courseId($courseId)->first();
      // ----------------- TIER -----------------

      // ----------------- COURSE -----------------
      $course = Course::with([
         'courseRelationWith_modules.moduleRelationWith_lessons.courseLessonRelatonWith_resource',
      ])->courseId($courseId)->first();

      if (!$course) {
         ExceptionHandling::bailout(404, "Course not found!");
      }
      $course->total_video_length_in_min = $course->total_video_length ?? 0;
      // ----------------- COURSE -----------------

      // ----------------- LESSON + MODULE -----------------
      $targetLesson = CourseLesson::status(1)->find($navigated['previous_lesson_id']);
      $targetModule = $targetLesson?->courseLessonRelatingBackTo_module()?->status(1)->first();

      if (!$targetLesson || !$targetModule) {
         ExceptionHandling::bailout(404, "The respective lesson/module is not found!");
      }
      // ----------------- LESSON + MODULE-----------------

      $previousLessonProgress = ProgressLesson::userId($userId)?->tierId($tierId)?->lessonId($navigated['previous_lesson_id'])->first();

      if (!$previousLessonProgress || ($previousLessonProgress && !$previousLessonProgress->is_complete)) {
         ExceptionHandling::bailout(404, "You have to complete the previous lessons to directly access this content!");
      }

      return ApiJsonReturnHelper::handle(true, 200, 'Course data have been fetched successfully.', [
         'lesson_details' => $targetLesson->makeHidden('courseLessonRelatingBackTo_module', 'courseLessonRelatonWith_resource', 'courseLessonRelatingBackTo_instructor'),
         'lesson_resources' => $targetLesson?->courseLessonRelatonWith_resource,
         'lesson_instructor' => $targetLesson?->courseLessonRelatingBackTo_instructor,
         'module_details' => $targetModule?->makeHidden('courseModuleRelationWith_quiz'),
         'course_details' => $course->makeHidden('courseRelationWith_modules'),
         'tier_details' => $tierDetails,
      ]);
   }
   // ----------------------------------------

   public static function nextCourseContent(int $userId, int $tierId, int $courseId, int $moduleId, int $lessonId)
   {
      $navigated = self::navigationAllowance($userId, $tierId, $courseId, $moduleId, $lessonId);

      if ($navigated['markPreviousComplete'] && !$navigated['currentLessonProgress']?->is_complete) {
         ExceptionHandling::bailout(403, "You have to complete the current lesson to advance.");
      }

      if (!$navigated['markPreviousComplete'] || !$navigated['markCurrentComplete']) {
         ExceptionHandling::bailout(403, "You have to complete all previous and current lesson(s) to proceed.");
      }

      $checkingCourseEnding = self::checkCourseFinish($userId, $tierId, $courseId);

      if ($navigated['triggerQuiz'] && !$navigated['QUIZ_PROGRESS']?->is_passed) {    // quiz exists

         $navigated['QUIZ']->quiz_questions = $navigated['QUIZ']->quizRelationWith_questions;

         $navigated['QUIZ']->quiz_questions->transform(function ($question) {
            $question->question_options = $question->questionRelationWith_options;
            $question->question_options->makeHidden(['created_at', 'updated_at']);
            $question->unsetRelation('questionRelationWith_options');

            return $question;
         });
         $navigated['QUIZ']->unsetRelation('quizRelationWith_questions');

         ProgressQuizHelper::recordQuizProgress($userId, $courseId, $navigated['QUIZ']->id, 0, 0, 0, $navigated['QUIZ']->passing_score);

         return ApiJsonReturnHelper::handle(true, 200, 'You must pass the quiz to proceed to the next stages.', [
            'quiz_details' => $navigated['QUIZ'],
            'course_details' => $navigated['course']->makeHidden('courseRelationWith_modules'),
            'tier_details' => $navigated['tierDetails'],
         ]);
      }
      // else if ($navigated['courseEnd'] && ((int)($navigated['nextModule']->id) === (int)($navigated['targetModule']->id))) {
      // /*
      else if ($navigated['courseEnd'] && $checkingCourseEnding && $checkingCourseEnding['is_course_completed']) {
         // course ends
         $quizResults = $navigated['course']?->courseRelationWith_ProgressQuiz()?->userId($userId)->get();
         $quizResults?->load(['progressQuizRelatingBackTo_Quiz']);
         $quizResults?->transform(function ($item) {
            $item->quiz_details = $item->progressQuizRelatingBackTo_Quiz;
            $item->unsetRelation('progressQuizRelatingBackTo_Quiz');
            return $item;
         });

         return ApiJsonReturnHelper::handle(true, 200, 'Congratulations! You have successfully finished the course!', [
            'quiz_results' => $quizResults ?? null,
            'course_details' => $navigated['course']->makeHidden('courseRelationWith_modules'),
            'tier_details' => $navigated['tierDetails'],
         ]);
      } 
      // */
      else { // lesson found
         return ApiJsonReturnHelper::handle(true, 200, 'Course data have been fetched successfully.', [
            'lesson_details' => $navigated['nextLesson']?->makeHidden('courseLessonRelatingBackTo_module', 'courseLessonRelatonWith_resource', 'courseLessonRelatingBackTo_instructor'),
            'lesson_resources' => $navigated['nextLesson']?->courseLessonRelatonWith_resource,
            'lesson_instructions' => $navigated['nextLesson']?->courseLessonRelatingBackTo_instructor,
            'module_details' => $navigated['nextLesson']?->courseLessonRelatingBackTo_module?->makeHidden('courseModuleRelationWith_quiz'),
            'course_details' => $navigated['course']->makeHidden('courseRelationWith_modules'),
            'tier_details' => $navigated['tierDetails'],
         ]);
      }
   }
   // ----------------------------------------

   public static function randomCourseContent(int $userId, int $tierId, int $courseId, int $moduleId, int $lessonId)
   {
      $navigated = self::navigationAllowance($userId, $tierId, $courseId, $moduleId, $lessonId);

      // --------------- GAMIFICATION BADGE CHECKING ---------------
      GamificationHelper::badgeGenerate($tierId, $userId, $courseId);
      // --------------- GAMIFICATION BADGE CHECKING ---------------

      // ----------------- TIER -----------------
      $tierDetails = SubscriptionTier::where('id', $tierId)->courseId($courseId)->first();
      // ----------------- TIER -----------------

      // ----------------- COURSE -----------------
      $course = Course::with([
         'courseRelationWith_modules.moduleRelationWith_lessons.courseLessonRelatonWith_resource',
      ])->courseId($courseId)->first();

      if (!$course) {
         ExceptionHandling::bailout(404, "Course not found!");
      }
      $course->total_video_length_in_min = $course->total_video_length ?? 0;
      // ----------------- COURSE -----------------

      // ----------------- LESSON + MODULE -----------------
      $targetLesson = CourseLesson::status(1)->find($lessonId);
      $targetModule = $targetLesson?->courseLessonRelatingBackTo_module()?->status(1)->first();

      if (!$targetLesson || !$targetModule) {
         ExceptionHandling::bailout(404, "The respective lesson/module is not found!");
      }
      // ----------------- LESSON + MODULE-----------------

      $currentLessonProgress = ProgressLesson::userId($userId)?->tierId($tierId)?->lessonId($lessonId)->first();
      $previousLessonProgress = ProgressLesson::userId($userId)?->tierId($tierId)?->lessonId($navigated['previous_lesson_id'])->first();

      if (!$previousLessonProgress || ($previousLessonProgress && !$previousLessonProgress->is_complete)) {
         ExceptionHandling::bailout(404, "You have to complete the previous lessons to directly access this content!");
      }

      if (!$currentLessonProgress) {
         $newLessonProgress = self::firstProgressLessonEntry($userId, $tierId, $targetLesson->id, 0);
      }

      // ----------------- QUIZ COMPLETION -----------------
      // $moduleQuiz = $targetModule?->courseModuleRelationWith_quiz ?? null;
      // $moduleQuizProgress = $moduleQuiz ? $moduleQuiz?->quizRelatingBackTo_ProgressQuiz()?->userId($userId)->first() : null;
      // if (!$moduleQuizProgress || ($moduleQuizProgress && !$moduleQuizProgress->is_passed)) {
      //    ExceptionHandling::bailout(404, "You have to complete the previous quiz(s) to directly access this content!");
      // }
      // ----------------- QUIZ COMPLETION -----------------

      return ApiJsonReturnHelper::handle(true, 200, 'Course data have been fetched successfully.', [
         'lesson_details' => $targetLesson->makeHidden('courseLessonRelatingBackTo_module', 'courseLessonRelatonWith_resource', 'courseLessonRelatingBackTo_instructor'),
         'lesson_resources' => $targetLesson?->courseLessonRelatonWith_resource,
         'lesson_instructor' => $targetLesson?->courseLessonRelatingBackTo_instructor,
         'module_details' => $targetModule?->makeHidden('courseModuleRelationWith_quiz'),
         'course_details' => $course->makeHidden('courseRelationWith_modules'),
         'tier_details' => $tierDetails,
      ]);
   }
   // ----------------------------------------

   public static function firstProgressLessonEntry(int $userId, int $tierId, int $lessonId, int $isComplete = 0)
   {
      $progressLesson = ProgressLesson::updateOrCreate(
         [
            'user_id' => $userId,
            'tier_id' => $tierId,
            'lesson_id' => $lessonId,
         ],
         [
            'is_complete' => (int)$isComplete,
            // 'time_taken' => isset($timeTaken) ? (int) $timeTaken : null,
            'status' => 1,
         ]
      );
      return $progressLesson;
   }
   // ----------------------------------------
   public static function checkCourseFinish(int $userId, int $tierId, int $courseId)
   {
      $courseLessonIds = CourseLesson::whereHas('courseLessonRelatingBackTo_module', function ($q) use ($courseId) {
         $q->where('course_id', $courseId);
      })->pluck('id');

      $completedLessons = ProgressLesson::userId($userId)->tierId($tierId)->isComplete(1)->whereIn('lesson_id', $courseLessonIds)->pluck('lesson_id');

      $totalLessons = $courseLessonIds->count();
      $completedCount = $completedLessons->count();

      $isCourseCompleted = $totalLessons === $completedCount;

      return [
         'total_lessons' => $totalLessons,
         'completed_lessons' => $completedCount,
         'is_course_completed' => $isCourseCompleted,
      ];
   }
}