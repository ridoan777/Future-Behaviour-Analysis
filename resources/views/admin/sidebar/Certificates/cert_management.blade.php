<x-app-layout>

	@php
		$breadCrumbs = [
			['label' => 'Certificate Metadata', 'icon' => 'ribbon'],
			['label' => 'Holders', 'url' => 'backend_all_certs', 'icon' => 'list'],
		];
	 @endphp

	<x-breadcrumb :crumbs="$breadCrumbs" />
	<!-- ---------------- APP AREA Starts ---------------- -->

	<!-- Start Main Widgets -->
	<x-page_header_widget pageName="Contact Us: All Sections" />
	<!-- End Main Widgets -->


	<!-- Alert Component -->
	<x-alert-component message="Form Submission" />
	<!-- Alert Component -->

	@php
		$ACCORDION_1_VISIBILITY = ''; // hidden or ''
		$ACCORDION_2_VISIBILITY = 'hidden';
	 @endphp

	<!---------------------------------------------------------------------------------------------- accordion -->
	<div class="hs-accordion-group">

		<x-ui_items.accordion.accordion-destroy />

		<div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
			id="hs-destroy-heading-one">

			<x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify 'Certicate Metas'" />

			<div id="hs-destroy-collapse-one"
				class="hs-accordion-content {{ $ACCORDION_1_VISIBILITY }} w-full overflow-hidden transition-[height] duration-300"
				role="region" aria-labelledby="hs-destroy-heading-one">
				<div class="p-3">
					<!-- Form::About-Info Icons Head -->
					<section
						class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
						<div class="my-5">

							<form method="POST" action="{{ route('backend_cert_meta_store') }}" enctype="multipart/form-data"
								class="rounded-lg p-2 dark:bg-neutral-700">
								@csrf

								{{-- Hidden "remove" flags (Dropify will set these dynamically) --}}
								<input type="hidden" name="remove[watermark]" id="remove_watermark" value="0">
								<input type="hidden" name="remove[trainer_signature]" id="remove_trainer_signature" value="0">


								<!-- Headers -->
								<div>
									<div class="mb-5 mt-2">
										<label for="header_top" class="inputLabelMedium">Header:Top</label>
										<input type="text" name="header_top" class="mediumInput"
											value="{{ old('header_top', $certMeta?->header_top ?? '') }}">
									</div>

									<div class="mb-5 mt-2">
										<label for="header_middle" class="inputLabelMedium">Header:Middle</label>
										<input type="text" name="header_middle" class="mediumInput"
											value="{{ old('header_middle', $certMeta?->header_middle ?? '') }}">
									</div>

									<div class="mb-5 mt-2">
										<label for="header_bottom" class="inputLabelMedium">Header:Bottom</label>
										<input type="text" name="header_bottom" class="mediumInput"
											value="{{ old('header_bottom', $certMeta?->header_bottom ?? '') }}">
									</div>
								</div>


								<hr class="my-10 border-none h-0.5 bg-gray-400">
								<!-- Trainer Details -->
								<div>
									<div class="mb-5 mt-2">
										<label for="trainer_name" class="inputLabelMedium">Trainer Name</label>
										<input type="text" name="trainer_name" class="mediumInput"
											value="{{ old('trainer_name', $certMeta?->trainer_name ?? '') }}">
									</div>

									<div class="mb-5 mt-2">
										<label for="trainer_certification" class="inputLabelMedium">Trainer Certification</label>
										<input type="text" name="trainer_certification" class="mediumInput"
											value="{{ old('trainer_certification', $certMeta?->trainer_certification ?? '') }}">
									</div>

									<div class="mb-5 mt-2">
										<label for="assist_trainer_name" class="inputLabelMedium">Assistant Trainer Name (if
											any)</label>
										<input type="text" name="assist_trainer_name" class="mediumInput"
											value="{{ old('assist_trainer_name', $certMeta?->assist_trainer_name ?? '') }}">
									</div>

									<div class="mb-5 mt-2">
										<label for="agency_name" class="inputLabelMedium">Agency Name</label>
										<input type="text" name="agency_name" class="mediumInput"
											value="{{ old('agency_name', $certMeta?->agency_name ?? '') }}">
									</div>
								</div>


								<hr class="my-10 border-none h-0.5 bg-gray-400">

								<!-- Image Fields -->
								@php
									$imageFields = [
										'trainer_signature' => 'Trainer Signature',
										'watermark' => 'Watermark',
									];
								  @endphp

								@foreach ($imageFields as $field => $label)
									<div class="mb-6">
										<label class="inputLabelMedium">{{ $label }}</label>
										<input type="file" id="{{ $field }}" name="{{ $field }}" class="dropify" data-height="150"
											@if ($certMeta?->$field) data-default-file="{{ Storage::url($certMeta->$field) }}"
											@endif />
									</div>
								@endforeach

								<hr class="my-10 border-none h-0.5 bg-gray-400">

								<!-- Footer -->

								<div class="mb-5 mt-2">
									<label for="footer" class="inputLabelMedium">Footer Text</label>
									<textarea class="summernote" name="footer">{{ old('footer', $certMeta?->footer ?? '') }}</textarea>
								</div>

								<button type="submit" class="showButton my-4">Submit / Update</button>
							</form>

						</div>
					</section>
					<!-- Form::About-Info Icons Head -->
				</div>
			</div>
		</div>
		<!--  -->

	</div>

	<!---------------------------------------------------------------------------------------------- accordion -->

	{{-- Dropify removal logic --}}
	<script>
		$(document).ready(function () {
			// Initialize all dropify elements
			$('.dropify').dropify();

			// Attach dynamic event handlers to each one
			$('.dropify').each(function () {
				const input = $(this);
				const id = input.attr('id');
				const hiddenField = $('#remove_' + id);

				// When file is cleared (trash icon clicked)
				input.on('dropify.afterClear', function () {
					hiddenField.val(1);
				});

				// When new file is chosen again
				input.on('change', function () {
					hiddenField.val(0);
				});
			});
		});
	</script>







	<!-- ---------------- APP AREA Starts ---------------- -->

</x-app-layout>