<?php

namespace App\Http\Controllers\Admin\Sidebar\Courses;

use App\Helpers\ImageManagement;
use App\Helpers\NewFileManagement;
use App\Http\Controllers\Controller;
use App\Models\Courses\Course;
use App\Models\Courses\CourseModule;
use App\Models\Quizzes\Quiz;
use App\Models\Webpages\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ModuleController extends Controller
{

	// the default values and dropdown data is coming from CourseModule::allCourses()

	public function moduleStore(Request $request)
	{
		// dd($request->all());
		$validated = $request->validate([
			'id' => 'nullable|integer|exists:course_modules,id',
			'course_id' => 'required|integer|exists:courses,id',
			'status' => 'nullable|boolean|in:0,1',

			'title' => 'required|string|max:255',
			'description' => 'nullable|string|max:2000',

			'total_lessons' => 'nullable|numeric',
			'total_video_length' => 'nullable|numeric',

			'quiz_id' => 'nullable|integer|exists:quizzes,id',
			'quiz_eligible' => 'nullable|string|max:30',
		], [
			'description.max' => "The description field must not be greater than 2000 characters. Use 'Ctrl+Shift+V' for copy-pasting or choose plain text."
		]);

		try {
			$module = !empty($validated['id']) ? CourseModule::findOrFail($validated['id']) : null;

			$oldCourseId = $module ? $module->course_id : null;

			if ($module) {
				$module->update([
					'course_id' => $validated['course_id'],

					'title' => $validated['title'],
					'description' => $validated['description'] ?? null,

					'total_lessons' => $validated['total_lessons'] ?? 0,
					'total_video_length' => $validated['total_video_length'] ?? 0,

					'quiz_id' => $validated['quiz_id'] ?? null,
					'quiz_eligible' => $validated['quiz_eligible'] ?? "last",

					'status' => $validated['status'] ?? 1,
				]);
			} else {
				$module = CourseModule::create([
					'course_id' => $validated['course_id'],
					'title' => $validated['title'],
					'description' => $validated['description'] ?? null,
					'quiz_id' => $validated['quiz_id'] ?? null,
					'quiz_eligible' => $validated['quiz_eligible'] ?? "last",
				]);

				$course = Course::withCount('courseRelationWith_modules')->find($module->course_id);
				if ($course) {
					$course->update([
						'total_modules' => $course->course_relation_with_modules_count,
					]);
				}
			}

			if (!empty($oldCourseId) && $oldCourseId != $module->course_id) {
				$oldCourse = Course::withCount('courseRelationWith_modules')->find($oldCourseId);
				if ($oldCourse) {
					$oldCourse->update([
						'total_modules' => $oldCourse->course_relation_with_modules_count,
					]);
				}
			}

			$newCourse = Course::withCount('courseRelationWith_modules')->find($module->course_id);

			if ($newCourse) {
				$newCourse->update([
					'total_modules' => $newCourse->course_relation_with_modules_count,
				]);
			}

			return back()->with('success', 'Module saved successfully.');
		} catch (\Exception $e) {
			return back()->with('error', 'Server error: ' . $e->getMessage())->withInput();
		}
	}


	public function editModule($id)
	{
		$allCourses = Course::where('status', 1)->get();
		$singleModule = CourseModule::with('courseModuleRelatingBackTo_course')->findOrFail($id);
		$allQuizzes = Quiz::where('status', 1)->get();

		return view('admin.sidebar.Courses.modules.moduleEdit', compact('allCourses', 'singleModule', 'allQuizzes'));
	}


	public function deleteModule(CourseModule $module)
	{
		$courseId = $module->course_id;
		$DISK_FOLDER = config('filesystems.default');

		// ImageManagement::deleteFile($module->banner_image, 'public');
		NewFileManagement::deleteFile($module->banner_image, $DISK_FOLDER);

		$module->moduleRelationWith_lessons()->each(function ($lesson) use ($DISK_FOLDER) {
			NewFileManagement::deleteFile($lesson->banner_image, $DISK_FOLDER);
			NewFileManagement::deleteFile($lesson->video, $DISK_FOLDER);

			// Nested closure also needs it
			$lesson->courseLessonRelatonWith_resource()->each(function ($resource) use ($DISK_FOLDER) {
				NewFileManagement::deleteFile($resource->file, $DISK_FOLDER);
			});
		});


		$module->delete();

		// Update course module count
		if ($courseId) {
			$course = Course::withCount('courseRelationWith_modules')->find($courseId);
			if ($course) {
				$course->update([
					'total_modules' => $course->course_relation_with_modules_count,
				]);
			}
		}

		return redirect()->back()->with('success', "Module deleted successfully!");
	}


	public function allModules()
	{
		// Sync lesson counts for each module
		$modules = CourseModule::withCount([
			'moduleRelationWith_lessons' => function ($q) {
				$q->where('status', 1); // count only active lessons
			}
		])->get();

		// foreach ($modules as $module) {
		// 	if ($module->total_lessons !== $module->course_module_relation_with_lessons_count) {
		// 		$module->update(['total_lessons' => $module->course_module_relation_with_lessons_count]);
		// 	}
		// }
		// dd();

		return view('admin.sidebar.Courses.modules.all_modules', compact('modules'));
	}


	public function ModuleListDataTable(Request $request)
	{
		$columns = ['id', 'course_id', 'title', 'description', 'total_lessons', 'total_video_length', 'quiz_id', 'quiz_eligible', 'status', 'created_at'];

		$draw = intval($request->input('draw'));
		$start = intval($request->input('start', 0));
		$length = intval($request->input('length', 25));
		$orderColIndex = $request->input('order.0.column', 0);
		$orderDir = $request->input('order.0.dir', 'asc');

		$orderCol = $columns[$orderColIndex] ?? 'id';
		$orderDir = in_array(strtolower($orderDir), ['asc', 'desc']) ? $orderDir : 'asc';

		// Ensure course_id is included in select()
		$query = CourseModule::with('courseModuleRelatingBackTo_course')
			->select($columns);

		// Search
		if ($search = $request->input('search.value')) {
			$query->where(function ($q) use ($search) {
				$searchable = ['title', 'description', 'total_lessons', 'total_video_length', 'status'];
				foreach ($searchable as $column) {
					$q->orWhere($column, 'like', "%{$search}%");
				}
				// Search by course title
				$q->orWhereHas('courseModuleRelatingBackTo_course', function ($q2) use ($search) {
					$q2->where('title', 'like', "%{$search}%");
				});
			});
		}

		$recordsTotal = CourseModule::count();
		$recordsFiltered = $query->count();

		$modules = $query->orderBy($orderCol, $orderDir)
			->offset($start)
			->limit($length)
			->get();

		$sn = $start;

		$modules->transform(function ($row) use (&$sn) {
			$sn++;
			$row->SN = $sn;

			$row->row_link = route('backend_module_edit', $row->id);

			$row->actions = '
            <div class="flex_xy_center gap-2">
                <button type="button" class="showButton" onclick="window.location.href=\'' . route('backend_module_edit', $row->id) . '\'">
                    ' . \App\Helpers\IconPack::edit(['class' => 'iconPackItem w-3 h-3 text-gray-100']) . '
                </button>
                <form action="' . route('backend_module_delete', $row->id) . '" method="POST" class="deleteForm">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="deleteButton">'
				. \App\Helpers\IconPack::trash(['class' => 'iconPackItem w-3 h-3 text-gray-100']) .
				'</button>
                </form>
            </div>
        ';

			$row->course_title = $row->courseModuleRelatingBackTo_course?->title ?? '<span class="text-gray-400">No CourseModule</span>';
			// $row->quiz_eligible = $row->quiz_eligible ? 'Yes' : 'No';

			$row->status = $row->status
				? '<span class="px-2 py-1 text-xs rounded-lg bg-green-100 text-green-700">Active</span>'
				: '<span class="px-2 py-1 text-xs rounded-lg bg-red-100 text-red-700">Inactive</span>';

			if ($row->created_at) {
				$date = Carbon::parse($row->created_at)->timezone('Asia/Dhaka');
				$row->created_at_formatted = $date->format('d M Y, H:i') . ' UTC+6';
			}

			$row->makeHidden(['created_at', 'courseModuleRelatingBackTo_course']);

			return $row;
		});

		return response()->json([
			'draw' => $draw,
			'recordsTotal' => $recordsTotal,
			'recordsFiltered' => $recordsFiltered,
			'data' => $modules,
		]);
	}
}
