<?php

namespace App\Http\Controllers\Admin\Sidebar\Quiz;

use App\Helpers\NewFileManagement;
use App\Http\Controllers\Controller;
use App\Models\Courses\Course;
use App\Models\Quizzes\Quiz;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QuizController extends Controller
{
	public function createFullQuiz()
	{
		$allQuizzes = Quiz::where('status', 1)->get();
		return view('admin.sidebar.Quizzes.quiz_management', compact('allQuizzes'));
	}

	public function storeQuiz(Request $request)
	{
		// dd($request->all());
		$validated = $request->validate([
			'id' => 'nullable|integer|exists:quizzes,id', // for updates
			'flag' => 'required|string|in:create,update',
			'status' => 'nullable|boolean|in:0,1',

			'title' => 'required|string|max:255',
			'instruction' => 'nullable|string|max:2000',

			'total_questions' => 'nullable|numeric',
			'time' => 'nullable|numeric',
			'passing_score' => 'nullable|numeric',
		]);

		try {
			if (!empty($validated['id'])) {
				$quiz = Quiz::findOrFail($validated['id']);
				$quiz->update([
					'title' => $validated['title'],
					'instruction' => $validated['instruction'] ?? null,
					'total_questions' => $validated['total_questions'] ?? 0,
					'time' => $validated['time'] ?? 0,
					'passing_score' => $validated['passing_score'] ?? 0,
					'status' => $validated['status'] ?? 1,
				]);
			} else {
				Quiz::create([
					'title' => $validated['title'],
					'instruction' => $validated['instruction'] ?? null,
					'total_questions' => $validated['total_questions'] ?? 0,
					'time' => $validated['time'] ?? 0,
					'passing_score' => $validated['passing_score'] ?? 0,
					'status' => $validated['status'] ?? 1,
				]);
			}

			return back()->with('success', 'Quiz set saved successfully.');
		} catch (\Exception $e) {
			return back()->with('error', 'Server error: ' . $e->getMessage())->withInput();
		}
	}

	public function editQuiz($id)
	{
		$singleQuiz = Quiz::with(['quizRelationWith_questions.questionRelationWith_options'])->findOrFail($id);

		return view('admin.sidebar.Quizzes.quizEdit', compact('singleQuiz'));
	}


	public function deleteQuiz(Quiz $quiz)
	{
		// dd($quiz);
		$DISK_FOLDER = config('filesystems.default');

		// Delete all questions and their images/options
		foreach ($quiz->quizRelationWith_questions as $question) {
			// Delete question images
			NewFileManagement::deleteFile($question->detail_image, $DISK_FOLDER);
			NewFileManagement::deleteFile($question->explaination_image, $DISK_FOLDER);

			// Delete all options of the question
			$question->questionRelationWith_options()->delete();

			// Delete the question itself
			$question->delete();
		}

		// Delete the quiz itself
		$quiz->delete();

		return redirect()->back()->with('success', "Quiz and all its questions/options deleted successfully!");
	}

	public function allQuizzes()
	{
		// Sync total_questions counts on page load
		$quizzes = Quiz::withCount([
			'quizRelationWith_questions' => function ($q) {
				$q->where('status', 1); // count only active questions
			}
		])->get();

		foreach ($quizzes as $quiz) {
			if ($quiz->total_questions !== $quiz->quiz_relation_with_questions_count) {
				$quiz->update(['total_questions' => $quiz->quiz_relation_with_questions_count]);
			}
		}

		return view('admin.sidebar.Quizzes.all_quizzes', compact('quizzes'));
	}


	public function QuizListDataTable(Request $request)
	{
		$columns = ['id', 'title', 'total_questions', 'time', 'passing_score', 'status', 'created_at'];

		$draw = intval($request->input('draw'));
		$start = intval($request->input('start', 0));
		$length = intval($request->input('length', 25));
		$orderColIndex = $request->input('order.0.column', 0);
		$orderDir = $request->input('order.0.dir', 'asc');

		$orderCol = $columns[$orderColIndex] ?? 'id';
		$orderDir = in_array(strtolower($orderDir), ['asc', 'desc']) ? $orderDir : 'asc';

		$query = Quiz::query()->select($columns);

		// 🔎 Search filter
		if ($search = $request->input('search.value')) {
			$query->where(function ($q) use ($search) {
				$q->orWhere('title', 'like', "%{$search}%")
					->orWhere('id', $search)
					->orWhere('total_questions', $search)
					->orWhere('time', $search)
					->orWhere('passing_score', $search)
					->orWhere('status', $search);
			});
		}

		$recordsTotal = Quiz::count();
		$recordsFiltered = $query->toBase()->getCountForPagination();

		$data = $query->orderBy($orderCol, $orderDir)
			->offset($start)
			->limit($length)
			->get();

		$sn = $start;

		$data = $data->transform(function ($row) use (&$sn) {
			$sn++;
			$row->SN = $sn;

			$row->time = isset($row->time) && $row->time > 0 ? $row->time . ' min' : 'N/A';
			$row->passing_score = isset($row->passing_score) && $row->passing_score > 0 ? $row->passing_score . '%' : 'N/A';

			$row->row_link = route('backend_quizzes_edit', $row->id); // ✅ clickable link

			$row->actions = '
				<div class="flex_xy_center gap-2">
					<form action="' . route('backend_quizzes_delete', $row->id) . '" 
							method="POST" 
							class="deleteForm">
						' . csrf_field() . '
						<button type="submit" class="deleteButton">'
				. \App\Helpers\IconPack::trash(['class' => 'iconPackItem w-3 h-3 text-gray-100']) .
				'</button>
					</form>
				</div>';


			$row->status = $row->status
				? '<span class="px-2 py-1 text-xs rounded-lg bg-green-100 text-green-700">Active</span>'
				: '<span class="px-2 py-1 text-xs rounded-lg bg-red-100 text-red-700">Inactive</span>';

			$row->created_at_formatted = $row->created_at
				? Carbon::parse($row->created_at)->timezone('Asia/Dhaka')->format('d M Y, H:i') . ' UTC+6'
				: 'Invalid Date';

			unset($row->created_at);
			return $row;
		});


		return response()->json([
			'draw' => $draw,
			'recordsTotal' => $recordsTotal,
			'recordsFiltered' => $recordsFiltered,
			'data' => $data,
		]);
	}

}
