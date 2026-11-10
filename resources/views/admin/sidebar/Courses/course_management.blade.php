<x-app-layout>

    @php
        $breadCrumbs = [
            ['label' => 'Course Management', 'url' => 'backend_courses_create', 'icon' => 'documentLines'],
            ['label' => 'Make Course'],
        ];
    @endphp

    <x-breadcrumb :crumbs="$breadCrumbs" />
    <!-- ---------------- APP AREA Starts ---------------- -->

    <!-- Start Main Widgets -->
    <x-page_header_widget pageName="Course Management" />
    <!-- End Main Widgets -->


    <!-- Alert Component -->
    <x-alert-component message="Form Submission" />
    <!-- Alert Component -->

    @php
        $ORDER_IN_PAGE = 1;
        $ACCORDION_1_VISIBILITY = 'hidden'; // hidden or ''
        $ACCORDION_2_VISIBILITY = 'hidden';
        $ACCORDION_3_VISIBILITY = 'hidden';
        $ACCORDION_4_VISIBILITY = 'hidden';
        $ACCORDION_5_VISIBILITY = 'hidden';
        $ACCORDION_6_VISIBILITY = 'hidden';
    @endphp

    <!------------------------------------------- ACCORDION ---------------------------------------- -->
    <div class="hs-accordion-group">
        <x-ui_items.accordion.accordion-destroy />

        <div id="hs-destroy-heading-one" {{-- Course --}}
            class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent">

            <x-ui_items.accordion.accordion_toggle_button toggleLabel="1. Create A Course" />

            <div id="hs-destroy-collapse-one"
                class="hs-accordion-content {{ $ACCORDION_1_VISIBILITY }} w-full overflow-hidden transition-[height] duration-300"
                role="region" aria-labelledby="hs-destroy-heading-one">
                <div class="p-3">
                    <!-- Form::Create Course -->
                    <section
                        class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
                        <div class="my-5">
                            <form method="POST" action="{{ route('backend_courses_store') }}"
                                class="rounded-lg p-2 dark:bg-neutral-700" enctype="multipart/form-data">
                                @csrf

                                <!--- IDENTIFIER HIDDEN INPUTS -->
                                <input type="hidden" name="flag" class="smallInput" value="create">
                                <!--- IDENTIFIER HIDDEN INPUTS -->

                                <div>
                                    <div class="mb-5 mt-2">
                                        <label for="title" class="inputLabelMedium">Course Title<span
                                                class="text-red-500">*</span></label>
                                        <input type="text" name="title" class="mediumInput"
                                            placeholder="max 255-characters">
                                    </div>
                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label for="description" class="inputLabelMedium">Course Description<span
                                                class="text-sm text-gray-400 font-light"> (Max 2000
                                                characters)</span></label>
                                        <textarea class="summernote" name="description" id="description"></textarea>
                                    </div>
                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label for="what_to_learn" class="inputLabelMedium">What To Learn<span
                                                class="text-sm text-gray-400 font-light"> (Max 2000
                                                characters) (Important: Press Enter to line break and separate each
                                                benefit item.)</span></label>
                                        <textarea class="summernote" name="what_to_learn" id="what_to_learn"></textarea>
                                    </div>
                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label class="inputLabelMedium">Banner Image</label>
                                        <input type="file" name="banner_image" class="dropify" data-height="150" />
                                    </div>
                                </div>

                                <button type="submit" class="editButton my-4">Create Course</button>
                            </form>
                        </div>
                    </section>
                    <!-- Form::Create Course -->
                </div>
            </div>
        </div>
        <!--  -->
        <div id="hs-destroy-heading-two" {{-- Module --}}
            class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent">

            @php
                $ORDER_IN_PAGE = 2;
            @endphp

            <x-ui_items.accordion.accordion_toggle_button toggleLabel="2. Create New Module" />

            <div id="hs-destroy-collapse-two"
                class="hs-accordion-content {{ $ACCORDION_2_VISIBILITY }} w-full overflow-hidden transition-[height] duration-300"
                role="region" aria-labelledby="hs-destroy-heading-two">
                <div class="p-3">
                    <!-- Form::About-Promo -->
                    <section
                        class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
                        <div class="my-5">
                            <form method="POST" action="{{ route('backend_module_store') }}"
                                class="rounded-lg p-2 dark:bg-neutral-700" enctype="multipart/form-data">
                                @csrf

                                <!--- IDENTIFIER HIDDEN INPUTS -->
                                <input type="hidden" name="flag" class="smallInput" value="create">
                                <!--- IDENTIFIER HIDDEN INPUTS -->

                                <div>

                                    <div class="mb-5 mt-2">
                                        <select id="courses" name="course_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="" selected>Choose a course</option>
                                            @foreach ($allCourses as $course)
                                                <option value="{{ $course->id }}">ID:{{ $course->id }} |
                                                    {{ $course->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!-- -->
                                    <div class="mb-5 mt-2">
                                        <label for="title" class="inputLabelMedium">Module Title<span
                                                class="text-red-500">*</span></label>
                                        <input type="text" name="title" class="mediumInput"
                                            placeholder="max 255-characters">
                                    </div>
                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label for="description" class="inputLabelMedium">Module Description<span
                                                class="text-sm text-gray-300 font-light"> (Max 2000
                                                characters)</span></label>
                                        <textarea class="summernote" name="description" id="description"></textarea>
                                    </div>
                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label for="description" class="inputLabelMedium">Link a Quiz</label>
                                        <select id="courses" name="quiz_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="" selected>No Quiz</option>
                                            @foreach ($allQuizzes as $index => $quiz)
                                                <option value="{{ $quiz->id }}">[Quiz ID:{{ $quiz->id }}] -
                                                    {{ $quiz->title }} - [{{ $quiz->total_questions }} ques] -
                                                    [{{ $quiz->time }} min] - [{{ $quiz->passing_score }}%]</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="editButton my-4">Create Module</button>
                            </form>
                        </div>
                    </section>
                    <!-- Form::About-Promo -->
                </div>
            </div>
        </div>
        <!--  -->
        <div id="hs-destroy-heading-three" {{-- Instructor --}}
            class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent">

            <x-ui_items.accordion.accordion_toggle_button toggleLabel="3. Create Instructors" />

            <div id="hs-destroy-collapse-three"
                class="hs-accordion-content {{ $ACCORDION_3_VISIBILITY }} w-full overflow-hidden transition-[height] duration-300"
                role="region" aria-labelledby="hs-destroy-heading-three">
                <div class="p-3">
                    <!-- Form::Create Instructor -->
                    <section
                        class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
                        <div class="my-5">
                            <form method="POST" action="{{ route('backend_instructor_store') }}"
                                class="rounded-lg p-2 dark:bg-neutral-700" enctype="multipart/form-data">
                                @csrf

                                <!--- IDENTIFIER HIDDEN INPUTS -->
                                <input type="hidden" name="flag" class="smallInput" value="create">
                                <!--- IDENTIFIER HIDDEN INPUTS -->

                                <div>
                                    <div class="mb-5 mt-2">
                                        <label for="name" class="inputLabelMedium">Instructor's Name<span
                                                class="text-red-500">*</span></label>
                                        <input type="text" name="name" class="mediumInput"
                                            placeholder="max 255-characters">
                                    </div>
                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label for="designation" class="inputLabelMedium">Designation</label>
                                        <input type="text" name="designation" class="mediumInput"
                                            placeholder="max 255-characters">
                                    </div>
                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label for="bio" class="inputLabelMedium">Bio<span
                                                class="text-sm text-gray-300 font-light"> (Max 2000
                                                characters)</span></label>
                                        <textarea class="summernote" name="bio" id="bio"></textarea>
                                    </div>
                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label class="inputLabelMedium">Display Picture</label>
                                        <input type="file" name="display_picture" class="dropify"
                                            data-height="150" />
                                    </div>
                                </div>

                                <button type="submit" class="editButton my-4">Enlist Instructor</button>
                            </form>
                        </div>
                    </section>
                    <!-- Form::Create Instructor -->
                </div>
            </div>
        </div>
        <!--  -->
        <div id="hs-destroy-heading-four" {{-- Lesson --}}
            class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent">

            <x-ui_items.accordion.accordion_toggle_button toggleLabel="4. Create Lessons" />

            <div id="hs-destroy-collapse-four"
                class="hs-accordion-content {{ $ACCORDION_4_VISIBILITY }} w-full overflow-hidden transition-[height] duration-300"
                role="region" aria-labelledby="hs-destroy-heading-four">
                <div class="p-3">

                    <!-- Form::Create Lesson -->
                    <section
                        class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
                        <div class="my-5">
                            <form method="POST" action="{{ route('backend_lesson_store') }}"
                                class="rounded-lg p-2 dark:bg-neutral-700" enctype="multipart/form-data">
                                @csrf

                                <!--- IDENTIFIER HIDDEN INPUTS -->
                                <input type="hidden" name="flag" class="smallInput" value="create">
                                <input type="hidden" name="lesson_uid" id="lessonUID">
                                <input type="hidden" name="video" id="videoPath">
                                <!--- IDENTIFIER HIDDEN INPUTS -->

                                <div>

                                    <div class="form-block">
                                        <div class="mb-5 mt-2">
                                            <label class="inputLabelMedium">Pick Course<span
                                                    class="text-red-500">*</span></label>
                                            <select name="course_id"
                                                class="courseDropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                <option value="" selected>Choose a course</option>
                                                @foreach ($allCourses as $course)
                                                    <option value="{{ $course->id }}"
                                                        data-course_uid="{{ $course->course_uid }}">ID:
                                                        {{ $course->id }} |
                                                        {{ $course->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!--  -->
                                        <div class="mb-5 mt-2">
                                            <label class="inputLabelMedium">Select Module<span
                                                    class="text-red-500">*</span></label>
                                            <select name="module_id"
                                                class="getModulesByCourseDropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                <option value="" selected>Choose a module</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- -->
                                    <div class="mb-5 mt-2">
                                        <label for="name" class="inputLabelMedium">Select Instructor<span
                                                class="text-red-500">*</span></label>
                                        <select name="instructor_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                            <option value="" selected>Choose an instructor</option>
                                            @foreach ($instructors as $instructor)
                                                <option value="{{ $instructor->id }}">{{ $instructor->name }} &nbsp;
                                                    || &nbsp;
                                                    {{ $instructor->designation }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- -->
                                    <div class="mb-5 mt-2">
                                        <label for="lesson_time" class="inputLabelMedium">Lesson Time</label>
                                        <input type="number" name="lesson_time" class="mediumInput"
                                            placeholder="Use positive integers only as minutes, like 45, 35, 15, etc.">
                                    </div>
                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label for="title" class="inputLabelMedium">Lesson Title</label>
                                        <input type="text" name="title" class="mediumInput" id="lessonTitle"
                                            placeholder="max 255-characters">
                                    </div>
                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label for="description" class="inputLabelMedium">Lesson Description</label>
                                        <textarea class="summernote" name="description"></textarea>
                                    </div>
                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label for="transcript_text" class="inputLabelMedium">Transcript/Lesson Text
                                            <span class="text-sm text-gray-300 font-light"> (max ~65,000
                                                characters)</span>
                                            <span class="text-sm text-orange-300 font-light"> (avoid direct copy paste.
                                                use
                                                Ctrl+Shift+V or ⌘+Shift+V)</span>
                                        </label>
                                        <textarea class="summernote" name="transcript_text"></textarea>
                                    </div>

                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label class="inputLabelMedium">Display Picture</label>
                                        <input type="file" name="banner_image" class="dropify"
                                            data-height="150" />
                                    </div>

                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label class="inputLabelMedium">Lesson Video</label>
                                        <input type="file" id="videoInput" class="dropify" data-height="150" />
                                    </div>
                                    <!-------- VIDEO UPLAOD PROGRESS --------->
                                    <div class="mb-5 mt-2">
                                        <div id="videoUploadProgressWrapper" style="display:none; margin-top:10px;">
                                            <div
                                                style="display:flex; justify-content:space-between; margin-bottom:4px;">
                                                <span style="font-size:13px; color:#6b7280;">Uploading video...</span>
                                                <span id="videoUploadPercent"
                                                    style="font-size:13px; color:#6b7280;">0%</span>
                                            </div>
                                            <div
                                                style="width:100%; background:#e5e7eb; border-radius:6px; height:8px;">
                                                <div id="videoUploadProgressBar"
                                                    style="width:0%; height:8px; background:#3b82f6; border-radius:6px; transition:width 0.3s ease;">
                                                </div>
                                            </div>
                                            <span id="videoUploadStatusMsg"
                                                style="font-size:12px; color:#9ca3af; margin-top:4px; display:block;"></span>
                                        </div>
                                    </div>
                                    <!-------- VIDEO UPLAOD PROGRESS --------->

                                </div>

                                <button type="submit" class="editButton my-4">Save Lesson</button>
                            </form>
                        </div>
                    </section>
                    <!-- Form::Create Lesson -->

                </div>
            </div>
        </div>
        <!--  -->
        <div id="hs-destroy-heading-five" {{-- Lesson Resource --}}
            class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent">

            <x-ui_items.accordion.accordion_toggle_button toggleLabel="5. Create Lesson Resources" />

            <div id="hs-destroy-collapse-five"
                class="hs-accordion-content {{ $ACCORDION_5_VISIBILITY }} w-full overflow-hidden transition-[height] duration-300"
                role="region" aria-labelledby="hs-destroy-heading-five">
                <div class="p-3">

                    <!-- Form::Create Lesson -->
                    <section
                        class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
                        <div class="my-5">
                            <form method="POST" action="{{ route('backend_lesson_resource_store') }}"
                                class="rounded-lg p-2 dark:bg-neutral-700" enctype="multipart/form-data">
                                @csrf

                                <!--- IDENTIFIER HIDDEN INPUTS -->
                                <input type="hidden" name="flag" class="smallInput" value="create">
                                <!--- IDENTIFIER HIDDEN INPUTS -->

                                <div>

                                    <div class="form-block">
                                        <div class="mb-5 mt-2">
                                            <label class="inputLabelMedium">Pick Course<span
                                                    class="text-red-500">*</span></label>
                                            <select name="course_id" required
                                                class="courseDropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                <option value="" selected>Choose a course</option>
                                                @foreach ($allCourses as $course)
                                                    <option value="{{ $course->id }}">{{ $course->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-5 mt-2">
                                            <label class="inputLabelMedium">Select Module<span
                                                    class="text-red-500">*</span></label>
                                            <select name="module_id" required
                                                class="getModulesByCourseDropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                <option value="" selected>Choose a module</option>
                                            </select>
                                        </div>

                                        <div class="mb-5 mt-2">
                                            <label class="inputLabelMedium">Select Lesson<span
                                                    class="text-red-500">*</span></label>
                                            <select name="lesson_id" required
                                                class="getLessonsByModuleDropdown bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                                <option value="" selected>Choose a lesson</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- -->

                                    <div id="resourceContainer">
                                        <!-- Initial Resource Block -->
                                        <div class="p-4 grid grid-cols-3 gap-4 border border-gray-300 rounded-lg resource-block"
                                            data-index="0">
                                            <div class="col-span-3 flex justify-between items-start">
                                                <label class="inputLabelMedium">Resource Title</label>
                                                <button type="button"
                                                    class="removeResourceBtn bg-red-500 text-white px-3 py-1 rounded text-sm">
                                                    Remove
                                                </button>
                                            </div>

                                            <div class="col-span-3">
                                                <input type="text" name="title[0]" class="mediumInput"
                                                    placeholder="max 255-characters">
                                            </div>

                                            <div class="col-span-1 file-container">
                                                <label class="inputLabelMedium">Add Resource File</label>
                                                <div class="mb-5 mt-2 file-block">
                                                    <input type="file" name="file[0]" class="dropify" />
                                                </div>
                                            </div>

                                            <div class="col-span-2 note-container">
                                                <label class="inputLabelMedium">Note
                                                    <span class="text-sm text-gray-300 font-light"> (max ~200
                                                        characters)</span>
                                                </label>
                                                <textarea class="summernote" name="note[0]"></textarea>
                                            </div>
                                        </div>

                                        <!-- Add Resource Button -->
                                        <div class="mt-3 flex justify-end">
                                            <button type="button" id="addResourceBtn"
                                                class="bg-blue-500 text-white px-4 py-2 rounded">
                                                + Add Resource
                                            </button>
                                        </div>
                                    </div>

                                </div>

                                <button type="submit" class="editButton my-4">Save Lesson</button>
                            </form>
                        </div>
                    </section>
                    <!-- Form::Create Lesson -->

                </div>
            </div>
        </div>

    </div>
    <!------------------------------------------- ACCORDION ---------------------------------------- -->


    <!--------- Script for video (promo) to start video always at 50%  --------->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const video = document.getElementById("promoVideo");
            if (video) {
                video.volume = 0.5; // 50%
            }
        });
    </script>
    <!--------- Script for video (promo) to start video always at 50%  --------->


    <!--------- GET MODULE OPTIONS BY COURSE DROPDOWN --------->
    <script>
        document.querySelectorAll('.form-block').forEach(block => {
            const courseDropdown = block.querySelector('.courseDropdown');
            const modulesDropdown = block.querySelector('.getModulesByCourseDropdown');
            const lessonsDropdown = block.querySelector('.getLessonsByModuleDropdown'); // May be null

            // --- Load modules on course change ---
            courseDropdown.addEventListener('change', function() {
                const courseId = this.value;
                modulesDropdown.innerHTML = '<option value="" selected>Choose a module</option>';

                // Only reset lessons dropdown if it exists
                if (lessonsDropdown) {
                    lessonsDropdown.innerHTML = '<option value="" selected>Choose a lesson</option>';
                }

                if (!courseId) return;

                fetch(`/admin/courses/${courseId}/get/modules`)
                    .then(response => response.json())
                    .then(modules => {
                        modules.forEach(module => {
                            const option = document.createElement('option');
                            option.value = module.id;
                            option.text = module.title;
                            modulesDropdown.appendChild(option);
                        });
                    })
                    .catch(err => console.error('Error fetching modules:', err));
            });

            // --- Load lessons on module change (only if lessons dropdown exists) ---
            if (lessonsDropdown) {
                modulesDropdown.addEventListener('change', function() {
                    const moduleId = this.value;
                    lessonsDropdown.innerHTML = '<option value="" selected>Choose a lesson</option>';

                    if (!moduleId) return;

                    fetch(`/admin/modules/${moduleId}/get/lessons`)
                        .then(response => response.json())
                        .then(lessons => {
                            lessons.forEach(lesson => {
                                const option = document.createElement('option');
                                option.value = lesson.id;
                                option.text = lesson.title;
                                lessonsDropdown.appendChild(option);
                            });
                        })
                        .catch(err => console.error('Error fetching lessons:', err));
                });
            }
        });
    </script>
    <!--------- GET MODULE OPTIONS BY COURSE DROPDOWN --------->

    <!--------- REMVOE FILE --------->
    {{-- <script>
        $(document).ready(function() {
            const drEvent = $('#videoInput').dropify();
            drEvent.on('dropify.afterClear', function(event, element) {
                $('#remove_video').val(1);
                $('#videoPath').val('');
                if (window.newVideoUploadedThisSession) {
                    discardUploadedVideo();
                }
            });
            drEvent.on('change', function() {
                $('#remove_video').val(0);
                window.newVideoUploadedThisSession = false;
            });

            const imgEvent = $('#imageDropify').dropify();
            imgEvent.on('dropify.afterClear', function(event, element) {
                $('#remove_image').val(1);
            });
            imgEvent.on('change', function() {
                $('#remove_image').val(0);
            });
        });
    </script> --}}
    <!--------- REMVOE FILE --------->

    <!--------- Dropify Dynamically load more files & inputs --------->
    <script>
        $(document).ready(function() {
            const maxResources = 9;

            // Initialize existing Dropify and Summernote
            $('.dropify').dropify();
            $('.summernote').summernote({
                height: 100
            });

            function createResourceBlock(index) {
                const block = $(`
						<div class="my-2 p-4 grid grid-cols-3 gap-4 border border-gray-300 rounded-lg resource-block" data-index="${index}">
								<div class="col-span-3 flex justify-between items-start">
									<label class="inputLabelMedium">Resource Title</label>
									<button type="button" class="removeResourceBtn bg-red-500 text-white px-3 py-1 rounded text-sm">
										Remove
									</button>
								</div>

								<div class="col-span-3">
									<input type="text" name="title[${index}]" class="mediumInput" placeholder="max 255-characters">
								</div>

								<div class="col-span-1 file-container">
									<label class="inputLabelMedium">Add Resource File</label>
									<div class="mb-5 mt-2 file-block">
										<input type="file" name="file[${index}]" class="dropify" />
									</div>
								</div>

								<div class="col-span-2 note-container">
									<label class="inputLabelMedium">Note
										<span class="text-sm text-gray-300 font-light"> (max ~200 characters)</span>
									</label>
									<textarea class="summernote" name="note[${index}]"></textarea>
								</div>
						</div>
					`);

                block.find('.dropify').dropify();
                block.find('.summernote').summernote({
                    height: 100
                });

                return block;
            }

            function reindexResources() {
                $('#resourceContainer .resource-block').each(function(index) {
                    const $block = $(this);
                    const titleInput = $block.find('input[type="text"]');
                    const summernoteTextarea = $block.find('textarea.summernote');
                    const fileInput = $block.find('input[type="file"]');

                    // Get Summernote content before destroying
                    const noteContent = summernoteTextarea.summernote('code');

                    // Update names
                    titleInput.attr('name', `title[${index}]`);
                    fileInput.attr('name', `file[${index}]`);

                    // Destroy and recreate Summernote with new name
                    summernoteTextarea.summernote('destroy');
                    summernoteTextarea.attr('name', `note[${index}]`);
                    summernoteTextarea.summernote({
                        height: 100
                    });
                    summernoteTextarea.summernote('code', noteContent); // Restore content
                });
            }

            // Add new resource block
            $('#addResourceBtn').on('click', function() {
                const currentCount = $('#resourceContainer .resource-block').length;
                if (currentCount >= maxResources) {
                    alert('Maximum ' + maxResources + ' resources allowed');
                    return;
                }
                const newBlock = createResourceBlock(currentCount);
                $(this).parent().before(newBlock);
            });

            // Remove resource block
            $('#resourceContainer').on('click', '.removeResourceBtn', function() {
                const $block = $(this).closest('.resource-block');

                // Destroy Summernote instance before removing block
                $block.find('.summernote').summernote('destroy');

                $block.remove();
                reindexResources();
            });
        });
    </script>
    <!--------- Dropify Dynamically load more files & inputs --------->

    <!--------- CHUNKING --------->
    @include('components.lessonUploadChunk')
    <!--------- CHUNKING --------->

    <!-- ---------------- APP AREA Starts ---------------- -->
</x-app-layout>
