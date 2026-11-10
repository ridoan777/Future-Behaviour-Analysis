<?php

namespace App\Http\Controllers\Admin\Sidebar\Certificates;

use App\Helpers\NewFileManagement;
use App\Helpers\Ui\DatatableHelper;
use App\Http\Controllers\Controller;
use App\Models\Certificates\CertificateFinal;
use App\Models\Certificates\CertificateMeta;
use App\Models\Subscription\SubscribedUser;
use App\Models\Trackers\ProgressResult;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class WebCertificateController extends Controller
{
	public function index()
	{
		return view('admin.sidebar.Certificates.all_certs');
	}

	public function create()
	{
		$certMeta = CertificateMeta::first();
		return view('admin.sidebar.Certificates.cert_management', compact('certMeta'));
	}

	public function store(Request $request)
	{
		$validated = $request->validate([
			'header_top' => ['nullable', 'string', 'max:255'],
			'header_middle' => ['nullable', 'string', 'max:255'],
			'header_bottom' => ['nullable', 'string', 'max:255'],

			'trainer_name' => ['nullable', 'string', 'max:255'],
			'trainer_certification' => ['nullable', 'string', 'max:255'],
			'assist_trainer_name' => ['nullable', 'string', 'max:255'],
			'agency_name' => ['nullable', 'string', 'max:255'],

			'footer' => ['nullable', 'string'],

			'trainer_signature' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
			'watermark' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:2048'],

			'remove' => ['array'],
			'remove.*' => ['nullable', Rule::in(['0', '1', 0, 1, true, false])],
		], [
			'mimes' => 'The :attribute must be a JPG, JPEG, PNG, or WEBP file.',
			'max' => 'The :attribute may not be greater than 2 MB.',
		]);

		try {
			DB::beginTransaction();

			$disk = config('filesystems.default');
			$existing = CertificateMeta::first();

			$data = [
				'header_top' => $validated['header_top'] ?? null,
				'header_middle' => $validated['header_middle'] ?? null,
				'header_bottom' => $validated['header_bottom'] ?? null,

				'trainer_name' => $validated['trainer_name'] ?? null,
				'trainer_certification' => $validated['trainer_certification'] ?? null,
				'assist_trainer_name' => $validated['assist_trainer_name'] ?? null,
				'agency_name' => $validated['agency_name'] ?? null,

				'footer' => $validated['footer'] ?? null,
			];

			// ---------- File Uploads ----------
			$imageFields = ['trainer_signature', 'watermark'];

			foreach ($imageFields as $field) {
				$removeFlag = $request->boolean("remove.$field");
				$fileInput = $request->file($field);
				$oldFile = $existing?->$field;

				$data[$field] = NewFileManagement::handleFile(
					$fileInput,
					$validated['trainer_name'] ?? 'trainer',
					$oldFile,
					'certificates/metas',
					$disk,
					$removeFlag
				);
			}

			CertificateMeta::updateOrCreate(
				['id' => $existing?->id ?? 0],
				$data
			);

			DB::commit();
			return back()->with('success', 'Certificate metadata saved successfully!');
		} catch (\Throwable $e) {
			DB::rollBack();
			report($e);
			return back()->with('error', 'Failed to save certificate meta: ' . $e->getMessage());
		}
	}

	public function delete($id)
	{
		$cert = ProgressResult::findOrFail($id);
		$cert->delete();
		return back()->with('success', 'Certificate deleted successfully.');
	}

	public function certUsersDataTableOld(Request $request)
	{
		$columns = ['id', 'cert_id', 'user_id', 'course_id', 'course_title', 'grade', 'name', 'email', 'complete_date', 'status', 'created_at'];

		$draw = intval($request->input('draw'));
		$start = intval($request->input('start', 0));
		$length = intval($request->input('length', 25));
		$orderColIndex = $request->input('order.0.column', 0);
		$orderDir = $request->input('order.0.dir', 'asc');

		// Map DataTable column index to actual DB column
		$columnMap = [
			0 => 'id',
			1 => 'cert_id',
			2 => 'name',
			3 => 'course_title',
			4 => 'grade',
			5 => 'complete_date',
			6 => 'status',
			7 => 'created_at',
			8 => null,
		];

		$orderCol = $columnMap[$orderColIndex] ?? 'id';
		$orderDir = in_array(strtolower($orderDir), ['asc', 'desc']) ? $orderDir : 'asc';

		// Build query
		$query = ProgressResult::select([
			'id',
			'cert_id',
			'user_id',
			'tier_id',
			'course_id',
			'course_title',
			'grade',
			'name',
			'email',
			'complete_date',
			'status',
			'created_at'
		]);


		// Search filter
		if ($search = $request->input('search.value')) {
			$query->where(function ($q) use ($search) {
				$q->where('cert_id', 'like', "%{$search}%")
					->orWhere('name', 'like', "%{$search}%")
					->orWhere('email', 'like', "%{$search}%")
					->orWhere('course_title', 'like', "%{$search}%");
			});
		}

		// Get totals
		$recordsTotal = ProgressResult::count();
		$recordsFiltered = $query->count();

		// Apply ordering and pagination
		if ($orderCol) {
			$query->orderBy($orderCol, $orderDir);
		}

		$certs = $query->offset($start)
			->limit($length)
			->get();

		// Transform data
		$sn = $start;
		$certs->transform(function ($row) use (&$sn) {
			$sn++;
			$row->SN = $sn;

			// Actions column
			$row->actions = '
            <div class="flex items-center justify-center gap-2">
                <form action="' . route('backend_certs_users_delete', $row->id) . '" method="POST" class="deleteForm">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="submit" class="deleteButton px-2 py-1 bg-red-500 hover:bg-red-600 rounded">
                        ' . \App\Helpers\IconPack::trash(['class' => 'iconPackItem w-3 h-3 text-gray-100']) . '
                    </button>
                </form>
            </div>';

			// Status badge
			$row->status = $row->status
				? '<span class="px-2 py-1 text-xs rounded-lg bg-green-100 text-green-700">Active</span>'
				: '<span class="px-2 py-1 text-xs rounded-lg bg-red-100 text-red-700">Inactive</span>';

			// Format created_at
			if ($row->created_at) {
				$date = \Carbon\Carbon::parse($row->created_at)->timezone('Asia/Dhaka');
				$row->created_at_formatted = $date->format('d M Y, H:i') . ' UTC+6';
			} else {
				$row->created_at_formatted = 'N/A';
			}

			return $row;
		});

		return response()->json([
			'draw' => $draw,
			'recordsTotal' => $recordsTotal,
			'recordsFiltered' => $recordsFiltered,
			'data' => $certs,
		]);
	}

	public function certificate_holder_dataTable(Request $request)
	{
		try {
			$columns = ['id','tier_id','user_id','course_id','header_top','header_middle','header_bottom','applicant_name','applicant_bacb_id','training_start','training_end','training_time','trainer_name','trainer_certification','assist_trainer_name','agency_name','trainer_signature','watermark','footer','created_at'];

			$draw = (int)$request->input('draw');
			$start = (int)$request->input('start', 0);
			$length = (int)$request->input('length', 25);
			$orderColIndex = (int)$request->input('order.0.column', 0);
			$orderCol = $columns[$orderColIndex] ?? 'id';
			$orderDir = strtolower($request->input('order.0.dir', 'asc')) === 'desc' ? 'desc' : 'asc';

			$query = CertificateFinal::with([
				'certRelatingBackTo_User',
				'certRelatingBackTo_Course',
				'certRelatingBackTo_Tier'
			]);

			if ($search = $request->input('search.value')) {
				$query->where(function ($q) use ($search) {
					$q->where('applicant_name', 'like', "%{$search}%")
						->orWhere('trainer_name', 'like', "%{$search}%")
						->orWhereHas('certRelatingBackTo_User', fn($q2) => $q2->where('first_name', 'like', "%{$search}%")->orWhere('last_name', 'like', "%{$search}%")->orWhere('email', 'like', "%{$search}%"))
						->orWhereHas('certRelatingBackTo_Course', fn($q3) => $q3->where('title', 'like', "%{$search}%"));
				});
			}

			$recordsTotal = CertificateFinal::count();
			$recordsFiltered = $query->count();

			$data = $query->orderBy($orderCol, $orderDir)->offset($start)->limit($length)->get();

			$sn = $start;
			$zones = \App\Helpers\Ui\ConvertDynamicTimezone::handle();

			$data->transform(function ($row) use (&$sn, $zones) {

				$row->DT_RowId = 'row_' . $row->id;
				$row->SN = ++$sn;

				$subscriber = SubscribedUser::userId((int)$row->user_id)->tierId((int)$row->tier_id)->courseId((int)$row->course_id)->latest()->first();

				// clickable row
				if($subscriber){
					$row->view_url = route('backend_subscription_single_subscriber', $subscriber->id);
				}

				$zone = $zones['zone'] ?: 'UTC';
				$offset = $zones['offset'] ?: '+00:00';

				$user = $row?->certRelatingBackTo_User;
				$row->user_name = DatatableHelper::userBlock($user);

				$course = $row?->certRelatingBackTo_Course;
				$row->course_title = DatatableHelper::detailBlock($course, true, $course?->course_uid, true, $course?->banner_image);

				$content = [
					'id' => $row->id,
					'title' => $row->applicant_name,
				];

				$row->certificate_title = DatatableHelper::detailBlock($content, true, $row->applicant_bacb_id, false, null);

				$row->trainers = '
					<div class="flex flex-col text-left">
						<span class="text-xs text-gray-600">Trainer: ' . ($row->trainer_name ?? "N/A") . '</span>
						<span class="text-xs text-gray-600">Trainer Cert:' . ($row->trainer_certification ?? "N/A") . '</span>
						<span class="text-xs text-gray-600">Assis. Trainer:' . ($row->assist_trainer_name ?? "N/A") . '</span>
						<span class="text-xs text-gray-600">Agency:' . ($row->agency_name ?? "N/A") . '</span>
					</div>
				';

				// $row->trainers = $row->trainer_name ?: 'N/A';

				$row->status = 1;

				$row->created_at_formatted = $row->created_at ? Carbon::parse($row->created_at)->timezone($zone)->format('d M Y, H:i') . ' (UTC' . $offset . ')' : 'N/A';

				$row->actions = DatatableHelper::datatableAction($row, false, null, 'backend_certs_users_delete');

				return $row;
			});

			return DatatableHelper::handleDatatableSuccess($draw, $recordsTotal, $recordsFiltered, $data);

		} catch (Exception $e) {
			return DatatableHelper::handleDatatableError($request, $e, true, "All certificates datatable error.");
		}
	}
}
