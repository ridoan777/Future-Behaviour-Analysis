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
	<x-page_header_widget pageName="Transactions: Pricing" />
	<!-- End Main Widgets -->


	<!-- Alert Component -->
	<x-alert-component message="Form Submission" />
	<!-- Alert Component -->

	@php
		$ACCORDION_1_VISIBILITY = 'hidden'; // hidden or ''
		$ACCORDION_2_VISIBILITY = '';
		$ACCORDION_3_VISIBILITY = 'hidden';
		$ACCORDION_4_VISIBILITY = '';
	 @endphp

	<!---------------------------------------------------------------------------------------------- accordion -->
	<div class="hs-accordion-group">

		<x-ui_items.accordion.accordion-destroy />

		<div id="hs-destroy-heading-one" {{-- Stripe Keys --}}
			class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent">

			<x-ui_items.accordion.accordion_toggle_button toggleLabel="1. Add stripe keys" />

			<div id="hs-destroy-collapse-one"
				class="hs-accordion-content {{ $ACCORDION_1_VISIBILITY }} w-full overflow-hidden transition-[height] duration-300"
				role="region" aria-labelledby="hs-destroy-heading-one">
				<div class="p-3">
					<section
						class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
						<div class="my-5">

							<form method="POST" action="{{ route('backend_subscriptions_keys_store') }}"
								class="rounded-lg p-2 dark:bg-neutral-700" enctype="multipart/form-data">
								@csrf

								<!--- IDENTIFIER HIDDEN INPUTS -->
								<input type="hidden" name="flag" class="smallInput" value="create">
								<!--- IDENTIFIER HIDDEN INPUTS -->

								<div>

									<div class="mb-5 mt-2">
										<label for="stripe_key" class="inputLabelMedium">Publishable Key
											<span class="text-red-500">*</span>
											<span class="text-sm text-gray-400 font-light"> (Found in Stripe Dashboard > Developers > API Keys > Overview > Stripe Key/Publishable Key > pk_...Aq54...)</span>
										</label>
										<input type="text" name="stripe_key" class="mediumInput"
											placeholder="Stripe/Publishable Key" value="{{ $allKeys?->stripe_key ?? null }}">
									</div>

									<!--  -->

									<div class="mb-5 mt-2">
										<label for="secret_key" class="inputLabelMedium">Stripe Secret Key
											<span class="text-red-500">*</span>
											<span class="text-sm text-gray-400 font-light"> (Found in Stripe Dashboard > Developers > API Keys > Overview > Secret Key > sk_...Aq54...)</span>
										</label>
										<input type="text" name="secret_key" class="mediumInput"
											placeholder="Secret Key" value="{{ $allKeys?->secret_key ?? null }}">
									</div>

									<!--  -->

									<div class="mb-5 mt-2">
										<label for="webhook_secret" class="inputLabelMedium">Webhook Secret Key
											<span class="text-red-500">*</span>
											<span class="text-sm text-gray-400 font-light"> (Found in Stripe Dashboard > Developers > Webhooks > Add Destination > 'Setup Your events & domain' > Webhook Secret Key > whsec_...Aq54...)</span>
										</label>
										<input type="text" name="webhook_secret" class="mediumInput"
											placeholder="Webhook Secret"
											value="{{ $allKeys?->webhook_secret ?? null }}">
									</div>

								</div>

								<button type="submit" class="editButton my-4">Save Keys</button>
							</form>
							
						</div>
					</section>
				</div>
			</div>
		</div>
		<!--  -->
		<div id="hs-destroy-heading-two" {{-- Create Tiers --}}
			class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent">

			<x-ui_items.accordion.accordion_toggle_button toggleLabel="2. Create Payment Packages" />

			<div id="hs-destroy-collapse-two"
				class="hs-accordion-content {{ $ACCORDION_2_VISIBILITY }} w-full overflow-hidden transition-[height] duration-300"
				role="region" aria-labelledby="hs-destroy-heading-two">
				<div class="p-3">
					<!-- Form::Create Quiz -->
					<section
						class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
						<div class="my-5">
							<form method="POST" action="{{ route('backend_transactions_tiers_store') }}"
								class="rounded-lg p-2 dark:bg-neutral-700" enctype="multipart/form-data">
								@csrf

								<!--- IDENTIFIER HIDDEN INPUTS -->
								<input type="hidden" name="flag" class="smallInput" value="create">
								<!--- IDENTIFIER HIDDEN INPUTS -->

								<div>
									<div class="mb-5 mt-2">
										<label for="title" class="inputLabelMedium">Link a Course
											<span class="text-red-500">*</span>
										</label>
										<select id="courses" name="course_id"
											class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
											required>
											<option value="" selected>Link a Course</option>
											@foreach ($allCourses as $course)
												<option value="{{ $course->id }}">{{ $course->title }}</option>
											@endforeach
										</select>
									</div>

									<div class="mb-5 mt-2">
										<label for="tier_name" class="inputLabelMedium">Tier Name/Label
											<span class="text-red-500">*</span>
										</label>
										<input type="text" name="tier_name" class="mediumInput" placeholder="max 40-characters"
											value="{{ old('tier_name') }}">
									</div>

									<!--  -->
									<hr class="my-8 border-0.75 border-gray-300">
									<!--  -->

									<div class="mb-5 mt-2">
										<label for="title" class="inputLabelMedium">Title (Top)
											<span class="text-red-500">*</span>
										</label>
										<input type="text" name="title" class="mediumInput" placeholder="max 40-characters"
											value="{{ old('title') }}">
									</div>

									<!--  -->

									<div class="mb-5 mt-2">
										<label for="subtitle" class="inputLabelMedium">Sub-Title</label>
										<input type="text" name="subtitle" class="mediumInput" placeholder="max 60-characters"
											value="{{ old('title') }}">
									</div>

									<!--  -->
									<hr class="my-8 border-0.75 border-gray-300">
									<!--  -->

									<div class="mb-5 mt-2">
										<label for="starting_price" class="inputLabelMedium">Starting Price
											<span class="text-red-500">*</span>
											<span class="text-sm text-gray-400 font-light"> (Numeric only, e.g., 400,
												55.5, etc. Must be greater than 0)</span>
										</label>
										<input type="text" name="starting_price" class="mediumInput"
											placeholder="Penned-through/Strike-through price" value="{{ old('starting_price') }}">
									</div>

									<!--  -->

									<div class="mb-5 mt-2">
										<label for="final_price" class="inputLabelMedium">Final Price
											<span class="text-red-500">*</span>
											<span class="text-sm text-gray-400 font-light"> (Numeric only, e.g., 400,
												55.5, etc. Must be greater than 0)</span>
										</label>
										<input type="text" name="final_price" class="mediumInput" placeholder="Final price"
											value="{{ old('final_price') }}">
									</div>

									<!--  -->
									<hr class="my-8 border-0.75 border-gray-300">
									<!--  -->

									<div class="mb-5 mt-2">
										<label for="benefits" class="inputLabelMedium">Tier Benefits
											<span class="text-sm text-gray-400 font-light"> (Max 1000 characters)</span>
											<span class="text-sm text-gray-400 font-light"> (Use 'Bulleted List' button
												to seperate them)</span>
										</label>
										<textarea name="benefits" id="ckeditor" rows="10">{{ old('benefits') }}</textarea>
									</div>

									<!--  -->

									<div class="mb-5 mt-2">
										<label for="product_id" class="inputLabelMedium">Stripe Product ID
											<span class="text-red-500">*</span>
										</label>
										<input type="text" name="product_id" class="mediumInput"
											placeholder="Product/Catalogue ID" value="{{ old('product_id') }}">
									</div>

									<!--  -->

									<div class="mb-5 mt-2">
										<label for="price_id" class="inputLabelMedium">Prodcut's Price ID
											<span class="text-red-500">*</span>
										</label>
										<input type="text" name="price_id" class="mediumInput"
											placeholder="Stripe's Package/Tier/Pricing ID of the same product ID"
											value="{{ old('price_id') }}">
									</div>

									<!--  -->
									<div class="mb-5 mt-2">
										<label for="quiz_eligible" class="inputLabelMedium">Duration</label>
										<select id="duration" name="duration"
											class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
											<option value="daily">Daily</option>
											<option value="1" selected>Monthly</option>
											<option value="3">3 Months</option>
											<option value="6">6 Months</option>
											<option value="12">1 year</option>
											<option value="lifetime">One-Time/Lifetime</option>
										</select>
									</div>

									<!--  -->
									<div class="mb-5 mt-2">
										<label for="quiz_eligible" class="inputLabelMedium">Active Status</label>
										<select id="status" name="status"
											class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
											<option value="0">Inactive</option>
											<option value="1">Active</option>
										</select>
									</div>

								</div>

								<button type="submit" class="editButton my-4">Create Tier</button>
							</form>
						</div>
					</section>
					<!-- Form::Create Quiz -->
				</div>
			</div>
		</div>
		<!--  -->
		<div id="hs-destroy-heading-three" {{-- Cashier Test --}}
			class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent hidden">

			<x-ui_items.accordion.accordion_toggle_button toggleLabel="Pricing" />

			<div id="hs-destroy-collapse-three"
				class="hs-accordion-content w-full {{ $ACCORDION_3_VISIBILITY }} overflow-hidden transition-[height] duration-300"
				role="region" aria-labelledby="hs-destroy-heading-three">
				<div class="p-3">
					{{-- CASHIER-STRIPE Pricing Starts --}}
					<div class="mx-auto max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
						<!-- Title -->
						<div class="mx-auto mb-10 max-w-2xl text-center lg:mb-14">
							<h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Subscription
								Plans</h2>
							<p class="mt-1 text-gray-600 dark:text-gray-400">Choose the plan that better fits your
								needs.</p>
						</div>
						<!-- End Title -->

						<!-- Grid -->
						<div class="mt-12 grid gap-6 sm:grid-cols-1 lg:grid-cols-3 lg:items-center">
							<!------------------------ Card ------------------------>
							<div class="flex flex-col rounded-xl border border-gray-200 p-8 text-center dark:border-gray-700">
								<h4 class="text-lg font-medium text-gray-800 dark:text-gray-200">Monthly</h4>
								<span class="mt-5 text-5xl font-bold text-gray-800 dark:text-gray-200">
									<span class="-me-2 text-2xl font-bold">$</span>
									4.99
								</span>
								<p class="mt-2 text-sm text-gray-500">No commitments. Cancel anytime.</p>

								<a href="{{ route('backend_webpages_transactions_checkout', ['plan' => 'price_1SHcIoPOI6AqXEglLkQZs7O9']) }}"
									class="mt-5 inline-flex items-center justify-center gap-x-2 rounded-lg border border-transparent bg-indigo-100 px-4 py-3 text-sm font-semibold text-indigo-800 hover:bg-indigo-200 disabled:pointer-events-none disabled:opacity-50 dark:text-indigo-400 dark:hover:bg-indigo-900 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
									Sign up
								</a>
							</div>
							<!------------------------ End Card ------------------------>

							<!------------------------ Card ------------------------>
							<div
								class="flex flex-col rounded-xl border-2 border-indigo-600 p-8 text-center shadow-xl dark:border-indigo-700">
								<p class="mb-3"><span
										class="inline-flex items-center gap-1.5 rounded-lg bg-indigo-100 px-3 py-1.5 text-xs font-semibold uppercase text-indigo-800 dark:bg-indigo-600 dark:text-white">Most
										popular</span></p>
								<h4 class="text-lg font-medium text-gray-800 dark:text-gray-200">Yearly</h4>
								<span class="mt-5 text-5xl font-bold text-gray-800 dark:text-gray-200">
									<span class="-me-2 text-2xl font-bold">$</span>
									34.99
								</span>
								<p class="mt-2 text-sm text-gray-500">Save 30% with full access for 1 year.</p>

								<a href="{{ route('backend_webpages_transactions_checkout', ['plan' => 'price_1SHcEfPOI6AqXEglD4QDIjj9']) }}"
									class="mt-5 inline-flex items-center justify-center gap-x-2 rounded-lg border border-transparent bg-indigo-600 px-4 py-3 text-sm font-semibold text-white hover:bg-indigo-700 disabled:pointer-events-none disabled:opacity-50 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
									Sign up
								</a>
							</div>
							<!------------------------ End Card ------------------------>

							<!------------------------ Card ------------------------>
							<div class="flex flex-col rounded-xl border border-gray-200 p-8 text-center dark:border-gray-700">
								<h4 class="text-lg font-medium text-gray-800 dark:text-gray-200">Lifetime</h4>
								<span class="mt-5 text-5xl font-bold text-gray-800 dark:text-gray-200">
									<span class="-me-2 text-2xl font-bold">$</span>
									174.99
								</span>
								<p class="mt-2 text-sm text-gray-500">Pay once. Lifetime access.</p>

								<a href="{{ route('backend_webpages_transactions_checkout', ['plan' => 'price_1SHcHgPOI6AqXEglnr0YLqAu']) }}"
									class="mt-5 inline-flex items-center justify-center gap-x-2 rounded-lg border border-transparent bg-indigo-100 px-4 py-3 text-sm font-semibold text-indigo-800 hover:bg-indigo-200 disabled:pointer-events-none disabled:opacity-50 dark:text-indigo-400 dark:hover:bg-indigo-900 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
									Sign up
								</a>
							</div>
							<!------------------------ End Card ------------------------>
						</div>
						<!-- End Grid -->
					</div>
					{{-- CASHIER-STRIPE Pricing Ends --}}
				</div>
			</div>
		</div>
		<!--  -->
		<div id="hs-destroy-heading-four" {{-- Non-Cashier Test --}}
			class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent">

			<x-ui_items.accordion.accordion_toggle_button toggleLabel="Pricing Test: Web Version (Display Only)" />

			<div id="hs-destroy-collapse-four"
				class="hs-accordion-content {{ $ACCORDION_4_VISIBILITY }} w-full overflow-hidden transition-[height] duration-300"
				role="region" aria-labelledby="hs-destroy-heading-four">
				<div class="p-4">
					<section class="grid grid-cols-3 gap-4">

						{{-- TEST Pricing Starts --}}
						@foreach ($allTiers as $tier)
							<div class="p-4 rounded-2xl border">
								<h3 class="text-gray-400	">{{ $tier?->tier_name ?? "N/A" }}</h3>
								<div class="flex justify-between">
									<h5 class="appTextBlue">{{ $tier?->title ?? 'N/A' }}</h5>
									{{-- --}}
									<div>
										<a href="{{ route('backend_transactions_payment_edit', $tier->id) }}" class="showButton p-1">
											{!! \App\Helpers\IconPack::edit(['class' => 'iconPackItem w-3 h-3 text-gray-100']) !!}
										</a>
										<form action="{{ route('backend_transactions_payment_delete', $tier->id) }}" method="POST"
											class="inline-block">
											@csrf
											@method('DELETE')
											<button type="submit" class="deleteButton p-1"
												onclick="return confirm('Are you sure you want to delete this resource?');">
												{!! \App\Helpers\IconPack::trash(['class' => 'iconPackItem w-3 h-3 text-gray-100']) !!}
											</button>
										</form>
									</div>
								</div>
								<div class="flex items-center gap-8">
									<h3>{{ $tier?->final_price ?? 'N/A' }}$</h3>
									<h4 class="line-through">{{ $tier?->starting_price ?? 'N/A' }}$</h4>
									<p class="text-gray-500">{{ $tier?->duration ?? 'N/A' }}
										{{ $tier?->duration === 'lifetime' || $tier?->duration === 'daily' ? '' : 'month/s' }}
									</p>
								</div>
								<h6>{{ $tier?->subtitle ?? 'N/A' }}</h6>
								<button class="mx-auto my-2 editButton">Enroll Now</button>
								<ul class="text-sm">{!! $tier?->benefits ?? 'N/A' !!}</ul>

							</div>
						@endforeach

						{{-- TEST Pricing Ends --}}
					</section>
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