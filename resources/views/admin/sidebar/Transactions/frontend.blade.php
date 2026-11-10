<x-app-layout>

	@php
		$breadCrumbs = [
			['label' => 'WebPages', 'url' => 'dashboard', 'icon' => 'documentLines'],
			['label' => 'Transactions', 'url' => 'backend.webpages_transactions_pricing', 'icon' => 'dollarSackLine'],
			['label' => 'Frontend-Test'],
		];
	 @endphp

	<x-breadcrumb :crumbs="$breadCrumbs" />
	<!-- ---------------- APP AREA Starts ---------------- -->

	<!-- Start Main Widgets -->
	<x-page_header_widget pageName="Transactions: Pricing Test in Frontend" />
	<!-- End Main Widgets -->


	<!-- Alert Component -->
	<x-alert-component message="Form Submission" />
	<!-- Alert Component -->

	@php
		$ACCORDION_1_VISIBILITY = ''; // hidden or ''
		$ACCORDION_2_VISIBILITY = 'hidden';
		$ACCORDION_3_VISIBILITY = 'hidden';
	 @endphp
	<!---------------------------------------------------------------------------------------------- accordion -->
	<div class="hs-accordion-group">

		<x-ui_items.accordion.accordion-destroy />

		<div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
			id="hs-destroy-heading-one">

			<x-ui_items.accordion.accordion_toggle_button toggleLabel="Cashier Pricing Test" />

			<div id="hs-destroy-collapse-one"
				class="hs-accordion-content {{ $ACCORDION_1_VISIBILITY }} w-full overflow-hidden transition-[height] duration-300"
				role="region" aria-labelledby="hs-destroy-heading-one">
				<div class="p-4">
					<section class="grid grid-cols-3 gap-4">
						{{-- TEST Pricing Starts --}}
						@foreach ($allTiers as $tier)
							<div class="p-4 rounded-2xl border">
								<h3 class="appTextBlue	">{{ $tier?->tier_name ?? "N/A" }}</h3>
								<h5>{{ $tier?->title ?? 'N/A' }}</h5>
								<div class="flex items-center gap-8">
									<h3>{{ $tier?->final_price ?? 'N/A' }}</h3>
									<h4 class="line-through">{{ $tier?->starting_price ?? 'N/A' }}</h4>
									<p class="text-gray-500">{{ $tier?->duration ?? 'N/A' }}
										{{ $tier?->duration === 'lifetime' ? '' : 'month/s' }}
									</p>
								</div>
								<h6>{{ $tier?->subtitle ?? 'N/A' }}</h6>
								<a href="{{ route('backend_transactions_payment_confirm', $tier->id) }}"
									class="mx-auto my-2 editButton">Enroll Now</a>
								<ul class="text-sm">{!! $tier?->benefits ?? 'N/A' !!}</ul>
							</div>
						@endforeach
						{{-- TEST Pricing Ends --}}
					</section>

				</div>
			</div>
		</div>
		<!-- -->
		<div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
			id="hs-destroy-heading-two">

			<x-ui_items.accordion.accordion_toggle_button toggleLabel="Non-Cashier Pricing Test" />

			<div id="hs-destroy-collapse-two"
				class="hs-accordion-content {{ $ACCORDION_2_VISIBILITY }} w-full overflow-hidden transition-[height] duration-300"
				role="region" aria-labelledby="hs-destroy-heading-two">
				<div class="p-4">
					<section class="grid grid-cols-3 gap-4">
						{{-- TEST Pricing Starts --}}
						@foreach ($allTiers as $tier)
							<div class="p-4 rounded-2xl border">
								<h3 class="appTextBlue	">{{ $tier?->tier_name ?? "N/A" }}</h3>
								<h5>{{ $tier?->title ?? 'N/A' }}</h5>
								<div class="flex items-center gap-8">
									<h3>{{ $tier?->final_price ?? 'N/A' }}</h3>
									<h4 class="line-through">{{ $tier?->starting_price ?? 'N/A' }}</h4>
									<p class="text-gray-500">{{ $tier?->duration ?? 'N/A' }}
										{{ $tier?->duration === 'lifetime' ? '' : 'month/s' }}
									</p>
								</div>
								<h6>{{ $tier?->subtitle ?? 'N/A' }}</h6>
								<a href="{{ route('backend_transactions_payment_confirm', $tier->id) }}"
									class="mx-auto my-2 editButton">Enroll Now</a>
								<ul class="text-sm">{!! $tier?->benefits ?? 'N/A' !!}</ul>
							</div>
						@endforeach
						{{-- TEST Pricing Ends --}}
					</section>

				</div>
			</div>
		</div>
		<!--  -->
		<div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
			id="hs-destroy-heading-three">

			<x-ui_items.accordion.accordion_toggle_button toggleLabel="Display Outcome" />

			<div id="hs-destroy-collapse-three"
				class="hs-accordion-content w-full {{ $ACCORDION_3_VISIBILITY }} overflow-hidden transition-[height] duration-300"
				role="region" aria-labelledby="hs-destroy-heading-three">

				<div class="p-3 grid grid-cols-1 gap-4">
					@if (isset($homepageData) && $homepageData->where('section', 'title')->isNotEmpty())
						<!-- DISPLAY LIST -->
						<section class="displayArea">
							<div class="my-10 sm:my-16 md:my-20 w-full sm:w-4/5 md:w-3/5 mx-auto flex flex-col gap-4">
								@foreach ($homepageData->where('section', 'title') as $data)
									<h1 class="text-center text-2xl sm:text-3xl md:text-4xl leading-tight md:leading-16">
										{!! $data->title !!}
									</h1>
									<p class="text-gray-500 text-sm sm:text-base text-center px-2">
										{!! $data->subtitle !!}
									</p>
									<div class="flex flex-wrap justify-center gap-2">
										<button class="editButton px-4 py-2 text-sm">{!! $data->btn_1 !!}</button>
										<button class="editButton px-4 py-2 text-sm">{!! $data->btn_2 !!}</button>
									</div>
								@endforeach
							</div>
						</section>
					@endif
					<!--  -->
					@if (isset($homepageData) && $homepageData->where('section', 'hero')->isNotEmpty())
						<section class="displayArea">
							<div class="my-10 sm:my-16 md:my-20 w-full sm:w-11/12 md:w-4/5 mx-auto">
								<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
									@foreach ($homepageData->where('section', 'hero') as $data)
										@if ($data->image)
											<img src="{{ Storage::url($data->image) }}" alt="{{ $data->image }}"
												class="w-full h-auto object-cover rounded-md">
										@elseif($data->btn_1 || $data->btn_2 || $data->btn_3)
											<div class="col-span-4 flex flex-wrap justify-center gap-2 mt-4">
												@foreach (['btn_1', 'btn_2', 'btn_3'] as $btn)
													@if ($data->$btn)
														<button class="pillEmpty px-4 py-2 text-sm">{!! $data->$btn !!}</button>
													@endif
												@endforeach
											</div>
										@endif
									@endforeach
								</div>
							</div>
						</section>
					@endif
					<!-- DISPLAY LIST -->
					@if (!isset($homepageData) || $homepageData->isEmpty())
						<section
							class="displayArea my-5 p-4 w-full rounded-lg border-none bg-white dark:bg-neutral-900 shadow-md shadow-gray-400 dark:shadow-none mx-auto">
							<h2 class="text-center text-gray-400 dark:text-gray-100">No records have been created yet!
							</h2>
						</section>
					@endif
				</div>
			</div>
		</div>

	</div>


	<!---------------------------------------------------------------------------------------------- accordion -->











	<!-- ---------------- APP AREA Starts ---------------- -->

</x-app-layout>