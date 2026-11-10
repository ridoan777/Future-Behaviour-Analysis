<x-app-layout>

	@php
		$breadCrumbs = [
			['label' => 'WebPages', 'url' => 'dashboard', 'icon' => 'documentLines'],
			['label' => 'Transactions', 'url' => 'backend.webpages_transactions_pricing', 'icon' => 'dollarSackLine'],
			['label' => 'Pricing'],
		];
	 @endphp

	<x-breadcrumb :crumbs="$breadCrumbs" />
	<!-- ---------------- APP AREA Starts ---------------- -->

	<!-- Start Main Widgets -->
	<x-page_header_widget pageName="Transactions: Modify Pricing Tier" />
	<!-- End Main Widgets -->


	<!-- Alert Component -->
	<x-alert-component message="Form Submission" />
	<!-- Alert Component -->

	@php
		$ACCORDION_1_VISIBILITY = ''; // hidden or ''
	 @endphp

	<!---------------------------------------------------------------------------------------------- accordion -->
	<div class="hs-accordion-group">

		<x-ui_items.accordion.accordion-destroy />

		<div id="hs-destroy-heading-one" {{-- Questions --}}
			class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent">

			<x-ui_items.accordion.accordion_toggle_button toggleLabel="1. Modify Payment Packages" />

			<div id="hs-destroy-collapse-one"
				class="hs-accordion-content {{ $ACCORDION_1_VISIBILITY }} w-full overflow-hidden transition-[height] duration-300"
				role="region" aria-labelledby="hs-destroy-heading-one">
				<div class="p-3">
					<!-- Form::Update Tier -->
					<section
						class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
						<div class="my-5">
							<form method="POST" action="{{ route('backend_transactions_tiers_store') }}"
								class="rounded-lg p-2 dark:bg-neutral-700" enctype="multipart/form-data">
								@csrf

								<!--- IDENTIFIER HIDDEN INPUTS -->
								<input type="hidden" name="flag" class="smallInput" value="update">
								<input type="hidden" name="id" class="smallInput" value="{{ $singleTier?->id ?? null }}">
								<!--- IDENTIFIER HIDDEN INPUTS -->

								<div>
									<div class="mb-5 mt-2">
										<label for="title" class="inputLabelMedium">Link a Course
											<span class="text-red-500">*</span>
										</label>
										<select id="courses" name="course_id"
											class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
											<option value="">Choose a course</option>
											@foreach ($allCourses as $course)
												<option value="{{ $course->id }}" {{ $singleTier->course_id == $course->id ? 'selected' : '' }}>
													{{ $course->title }}
												</option>
											@endforeach
										</select>
									</div>

									<div class="mb-5 mt-2">
										<label for="tier_name" class="inputLabelMedium">Tier Name/Label
											<span class="text-red-500">*</span>
										</label>
										<input type="text" name="tier_name" class="mediumInput" placeholder="max 40-characters"
											value="{{ $singleTier?->tier_name ?? null }}">
									</div>

									{{--  --}}

									<div class="mb-5 mt-2">
										<label for="title" class="inputLabelMedium">Title
											<span class="text-red-500">*</span>
										</label>
										<input type="text" name="title" class="mediumInput" placeholder="max 40-characters"
											value="{{ $singleTier?->title ?? null }}">
									</div>

									<!--  -->

									<div class="mb-5 mt-2">
										<label for="subtitle" class="inputLabelMedium">Sub-Title</label>
										<input type="text" name="subtitle" class="mediumInput" placeholder="max 60-characters"
											value="{{ $singleTier?->subtitle ?? null }}">
									</div>

									<!--  -->

									<div class="mb-5 mt-2">
										<label for="starting_price" class="inputLabelMedium">Starting Price
											<span class="text-red-500">*</span>
											<span class="text-sm text-gray-400 font-light"> (Numeric only, e.g., 400, 55.5, etc.
												Must be greater than 0)</span>
										</label>
										<input type="text" name="starting_price" class="mediumInput"
											placeholder="Penned-through/Strike-through price"
											value="{{ $singleTier?->starting_price ?? 0 }}">
									</div>

									<!--  -->

									<div class="mb-5 mt-2">
										<label for="final_price" class="inputLabelMedium">Final Price
											<span class="text-red-500">*</span>
											<span class="text-sm text-gray-400 font-light"> (Numeric only, e.g., 400, 55.5, etc.
												Must be greater than 0)</span>
										</label>
										<input type="text" name="final_price" class="mediumInput" placeholder="Final price"
											value="{{ $singleTier?->final_price ?? 0 }}">
									</div>

									<!--  -->

									<div class="mb-5 mt-2">
										<label for="benefits" class="inputLabelMedium">Tier Benefits
											<span class="text-sm text-gray-400 font-light"> (Max 1000 characters)</span>
											<span class="text-sm text-gray-400 font-light"> (Use 'Bulleted List' button to seperate
												them)</span>
										</label>
										<textarea name="benefits" id="ckeditor"
											rows="10">{!! $singleTier?->benefits ?? "N/A" !!}</textarea>
									</div>

									<!--  -->

									<div class="mb-5 mt-2">
										<label for="product_id" class="inputLabelMedium">Stripe Product ID
											<span class="text-red-500">*</span>
										</label>
										<input type="text" name="product_id" class="mediumInput"
											placeholder="Product/Catalogue ID" value="{{ $singleTier?->product_id ?? "N/A" }}">
									</div>

									<!--  -->

									<div class="mb-5 mt-2">
										<label for="price_id" class="inputLabelMedium">Prodcut's Price ID
											<span class="text-red-500">*</span>
										</label>
										<input type="text" name="price_id" class="mediumInput"
											placeholder="Stripe's Package/Tier/Pricing ID of the same product ID"
											value="{{ $singleTier?->price_id ?? "N/A" }}">
									</div>

									<!--  -->
									<div class="mb-5 mt-2">
										<label for="quiz_eligible" class="inputLabelMedium">Duration</label>
										<select id="duration" name="duration"
											class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
											<option value="1" {{ $singleTier->duration == 1 ? 'selected' : '' }}>Monthly</option>
											<option value="3" {{ $singleTier->duration == 3 ? 'selected' : '' }}>3 Months</option>
											<option value="6" {{ $singleTier->duration == 6 ? 'selected' : '' }}>6 Months</option>
											<option value="12" {{ $singleTier->duration == 12 ? 'selected' : '' }}>1 year</option>
											<option value="lifetime" {{ $singleTier->duration == "lifetime" ? 'selected' : '' }}>
												One-Time/Lifetime</option>
										</select>
									</div>

									<!--  -->
									<div class="mb-5 mt-2">
										<label for="quiz_eligible" class="inputLabelMedium">Active Status</label>
										<select id="status" name="status"
											class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
											<option value="0" {{ $singleTier->status == 0 ? 'selected' : '' }}>Inactive</option>
											<option value="1" {{ $singleTier->status == 1 ? 'selected' : '' }}>Active</option>
										</select>
									</div>

								</div>

								<button type="submit" class="showButton my-4">Update Tier</button>
							</form>
						</div>
					</section>
					<!-- Form::Update Tier -->
				</div>
			</div>
		</div>

	</div>

	<!---------------------------------------------------------------------------------------------- accordion -->

	<!-- ---------------- APP AREA ENDS ---------------- -->



	{{-- CK EDITOR --}}
	<script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>

	<script>
		ClassicEditor
			.create(document.querySelector('#ckeditor'))
			.catch(error => {
				console.error(error);
			});
	</script>

	<style>
		.ck-editor__editable_inline {
			min-height: 150px;
			/* ensures editor has enough height */
		}
	</style>
	{{-- CK EDITOR --}}


</x-app-layout>