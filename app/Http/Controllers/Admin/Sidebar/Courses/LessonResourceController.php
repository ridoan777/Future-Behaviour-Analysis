<?php

namespace App\Http\Controllers\Admin\Sidebar\Courses;

use App\Helpers\NewFileManagement;
use App\Http\Controllers\Controller;
use App\Models\Courses\Course;
use App\Models\Courses\CourseLessonResource;
use App\Models\Courses\CourseModule;
use App\Models\Courses\CourseLesson;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class LessonResourceController extends Controller
{

	public function storeResource(Request $request)
	{
		$validated = $request->validate([
			'lesson_id' => 'required|integer|exists:course_lessons,id',
			'status' => 'nullable|boolean|in:0,1',

			'title' => 'required|array',
			'title.*' => 'required|string|max:255',

			'note' => 'nullable|array',
			'note.*' => 'nullable|string|max:2000',

			'file' => 'nullable|array',
			'file.*' => 'nullable|file|mimes:pdf,txt,doc,docx,xls,xlsx,csv|max:10485760', // max 10MB
		]);

		try {
			$lessonId = (int)$validated['lesson_id'];
			$DISK_FOLDER = config('filesystems.default');
			$lesson = CourseLesson::findOrFail($lessonId);
			$course = $lesson?->courseLessonRelatingBackTo_course;

			foreach ($validated['title'] as $index => $resourceTitle) {
				$resourceNote = $validated['note'][$index] ?? null;
				$resourceFile = $request->file('file')[$index] ?? null;
				$resourceId = $validated['resource_id'][$index] ?? null;

				$filePath = null;

				$sizeInBytes = $resourceFile->getSize();
				if ($sizeInBytes < 1048576) {
					$sizeFormatted = round($sizeInBytes / 1024, 2) . " KB";
				} else {
					$sizeFormatted = round($sizeInBytes / 1048576, 3) . " MB";
				}
				$meta = $resourceFile->getClientOriginalExtension() . "|" . $sizeFormatted;

				// $imageFolder = "course-management/courses/{$course->course_uid}/lesson-files/{$sanitizeCourseName}";
				$imageFolder = "course-management/courses/{$request->course_uid}/lesson-files/{$request->lesson_uid}/lesson-resources/";

				if ($resourceId) {
					$resource = CourseLessonResource::findOrFail($resourceId);

					$filePath = NewFileManagement::handleFile(
						$resourceFile,
						$resourceTitle,
						$resource->file, // replace old file if new one uploaded
						$imageFolder,	// 'course-management/lesson-resources',
						$DISK_FOLDER,
						false
					);

					$resource->update([
						'title' => $resourceTitle,
						'note' => $resourceNote,
						'file' => $filePath ?? $resource->file, // keep old if no new file
						'meta' => $meta,
						'status' => $validated['status'] ?? 1,
					]);

				} else {
					$filePath = NewFileManagement::handleFile(
						$resourceFile,
						$resourceTitle,
						null,
						'course-management/lesson-resources',
						$DISK_FOLDER,
						false
					);

					CourseLessonResource::create([
						'lesson_id' => $lessonId,
						'title' => $resourceTitle,
						'note' => $resourceNote,
						'file' => $filePath,
						'meta' => $meta,
						'status' => $validated['status'] ?? 1,
					]);
				}
			}

			return redirect()->back()->with('success', 'Resources saved successfully.');

		} catch (\Exception $e) {
			return redirect()->back()->withErrors(['error' => $e->getMessage()]);
		}
	}


	public function editResource($resourceId)
	{
		$singleResource = CourseLessonResource::with('lessonResourceRelatingBackTo_lesson')->findOrFail($resourceId);

		$singleLesson = $singleResource->lessonResourceRelatingBackTo_lesson;

		$allCourses = Course::all();
		$allModules = CourseModule::all();
		$allLessons = CourseLesson::all();

		// $allModules = CourseModule::where('course_id', $singleLesson->course_id)->get();

		return view(
			'admin.sidebar.Courses.lesson_resources.lesson_resourcesEdit',
			compact('allCourses', 'allModules', 'allLessons', 'singleLesson', 'singleResource')
		);
	}


	public function updateResource(Request $request, $id)
	{
		// Fetch the resource
		$resource = CourseLessonResource::findOrFail($id);

		// Validate input
		$validated = $request->validate([
			'title' => 'required|string|max:255',
			'note' => 'nullable|string|max:2000',
			'file' => 'nullable|file|mimes:pdf,txt,doc,docx,xls,xlsx,csv|max:10485760',
			'status' => 'nullable|boolean|in:0,1',
			'lesson_id' => 'required|integer|exists:course_lessons,id', // Optional if you allow changing lesson
		]);

		$filePath = $resource->file; // default to existing file
		$meta = $resource->meta;

		// Handle file upload if present
		if ($request->hasFile('file')) {
			$resourceFile = $request->file('file');

			// Calculate size
			$sizeInBytes = $resourceFile->getSize();
			$sizeFormatted = $sizeInBytes < 1048576
				? round($sizeInBytes / 1024, 2) . " KB"
				: round($sizeInBytes / 1048576, 3) . " MB";

			// Set meta
			$meta = $resourceFile->getClientOriginalExtension() . "|" . $sizeFormatted;

			// Handle file storage & replace old file
			$filePath = NewFileManagement::handleFile(
				$resourceFile,
				$validated['title'],
				$resource->file,
				'course-management/lesson-resources',
				'public',
				false
			);
		}

		// Update resource
		$resource->update([
			'lesson_id' => $validated['lesson_id'] ?? $resource->lesson_id,
			'title' => $validated['title'],
			'note' => $validated['note'] ?? null,
			'file' => $filePath,
			'meta' => $meta,
			'status' => $validated['status'] ?? 1,
		]);

		return redirect()->back()->with('success', 'Resource updated successfully.');
	}



	public function deleteResource(Request $request, $id)
	{
		try {
			// Find the resource or fail
			$resource = CourseLessonResource::findOrFail($id);

			// Delete the file from storage if it exists
			if ($resource->file) {
				NewFileManagement::deleteFile($resource->file, 'public');
			}

			// Delete the resource record from database
			$resource->delete();

			return redirect()->back()->with('success', 'Resource deleted successfully.');

		} catch (\Exception $e) {
			return redirect()->back()->withErrors(['error' => $e->getMessage()]);
		}
	}



	public function allLessonResources()
	{
		return view('admin.sidebar.Courses.lesson_resources.all_lesson_resources');
	}


	public function LessonsListDataTable(Request $request)
	{
		$columns = ['id', 'course_id', 'module_id', 'instructor_id', 'title', 'description', 'transcript_text', 'banner_image', 'video', 'video_length', 'status', 'created_at'];

		$draw = intval($request->input('draw'));
		$start = intval($request->input('start', 0));
		$length = intval($request->input('length', 25));
		$orderColIndex = $request->input('order.0.column', 0);
		$orderDir = $request->input('order.0.dir', 'asc');

		$orderCol = $columns[$orderColIndex] ?? 'id';
		$orderDir = in_array(strtolower($orderDir), ['asc', 'desc']) ? $orderDir : 'asc';

		$query = CourseLesson::with([
			'courseLessonRelatingBackTo_course',
			'courseLessonRelatingBackTo_module',
			'courseLessonRelatingBackTo_instructor'
		])->select($columns);

		// Search
		if ($search = $request->input('search.value')) {
			$query->where(function ($q) use ($search) {
				$searchable = ['title', 'description', 'transcript_text', 'status'];
				foreach ($searchable as $column) {
					$q->orWhere($column, 'like', "%{$search}%");
				}
				$q->orWhereHas('courseLessonRelatingBackTo_course', fn($q2) => $q2->where('title', 'like', "%{$search}%"));
				$q->orWhereHas('courseLessonRelatingBackTo_module', fn($q2) => $q2->where('title', 'like', "%{$search}%"));
				$q->orWhereHas('courseLessonRelatingBackTo_instructor', fn($q2) => $q2->where('name', 'like', "%{$search}%"));
			});
		}

		$recordsTotal = CourseLesson::count();
		$recordsFiltered = $query->count();

		$lessons = $query->orderBy($orderCol, $orderDir)
			->offset($start)
			->limit($length)
			->get();

		$sn = $start;

		$lessons->transform(function ($row) use (&$sn) {
			$sn++;
			$row->SN = $sn;

			$row->row_link = route('backend_lesson_edit', $row->id);

			$row->actions = '
			<div class="flex_xy_center gap-2">
				<button type="button" class="showButton" onclick="window.location.href=\'' . route('backend_lesson_edit', $row->id) . '\'">
					' . \App\Helpers\IconPack::edit(['class' => 'iconPackItem w-3 h-3 text-gray-100']) . '
				</button>
				<form action="' . route('backend_lesson_delete', $row->id) . '" method="POST" class="deleteForm">
					' . csrf_field() . method_field('DELETE') . '
					<button type="submit" class="deleteButton">'
				. \App\Helpers\IconPack::trash(['class' => 'iconPackItem w-3 h-3 text-gray-100']) .
				'</button>
				</form>
			</div>
		';

			$row->course_title = $row->courseLessonRelatingBackTo_course?->title ?? '<span class="text-gray-400">No Course</span>';
			$row->module_title = $row->courseLessonRelatingBackTo_module?->title ?? '<span class="text-gray-400">No Module</span>';
			$row->instructor_name = $row->courseLessonRelatingBackTo_instructor?->name ?? '<span class="text-gray-400">No Instructor</span>';

			// Banner
			if ($row->banner_image) {
				$url = Storage::url($row->banner_image);
				$row->banner_image_tag = '<img src="' . $url . '" alt="Banner" style="width:60px; height:60px; border-radius:8px;">';
			} else {
				$row->banner_image_tag = '<span class="text-gray-400">No Image</span>';
			}

			$row->video_duration = isset($row->video_length) && $row->video_length > 0 ? (int)$row->video_length . ' min' : 'N/A';


			// if ($row->video) {
			// 	$filePath = storage_path('app/public/' . $row->video);

			// 	$row->video_duration = ImageManagement::videoDuration($filePath);
			// } else {
			// 	$row->video_duration = "N/A";
			// }


			$row->status = $row->status
				? '<span class="px-2 py-1 text-xs rounded-lg bg-green-100 text-green-700">Active</span>'
				: '<span class="px-2 py-1 text-xs rounded-lg bg-red-100 text-red-700">Inactive</span>';

			if ($row->created_at) {
				$date = Carbon::parse($row->created_at)->timezone('Asia/Dhaka');
				$row->created_at_formatted = $date->format('d M Y, H:i') . ' UTC+6';
			}

			$row->makeHidden([
				'created_at',
				'courseLessonRelatingBackTo_course',
				'courseLessonRelatingBackTo_module',
				'courseLessonRelatingBackTo_instructor'
			]);

			return $row;
		});

		return response()->json([
			'draw' => $draw,
			'recordsTotal' => $recordsTotal,
			'recordsFiltered' => $recordsFiltered,
			'data' => $lessons,
		]);
	}
}
