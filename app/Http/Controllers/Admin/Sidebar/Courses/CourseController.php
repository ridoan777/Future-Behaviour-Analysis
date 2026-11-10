<?php

namespace App\Http\Controllers\Admin\Sidebar\Courses;

use App\Helpers\CourseHelpers\CourseStatistics;
use App\Helpers\ImageManagement;
use App\Helpers\UidGenerator;
use App\Http\Controllers\Controller;
use App\Models\Courses\{Course, CourseInstructor, CourseLesson, CourseModule};
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Models\Quizzes\Quiz;
use Exception;

class CourseController extends Controller
{
	public function index()
	{
		// /*	// run the method to populate the courses with module counts
		$courses = Course::withCount('courseRelationWith_modules')->get();
		foreach ($courses as $course) {
			$totalLessons = CourseLesson::where('course_id', $course->id)->count();
			$totalVideoLength = CourseLesson::where('course_id', $course->id)->sum('video_length');

			/** @var \App\Models\Courses\Course $course */
			$course->update([
				'total_modules' => $course->course_relation_with_modules_count,
				'total_lessons' => $totalLessons,
				'total_video_length' => round($totalVideoLength, 2),
			]);
		}
		// */
		// self::syncVideoLengths();
		/*	// run the method to populate the quiz table with total question counts
			$quizzes = Quiz::withCount('quizRelationWith_questions')->get();

			foreach ($quizzes as $quiz) {
				$quiz->update([
					'total_questions' => $quiz->quiz_relation_with_questions_count,
				]);
			}
			// */

		return view('admin.sidebar.Courses.all_courses');
	}

	public function create()
	{
		$allCourses = Course::where('status', 1)->get();
		$instructors = CourseInstructor::where('status', 1)->get();
		$allLessons = CourseLesson::all();
		$allQuizzes = Quiz::where('status', 1)->get();

		return view('admin.sidebar.Courses.course_management', compact('allCourses', 'instructors', 'allLessons', 'allQuizzes'));
	}

	public function getModulesByCourse($courseId)
	{
		$modulesByCourse = Course::find($courseId)?->courseRelationWith_modules()->where('status', 1)->get(['id', 'title']) ?? collect();

		return response()->json($modulesByCourse);
	}

	public function getLessonsByModule($moduleId)
	{
		$lessonsByModule = CourseModule::find($moduleId)?->moduleRelationWith_lessons()->where('status', 1)->get(['id', 'title']) ?? collect();

		return response()->json($lessonsByModule);
	}

	public function store(Request $request)
	{
		// dd($request->all());
		$validated = $request->validate([
			'id' => 'nullable|integer|exists:courses,id', // when updating
			'flag' => 'required|string|in:create,update',
			'status' => 'nullable|boolean|in:0,1',

			'title' => 'required|string|max:255',
			'description' => 'nullable|string|max:2000',
			'what_to_learn' => 'nullable|string|max:2000',
			'banner_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:10485',
			'remove_image' => 'nullable|boolean',

			'total_modules' => 'nullable|numeric',
			'total_lessons' => 'nullable|numeric',
			'total_video_length' => 'nullable|numeric',
		]);

		try {
			$DISK_FOLDER = config('filesystems.default');
			$course = !empty($validated['id']) ? Course::findOrFail($validated['id']) : null;

			$COURSE_UID = $course ? $course->course_uid : UidGenerator::uniqueName($validated['title'], 24, 4);
			$imageFolder = "course-management/courses/{$COURSE_UID}";

			$validated['banner_image'] = ImageManagement::handleFile(
				$request->file('banner_image') ?? null,
				$validated['title'] ?? "no-title",
				$course->banner_image ?? null,
				// 'course-management/courses_head',
				$imageFolder,
				$DISK_FOLDER,
				$request->boolean('remove_image')
			);

			// Create or update
			if ($course) {
				$course->update([
					'title' => $validated['title'],
					'course_uid' => $COURSE_UID ?? null,
					'description' => $validated['description'] ?? null,
					'what_to_learn' => $validated['what_to_learn'] ?? null,
					'total_modules' => $validated['total_modules'] ?? 0,
					'total_lessons' => $validated['total_lessons'] ?? 0,
					'total_video_length' => $validated['total_video_length'] ?? 0,
					'banner_image' => $validated['banner_image'] ?? null,
					'status' => $validated['status'] ?? 1,
				]);
			} else {
				Course::create([
					'title' => $validated['title'],
					'course_uid' => $COURSE_UID ?? null,
					'description' => $validated['description'] ?? null,
					'what_to_learn' => $validated['what_to_learn'] ?? null,
					'total_modules' => $validated['total_modules'] ?? 0,
					'total_lessons' => $validated['total_lessons'] ?? 0,
					'total_video_length' => $validated['total_video_length'] ?? 0,
					'banner_image' => $validated['banner_image'] ?? null,
					'status' => $validated['status'] ?? 1,
				]);
			}

			return back()->with('success', 'Course saved successfully.');
		} catch (Exception $e) {
			return back()->with('error', 'Server error: ' . $e->getMessage())->withInput();
		}
	}

	public function show($id)
	{
		$singleCourse = Course::findOrFail($id);

		return view('admin.sidebar.Courses.courseEdit', compact('singleCourse'));
	}

	public function delete(Course $course)
	{
		try {
			$name = $course->title;
			$DISK_FOLDER = config('filesystems.default');
			$imageFolder = null;

			$imageFolder = dirname($course?->banner_image);

			if (!$imageFolder || $imageFolder === "" || $imageFolder === "." || empty($imageFolder)) {
				$imageFolder = "course-management/courses/{$course->course_uid}";
			}

			if ($imageFolder && !empty($imageFolder)) {
				ImageManagement::deleteFolder($imageFolder, $DISK_FOLDER);
			}
			$course->delete();

			return redirect()->back()->with('success', "Course '{$name}' deleted successfully!");
		} catch (Exception $e) {
			return back()->with('error', 'Server error: ' . $e->getMessage())->withInput();
		}
	}

	public function CourseListDataTable(Request $request)
	{
		$columns = ['id', 'title', 'description', 'banner_image', 'total_modules', 'total_lessons', 'total_video_length', 'status', 'created_at'];

		$draw = intval($request->input('draw'));
		$start = intval($request->input('start', 0));
		$length = intval($request->input('length', 25));
		$orderColIndex = $request->input('order.0.column', 0);
		$orderDir = $request->input('order.0.dir', 'asc');

		$orderCol = $columns[$orderColIndex] ?? 'id';
		$orderDir = in_array(strtolower($orderDir), ['asc', 'desc']) ? $orderDir : 'asc';

		$query = Course::query()->select($columns);

		if ($search = $request->input('search.value')) {
			$query->where(function ($q) use ($search) {
				$searchable = ['title', 'description', 'total_modules', 'total_lessons', 'total_video_length', 'status'];
				foreach ($searchable as $column) {
					$q->orWhere($column, 'like', "%{$search}%");
				}
			});
		}

		$recordsTotal = Course::count();
		$recordsFiltered = $query->count();

		$data = $query->orderBy($orderCol, $orderDir)->offset($start)->limit($length)->get();

		$sn = $start;

		$data->transform(function ($row) use (&$sn) {
			$sn++;
			$row->SN = $sn;

			$row->row_link = route('backend_courses_edit', $row->id); // redirect route on row click

			$stats = CourseStatistics::calculate($row);

			$row->statistics = '
				<div class="text-xs leading-4">
					<div><strong>Rating:</strong> ' . ($stats['average_rating'] ?? '0.0') . '</div>
					<div><strong>Enrolled:</strong> ' . ($stats['total_enrolled'] ?? 0) . '</div>
				</div>
			';

			$row->actions = '
				<div class="flex_xy_center gap-2">
					<button type="button" class="showButton" onclick="window.location.href=\'' . route('backend_all_courses') . '\'">
							' . \App\Helpers\IconPack::edit(['class' => 'iconPackItem w-3 h-3 text-gray-100']) . '
					</button>
					<form action="' . route('backend_courses_delete', $row->id) . '" 
								method="POST" 
								class="deleteForm">
							' . csrf_field() . '
							' . method_field('DELETE') . '
							<button type="submit" class="deleteButton">'
				. \App\Helpers\IconPack::trash(['class' => 'iconPackItem w-3 h-3 text-gray-100']) .
				'</button>
					</form>
				</div>
			';

			$row->total_video_length = isset($row->total_video_length) && $row->total_video_length > 0 ? (float)$row->total_video_length . ' min' : 'N/A';

			$row->status = $row->status
				? '<span class="px-2 py-1 text-xs rounded-lg bg-green-100 text-green-700">Active</span>'
				: '<span class="px-2 py-1 text-xs rounded-lg bg-red-100 text-red-700">Inactive</span>';

			if ($row->banner_image) {
				$url = Storage::url($row->banner_image);
				$row->banner_image_tag = '<img src="' . $url . '" alt="Banner" style="width:60px; height:60PX; border-radius:8px;">';
			} else {
				$row->banner_image_tag = '<span class="text-gray-400">No Image</span>';
			}

			if ($row->created_at) {
				try {
					$date = Carbon::parse($row->created_at)->timezone('Asia/Dhaka');
					$row->created_at_formatted = $date->format('d M Y, H:i') . ' UTC+6';
				} catch (Exception $e) {
					$row->created_at_formatted = 'Invalid Date';
				}
			}
			$row->makeHidden(['created_at']);

			return $row;
		});

		return response()->json([
			'draw' => $draw,
			'recordsTotal' => $recordsTotal,
			'recordsFiltered' => $recordsFiltered,
			'data' => $data,
		]);
	}

	public static function syncVideoLengths()
	{
		// Update modules
		$modules = CourseModule::with('moduleRelationWith_lessons')->get();
		foreach ($modules as $module) {
			$totalMinutes = $module->moduleRelationWith_lessons->sum('video_length'); // sum in minutes
			$module->update([
				'total_video_length' => round($totalMinutes, 2), // convert to hours as float
				// 'total_video_length' => round($totalMinutes / 60, 2), // convert to hours as float
			]);
		}

		// Update courses
		$courses = Course::with('courseRelationWith_lessons')->get();
		foreach ($courses as $course) {
			$totalMinutes = $course->courseRelationWith_lessons->sum('video_length'); // sum in minutes
			$course->update([
				'total_video_length' => round($totalMinutes, 2), // convert to hours as float
				// 'total_video_length' => round($totalMinutes / 60, 2), // convert to hours as float
			]);
		}

		return "Video lengths synced successfully!";
	}
}
