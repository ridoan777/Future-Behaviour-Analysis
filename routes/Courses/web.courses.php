<?php

use App\Http\Controllers\Admin\Sidebar\Courses\{CourseController, ModuleController, InstructorController, LessonController, LessonResourceController};
use App\Http\Controllers\Admin\Sidebar\Quiz\{QuestionController, QuizController};
use Illuminate\Support\Facades\Route;

# this route will only contain everything related to course, modules & lessons

// ------------ COURSES ------------
Route::prefix('admin')->middleware(['auth:web'])->group(function () {

	Route::get('/courses/make-course', [CourseController::class, 'create'])->name('backend_courses_create');
	Route::get('/courses/edit-course/{id}', [CourseController::class, 'show'])->name('backend_courses_edit');

	Route::post('/courses/make-course/store', [CourseController::class, 'store'])->name('backend_courses_store');
	Route::delete('/courses/make-course/{course}/delete', [CourseController::class, 'delete'])->name('backend_courses_delete');

	Route::get('/courses/all-course', [CourseController::class, 'index'])->name('backend_all_courses');
	Route::post('/courses/all-course/datatables', [CourseController::class, 'CourseListDataTable'])->name('backend_dataTable_courses');

});
// ------------ COURSES ------------


// ------------ MODULES ------------

Route::prefix('admin')->middleware(['auth:web'])->group(function () {

	Route::get('/modules/all-modules', [ModuleController::class, 'allModules'])->name('backend_all_modules');

	Route::post('/modules/make-module/store', [ModuleController::class, 'moduleStore'])->name('backend_module_store');

	Route::get('/modules/edit-module/{id}', [ModuleController::class, 'editModule'])->name('backend_module_edit');

	Route::delete('/modules/{module}/delete', [ModuleController::class, 'deleteModule'])->name('backend_module_delete');

	Route::post('/module/all-modules/datatables', [ModuleController::class, 'ModuleListDataTable'])->name('backend_dataTable_modules');

});
// ------------ MODULES ------------


// ------------ INSTRUCTORS ------------

Route::prefix('admin')->middleware(['auth:web'])->group(function () {

	Route::post('/instructor/make-instrcutor/store', [InstructorController::class, 'instructorStore'])->name('backend_instructor_store');

	Route::get('/instructors/edit-instructor/{id}', [InstructorController::class, 'editInstructor'])->name('backend_instructor_edit');

	Route::delete('/instructors/{id}/delete', [InstructorController::class, 'deleteInstructor'])->name('backend_instructor_delete');


	Route::get('/instructor/all-instructors', [InstructorController::class, 'allInstructor'])->name('backend_all_instructors');

	Route::post('/instructor/all-instructors/datatables', [InstructorController::class, 'InstructorListDataTable'])->name('backend_dataTable_instructors');

});
// ------------ INSTRUCTORS ------------



// ------------ LESSONS ------------

Route::prefix('admin')->middleware(['auth:web'])->group(function () {

	Route::get('/lessons/all-lessons', [LessonController::class, 'index'])->name('backend_all_lessons');

	Route::post('/lessons/make-lesson/store', [LessonController::class, 'store'])->name('backend_lesson_store');

	Route::get('/lessons/edit-lesson/{id}', [LessonController::class, 'show'])->name('backend_lesson_edit');

	Route::delete('/lessons/{lesson}/delete', [LessonController::class, 'delete'])->name('backend_lesson_delete');

	Route::post('/lesson/all-lessons/datatables', [LessonController::class, 'LessonsListDataTable'])->name('backend_dataTable_lessons');
});
// ------------ LESSONS ------------

// ------------ CHUNKING ------------

Route::prefix('admin')->middleware(['auth:web'])->group(function () {

	Route::post('/lesson/upload-chunk', [LessonController::class, 'uploadChunk'])->name('lesson.upload.chunk');
	Route::post('/lesson/merge-chunk', [LessonController::class, 'mergeChunks'])->name('lesson.merge.chunk');
	Route::post('/lesson/generate-uid', [LessonController::class, 'generateUID'])->name('lesson.generate.uid');
	Route::post('/lesson/discard-video', [LessonController::class, 'discardVideo'])->name('lesson.discard.video');
});
// ------------ CHUNKING ------------

// ------------ PROCESS::JOBS ------------
Route::post('/admin/lessons/calc-all-duration', [LessonController::class, 'calculateAllVideoLengths'])->name('backend_lesson_calc_all_duration');
// ------------ PROCESS::JOBS ------------

// ------------ LESSON RESOURCES ------------

Route::prefix('admin')->middleware(['auth:web'])->group(function () {

	Route::post('/lesson/lesson-resources/make-resource/store', [LessonResourceController::class, 'storeResource'])->name('backend_lesson_resource_store');

	Route::get('/lesson/lesson-resources/edit-resource/{id}', [LessonResourceController::class, 'editResource'])->name('backend_lesson_resource_edit');

	Route::post('/lesson/lesson-resources/update-resource/{id}', [LessonResourceController::class, 'updateResource'])->name('backend_lesson_resource_update');

	Route::delete('/lessons/lesson-resources/{id}/delete', [LessonResourceController::class, 'deleteResource'])->name('backend_lesson_resource_delete');

	Route::get('/lessons/all-lesson-resources', [LessonResourceController::class, 'allLessonResources'])->name('backend_all_lesson_resources');

	Route::post('/lesson/all-lesson-resources/datatables', [LessonResourceController::class, 'LessonsListDataTable'])->name('backend_dataTable_lesson_resource');
});
// ------------ LESSON RESOURCES ------------


// ------------ CONDITIONAL DROPDOWN ------------

Route::prefix('admin')->middleware(['auth:web'])->group(function () {

	Route::get('/courses/{courseId}/get/modules', [CourseController::class, 'getModulesByCourse'])->name('get_modules_by_Course');

	Route::get('/modules/{moduleId}/get/lessons', [CourseController::class, 'getLessonsByModule'])->name('get_lessons_by_module');

});
// ------------ CONDITIONAL DROPDOWN ------------


// ------------ QUIZZES ------------
Route::prefix('admin')->middleware(['auth:web'])->group(function () {

	Route::get('/quizzes/make-quizzes', [QuizController::class, 'createFullQuiz'])->name('backend_quizzes_create');
	Route::get('/quizzes/edit-quiz/{id}', [QuizController::class, 'editQuiz'])->name('backend_quizzes_edit');

	Route::post('/quizzes/make-quiz/store', [QuizController::class, 'storeQuiz'])->name('backend_quiz_store');
	Route::post('/quizzes/{quiz}/delete', [QuizController::class, 'deleteQuiz'])->name('backend_quizzes_delete');

	Route::get('/quizzes/all-quizzes', [QuizController::class, 'allQuizzes'])->name('backend_all_quizzes');
	Route::post('/quizzes/all-quizzes/datatables', [QuizController::class, 'QuizListDataTable'])->name('backend_dataTable_quizzes');

});
// ------------ QUIZZES ------------


// ------------ QUESTIONS ------------
Route::prefix('admin')->middleware(['auth:web'])->group(function () {

	Route::post('/quizzes/questions/make-question/store', [QuestionController::class, 'storeQuestion'])->name('backend_question_store');

	Route::get('/quizzes/questions/all-questions', [QuestionController::class, 'allQuestions'])->name('backend_all_questions');


	Route::get('/get-question-block', [QuestionController::class, 'getQuestionBlock'])->name('get_question_block');

	Route::get('/get-question-edit-block', [QuestionController::class, 'getQuestionEditBlock'])->name('get_question_edit_block');

});
// ------------ QUESTIONS ------------

