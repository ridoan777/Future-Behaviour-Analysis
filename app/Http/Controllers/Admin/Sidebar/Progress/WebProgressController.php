<?php

namespace App\Http\Controllers\Admin\Sidebar\Progress;

use App\Helpers\Ui\DatatableHelper;
use App\Http\Controllers\Controller;
use App\Models\Subscription\SubscribedUser;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class WebProgressController extends Controller
{
	public function index()
	{
		return view('admin.sidebar.Progress.all_progress');
	}


	public function progressDataTable(Request $request)
	{
		try {
			$columns = ['id', 'user_id', 'tier_id', 'course_id', 'created_at'];

			$draw = (int)$request->input('draw');
			$start = (int)$request->input('start', 0);
			$length = (int)$request->input('length', 25);
			$orderColIndex = (int)$request->input('order.0.column', 0);
			$orderCol = $columns[$orderColIndex] ?? 'id';
			$orderDir = strtolower($request->input('order.0.dir', 'asc')) === 'desc' ? 'desc' : 'asc';

			$query = SubscribedUser::with([
				'subscriberRelatingBackTo_User',
				'subscriberRelatingBackTo_Course'
			])->withCount([
						'subscriberRelationWith_ProgressLessons as completed_lessons' => function ($q) {
							$q->where('is_complete', 1);
						}
					]);

			$query->with(['subscriberRelatingBackTo_Course.courseRelationWith_lessons']);

			if ($search = $request->input('search.value')) {
				$query->where(function ($q) use ($search) {
					$q->orWhereHas('subscriberRelatingBackTo_User', fn($q2) =>
						$q2->where('first_name', 'like', "%{$search}%")
							->orWhere('last_name', 'like', "%{$search}%")
							->orWhere('email', 'like', "%{$search}%"))
						->orWhereHas('subscriberRelatingBackTo_Course', fn($q3) =>
							$q3->where('title', 'like', "%{$search}%"));
				});
			}

			$recordsTotal = SubscribedUser::count();
			$recordsFiltered = $query->count();

			$data = $query->orderBy($orderCol, $orderDir)->offset($start)->limit($length)->get();

			$sn = $start;
			$zones = \App\Helpers\Ui\ConvertDynamicTimezone::handle();

			$data->transform(function ($row) use (&$sn, $zones) {

				$row->DT_RowId = 'row_' . $row->id;
				$row->SN = ++$sn;

				// clickable row
				$row->view_url = route('backend_subscription_single_subscriber', $row->id) . '#progressSubscriber';

				$zone = $zones['zone'] ?: 'UTC';
				$offset = $zones['offset'] ?: '+00:00';

				// USER
				$user = $row?->subscriberRelatingBackTo_User;
				$row->user_name = DatatableHelper::userBlock($user);

				// COURSE
				$course = $row?->subscriberRelatingBackTo_Course;
				$row->course_title = DatatableHelper::detailBlock($course, true, $course?->course_uid, true, $course?->banner_image);

				// UID
				$row->uid = $course?->course_uid ?? '—';

				// PROGRESS (simple placeholder, you can replace with real logic)
				$completed = $row->completed_lessons ?? 0;
				$total = $row->subscriberRelatingBackTo_Course?->courseRelationWith_lessons?->count() ?? 0;

				$percent = $total > 0 ? round(($completed / $total) * 100) : 0;

				$row->progress = '
					<div class="w-full">
						<div class="w-full bg-gray-200 rounded-full h-2.5">
							<div class="bg-blue-500 h-2.5 rounded-full" style="width: ' . $percent . '%;"></div>
						</div>
						<span class="text-xs">' . $completed . ' / ' . $total . ' (' . $percent . '%)</span>
					</div>
				';

				// CREATED
				$row->created_at_formatted = $row->created_at
					? Carbon::parse($row->created_at)->timezone($zone)->format('d M Y, H:i') . ' (UTC' . $offset . ')'
					: 'N/A';

				// $row->actions = DatatableHelper::datatableAction($row, false, null, 'backend_subscription_delete');

				return $row;
			});

			return DatatableHelper::handleDatatableSuccess($draw, $recordsTotal, $recordsFiltered, $data);

		} catch (Exception $e) {
			return DatatableHelper::handleDatatableError($request, $e, true, "Progress datatable error.");
		}
	}
}
