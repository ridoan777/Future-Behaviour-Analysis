<?php

namespace App\Http\Controllers\Admin\CommonContents;

use App\Models\NewsletterForm;
use App\Models\Webpages\CommonSection;
// use App\Models\CommonSection;

use App\Helpers\ImageManagement;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

class CommonController extends Controller
{

	public function banner()
	{
		$allBanners = CommonSection::where('type', 'banner')->get();

		return view('admin.common_sections.banner', compact('allBanners'));
	}

	public function faq()
	{
		$FAQs = CommonSection::where('type', 'faq')->get();

		$faqHead = $FAQs->where('section', 'faq_head')->first();
		$faqBody = $FAQs->where('section', 'faq_body');

		return view('admin.common_sections.faq', compact('faqHead', 'faqBody'));
	}

	public function newsletter()
	{
		$newsletter = CommonSection::where('type', 'newsletter')->first();

		return view('admin.common_sections.newsletter', compact('newsletter'));
	}

	public function policyConditions()
	{
		$policyConditions = CommonSection::where('type', 'policy_condition')->get();
		$policy = $policyConditions->firstWhere('section', 'policy');
		$condition = $policyConditions->firstWhere('section', 'condition');

		return view('admin.common_sections.policy_conditions', compact('policy', 'condition'));
	}


	public function newsletterFormData()
	{
		// dd("check-1");
		$newsletters = NewsletterForm::where('type', 'newsletter')->get();

		return view('admin.sidebar.Forms.newsletters', compact('newsletters'));
	}

	public function newsletterTableData(Request $request)
	{
		try{

			$columns = ['id', 'type', 'email', 'registered', 'created_at'];
			$draw = intval($request->input('draw'));
			$start = intval($request->input('start', 0));
			$length = intval($request->input('length', 25));
			$orderColIndex = $request->input('order.0.column', 0);
			$orderCol = $columns[$orderColIndex] ?? 'id';
			$orderDir = $request->input('order.0.dir', 'asc');
	
			$query = NewsletterForm::query()->where('type', 'newsletter')->select(['id', 'type', 'email', 'registered', 'created_at']);
	
			$recordsTotal = $query->count();
	
			if ($search = $request->input('search.value')) {
				$query->where(function ($q) use ($search) {
					$q->where('registered', 'like', "%{$search}%")
						->orWhere('email', 'like', "%{$search}%");
				});
			}
	
			$recordsFiltered = $query->count();
	
			$data = $query->orderBy($orderCol, $orderDir)
				->offset($start)
				->limit($length)
				->get();
	
			$sn = $start;
	
			$data->transform(function ($row, $key) use ($start) {
				$row->SN = $key + 1 + $start;
				$row->registered = $row->registered ? 'Yes' : '';
	
				$deleteUrl = route('backend_forms_newsletter_delete', $row->id);
				$trashIcon = \App\Helpers\IconPack::trash(['class' => 'iconPackItem w-3 h-3 text-gray-100']);
	
				$row->actions = '
					<div class="flex items-center justify-center gap-2">
							<form action="' . $deleteUrl . '" method="POST" class="deleteForm inline m-0 p-0">
								' . csrf_field() . method_field('DELETE') . '
								<button type="submit"
									class="bg-red-500 hover:bg-red-600 text-white p-2 rounded transition"
									title="Delete">
									' . $trashIcon . '
								</button>
							</form>
					</div>
				';
	
				return $row;
			});
	
	
			return response()->json([
				'draw' => $draw,
				'recordsTotal' => $recordsTotal,
				'recordsFiltered' => $recordsFiltered,
				'data' => $data,
			]);
		}  catch (Throwable $e) {
			Log::error('newsletter datatable error', [
				'message' => $e->getMessage(),
				'line' => $e->getLine(),
				'file' => $e->getFile(),
			]);

			return response()->json([
				'draw' => intval($request->input('draw')),
				'recordsTotal' => 0,
				'recordsFiltered' => 0,
				'data' => [],
				'error' => 'Unable to load newsletter data.',
			], 500);
		}
	}

	public function newsletterDelete(NewsletterForm $mail){
		$email = '';
		try{
			$email = $mail->email;
			$mail->delete();

			return redirect()->back()->with('success', "A newsletter intent of {$email} has been deleted.");

		} catch (\Exception $e) {
			return redirect()->route('backend.common_section_banner')->with('success', "{$email} failed to delete!" . $e->getMessage())->withInput();
		}
	}
	// ---------------NEWSLETTER---------------

	public function footer()
	{
		$data = CommonSection::all();

		$infoHead = $data->where('section', 'footer_detail')->first();
		// dd($data, $infoHead);
		$social = $data->where('section', 'footer_social')->keyBy('order_in_section');

		$contact = $data->where('type', 'footer')->where('section', 'contact')->keyBy('order_in_section');

		$quick_access = $data->where('section', 'quick_access')->keyBy('order_in_section');
		$subscribe_email = $data->where('section', 'subscribe_email')->keyBy('order_in_section')->first();
		$copyright_text = $data->where('section', 'copyright_text')->keyBy('order_in_section')->first();

		return view('admin.common_sections.footer', compact('infoHead', 'social', 'contact', 'quick_access', 'subscribe_email', 'copyright_text'));
	}

	public function commonSectionStore(Request $request)
	{
		// dd($request->all());
		$validated = $request->validate([
			'type' => 'required|string|max:120',
			'section' => 'required|string|max:120',
			'order_in_section' => 'nullable|numeric',
			'title' => 'nullable|string|max:600',
			'subtitle' => 'nullable|string|max:1200',
			'detail' => 'nullable|string',
			'images' => 'nullable|array',
			'images.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,mp4,mov,3gp,avi|max:10485760',
			'btn_text' => 'nullable|string|max:30',
			'btn_url' => 'nullable|string',
			'btn_icon' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,mp4,mov,3gp,avi|max:10485760',
		], [
			'title.max' => "The :attribute field must not be greater than :max characters. Reduce over-styling or use plain text first.",
			'subtitle.max' => "The :attribute field must not be greater than :max characters. Reduce over-styling or use plain text first.",
			'btn_text.max' => "The :attribute field must not be greater than :max characters. Reduce over-styling or use plain text first.",
		],);

		try {
			$DISK_FOLDER = config('filesystems.default');
			$imagePaths = [];

			// ---------------- Handle multiple images ----------------
			if ($request->hasFile('images')) {
				$uploadedFiles = $request->file('images');

				foreach ($uploadedFiles as $index => $uploadedFile) {
					if ($uploadedFile) {
						$filePath = ImageManagement::storeFile(
							$uploadedFile,
							$validated['title'] ?? 'no-title',
							'common-section-pics',
							$DISK_FOLDER
						);

						$imagePaths[] = $filePath;

						// Check if a row already exists
						$existing = CommonSection::where([
							'type' => $validated['type'],
							'section' => $validated['section'],
							'order_in_section' => $validated['order_in_section'] ?? $index + 1,
						])->first();

						// Delete old image from storage if exists
						if ($existing && $existing->image) {
							Storage::disk($DISK_FOLDER)->delete($existing->image);
						}

						// Create or update with new image
						CommonSection::updateOrCreate(
							[
								'type' => $validated['type'],
								'section' => $validated['section'],
								'order_in_section' => $validated['order_in_section'] ?? $index + 1,
							],
							[
								'image' => $filePath,
							]
						);
					}
				}
			}

			// ---------------- Handle single icon file ----------------
			$iconPath = null;
			if ($request->hasFile('btn_icon')) {
				$iconPath = ImageManagement::storeFile(
					$request->file('btn_icon'),
					$validated['title'] ?? 'no-title',
					'common-section-icons',
					$DISK_FOLDER
				);

				$existing = CommonSection::where([
					'type' => $validated['type'],
					'section' => $validated['section'],
					'order_in_section' => $validated['order_in_section'] ?? null,
				])->first();

				if ($existing && $existing->btn_icon) {
					Storage::disk($DISK_FOLDER)->delete($existing->btn_icon);
				}
			}

			// ---------------- Create or Update Main Content ----------------
			CommonSection::updateOrCreate(
				[
					'type' => $validated['type'],
					'section' => $validated['section'],
					'order_in_section' => $validated['order_in_section'] ?? null,
				],
				[
					'title' => $validated['title'] ?? null,
					'subtitle' => $validated['subtitle'] ?? null,
					'detail' => $validated['detail'] ?? null,
					'btn_text' => $validated['btn_text'] ?? null,
					'btn_url' => $validated['btn_url'] ?? null,
					'btn_icon' => $iconPath,
				]
			);

			return redirect()->back()->with(
				'success',
				$validated['type'] . " section named '" . $validated['section'] . "' saved successfully."
			);
		} catch (QueryException $e) {
			return redirect()->back()->with('error', 'Database error: ' . $e->getMessage())->withInput();
		} catch (\Exception $e) {
			return redirect()->back()->with('error', 'Server error: ' . $e->getMessage())->withInput();
		}
	}

	public function commonSectionDelete(CommonSection $commonSection)
	{
		$sectionName = '';
		$sectionName = $commonSection->section;
		try {

			// Delete image file if exists
			if ($commonSection->image) {
				if (Storage::disk('public')->exists($commonSection->image)) {
					Storage::disk('public')->delete($commonSection->image);
				} else {
					Log::warning("Image file not found: {$commonSection->image} for user: {$sectionName}");
				}
			}

			// Delete the user record
			$commonSection->delete();

			return redirect()->route('backend.common_section_banner')->with('success', "{$sectionName} deleted successfully! Make sure to recreate this section as soon as possible to prevent UI breaking.");
		} catch (ValidationException $e) {
			return redirect()->route('backend.common_section_banner')->with('success', "{$sectionName} failed to delete!" . $e->getMessage())->withInput();
		} catch (\Exception $e) {
			return redirect()->route('backend.common_section_banner')->with('success', "{$sectionName} failed to delete!" . $e->getMessage())->withInput();
		}
	}


	/*  -------------- APIs --------------
		The APIs of these section can be found on 'app\Http\Controllers\Api\Webpage\ApiWebpageController.php'
	  -------------- APIs -------------- */
}
