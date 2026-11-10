<x-app-layout>

	@php
		$breadCrumbs = [
			['label' => 'WebPages', 'url' => 'dashboard', 'icon' => 'documentLines'],
			['label' => 'Transactions', 'url' => 'backend.webpages_transactions_pricing', 'icon' => 'dollarSackLine'],
			['label' => 'Tiers', 'url' => 'backend_webpages_transactions_frontend', 'icon' => 'dollarSackLine'],
			['label' => 'Frontend-Test'],
		];
	 @endphp

	<x-breadcrumb :crumbs="$breadCrumbs" />

	<!-- Start Main Widgets -->
	<x-page_header_widget pageName="Transactions: Payment Confirmation" />
	<!-- End Main Widgets -->


	<!-- Alert Component -->
	<x-alert-component message="Form Submission" />
	<!-- Alert Component -->
	<!-- ---------------- APP AREA Starts ---------------- -->

	{{-- <form method="POST" action="{{ route('backend_transactions_payment_confirmed_store', $tier->id) }}" --}} 
	<form
		method="POST" action="{{ route('backend_webpages_transactions_checkout', $tier->id) }}"
		class="rounded-lg p-2 dark:bg-neutral-700" enctype="multipart/form-data">
		@csrf

		<!--- IDENTIFIER HIDDEN INPUTS -->
		<div>
			<input type="hidden" name="flag" value="create">

			<input type="hidden" name="user_id" value="{{ Auth::id() }}" readonly>
			<input type="hidden" name="tier_id" value="{{ $tier->id }}" readonly>

			<input type="hidden" name="course_id" class="mediumInput"
				value="{{ $tier->subscriptionTiersRelationWith_course->id }}" readonly>
			<input type="hidden" name="paid_amount" value="{{ $tier->final_price }}" readonly>
			<input type="hidden" name="duration" value="{{ $tier->duration }}" readonly>
		</div>
		<!--- IDENTIFIER HIDDEN INPUTS -->

		<div>
			<div class="mb-5 mt-2">
				<label for="title" class="inputLabelMedium">Payer:
					{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</label>
			</div>

			<!--  -->
			<div class="mb-5 mt-2">
				<label for="title" class="inputLabelMedium">Course to purchase:
					{{ $tier->subscriptionTiersRelationWith_course->title }}</label>
			</div>

			<!--  -->

			<div class="mb-5 mt-2 flex items-center gap-20">
				<label for="subtitle" class="inputLabelMedium">Total Amount: {{ $tier->final_price }}$</label>
			</div>

			<!--  -->
			<div>
				<label for="subtitle" class="inputLabelMedium">Duration: {{ $tier->duration }}
					{{ $tier?->duration === 'lifetime' || $tier?->duration === 'daily' ? '(recurring)' : 'month/s' }}</label>
			</div>
			<!--  -->

			<!--  -->
			<div>
				<label for="subtitle" class="inputLabelMedium">Benefits:</label>
				<ul class="text-sm">{!! $tier->benefits !!}</ul>
			</div>
			<!--  -->
			<div class="mb-5 mt-2 flex">
				<input type="checkbox" class="checkBox" id="age_consent" checked="" name="age_consent">
				<label for="age_consent" class="text-sm text-gray-500 ms-3 dark:text-neutral-400">I am 18 years or older
					(You must be at least 18 years old)</label>
			</div>

			<!--  -->
			<div class="mb-5 mt-2 flex">
				<input type="checkbox" class="checkBox" id="education_consent" checked="" name="education_consent">
				<label for="education_consent" class="text-sm text-gray-500 ms-3 dark:text-neutral-400">I acknowledge that I
					have a Diploma or a High School Degree? (This is a requirement)</label>
			</div>

		</div>

		<button type="submit" class="editButton my-4">Confirm Payment</button>
	</form>



	<!-- ---------------- APP AREA Starts ---------------- -->

</x-app-layout>