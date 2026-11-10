<?php

namespace App\Http\Controllers\Admin\Sidebar\Courses;

use App\Helpers\{ExceptionHandling, NewFileManagement, UidGenerator};
use App\Http\Controllers\Controller;
use App\Models\Courses\{Course, CourseInstructor, CourseLessonResource, CourseModule, CourseLesson};
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\{Carbon, Str};
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Throwable;

class LessonController extends Controller
{
	public function index()
	{
		return view('admin.sidebar.Courses.lessons.all_lessons');
	}

	public function storeOld(Request $request)
	{
		$validated = $request->validate([
			'id' => 'nullable|integer|exists:course_lessons,id',
			'course_id' => 'required|integer|exists:courses,id',
			'module_id' => 'required|integer|exists:course_modules,id',
			'instructor_id' => 'nullable|integer|exists:course_instructors,id',
			'status' => 'nullable|boolean|in:0,1',

			'lesson_time' => 'required|integer|max:600',
			'title' => 'required|string|max:255',
			'description' => 'nullable|string|max:2000',
			'transcript_text' => 'nullable|string',

			'banner_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:10485',	// it's kb, not bytes
			'remove_image' => 'nullable|boolean',
			// 'video' => 'nullable|file|mimes:mp4,mov,3gp,avi|max:10485760',
			'video' => 'nullable|string',
			'remove_video' => 'nullable|boolean',
		], [
			'description.max' => "The description field must not be greater than 2000 characters. Use 'Ctrl+Shift+V' for copy-pasting or choose plain text."
		]);

		try {
			$DISK_FOLDER = config('filesystems.default');

			$existingLesson = !empty($validated['id']) ? CourseLesson::findOrFail($validated['id']) : null;
			$oldCourseId = $existingLesson ? $existingLesson->course_id : null;
			$course = Course::findOrFail((int)$validated['course_id']);

			$sanitizeLessonName = UidGenerator::sanitizeName($validated['title']);

			$LESSON_UID = NULL;
			if ($existingLesson) {
				$LESSON_UID = $existingLesson?->lesson_uid;
			} else {
				$LESSON_UID = UidGenerator::uniqueName($validated['title'], 18, 4);
			}
			$imageFolder = "course-management/courses/{$course->course_uid}/lesson-files/{$LESSON_UID}";

			// Handle banner image
			$validated['banner_image'] = NewFileManagement::handleFile(
				$request->file('banner_image'),
				$validated['title'] ?? 'no-title',
				$existingLesson->banner_image ?? null,
				// "course-management/lesson-files/{$sanitizeLessonName}",
				$imageFolder,
				$DISK_FOLDER,
				$request->boolean('remove_image')
			);

			// Handle video
			$validated['video'] = NewFileManagement::handleFile(
				$request->file('video'),
				$validated['title'] ?? 'no-title',
				$existingLesson->video ?? null,
				// "course-management/lesson-files/{$sanitizeLessonName}/videos",
				$imageFolder,
				$DISK_FOLDER,
				$request->boolean('remove_video')
			);

			// Calculate video length in minutes
			$validated['video_length'] = 0;
			if ($request->filled('video')) {
				$validated['video'] = $request->input('video');
			} else {
				$validated['video'] = $existingLesson->video ?? null;
			}
			// if ($validated['video']) {
			// 	$disk = config('filesystems.default');
			// 	$videoLengthMinutes = NewFileManagement::videoDuration($validated['video'], $disk);
			// 	$validated['video_length'] = is_numeric($videoLengthMinutes) ? $videoLengthMinutes : 0;
			// } else {
			// 	$validated['video_length'] = 0;
			// }

			// Create or update lesson
			if ($existingLesson) {
				$existingLesson->update([
					'course_id' => $validated['course_id'],
					'module_id' => $validated['module_id'],
					'instructor_id' => $validated['instructor_id'],
					'lesson_time' => (int)$validated['lesson_time'],
					'title' => $validated['title'],
					'description' => $validated['description'] ?? null,
					'transcript_text' => $validated['transcript_text'] ?? null,
					'banner_image' => $validated['banner_image'] ?? null,
					'video' => $validated['video'] ?? null,
					'video_length' => $validated['video_length'] ?? $existingLesson->video_length,
					'status' => $validated['status'] ?? 1,
				]);
			} else {
				$existingLesson = CourseLesson::create([
					'lesson_uid' => $LESSON_UID ?? null,
					'course_id' => $validated['course_id'],
					'module_id' => $validated['module_id'],
					'instructor_id' => $validated['instructor_id'],
					'lesson_time' => (int)$validated['lesson_time'],
					'title' => $validated['title'],
					'description' => $validated['description'] ?? null,
					'transcript_text' => $validated['transcript_text'] ?? null,
					'banner_image' => $validated['banner_image'] ?? null,
					'video' => $validated['video'] ?? null,
					'video_length' => $validated['video_length'] ?? null,
					'status' => $validated['status'] ?? 1,
				]);
			}

			// Update module totals
			$module = CourseModule::withCount('moduleRelationWith_lessons')->find($existingLesson->module_id);
			if ($module) {
				$module->update([
					'total_lessons' => $module->module_relation_with_lessons_count,
					'total_video_length' => round(CourseLesson::where('module_id', $existingLesson->module_id)->sum('video_length'), 2),
				]);
			}

			// Update course totals
			$course = Course::withCount('courseRelationWith_lessons')->find($existingLesson->course_id);
			if ($course) {
				$course->update([
					'total_lessons' => $course->course_relation_with_lessons_count,
					'total_video_length' => round(CourseLesson::where('course_id', $existingLesson->course_id)->sum('video_length'), 2),
				]);
			}

			// Update old course totals if lesson moved
			if (!empty($oldCourseId) && $oldCourseId != $existingLesson->course_id) {
				$oldCourse = Course::find($oldCourseId);
				if ($oldCourse) {
					$oldCourse->update([
						'total_lessons' => CourseLesson::where('course_id', $oldCourseId)->count(),
						'total_video_length' => round(CourseLesson::where('course_id', $oldCourseId)->sum('video_length'), 2),
					]);
				}
			}

			return back()->with('success', 'Lesson saved successfully.');
		} catch (Exception $e) {
			return back()->with('error', 'Server error: ' . $e->getMessage())->withInput();
		}
	}

	public function store(Request $request)
	{
		$validated = $request->validate([
			'id' => 'nullable|integer|exists:course_lessons,id',
			'course_id' => 'required|integer|exists:courses,id',
			'module_id' => 'required|integer|exists:course_modules,id',
			'instructor_id' => 'nullable|integer|exists:course_instructors,id',
			'lesson_uid' => 'nullable|string|max:100',
			'status' => 'nullable|boolean|in:0,1',

			'lesson_time' => 'required|integer|max:600',
			'title' => 'required|string|max:255',
			'description' => 'nullable|string|max:2000',
			'transcript_text' => 'nullable|string',

			'banner_image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:10485',	// it's kb, not bytes
			'remove_image' => 'nullable|boolean',
			// 'video' => 'nullable|file|mimes:mp4,mov,3gp,avi|max:10485760',
			'video' => 'nullable|string',
			'remove_video' => 'nullable|boolean',
		], [
			'description.max' => "The description field must not be greater than 2000 characters. Use 'Ctrl+Shift+V' for copy-pasting or choose plain text."
		]);

		try {
			$DISK_FOLDER = config('filesystems.default');

			$existingLesson = !empty($validated['id']) ? CourseLesson::findOrFail($validated['id']) : null;
			$oldCourseId = $existingLesson ? $existingLesson->course_id : null;
			$course = Course::findOrFail((int)$validated['course_id']);

			$sanitizeLessonName = UidGenerator::sanitizeName($validated['title']);

			// ---------------- CHUNKING ON EFFECT ----------------
			$LESSON_UID = $existingLesson ? $existingLesson->lesson_uid : ($validated['lesson_uid'] ?? UidGenerator::uniqueName($validated['title'], 18, 4));

			$imageFolder = "course-management/courses/{$course->course_uid}/lesson-files/{$LESSON_UID}";

			$validated['banner_image'] = NewFileManagement::handleFile(
				$request->file('banner_image'),
				$validated['title'] ?? 'no-title',
				$existingLesson->banner_image ?? null,
				$imageFolder,
				$DISK_FOLDER,
				$request->boolean('remove_image')
			);

			if ($request->boolean('remove_video')) {
				if (!empty($existingLesson->video)) {
					$disk = Storage::disk($DISK_FOLDER);
					if ($disk->exists($existingLesson->video)) {
						$disk->delete($existingLesson->video);
					}
				}
				$validated['video'] = null;
				$validated['video_length'] = 0;
			} else {
				$newVideoPath = $request->filled('video') ? $request->input('video') : null;

				if ($newVideoPath && str_contains($newVideoPath, '/temp/')) {
					$disk = Storage::disk($DISK_FOLDER);
					$permanentPath = str_replace('/temp/', '/', $newVideoPath);

					// -------------- delete old video from permanent location first --------------
					if ($existingLesson && !empty($existingLesson->video) && $disk->exists($existingLesson->video)) {
						$disk->delete($existingLesson->video);
					}

					// -------------- move temp file to permanent location --------------
					$disk->move($newVideoPath, $permanentPath);
					$newVideoPath = $permanentPath;

					// -------------- clean up temp folder --------------
					$tempFolder = dirname($newVideoPath) . '/../temp';
					// dirname gives permanent folder, go up then into temp — use string manipulation instead:
					$tempFolder = "course-management/courses/{$course->course_uid}/lesson-files/{$LESSON_UID}/temp";
					if ($disk->exists($tempFolder)) {
						$disk->deleteDirectory($tempFolder);
					}
				}

				$validated['video'] = $newVideoPath ?? ($existingLesson->video ?? null);
			}
			// ---------------- CHUNKING ON EFFECT ----------------

			// Create or update lesson

			if ($existingLesson) {
				$existingLesson->update([
					'course_id' => $validated['course_id'],
					'module_id' => $validated['module_id'],
					'instructor_id' => $validated['instructor_id'],
					'lesson_time' => (int)$validated['lesson_time'],
					'title' => $validated['title'],
					'description' => $validated['description'] ?? null,
					'transcript_text' => $validated['transcript_text'] ?? null,
					'banner_image' => $validated['banner_image'] ?? null,
					'video' => $validated['video'] ?? null,
					'video_length' => $validated['video_length'] ?? $existingLesson->video_length,
					'status' => $validated['status'] ?? 1,
				]);
			} else {
				$existingLesson = CourseLesson::create([
					'lesson_uid' => $LESSON_UID ?? null,
					'course_id' => $validated['course_id'],
					'module_id' => $validated['module_id'],
					'instructor_id' => $validated['instructor_id'],
					'lesson_time' => (int)$validated['lesson_time'],
					'title' => $validated['title'],
					'description' => $validated['description'] ?? null,
					'transcript_text' => $validated['transcript_text'] ?? null,
					'banner_image' => $validated['banner_image'] ?? null,
					'video' => $validated['video'] ?? null,
					'video_length' => $validated['video_length'] ?? null,
					'status' => $validated['status'] ?? 1,
				]);
			}

			// ----------------- DELETE FOLDER IF EMPTY -----------------
			$disk = Storage::disk($DISK_FOLDER);
			$lessonFolder = "course-management/courses/{$course->course_uid}/lesson-files/{$LESSON_UID}";
			$dbHasNoVideo = empty($existingLesson->fresh()->video);
			$dbHasNoImage = empty($existingLesson->fresh()->banner_image);

			if ($dbHasNoVideo && $dbHasNoImage) {
				if ($disk->exists($lessonFolder)) {

					// -------------- ADDED: clean up any empty subfolders first
					//                temp/ left by failed discard, resource/ emptied by resource deletion, etc. --------------
					foreach ($disk->directories($lessonFolder) as $subFolder) {
						$subFiles = $disk->files($subFolder);
						$subDirs = $disk->directories($subFolder);
						if (empty($subFiles) && empty($subDirs)) {
							$disk->deleteDirectory($subFolder);
						}
					}

					// -------------- then check if parent is now empty too --------------
					$remainingFiles = $disk->files($lessonFolder);
					$remainingDirectories = $disk->directories($lessonFolder);
					if (empty($remainingFiles) && empty($remainingDirectories)) {
						$disk->deleteDirectory($lessonFolder);
					}
				}
			}
			// ----------------- DELETE FOLDER IF EMPTY -----------------

			// Update module totals
			$module = CourseModule::withCount('moduleRelationWith_lessons')->find($existingLesson->module_id);
			if ($module) {
				$module->update([
					'total_lessons' => $module->module_relation_with_lessons_count,
					'total_video_length' => round(CourseLesson::where('module_id', $existingLesson->module_id)->sum('video_length'), 2),
				]);
			}

			// Update course totals
			$course = Course::withCount('courseRelationWith_lessons')->find($existingLesson->course_id);
			if ($course) {
				$course->update([
					'total_lessons' => $course->course_relation_with_lessons_count,
					'total_video_length' => round(CourseLesson::where('course_id', $existingLesson->course_id)->sum('video_length'), 2),
				]);
			}

			// Update old course totals if lesson moved
			if (!empty($oldCourseId) && $oldCourseId != $existingLesson->course_id) {
				$oldCourse = Course::find($oldCourseId);
				if ($oldCourse) {
					$oldCourse->update([
						'total_lessons' => CourseLesson::where('course_id', $oldCourseId)->count(),
						'total_video_length' => round(CourseLesson::where('course_id', $oldCourseId)->sum('video_length'), 2),
					]);
				}
			}

			return back()->with('success', 'Lesson saved successfully.');
		} catch (Exception $e) {
			return back()->with('error', 'Server error: ' . $e->getMessage())->withInput();
		}
	}

	public function show($id)
	{
		$allCourses = Course::all();

		$singleLesson = CourseLesson::with(['courseLessonRelatingBackTo_course', 'courseLessonRelatingBackTo_module'])->findOrFail($id);

		$allModules = CourseModule::where('course_id', $singleLesson->course_id)->get();

		$allInstructors = CourseInstructor::all();

		$allResources = CourseLessonResource::where('lesson_id', $id)->get();

		return view('admin.sidebar.Courses.lessons.lessonEdit', compact('allCourses', 'allModules', 'allInstructors', 'singleLesson', 'allResources'));
	}

	public function delete(CourseLesson $lesson)
	{
		$courseId = $lesson->course_id;
		$moduleId = $lesson->module_id;
		$DISK_FOLDER = config('filesystems.default');
		$imageFolder = dirname($lesson->banner_image ?? $lesson->video ?? null);

		NewFileManagement::deleteFile($lesson->banner_image, $DISK_FOLDER);
		NewFileManagement::deleteFile($lesson->video, $DISK_FOLDER);
		if ($imageFolder) {
			NewFileManagement::deleteFolder($imageFolder, $DISK_FOLDER);
		}

		// Delete all resource files
		$lesson->courseLessonRelatonWith_resource()->each(function ($resource) use ($DISK_FOLDER) {
			NewFileManagement::deleteFile($resource->file, $DISK_FOLDER);
		});

		$lesson->delete();

		// Update module counts
		if ($moduleId) {
			$module = CourseModule::withCount('moduleRelationWith_lessons')->with('moduleRelationWith_lessons')->find($moduleId);

			if ($module) {
				$totalMinutes = $module->moduleRelationWith_lessons->sum('video_length');
				$module->update([
					'total_lessons' => $module->module_relation_with_lessons_count,
					'total_video_length' => round($totalMinutes / 60, 2),
				]);
			}
		}

		// Update course counts
		if ($courseId) {
			$course = Course::withCount('courseRelationWith_lessons')->with('courseRelationWith_lessons')->find($courseId);

			if ($course) {
				$totalMinutes = $course->courseRelationWith_lessons->sum('video_length');
				$course->update([
					'total_lessons' => $course->course_relation_with_lessons_count,
					'total_video_length' => round($totalMinutes / 60, 2),
				]);
			}
		}

		return redirect()->back()->with('success', "Lesson deleted successfully!");
	}

	public function LessonsListDataTable(Request $request)
	{
		$columns = ['id', 'lesson_uid', 'course_id', 'module_id', 'instructor_id', 'title', 'description', 'transcript_text', 'banner_image', 'video', 'video_length', 'status', 'created_at'];

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

		$lessons = $query->orderBy($orderCol, $orderDir)->offset($start)->limit($length)->get();

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

			$row->course_title = '<div>
				<p class=" text-xs">DB ID: ' . ($row?->courseLessonRelatingBackTo_course?->id ?? "No ID") . '</p>
				<p class="">' . ($row?->courseLessonRelatingBackTo_course?->title ?? "No Title") . '</p>
			</div>';

			$row->module_title = '<div>
				<p class=" text-xs">DB ID: ' . ($row?->courseLessonRelatingBackTo_module?->id ?? "No ID") . '</p>
				<p class="">' . ($row?->courseLessonRelatingBackTo_module?->title ?? "No Title") . '</p>
			</div>';

			$row->instructor_name = '<div class="flex justify-between items-center">
				<div><img src="' . ($row?->courseLessonRelatingBackTo_instructor?->display_picture ? Storage::url($row?->courseLessonRelatingBackTo_instructor?->display_picture) : asset('./site_assets/dummies/dummy_man.webp')) . '" class="w-12 h-12 rounded-lg"></div>
				<div class="min-w-32">
					<p class=" text-xs">DB ID: ' . ($row?->courseLessonRelatingBackTo_instructor?->id ?? "No ID") . '</p>
					<p class="">' . ($row?->courseLessonRelatingBackTo_instructor?->name ?? "No Name") . '</p>
				</div>
			</div>';

			// Banner
			if ($row->banner_image) {
				$url = Storage::url($row->banner_image);
				$row->banner_image_tag = '<img src="' . $url . '" alt="Banner" style="width:60px; height:60px; border-radius:8px;">';
			} else {
				$row->banner_image_tag = '<span class="text-gray-400">No Image</span>';
			}

			$row->video_duration = isset($row->video_length) && $row->video_length > 0 ? (int)$row->video_length . ' min' : 'N/A';

			$row->description = Str::limit(strip_tags($row->description), 45);
			$row->transcript_text = Str::limit(strip_tags($row->transcript_text), 45);

			$row->status = ((int)$row->status === 1)
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

	// ----------------- TOOLS -----------------

	public function generateUID(Request $request)
	{
		$request->validate(['title' => 'required|string|max:255']);
		return response()->json([
			'status' => true,
			'lesson_uid' => UidGenerator::uniqueName($request->input('title'), 18, 4),
		]);
	}

	public function calculateAllVideoLengths()
	{
		try {
			$DISK_FOLDER = config('filesystems.default');

			$total = CourseLesson::whereNotNull('video')->where('video', '!=', '')->count();
			// Log::info('calculateAllVideoLengths: total lessons with video', ['count' => $total]);

			CourseLesson::whereNotNull('video')->where('video', '!=', '')->chunk(5, function ($lessons) use ($DISK_FOLDER) {
				foreach ($lessons as $lesson) {
					try {
						$duration = NewFileManagement::videoDuration($lesson->video, $DISK_FOLDER);
						// Log::info('calculateAllVideoLengths: duration result', ['id' => $lesson->id,'duration' => $duration]);

						$lesson->update([
							'video_length' => is_numeric($duration) ? $duration : 0,
						]);

						$module = CourseModule::withCount('moduleRelationWith_lessons')->find($lesson->module_id);
						if ($module) {
							$module->update([
								'total_lessons' => $module->module_relation_with_lessons_count,
								'total_video_length' => round(CourseLesson::where('module_id', $lesson->module_id)->sum('video_length'), 2),
							]);
						}

						$course = Course::withCount('courseRelationWith_lessons')->find($lesson->course_id);
						if ($course) {
							$course->update([
								'total_lessons' => $course->course_relation_with_lessons_count,
								'total_video_length' => round(CourseLesson::where('course_id', $lesson->course_id)->sum('video_length'), 2),
							]);
						}

					} catch (Throwable $e) {
						Log::error('calculateAllVideoLengths: failed lesson', ['id' => $lesson->id,'error' => $e->getMessage()]);
						continue;
					}
				}
			});

			return back()->with('success', 'All video durations calculated');
		} catch (Throwable $e) {
			return back()->with('error', $e->getMessage());
		}
	}

	public function uploadChunk(Request $request)
	{
		$request->validate([
			'chunk' => 'required|file',
			'chunk_index' => 'required|integer',
			'file_name' => 'required|string',
		]);

		$chunk = $request->file('chunk');
		$index = $request->chunk_index;
		$rawName = $request->file_name;
		$ext = pathinfo($rawName, PATHINFO_EXTENSION);
		$baseName = pathinfo($rawName, PATHINFO_FILENAME);
		$baseName = preg_replace('/\s+/', '_', $baseName); // spaces to underscores
		$baseName = preg_replace('/[^A-Za-z0-9_\-.]/', '', $baseName); // remove anything not URL-safe
		$fileName = $baseName . '.' . $ext;

		$tempPath = storage_path("app/chunks/{$fileName}");

		if (!file_exists($tempPath)) {
			mkdir($tempPath, 0777, true);
		}

		$chunk->move($tempPath, "chunk_{$index}");

		// return response()->json(['status' => true]);
		return response()->json(['status' => true, 'file_name' => $fileName]);
	}

	public function mergeChunks(Request $request)
	{
		$request->validate([
			'file_name' => 'required|string',
			'total_chunks' => 'required|integer',
			'course_uid' => 'required|string',
			'lesson_uid' => 'required|string',
			'flag' => 'nullable|string|in:create,update',
		]);

		$fileName = $request->file_name;
		$total = (int)$request->total_chunks;
		$flag = $request->input('flag', 'create');
		$tempPath = storage_path("app/chunks/{$fileName}");
		$localFile = storage_path("app/{$fileName}");

		if (!is_dir($tempPath)) {
			return response()->json(['status' => false, 'message' => 'Chunk directory not found.'], 422);
		}

		$final = fopen($localFile, 'wb');
		for ($i = 0; $i < $total; $i++) {
			$chunkPath = "{$tempPath}/chunk_{$i}";
			if (!file_exists($chunkPath)) {
				fclose($final);
				return response()->json(['status' => false, 'message' => "Missing chunk {$i}."], 422);
			}
			$chunk = fopen($chunkPath, 'rb');
			stream_copy_to_stream($chunk, $final);
			fclose($chunk);
			unlink($chunkPath);
		}
		fclose($final);
		rmdir($tempPath);

		$disk = Storage::disk(config('filesystems.default'));

		if ($flag === 'update') {
			$finalPath = "course-management/courses/{$request->course_uid}/lesson-files/{$request->lesson_uid}/temp/{$fileName}";
			$tempFolder = "course-management/courses/{$request->course_uid}/lesson-files/{$request->lesson_uid}/temp";

			if ($disk->exists($tempFolder)) {
				foreach ($disk->files($tempFolder) as $existingTemp) {
					$disk->delete($existingTemp);
				}
			}
		} else {
			$finalPath = "course-management/courses/{$request->course_uid}/lesson-files/{$request->lesson_uid}/{$fileName}";
			$lessonFolder = "course-management/courses/{$request->course_uid}/lesson-files/{$request->lesson_uid}";
			$videoExtensions = ['mp4', 'mov', 'avi', '3gp', 'mkv', 'webm'];

			if ($disk->exists($lessonFolder)) {
				foreach ($disk->files($lessonFolder) as $existingFile) {
					$ext = strtolower(pathinfo($existingFile, PATHINFO_EXTENSION));
					if (in_array($ext, $videoExtensions)) {
						$disk->delete($existingFile);
					}
				}
			}
		}

		$stream = fopen($localFile, 'r');
		$stored = $disk->put($finalPath, $stream);
		if (is_resource($stream))
			fclose($stream);
		if (file_exists($localFile))
			unlink($localFile);

		if (!$stored) {
			return response()->json(['status' => false, 'message' => 'Failed to store final file.'], 500);
		}

		return response()->json(['status' => true, 'path' => $finalPath]);
	}

	public function discardVideo(Request $request)
	{
		$request->validate([
			'course_uid' => 'required|string',
			'lesson_uid' => 'required|string',
			'flag' => 'nullable|string|in:create,update',
		]);

		$disk = Storage::disk(config('filesystems.default'));
		$lessonFolder = "course-management/courses/{$request->course_uid}/lesson-files/{$request->lesson_uid}";
		$flag = $request->input('flag', 'create');
		$videoExtensions = ['mp4', 'mov', 'avi', '3gp', 'mkv', 'webm'];
		$tempFolder = "{$lessonFolder}/temp";

		if ($flag === 'update') {
			if ($disk->exists($tempFolder)) {
				$disk->deleteDirectory($tempFolder);
			}
		} else {
			$videoExtensions = ['mp4', 'mov', 'avi', '3gp', 'mkv', 'webm'];
			if ($disk->exists($lessonFolder)) {
				foreach ($disk->files($lessonFolder) as $file) {
					$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
					if (in_array($ext, $videoExtensions)) {
						$disk->delete($file);
					}
				}
			}
			if ($disk->exists($tempFolder)) {
				$disk->deleteDirectory($tempFolder);
			}
			if ($disk->exists($lessonFolder)) {	// to delete empty folder while lesson-create
				if (empty($disk->files($lessonFolder)) && empty($disk->directories($lessonFolder))) {
					$disk->deleteDirectory($lessonFolder);
				}
			}
		}


		return response()->json(['status' => true]);
	}
}
