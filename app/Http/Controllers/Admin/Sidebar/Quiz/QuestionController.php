<?php

namespace App\Http\Controllers\Admin\Sidebar\Quiz;

use App\Helpers\ImageManagement;
use App\Helpers\NewFileManagement;
use App\Http\Controllers\Controller;
use App\Models\Quizzes\Question;
use App\Models\Quizzes\Quiz;
use App\Models\Quizzes\QuizQuestion;
use App\Models\Quizzes\QuizOption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class QuestionController extends Controller
{
	// /*
	public function storeQuestion(Request $request)
	{
		$validated = $request->validate([
			'flag' => 'required|string|in:create,update',
			'quiz_id' => 'required|integer|exists:quizzes,id',
			'status' => 'nullable|boolean|in:0,1',
			'questions' => 'required|array|min:1',
			'questions.*.id' => 'nullable|integer|exists:quiz_questions,id',
			'questions.*.title' => 'required|string|max:255',
			'questions.*.detail' => 'nullable|string',
			'questions.*.detail_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:10240',
			'questions.*.remove_detail_image' => 'nullable|boolean',
			'questions.*.explaination' => 'nullable|string',
			'questions.*.explaination_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:10240',
			'questions.*.remove_explaination_image' => 'nullable|boolean',
			'questions.*.options' => 'required|array|min:1|max:5',
			'questions.*.options.*' => 'required|string|max:255',
			'questions.*.is_correct' => 'required|integer|min:0',
		], [
			'quiz_id.required' => "You must choose a Quiz Head.",
		]);

		try {
			$DISK_FOLDER = config('filesystems.default');


			// First, delete removed questions (sync approach)
			$submittedIds = collect($request->input('questions'))->pluck('id')->filter()->toArray();

			QuizQuestion::where('quiz_id', $validated['quiz_id'])
				->whereNotIn('id', $submittedIds)
				->each(function ($question) use ($DISK_FOLDER) {
					if ($question->detail_image) {
						Storage::disk($DISK_FOLDER)->delete($question->detail_image);
					}
					if ($question->explaination_image) {
						Storage::disk($DISK_FOLDER)->delete($question->explaination_image);
					}
					$question->questionRelationWith_options()->delete();
					$question->delete();
				});

			//  Handle submitted questions
			foreach ($request->input('questions') as $qIndex => $questionData) {
				$detailImagePath = null;
				$explainImagePath = null;

				// Check if updating existing question
				if ($request->input('flag') === 'update' && !empty($questionData['id'])) {
					$question = QuizQuestion::findOrFail($questionData['id']);

					// Handle detail image removal
					if (!empty($questionData['remove_detail_image']) && $questionData['remove_detail_image'] == '1') {
						if ($question->detail_image) {
							Storage::disk($DISK_FOLDER)->delete($question->detail_image);
						}
						$detailImagePath = null;
					} else {
						$detailImagePath = $question->detail_image;
					}

					// Handle explaination image removal
					if (!empty($questionData['remove_explaination_image']) && $questionData['remove_explaination_image'] == '1') {
						if ($question->explaination_image) {
							Storage::disk($DISK_FOLDER)->delete($question->explaination_image);
						}
						$explainImagePath = null;
					} else {
						$explainImagePath = $question->explaination_image;
					}

					// Handle new detail image upload
					if ($request->hasFile("questions.$qIndex.detail_image")) {
						if ($question->detail_image) {
							Storage::disk($DISK_FOLDER)->delete($question->detail_image);
						}
						$detailImagePath = NewFileManagement::storeFile(
							$request->file("questions.$qIndex.detail_image"),
							$questionData['title'],
							'quiz-management/question-images',
							$DISK_FOLDER
						);
					}

					// Handle new explaination image upload
					if ($request->hasFile("questions.$qIndex.explaination_image")) {
						if ($question->explaination_image) {
							Storage::disk($DISK_FOLDER)->delete($question->explaination_image);
						}
						$explainImagePath = NewFileManagement::storeFile(
							$request->file("questions.$qIndex.explaination_image"),
							$questionData['title'],
							'quiz-management/question-images',
							$DISK_FOLDER
						);
					}

					$question->update([
						'title' => $questionData['title'],
						'detail' => $questionData['detail'] ?? null,
						'detail_image' => $detailImagePath,
						'explaination' => $questionData['explaination'] ?? null,
						'explaination_image' => $explainImagePath,
					]);

					// Remove old options
					$question->questionRelationWith_options()->delete();

				} else {
					// Create new question
					if ($request->hasFile("questions.$qIndex.detail_image")) {
						$detailImagePath = NewFileManagement::storeFile(
							$request->file("questions.$qIndex.detail_image"),
							$questionData['title'],
							'quiz-management/question-images',
							$DISK_FOLDER
						);
					}

					if ($request->hasFile("questions.$qIndex.explaination_image")) {
						$explainImagePath = NewFileManagement::storeFile(
							$request->file("questions.$qIndex.explaination_image"),
							$questionData['title'],
							'quiz-management/question-images',
							$DISK_FOLDER
						);
					}

					$question = QuizQuestion::create([
						'quiz_id' => $validated['quiz_id'],
						'title' => $questionData['title'],
						'detail' => $questionData['detail'] ?? null,
						'detail_image' => $detailImagePath,
						'explaination' => $questionData['explaination'] ?? null,
						'explaination_image' => $explainImagePath,
						'status' => 1,
					]);
				}

				// Create new options
				foreach ($questionData['options'] as $oIndex => $optionText) {
					QuizOption::create([
						'question_id' => $question->id,
						'option_text' => $optionText,
						'is_correct' => ($oIndex == $questionData['is_correct']) ? 1 : 0,
						'status' => 1,
					]);
				}
			}

			// 🔥 Update total questions count in quiz
			$quiz = Quiz::withCount('quizRelationWith_questions')->find($validated['quiz_id']);
			if ($quiz) {
				$quiz->update([
					'total_questions' => $quiz->quiz_relation_with_questions_count,
				]);
			}

			return back()->with('success', 'All questions and options saved successfully.');

		} catch (\Exception $e) {
			return back()->with('error', 'Server error: ' . $e->getMessage())->withInput();
		}
	}
	// */


	public function getQuestionBlock(Request $request)
	{
		$index = (int) $request->input('index', 0); // cast to int
		return view('components.questionCreateBlock', compact('index'))->render();
	}


	public function getQuestionEditBlock(Request $request)
	{
		$index = $request->input('index', 0);
		$question = null; // New question, no data
		return view('components.questionEditBlock', compact('index', 'question'))->render();
	}

}

/*

*/