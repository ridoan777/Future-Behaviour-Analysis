<x-app-layout>

    @php
        $breadCrumbs = [
            ['label' => 'Course Management', 'url' => 'backend_courses_create', 'icon' => 'documentLines'],
            ['label' => 'All Courses', 'url' => 'backend_all_courses', 'icon' => 'documentLines'],
            ['label' => 'Update Course'],
        ];
    @endphp

    <x-breadcrumb :crumbs="$breadCrumbs" />
    <!-- ---------------- APP AREA Starts ---------------- -->

    <!-- Start Main Widgets -->
    <x-page_header_widget pageName="Course: {{ Str::limit($singleCourse->title, 60) }}" />
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

        <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
            id="hs-destroy-heading-one">

            <x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify A Course" />

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
                                <input type="hidden" name="flag" class="smallInput" value="update">
                                <input type="hidden" name="id" class="smallInput"
                                    value="{{ $singleCourse?->id ?? null }}">
                                <input type="hidden" name="remove_image" id="remove_image" value="0">
                                <!--- IDENTIFIER HIDDEN INPUTS -->

                                <div>
                                    <div class="mb-5 mt-2">
                                        <label for="title" class="inputLabelMedium">Course Title<span
                                                class="text-red-500">*</span></label>
                                        <input type="text" name="title" class="mediumInput"
                                            placeholder="max 255-characters"
                                            value="{{ old('title', $singleCourse->title ?? '') }}">
                                    </div>
                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label for="description" class="inputLabelMedium">Course Description<span
                                                class="text-sm text-gray-300 font-light"> (Max 2000
                                                characters)</span></label>
                                        <textarea class="summernote" name="description" id="description">{{ old('description', $singleCourse->description ?? '') }}</textarea>
                                    </div>
                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label for="what_to_learn" class="inputLabelMedium">What To Learn<span
                                                class="text-sm text-gray-400 font-light"> (Max 2000
                                                characters) (Important: Press Enter to line break and separate each
                                                benefit item.)</span></label>
                                        <textarea class="summernote" name="what_to_learn" id="what_to_learn">{{ old('what_to_learn', $singleCourse->what_to_learn ?? '') }}</textarea>
                                    </div>
                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label class="inputLabelMedium">Banner Image</label>
                                        <input type="file" name="banner_image" class="dropify" data-height="150"
                                            @if (isset($singleCourse) && $singleCourse?->banner_image) data-default-file="{{ Storage::url($singleCourse?->banner_image) }}" @endif />
                                    </div>
                                </div>

                                <button type="submit" class="editButton my-4">Update Course</button>
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

            <x-ui_items.accordion.accordion_toggle_button toggleLabel="All modules under this course" />

            <div id="hs-destroy-collapse-two"
                class="hs-accordion-content {{ $ACCORDION_2_VISIBILITY }} w-full overflow-hidden transition-[height] duration-300"
                role="region" aria-labelledby="hs-destroy-heading-two">
                <div class="p-3">
                    <section
                        class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">

                        <!-- This is Course::module cards -->
                        <div class="p-4 grid grid-cols-1 gap-4">
                            @foreach ($singleCourse->courseRelationWith_modules as $singleModule)
                                <a href="{{ route('backend_module_edit', $singleModule->id) }}"
                                    class="noImageCard col-span-1">
                                    <div class="w-full flex justify-between">
                                        <span>Module: {{ $loop->iteration }}</span>
                                        <span
                                            class="px-2 py-1 rounded-full text-xs {{ $singleModule->status == 1 ? 'bg-green-500' : 'bg-orange-500' }} text-white">
                                            {{ $singleModule->status == 1 ? 'Active' : 'Inactive' }}
                                        </span>

                                    </div>
                                    <!--- --->
                                    <h5>{{ $singleModule->title }}</h5>
                                    <p class="dark:text-gray-200 text-center">{!! $singleModule->description !!}
                                    </p>
                                    <!--- --->
                                    <p class="mt-10 text-gray-400">Database-id: {{ $singleModule->id }}</p>
                                </a>
                            @endforeach
                        </div>
                        <!-- This is Course::module cards -->
                    </section>
                </div>
            </div>
        </div>
        <!--  -->

    </div>

    <!---------------------------------------------------------------------------------------------- accordion -->



    {{-- Script for tweaking remove_image = 1 --}}
    <script>
        $(document).ready(function() {
            const drEvent = $('.dropify').dropify();

            drEvent.on('dropify.afterClear', function(event, element) {
                $('#remove_image').val(1);
            });

            drEvent.on('change', function() {
                $('#remove_image').val(0);
            });
        });
    </script>

    {{-- Script for tweaking remove_image = 1 --}}







    <!-- ---------------- APP AREA Starts ---------------- -->

</x-app-layout>
