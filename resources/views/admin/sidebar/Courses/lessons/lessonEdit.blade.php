<x-app-layout>

    @php
        $breadCrumbs = [
            ['label' => 'Course Management', 'url' => 'backend_courses_create', 'icon' => 'documentLines'],
            ['label' => 'All Modules', 'url' => 'backend_all_modules', 'icon' => 'documentLines'],
            ['label' => 'All Lessons', 'url' => 'backend_all_lessons', 'icon' => 'documentLines'],
            ['label' => 'Modify Lesson', 'icon' => 'envelope'],
        ];
    @endphp

    <x-breadcrumb :crumbs="$breadCrumbs" />
    <!-- ---------------- APP AREA Starts ---------------- -->

    <!-- Start Main Widgets -->
    <x-page_header_widget :pageName="'Lesson: ' . Str::limit($singleLesson->title, 60)" />
    <!-- End Main Widgets -->


    <!-- Alert Component -->
    <x-alert-component message="Form Submission" />
    <!-- Alert Component -->

    @php
        $ORDER_IN_PAGE = 1;
        $ACCORDION_1_VISIBILITY = ''; // hidden or ''
        $ACCORDION_2_VISIBILITY = 'hidden';
        $ACCORDION_3_VISIBILITY = 'hidden';
    @endphp

    <!---------------------------------------------------------------------------------------------- accordion -->
    <div class="hs-accordion-group">

        <x-ui_items.accordion.accordion-destroy />

        <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
            id="hs-destroy-heading-one">

            <x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify This Lesson" />

            <div id="hs-destroy-collapse-one"
                class="hs-accordion-content {{ $ACCORDION_1_VISIBILITY }} w-full overflow-hidden transition-[height] duration-300"
                role="region" aria-labelledby="hs-destroy-heading-one">
                <div class="p-3">
                    <!-- Form::Create Course -->
                    <section
                        class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
                        <div class="my-5">

                            <form method="POST" action="{{ route('backend_lesson_store') }}"
                                class="rounded-lg p-2 dark:bg-neutral-700" enctype="multipart/form-data">
                                @csrf

                                <!--- IDENTIFIER HIDDEN INPUTS -->
                                <div>
                                    <input type="hidden" name="flag" class="smallInput" value="update">
                                    <input type="hidden" name="id" class="smallInput"
                                        value="{{ $singleLesson?->id ?? null }}">
                                    <input type="hidden" name="lesson_uid" id="lessonUID"
                                        value="{{ $singleLesson->lesson_uid ?? '' }}">
                                    <input type="hidden" name="video" id="videoPath"
                                        value="{{ $singleLesson->video ?? '' }}">
                                    <input type="hidden" name="remove_image" id="remove_image" value="0">
                                    <input type="hidden" name="remove_video" id="remove_video" value="0">
                                </div>
                                <!--- IDENTIFIER HIDDEN INPUTS -->

                                <div>
                                    <div class="mb-5 mt-2">
                                        <label for="title" class="inputLabelMedium">Lesson UID</label>
                                        <input type="text" name="title" class="normalInput" id="lessonTitle"
                                            value="{{ old('title', $singleLesson->lesson_uid ?? '') }}" readonly
                                            disabled>
                                    </div>
                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label for="name" class="inputLabelMedium">Pick Course<span
                                                class="text-red-500">*</span></label>
                                        <select id="getCoursesForLesson" name="course_id"
                                            class="selectdropdowninput courseDropdown">
                                            <option value="" selected>Choose a course</option>
                                            @foreach ($allCourses as $course)
                                                <option value="{{ $course->id }}"
                                                    data-course_uid="{{ $course->course_uid }}"
                                                    {{ $singleLesson->course_id == $course->id ? 'selected' : '' }}>
                                                    ID: {{ $course?->id }} | {{ $course?->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- -->
                                    <div class="mb-5 mt-2">
                                        <label for="name" class="inputLabelMedium">Pick Module<span
                                                class="text-red-500">*</span></label>
                                        <select id="getModulesForLesson" name="module_id" class="selectdropdowninput">
                                            <option value="" selected>Choose a module</option>
                                            @foreach ($allModules as $module)
                                                <option value="{{ $module->id }}"
                                                    {{ $singleLesson->module_id == $module->id ? 'selected' : '' }}>
                                                    ID: {{ $module?->id }} | {{ $module?->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- -->
                                    <div class="mb-5 mt-2">
                                        <label for="name" class="inputLabelMedium">Select Insturctor<span
                                                class="text-red-500">*</span></label>
                                        <select name="instructor_id" class="selectdropdowninput">
                                            <option value="" selected>Select One</option>
                                            @foreach ($allInstructors as $instructor)
                                                <option value="{{ $instructor->id }}"
                                                    {{ $singleLesson->instructor_id == $instructor->id ? 'selected' : '' }}>
                                                    {{ $instructor->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- -->
                                    <div class="mb-5 mt-2">
                                        <label for="lesson_time" class="inputLabelMedium">Lesson Time
                                            <span class="text-sm text-gray-400 font-light"> (Use positive integers only
                                                as minutes, e.g., 45, 15, 30, etc.)</span>
                                        </label>
                                        <input type="text" name="lesson_time" class="mediumInput"
                                            value="{{ old('lesson_time', $singleLesson->lesson_time ?? '') }}">
                                    </div>
                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label for="title" class="inputLabelMedium">Lesson Title
                                            <span class="text-sm text-gray-400 font-light"> (max 255 characters)</span>
                                        </label>
                                        <input type="text" name="title" class="mediumInput" id="lessonTitle"
                                            value="{{ old('title', $singleLesson->title ?? '') }}">
                                    </div>
                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label for="description" class="inputLabelMedium">Lesson Description
                                            <span class="text-sm text-gray-400 font-light"> (max 2,000
                                                characters)</span>
                                        </label>

                                        <textarea class="summernote" name="description">{!! old('description', $singleLesson->description ?? '') !!}</textarea>
                                    </div>
                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label for="transcript_text" class="inputLabelMedium">Transcript/Lesson Text
                                            <span class="text-sm text-gray-400 font-light"> (max ~65,000
                                                characters)</span>
                                            <span class="text-sm text-orange-300 font-light"> (avoid direct copy paste.
                                                use
                                                Ctrl+Shift+V or ⌘+Shift+V)</span>
                                        </label>
                                        <textarea class="summernote" name="transcript_text">{!! old('description', $singleLesson->transcript_text ?? '') !!}</textarea>
                                    </div>

                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label class="inputLabelMedium">Banner Image</label>
                                        <input type="file" name="banner_image" class="dropify" id="imageDropify"
                                            data-height="150"
                                            @if (isset($singleLesson) && $singleLesson?->banner_image) data-default-file="{{ Storage::url($singleLesson?->banner_image) }}" @endif />
                                    </div>

                                    <!--  -->
                                    <div class="mb-5 mt-2 grid grid-cols-1">
                                        {{-- <div class="col-span-1">
                                            <label class="inputLabelMedium">Lesson Video</label>
                                            <input type="file" name="video" class="dropify" id="videoDropify"
                                                data-height="150"
                                                @if (isset($singleLesson) && $singleLesson?->video) data-default-file="{{ Storage::url($singleLesson?->video) }}" @endif />
                                        </div> --}}
                                        <div class="col-span-1">
                                            <label class="inputLabelMedium">Lesson Video</label>
                                            <input type="file" id="videoInput" class="dropify" data-height="150"
                                                @if (isset($singleLesson) && $singleLesson?->video) data-default-file="{{ Storage::url($singleLesson?->video) }}" @endif />
                                        </div>
                                        <!-------- VIDEO UPLAOD PROGRESS --------->
                                        <div class="mb-5 mt-2">
                                            <div id="videoUploadProgressWrapper"
                                                style="display:none; margin-top:10px;">
                                                <div
                                                    style="display:flex; justify-content:space-between; margin-bottom:4px;">
                                                    <span style="font-size:13px; color:#6b7280;">Uploading
                                                        video...</span>
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

                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label for="quiz_eligible" class="inputLabelMedium">Active Status</label>
                                        <select id="courses" name="status"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            <option value="1" {{ $singleLesson->status == 1 ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="0" {{ $singleLesson->status == 0 ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                        </select>
                                    </div>

                                    <!--  -->
                                </div>

                                <button type="submit" class="showButton my-4">Save Lesson</button>
                            </form>

                        </div>
                    </section>
                    <!-- Form::Create Course -->
                </div>
            </div>
        </div>
        <!--  -->
        <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
            id="hs-destroy-heading-two">

            <x-ui_items.accordion.accordion_toggle_button toggleLabel="Watch the video" />

            <div id="hs-destroy-collapse-two"
                class="hs-accordion-content {{ $ACCORDION_2_VISIBILITY }} w-full overflow-hidden transition-[height] duration-300"
                role="region" aria-labelledby="hs-destroy-heading-two">
                <div class="p-3">
                    <section
                        class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
                        <div class="w-full h-auto my-5">
                            @php
                                $hasVideo = isset($singleLesson) && !empty($singleLesson?->video);
                                $exists = $hasVideo
                                    ? Storage::disk(config('filesystems.default'))->exists($singleLesson->video)
                                    : false;
                            @endphp

                            @if ($hasVideo && $exists)
                                <div class="w-full rounded-lg border border-gray-300 shadow-sm">
                                    <video class="w-full h-auto object-cover" controls preload="metadata">
                                        <source src="{{ Storage::url($singleLesson->video) }}" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                            @elseif ($hasVideo && !$exists)
                                <div class="p-2 border text-center">
                                    <span class="text-xs text-red-500">
                                        File exists in DB but not found in storage! Re-upload required.
                                    </span>
                                </div>
                            @else
                                <div class="p-2 border text-center">
                                    <span class="text-xs text-orange-400">
                                        No playable video file available!
                                    </span>
                                </div>
                            @endif
                        </div>

                </div>
                </section>
                <!-- Form::Create Course -->
            </div>
        </div>
        <!--  -->
        <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
            id="hs-destroy-heading-three">

            <x-ui_items.accordion.accordion_toggle_button toggleLabel="Lesson Resources" />

            <div id="hs-destroy-collapse-three"
                class="hs-accordion-content {{ $ACCORDION_3_VISIBILITY }} w-full overflow-hidden transition-[height] duration-300"
                role="region" aria-labelledby="hs-destroy-heading-three">
                <div class="p-3">
                    <section
                        class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">

                        <!-- This is Lesson::resource cards -->
                        <div class="p-4 grid grid-cols-3 gap-4">

                            @foreach ($allResources as $resource)
                                <div class="noImageCard col-span-1 p-4 rounded-lg shadow bg-white dark:bg-gray-800">
                                    <div class="w-full flex justify-between">
                                        <span>Resource: {{ $loop->iteration }}</span>
                                        <span
                                            class="px-2 py-1 rounded-full text-xs {{ $resource?->status == 1 ? 'bg-green-500' : 'bg-orange-500' }} text-white">
                                            {{ $resource?->status == 1 ? 'Available' : 'Unavailable' }}
                                        </span>
                                    </div>

                                    <!-- Title + Note -->
                                    <div class="flex items-center justify-between">
                                        <h5 class="mt-2 font-semibold">{{ $resource?->title }}</h5>
                                        <div>
                                            <a href="{{ route('backend_lesson_resource_edit', $resource->id) }}"
                                                class="showButton p-1">
                                                {!! \App\Helpers\IconPack::edit(['class' => 'iconPackItem w-3 h-3 text-gray-100']) !!}
                                            </a>
                                            <form
                                                action="{{ route('backend_lesson_resource_delete', $resource->id) }}"
                                                method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="deleteButton p-1"
                                                    onclick="return confirm('Are you sure you want to delete this resource?');">
                                                    {!! \App\Helpers\IconPack::trash(['class' => 'iconPackItem w-3 h-3 text-gray-100']) !!}
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <p class="text-gray-400 dark:text-gray-200 text-center text-xs mt-1">
                                        {!! $resource->note !!}
                                    </p>

                                    <!-- File preview -->
                                    <div class="mt-4 flex items-center justify-start gap-4">
                                        @php
                                            $extension = strtolower(
                                                trim(pathinfo($resource->file, PATHINFO_EXTENSION)),
                                            );
                                        @endphp

                                        <div class="w-6 h-6 flex items-center justify-center">
                                            @if ($extension === 'pdf')
                                                {!! \App\Helpers\IconPack::file(['class' => 'w-5 h-5 text-red-600']) !!}
                                            @elseif (in_array($extension, ['xls', 'xlsx', 'csv']))
                                                {!! \App\Helpers\IconPack::file(['class' => 'w-5 h-5 text-green-600']) !!}
                                            @elseif (in_array($extension, ['doc', 'docx']))
                                                {!! \App\Helpers\IconPack::file(['class' => 'w-5 h-5 text-blue-600']) !!}
                                            @else
                                                {{-- Fallback for unknown types --}}
                                                {!! \App\Helpers\IconPack::file(['class' => 'w-5 h-5 text-yellow-300']) !!}
                                            @endif
                                        </div>
                                        <p class="text-gray-400 text-sm">{{ $resource?->meta ?? null }}</p>

                                    </div>

                                    <!-- Footer -->
                                    <p class="mt-6 text-gray-400 text-xs">Database-id: {{ $resource?->id }}</p>
                                </div>
                            @endforeach
                        </div>
                        <!-- End Lesson::resource cards -->

                        @if (empty($allResources) || $allResources->isEmpty())
                            <p class="text-center text-gray-400">No files were added</p>
                        @endif
                        <!-- This is No-resource block -->



                    </section>
                </div>
                <!-- Form::Create Course -->
            </div>
        </div>
    </div>
    <!--  -->

    </div>

    <!---------------------------------------------------------------------------------------------- accordion -->

    <!--------- SELECT INPUT DROPDOWN STYLING --------->
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
    <!--------- SELECT INPUT DROPDOWN STYLING --------->

    <!--------- REMVOE FILE --------->
    <script>
        $(document).ready(function() {
            const drEvent = $('#imageDropify').dropify();

            drEvent.on('dropify.afterClear', function(event, element) {
                $('#remove_image').val(1);
            });

            drEvent.on('change', function() {
                $('#remove_image').val(0);
            });
        });
    </script>
    <!--------- REMVOE FILE --------->

    <!--------- GET MODULE OPTIONS BY COURSE DROPDOWN --------->
    <script>
        document.getElementById('getCoursesForLesson').addEventListener('change', function() {
            const courseId = this.value;
            const modulesDropdown = document.getElementById('getModulesForLesson');

            // Reset modules dropdown
            modulesDropdown.innerHTML = '<option value="" selected>Choose a module</option>';

            if (!courseId) return; // Exit if no course selected

            // Fetch modules for the selected course
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
                .catch(err => {
                    console.error('Error fetching modules:', err);
                    alert('Failed to load modules. Please try again.');
                });
        });
    </script>
    <!--------- GET MODULE OPTIONS BY COURSE DROPDOWN --------->


    <!--------- CHUNKING --------->
    @include('components.lessonUploadChunk')
    <!--------- CHUNKING --------->

    <!-- ---------------- APP AREA Starts ---------------- -->

</x-app-layout>
