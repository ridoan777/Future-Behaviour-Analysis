<x-app-layout>

    @php
        $breadCrumbs = [
            ['label' => 'WebPages', 'icon' => 'documentLines'],
            ['label' => 'Course Page', 'icon' => 'documentLines'],
            ['label' => 'CMS'],
        ];

        $headData = $coursePageData->where('page', 'course_page')->where('order_in_pg', 1)->where('section', 'head');

        $subtitleData = $headData->firstWhere('content_name', 'subtitle');
        $titleData = $headData->firstWhere('content_name', 'title');
        $descriptionData = $headData->firstWhere('content_name', 'description');
        $searchPlaceholder = $headData->firstWhere('content_name', 'placeholder');

      $widgetData = $coursePageData
         ->where('page', 'course_page')
         ->where('order_in_pg', 2)
         ->where('section', 'course_widget')
         ->values();

      $widgetItems = collect(range(0, 2))->map(function ($index) use ($widgetData) {
         $saved = $widgetData->get($index);

         return [
            'id' => $saved?->id,
            'content_name' => $saved?->content_name,
            'value' => $saved?->value,
         ];
      });

        $ACCORDION_1_VISIBILITY = '';
        $ACCORDION_2_VISIBILITY = '';
        $ACCORDION_3_VISIBILITY = '';
    @endphp

    <x-breadcrumb :crumbs="$breadCrumbs" />
    <x-page_header_widget pageName="Course Page CMS" />
    <x-alert-component message="Form Submission" />

    <div class="hs-accordion-group">
        <x-ui_items.accordion.accordion-destroy />

        <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
            id="hs-destroy-heading-one">
            <x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify Course Page Head (Must need content names serially to store it's value)" />

            <div id="hs-destroy-collapse-one"
                class="hs-accordion-content w-full {{ $ACCORDION_1_VISIBILITY }} overflow-hidden transition-[height] duration-300"
                role="region" aria-labelledby="hs-destroy-heading-one">
                <div class="p-3">
                    <section
                        class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
                        <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-3">
                            <div>
                                <label class="inputLabelMedium">Page</label>
                                <input type="text" class="normalInputDisabled" value="course_page" readonly disabled>
                            </div>
                            <div>
                                <label class="inputLabelMedium">Order In Page</label>
                                <input type="text" class="normalInputDisabled" value="1" readonly disabled>
                            </div>
                            <div>
                                <label class="inputLabelMedium">Section</label>
                                <input type="text" class="normalInputDisabled" value="head" readonly disabled>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('backend_webpages_coursepage_store') }}"
                            class="rounded-lg border border-gray-200 p-4 dark:border-neutral-600 dark:bg-neutral-700">
                            @csrf
                            <input type="hidden" name="page" value="course_page" readonly>
                            <input type="hidden" name="order_in_page" value="1" readonly>
                            <input type="hidden" name="section" value="head" readonly>

                            <input type="hidden" name="item_id[]" value="{{ $subtitleData?->id }}" readonly>
                            <input type="hidden" name="content_name[]" value="subtitle" readonly>
                            <div class="mb-6">
                                <label class="inputLabelMedium">Subtitle</label>
                                <textarea class="summernote" name="value[]">{!! old('value.0', $subtitleData?->value) !!}</textarea>
                            </div>

                            <input type="hidden" name="item_id[]" value="{{ $titleData?->id }}" readonly>
                            <input type="hidden" name="content_name[]" value="title" readonly>
                            <div class="mb-6">
                                <label class="inputLabelMedium">Title</label>
                                <textarea class="summernote" name="value[]">{!! old('value.1', $titleData?->value) !!}</textarea>
                            </div>

                            <input type="hidden" name="item_id[]" value="{{ $descriptionData?->id }}" readonly>
                            <input type="hidden" name="content_name[]" value="description" readonly>
                            <div class="mb-4">
                                <label class="inputLabelMedium">Description</label>
                                <textarea class="summernote" name="value[]">{!! old('value.2', $descriptionData?->value) !!}</textarea>
                            </div>

                            <input type="hidden" name="item_id[]" value="{{ $searchPlaceholder?->id }}" readonly>
                            <input type="hidden" name="content_name[]" value="placeholder" readonly>
                            <div class="mb-4">
                                <label class="inputLabelMedium">Placeholder</label>
                                <textarea class="summernote" name="value[]">{!! old('value.2', $searchPlaceholder?->value) !!}</textarea>
                            </div>

                            <button type="submit" class="editButton my-4">Submit Head Section</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>

        <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
            id="hs-destroy-heading-two">
            <x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify Course Widgets (Must need content names serially to store it's value)" />

            <div id="hs-destroy-collapse-two"
                class="hs-accordion-content w-full {{ $ACCORDION_2_VISIBILITY }} overflow-hidden transition-[height] duration-300"
                role="region" aria-labelledby="hs-destroy-heading-two">
                <div class="p-3">
                    <section
                        class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
                        <div class="mb-6 grid grid-cols-1 gap-4 md:grid-cols-3">
                            <div>
                                <label class="inputLabelMedium">Page</label>
                                <input type="text" class="normalInputDisabled" value="course_page" readonly disabled>
                            </div>
                            <div>
                                <label class="inputLabelMedium">Order In Page</label>
                                <input type="text" class="normalInputDisabled" value="2" readonly disabled>
                            </div>
                            <div>
                                <label class="inputLabelMedium">Section</label>
                                <input type="text" class="normalInputDisabled" value="course_widget" readonly
                                    disabled>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('backend_webpages_coursepage_store') }}"
                            class="rounded-lg border border-gray-200 p-4 dark:border-neutral-600 dark:bg-neutral-700">
                            @csrf
                            <input type="hidden" name="page" value="course_page" readonly>
                            <input type="hidden" name="order_in_page" value="2" readonly>
                            <input type="hidden" name="section" value="course_widget" readonly>

                            <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                                @foreach ($widgetItems as $index => $widgetItem)
                                    <div class="rounded-lg border border-gray-200 p-4 dark:border-neutral-600">
                                        <input type="hidden" name="item_id[]" value="{{ $widgetItem['id'] }}" readonly>
                                        <div class="mb-4">
                                            <label class="inputLabelMedium">Item {{ $index + 1 }} Content
                                                Name</label>
                                            <textarea class="summernote" name="content_name[]">{!! old('content_name.' . $index, $widgetItem['content_name'] ?? null) !!}</textarea>
                                        </div>

                                        <div>
                                            <label class="inputLabelMedium">Item {{ $index + 1 }} Value</label>
                                            <textarea class="summernote" name="value[]">{!! old('value.' . $index, $widgetItem['value'] ?? null) !!}</textarea>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button type="submit" class="editButton my-4">Submit Widget Section</button>
                        </form>
                    </section>
                </div>
            </div>
        </div>

        <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
            id="hs-destroy-heading-three">
            <x-ui_items.accordion.accordion_toggle_button toggleLabel="Display Outcome" />

            <div id="hs-destroy-collapse-three"
                class="hs-accordion-content w-full {{ $ACCORDION_3_VISIBILITY }} overflow-hidden transition-[height] duration-300"
                role="region" aria-labelledby="hs-destroy-heading-three">
                <div class="p-3">
                    <section
                        class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
                        <div class="p-4 text-center">
                            <div
                                class="mx-auto mb-6 inline-flex items-center gap-2 rounded-full bg-sky-100 px-5 py-3 text-sm font-semibold text-sky-500">
                                <span>{!! $subtitleData?->value !!}</span>
                            </div>

                            <h1 class="mx-auto max-w-4xl text-4xl font-black leading-tight text-[#111827] md:text-7xl">
                                {!! $titleData?->value !!}
                            </h1>

                            <div class="mx-auto mt-8 max-w-3xl text-xl leading-9 text-gray-500">
                                {!! $descriptionData?->value !!}
                            </div>
                        </div>

                        <div
                            class="mt-16 rounded-[2.5rem] bg-[#1694da] px-6 py-10 text-white shadow-lg md:px-10 md:py-14">
                            <div class="grid grid-cols-1 gap-10 text-center md:grid-cols-3">
                                @foreach ($widgetItems as $widgetItem)
                                    <div class="mx-auto max-w-sm">
                                        <div class="text-5xl font-black md:text-7xl">
                                            {!! $widgetItem['value'] !!}
                                        </div>
                                        <div class="mx-auto my-5 h-4 w-28 rounded-full bg-sky-400/70"></div>
                                        <div class="text-lg font-semibold leading-8 text-sky-50">
                                            {!! $widgetItem['content_name'] !!}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
