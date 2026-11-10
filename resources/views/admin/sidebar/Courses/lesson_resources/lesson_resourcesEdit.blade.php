<x-app-layout>

	@php
		$breadCrumbs = [
			['label' => 'Course Management', 'url' => 'backend_courses_create', 'icon' => 'documentLines'],
			['label' => 'All Courses', 'url' => 'backend_all_courses', 'icon' => 'document'],
			['label' => 'All Modules', 'url' => 'backend_all_modules', 'icon' => 'cubic'],
			['label' => 'All Lessons', 'url' => 'backend_all_lessons', 'icon' => 'layers'],
			['label' => 'Modify Lesson', 'icon' => 'squarePoll'],
		];
	 @endphp

	<x-breadcrumb :crumbs="$breadCrumbs" />
	<!-- ---------------- APP AREA Starts ---------------- -->

	<!-- Start Main Widgets -->
	<x-page_header_widget pageName="Resource: {{ Str::limit($singleResource->title, 60) }}" />
	<!-- End Main Widgets -->


	<!-- Alert Component -->
	<x-alert-component message="Form Submission" />
	<!-- Alert Component -->

	@php
		$ORDER_IN_PAGE = 1;
		$ACCORDION_1_VISIBILITY = ''; // hidden or ''
		$ACCORDION_2_VISIBILITY = 'hidden';
	 @endphp

	<!---------------------------------------------------------------------------------------------- accordion -->
	<div class="hs-accordion-group">

		<x-ui_items.accordion.accordion-destroy />

		<div id="hs-destroy-heading-one" {{-- Lesson Resource --}}
			class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent">

			<x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify Lesson Resources" />

			<div id="hs-destroy-collapse-one"
				class="hs-accordion-content {{ $ACCORDION_1_VISIBILITY }} w-full overflow-hidden transition-[height] duration-300"
				role="region" aria-labelledby="hs-destroy-heading-one">
				<div class="p-3">

					<!-- Form::Create Lesson -->
					<section
						class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
						<div class="my-5">

							<form method="POST" action="{{ route('backend_lesson_resource_update', $singleResource->id) }}"
								class="rounded-lg p-2 dark:bg-neutral-700" enctype="multipart/form-data">
								@csrf

								<div>
									<!-- Course Dropdown -->
									<div class="form-block">
										<div class="mb-5 mt-2">
											<label class="inputLabelMedium">Pick Course<span class="text-red-500">*</span></label>
											<select name="course_id" required
												class="courseDropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
												<option value="">Choose a course</option>
												@foreach ($allCourses as $course)
													<option value="{{ $course->id }}" {{ $singleLesson->course_id == $course->id ? 'selected' : '' }}>
														{{ $course->title }}
													</option>
												@endforeach
											</select>
										</div>

										<div class="mb-5 mt-2">
											<label class="inputLabelMedium">Select Module<span
													class="text-red-500">*</span></label>
											<select name="module_id" required
												class="getModulesByCourseDropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
												data-selected="{{ $singleLesson->module_id }}">
												<option value="">Choose a module</option>
											</select>
										</div>

										<div class="mb-5 mt-2">
											<label class="inputLabelMedium">Select Lesson<span
													class="text-red-500">*</span></label>
											<select name="lesson_id" required
												class="getLessonsByModuleDropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
												data-selected="{{ $singleLesson->id }}">
												<option value="">Choose a lesson</option>
											</select>
										</div>
									</div>

									<!-- Resource Fields -->
									<div class="p-4 grid grid-cols-3 gap-4 border border-gray-300 rounded-lg">
										<div class="col-span-3">
											<label class="inputLabelMedium">Resource Title</label>
											<input type="text" name="title" class="mediumInput" placeholder="max 255-characters"
												value="{{ old('title', $singleResource->title) }}">
										</div>

										<div class="col-span-1 file-container">
											<label class="inputLabelMedium">Add Resource File</label>
											<div class="mb-5 mt-2 file-block">
												<input type="file" name="file" class="dropify" @if ($singleResource->file)
												data-default-file="{{ Storage::url($singleResource->file) }}" @endif />
											</div>
										</div>

										<div class="col-span-2 note-container">
											<label class="inputLabelMedium">Note
												<span class="text-sm text-gray-300 font-light">(max ~200
													characters)</span>
											</label>
											<textarea class="summernote"
												name="note">{{ old('note', $singleResource->note) }}</textarea>
										</div>
									</div>
								</div>

								<button type="submit" class="editButton my-4">Save Resource</button>
							</form>

						</div>
					</section>
					<!-- Form::Create Lesson -->

				</div>
			</div>
		</div>
		<!--  -->
	</div>
	<!--  -->

	</div>

	<!---------------------------------------------------------------------------------------------- accordion -->

	{{-- Select-Input Dropdown styles --}}
	<style>
		.selectdropdowninput {
			background-color: #f9fafb;
			border: 1px solid #d1d5db;
			color: #111827;
			font-size: 0.875rem;
			border-radius: 0.5rem;
			display: block;
			width: 100%;
			padding: 0.625rem;
			line-height: 1.25rem;
			transition: border-color 0.2s, box-shadow 0.2s;
		}

		.selectdropdowninput:focus {
			outline: none;
			border-color: #3b82f6;
			box-shadow: 0 0 0 1px #3b82f6;
		}
	</style>

	{{-- Select-Input Dropdown styles --}}


	{{-- Script for tweaking remove_image = 1 --}}
	<script>
		$(document).ready(function () {
			// const drEvent = $('.dropify').dropify();
			const drEvent = $('#imageDropify').dropify();

			drEvent.on('dropify.afterClear', function (event, element) {
				$('#remove_image').val(1);
			});

			drEvent.on('change', function () {
				$('#remove_image').val(0);
			});
		});
		$(document).ready(function () {
			// const drEvent = $('.dropify').dropify();
			const drEvent = $('#videoDropify').dropify();

			drEvent.on('dropify.afterClear', function (event, element) {
				$('#remove_video').val(1);
			});

			drEvent.on('change', function () {
				$('#remove_video').val(0);
			});
		});
	</script>

	{{-- Script for tweaking remove_image = 1 --}}


	{{-- Get module options by Course dropdown --}}
	<script>
		document.addEventListener('DOMContentLoaded', function () {
			document.querySelectorAll('.form-block').forEach(block => {
				const courseDropdown = block.querySelector('.courseDropdown');
				const modulesDropdown = block.querySelector('.getModulesByCourseDropdown');
				const lessonsDropdown = block.querySelector('.getLessonsByModuleDropdown');

				const selectedCourseId = courseDropdown.value;
				const selectedModuleId = modulesDropdown.dataset.selected; // We'll set this in Blade
				const selectedLessonId = lessonsDropdown.dataset.selected; // We'll set this in Blade

				// --- Function to load modules ---
				const loadModules = (courseId, selectedModule = null) => {
					modulesDropdown.innerHTML = '<option value="" selected>Choose a module</option>';
					if (!courseId) return;

					fetch(`/admin/courses/${courseId}/get/modules`)
						.then(res => res.json())
						.then(modules => {
							modules.forEach(module => {
								const option = document.createElement('option');
								option.value = module.id;
								option.text = module.title;
								if (selectedModule && module.id == selectedModule) option
									.selected = true;
								modulesDropdown.appendChild(option);
							});

							if (selectedModule) loadLessons(selectedModule, selectedLessonId);
						})
						.catch(err => console.error(err));
				};

				// --- Function to load lessons ---
				const loadLessons = (moduleId, selectedLesson = null) => {
					lessonsDropdown.innerHTML = '<option value="" selected>Choose a lesson</option>';
					if (!moduleId) return;

					fetch(`/admin/modules/${moduleId}/get/lessons`)
						.then(res => res.json())
						.then(lessons => {
							lessons.forEach(lesson => {
								const option = document.createElement('option');
								option.value = lesson.id;
								option.text = lesson.title;
								if (selectedLesson && lesson.id == selectedLesson) option
									.selected = true;
								lessonsDropdown.appendChild(option);
							});
						})
						.catch(err => console.error(err));
				};

				// --- Load modules/lessons on page load if editing ---
				if (selectedCourseId) {
					loadModules(selectedCourseId, modulesDropdown.dataset.selected);
				}

				// --- Event listeners ---
				courseDropdown.addEventListener('change', function () {
					loadModules(this.value);
					lessonsDropdown.innerHTML =
						'<option value="" selected>Choose a lesson</option>';
				});

				modulesDropdown.addEventListener('change', function () {
					loadLessons(this.value);
				});
			});
		});
	</script>

	{{-- Get module options by Course dropdown --}}




	<!-- ---------------- APP AREA Starts ---------------- -->

</x-app-layout>