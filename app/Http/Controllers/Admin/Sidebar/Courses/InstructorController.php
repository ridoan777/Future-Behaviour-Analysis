<?php

namespace App\Http\Controllers\Admin\Sidebar\Courses;

use App\Helpers\ImageManagement;
use App\Http\Controllers\Controller;
use App\Models\Courses\Course;
use App\Models\Courses\CourseInstructor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class InstructorController extends Controller
{


	public function instructorStore(Request $request)
	{
		// dd($request->all());
		$validated = $request->validate([
			'id' => 'nullable|integer|exists:course_instructors,id',
			'status' => 'nullable|boolean|in:0,1',

			'name' => 'required|string|max:255',
			'designation' => 'nullable|string|max:255',
			'bio' => 'nullable|string|max:2000',

			'display_picture' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:10485',
		], [
			'bio.max' => "The bio field must not be greater than 2000 characters. Use 'Ctrl+Shift+V' for copy-pasting or choose plain text."
		]);

		try {
			$DISK_FOLDER = config('filesystems.default');
			$instructor = !empty($validated['id']) ? CourseInstructor::findOrFail($validated['id']) : null;

			$validated['display_picture'] = ImageManagement::handleFile(
				$request->file('display_picture') ?? null,
				$validated['title'] ?? "no-title",
				$instructor->display_picture ?? null,
				'course-management/instructors',
				$DISK_FOLDER,
				$request->boolean('remove_image')
			);

			// Create or update
			if ($instructor) {
				$instructor->update([
					'name' => $validated['name'],
					'designation' => $validated['designation'],
					'bio' => $validated['bio'] ?? null,

					'display_picture' => $validated['display_picture'] ?? null,

					'status' => $validated['status'] ?? 1,
				]);
			} else {
				CourseInstructor::create([
					'name' => $validated['name'],
					'designation' => $validated['designation'],
					'bio' => $validated['bio'] ?? null,

					'display_picture' => $validated['display_picture'] ?? null,

					'status' => $validated['status'] ?? 1,
				]);
			}

			return back()->with('success', 'Instructor saved successfully.');
		} catch (\Exception $e) {
			return back()->with('error', 'Server error: ' . $e->getMessage())->withInput();
		}
	}


	public function editInstructor($id)
	{
		$singleInstructor = CourseInstructor::findOrFail($id);

		return view('admin.sidebar.Courses.instructors.instructorEdit', compact('singleInstructor'));
	}


	public function deleteInstructor(CourseInstructor $id)
	{
		$name = '';
		$name = $id->name;
		ImageManagement::deleteFile($id->display_picture, 'public');

		$id->delete();

		return redirect()->back()->with('success', "Instructor '{$name}' deleted successfully!");
	}

	public function allInstructor()
	{
		$allInstructors = CourseInstructor::all();

		return view('admin.sidebar.Courses.instructors.all_instructors', $allInstructors);
	}


	public function InstructorListDataTable(Request $request)
	{
		$columns = ['id', 'name', 'designation', 'bio', 'display_picture', 'status', 'created_at'];

		$draw = intval($request->input('draw'));
		$start = intval($request->input('start', 0));
		$length = intval($request->input('length', 25));
		$orderColIndex = $request->input('order.0.column', 0);
		$orderDir = $request->input('order.0.dir', 'asc');

		$orderCol = $columns[$orderColIndex] ?? 'id';
		$orderDir = in_array(strtolower($orderDir), ['asc', 'desc']) ? $orderDir : 'asc';

		$query = CourseInstructor::query();

		if ($search = $request->input('search.value')) {
			$query->where(function ($q) use ($search) {
				$searchable = ['name', 'designation', 'bio'];
				foreach ($searchable as $column) {
					$q->orWhere($column, 'like', "%{$search}%");
				}
			});
		}

		$recordsTotal = CourseInstructor::count();
		$recordsFiltered = $query->count();

		$data = $query->orderBy($orderCol, $orderDir)
			->offset($start)
			->limit($length)
			->get();

		$sn = $start;

		$data->transform(function ($row) use (&$sn) {
			$sn++;
			$row->SN = $sn;

			$row->row_link = route('backend_instructor_edit', $row->id);

			$row->actions = '
				<div class="flex_xy_center gap-2">
					<button type="button" class="showButton" onclick="window.location.href=\'' . route('backend_instructor_edit', $row->id) . '\'">
								' . \App\Helpers\IconPack::edit(['class' => 'iconPackItem w-3 h-3 text-gray-100']) . '
					</button>
					<form action="' . route('backend_instructor_delete', $row->id) . '" 
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


			if ($row->display_picture) {
				$url = Storage::url($row->display_picture);
				$row->display_picture_tag = '<img src="' . $url . '" alt="DP" style="width:60px; height:auto; border-radius:16px;">';
			} else {
				$row->display_picture_tag = '<span class="text-gray-400">No Image</span>';
			}


			$row->status = $row->status
				? '<span class="px-2 py-1 text-xs rounded-lg bg-green-100 text-green-700">Active</span>'
				: '<span class="px-2 py-1 text-xs rounded-lg bg-red-100 text-red-700">Inactive</span>';

			if ($row->created_at) {
				try {
					$date = \Carbon\Carbon::parse($row->created_at)->timezone('Asia/Dhaka');
					$row->created_at_formatted = $date->format('d M Y, H:i') . ' UTC+6';
				} catch (\Exception $e) {
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


}
