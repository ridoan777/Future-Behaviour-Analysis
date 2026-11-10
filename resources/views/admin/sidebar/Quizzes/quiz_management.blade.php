<x-app-layout>

    @php
        $breadCrumbs = [
            ['label' => 'Course Management', 'url' => 'backend_courses_create', 'icon' => 'documentLines'],
            ['label' => 'Make Quiz'],
            ['label' => 'Quiz Lists', 'url' => 'backend_all_quizzes', 'icon' => 'documentLines'],
        ];
    @endphp

    <x-breadcrumb :crumbs="$breadCrumbs" />
    <!-- ---------------- APP AREA Starts ---------------- -->

    <!-- Start Main Widgets -->
    <x-page_header_widget pageName="Quiz Management" />
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

        <div id="hs-destroy-heading-one" {{-- Quiz Set --}}
            class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent">

            <x-ui_items.accordion.accordion_toggle_button toggleLabel="1. Create A Quiz Head" />

            <div id="hs-destroy-collapse-one"
                class="hs-accordion-content {{ $ACCORDION_1_VISIBILITY }} w-full overflow-hidden transition-[height] duration-300"
                role="region" aria-labelledby="hs-destroy-heading-one">
                <div class="p-3">
                    <!-- Form::Create Quiz -->
                    <section
                        class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
                        <div class="my-5">
                            <form method="POST" action="{{ route('backend_quiz_store') }}"
                                class="rounded-lg p-2 dark:bg-neutral-700" enctype="multipart/form-data">
                                @csrf

                                <!--- IDENTIFIER HIDDEN INPUTS -->
                                <input type="hidden" name="flag" class="smallInput" value="create">
                                <!--- IDENTIFIER HIDDEN INPUTS -->

                                <div>
                                    <div class="mb-5 mt-2">
                                        <label for="title" class="inputLabelMedium">Quiz Title<span
                                                class="text-red-500">*</span></label>
                                        <input type="text" name="title" class="mediumInput"
                                            placeholder="max 255-characters" value="{{ old('title') }}">
                                    </div>
                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label for="instruction" class="inputLabelMedium">Quiz Instructions
                                            <span class="text-sm text-gray-400 font-light"> (Max 2000 characters)</span>
                                            <span class="text-sm text-gray-400 font-light"> (Use 'Bulleted List' button
                                                to seperate them)</span>
                                        </label>
                                        <textarea name="instruction" id="ckeditor" rows="10">{{ old('instruction') }}</textarea>
                                    </div>
                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label for="time" class="inputLabelMedium">Total Time
                                            <span class="text-red-500">*</span>
                                            <span class="text-gray-400 text-sm">(in minutes)</span>
                                        </label>
                                        <input type="text" name="time" class="mediumInput"
                                            value="{{ old('time') }}">
                                    </div>
                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label for="passing_score" class="inputLabelMedium">Passing Score
                                            <span class="text-red-500">*</span>
                                            <span class="text-gray-400 text-sm">(%)</span>
                                        </label>
                                        <input type="text" name="passing_score" class="mediumInput"
                                            value="{{ old('passing_score') }}">
                                    </div>
                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label class="inputLabelMedium text-gray-600">* Go to any <a
                                                href="{{ route('backend_all_modules') }}"
                                                class="text-blue-500 underline">Module</a> to attach a quiz. But first
                                            make sure quiz-set has questions and options created properly.</label>
                                    </div>
                                </div>

                                <button type="submit" class="editButton my-4">Create Course</button>
                            </form>
                        </div>
                    </section>
                    <!-- Form::Create Quiz -->
                </div>
            </div>
        </div>
        <!--  -->
        <div id="hs-destroy-heading-two" {{-- Questions --}}
            class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent">

            <x-ui_items.accordion.accordion_toggle_button toggleLabel="2. Create Question Set" />

            <div id="hs-destroy-collapse-two"
                class="hs-accordion-content {{ $ACCORDION_2_VISIBILITY }} w-full overflow-hidden transition-[height] duration-300"
                role="region" aria-labelledby="hs-destroy-heading-two">
                <div class="p-3">
                    <!-- Form::Create Quiz -->
                    <section
                        class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
                        <div class="my-5">
                            <form method="POST" action="{{ route('backend_question_store') }}"
                                class="rounded-lg p-2 dark:bg-neutral-700" enctype="multipart/form-data">
                                @csrf

                                <!--- IDENTIFIER HIDDEN INPUTS -->
                                <input type="hidden" name="flag" class="smallInput" value="create">
                                <!--- IDENTIFIER HIDDEN INPUTS -->

                                <div>
                                    <div class="mb-5 mt-2">
                                        <label for="title" class="inputLabelMedium">Attach the Quiz Head
                                            <span class="text-red-500">*</span>
                                            <span class="text-sm text-gray-400 font-light"> (creating new questions under existing Quiz Head will replace the old questions for the same head)</span>
                                        </label>
                                        <select id="courses" name="quiz_id"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                            required>
                                            <option value="" selected>Choose a Quiz Head</option>
                                            @foreach ($allQuizzes as $quiz)
                                                <option value="{{ $quiz->id }}">{{ $quiz->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Dynamic Question Block  -->
                                    <div id="questionsContainer">
                                        <div class="quiz-question-set p-4 border rounded-lg mb-4" data-index="0">
                                            @include('components.questionCreateBlock', ['index' => 0])
                                        </div>
                                    </div>

                                    <div class="flex justify-end">
                                        <button type="button" id="addQuestionBtn"
                                            class="p-2 my-4 bg-fuchsia-900 hover:bg-fuchsia-700 text-white text-sm rounded">
                                            + Add Question
                                        </button>
                                    </div>
                                    <!-- Dynamic Question Block  -->

                                </div>

                                <button type="submit" class="editButton my-4">Create Questions</button>
                            </form>
                        </div>
                    </section>
                    <!-- Form::Create Quiz -->
                </div>
            </div>
        </div>
        <!--  -->

    </div>

    <!---------------------------------------------------------------------------------------------- accordion -->



    {{-- Script for video (promo) to start video always at 50% --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const video = document.getElementById("promoVideo");
            if (video) {
                video.volume = 0.5; // 50%
            }
        });
    </script>
    {{-- Script for video (promo) to start video always at 50% --}}


    {{-- Get module options by Course dropdown --}}
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
    {{-- Get module options by Course dropdown --}}


    {{-- Dropify Dynamically load more files & inputs --}}
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
    {{-- Dropify Dynamically load more files & inputs --}}

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


    {{-- add quesdtion + options --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let questionIndex = document.querySelectorAll('.quiz-question-set').length - 1;

            const questionsContainer = document.getElementById('questionsContainer');
            const addQuestionBtn = document.getElementById('addQuestionBtn');

            // Add new Question
            addQuestionBtn.addEventListener('click', function() {
                questionIndex++;
                fetch(`{{ route('get_question_block') }}?index=${questionIndex}`)
                    .then(response => response.text())
                    .then(html => {
                        const wrapper = document.createElement('div');
                        wrapper.classList.add('quiz-question-set', 'p-4', 'border', 'rounded-lg',
                            'mb-4');
                        wrapper.dataset.index = questionIndex;
                        wrapper.innerHTML = html;
                        questionsContainer.appendChild(wrapper);
                        initQuestionEvents(
                        wrapper); // initialize options and remove events for new question
                        initSummernote(wrapper); // re-init summernote for new textareas
                        initDropify(wrapper); // re-init dropify for new file inputs
                    })
                    .catch(err => console.error(err));
            });

            // Initialize events for existing questions
            document.querySelectorAll('.quiz-question-set').forEach(initQuestionEvents);

            function initQuestionEvents(questionBlock) {
                const qIndex = questionBlock.dataset.index;

                // Remove question button
                const removeBtn = questionBlock.querySelector('.removeQuestionBtn');
                if (removeBtn) {
                    removeBtn.addEventListener('click', () => {
                        questionBlock.remove();
                    });
                }

                // Add option button
                const addOptionBtn = questionBlock.querySelector('.addOptionBtn');
                const optionsContainer = questionBlock.querySelector(`#optionsContainer-${qIndex}`);
                if (addOptionBtn) {
                    addOptionBtn.addEventListener('click', () => {
                        const currentOptions = optionsContainer.querySelectorAll('.option-block');
                        if (currentOptions.length >= 5) {
                            alert('Maximum 5 options allowed per question.');
                            return;
                        }

                        const optionIndex = currentOptions.length;
                        const optionBlock = document.createElement('div');
                        optionBlock.classList.add('option-block', 'flex', 'items-center', 'gap-3', 'mt-2',
                            'mb-2');
                        optionBlock.dataset.index = optionIndex;
                        optionBlock.innerHTML = `
                    <input type="radio" name="questions[${qIndex}][is_correct]" value="${optionIndex}" class="w-4 h-4" required>
                    <input type="text" name="questions[${qIndex}][options][${optionIndex}]" class="mediumInput flex-1" placeholder="Option text" required>
                    <button type="button" class="removeOptionBtn bg-red-500 text-white px-3 py-1 rounded text-sm">Remove</button>
                `;
                        optionsContainer.appendChild(optionBlock);

                        // Add remove event for this option
                        optionBlock.querySelector('.removeOptionBtn').addEventListener('click', () => {
                            optionBlock.remove();
                            // Optional: re-index remaining options if needed
                        });
                    });
                }

                // Initialize remove buttons for existing options
                questionBlock.querySelectorAll('.removeOptionBtn').forEach(btn => {
                    btn.addEventListener('click', (e) => {
                        e.target.closest('.option-block').remove();
                    });
                });
            }

            // Re-init Summernote for dynamically added textareas
            function initSummernote(container) {
                $(container).find('.summernote').each(function() {
                    $(this).summernote({
                        height: 100
                    });
                });
            }

            // Re-init Dropify for dynamically added file inputs
            function initDropify(container) {
                $(container).find('.dropify').dropify();
            }

        });
    </script>
    {{-- add quesdtion + options --}}


    <!-- ---------------- APP AREA Starts ---------------- -->

</x-app-layout>
