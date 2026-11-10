<x-app-layout>

    @php
        $breadCrumbs = [
            ['label' => 'Quiz Management', 'url' => 'backend_quizzes_create', 'icon' => 'documentLines'],
            ['label' => 'All Quizzes', 'url' => 'backend_all_quizzes', 'icon' => 'documentLines'],
            ['label' => 'Update Quize'],
        ];
    @endphp

    <x-breadcrumb :crumbs="$breadCrumbs" />
    <!-- ---------------- APP AREA Starts ---------------- -->

    <!-- Start Main Widgets -->
    <x-page_header_widget pageName="Quiz Set: {{ Str::limit($singleQuiz->title, 60) }}" />
    <!-- End Main Widgets -->


    <!-- Alert Component -->
    <x-alert-component message="Form Submission" />
    <!-- Alert Component -->

    @php
        $ORDER_IN_PAGE = 1;
        $ACCORDION_1_VISIBILITY = 'hidden'; // hidden or ''
        $ACCORDION_2_VISIBILITY = 'hidden';
    @endphp

    <!---------------------------------------------------------------------------------------------- accordion -->
    <div class="hs-accordion-group">

        <x-ui_items.accordion.accordion-destroy />

        <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
            id="hs-destroy-heading-one">

            <x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify A Quiz Head. Quiz ID: {{ $singleQuiz?->id }}" />

            <div id="hs-destroy-collapse-one"
                class="hs-accordion-content {{ $ACCORDION_1_VISIBILITY }} w-full overflow-hidden transition-[height] duration-300"
                role="region" aria-labelledby="hs-destroy-heading-one">
                <div class="p-3">
                    <!-- Form::Modify Quiz -->
                    <section
                        class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
                        <div class="my-5">
                            <form method="POST" action="{{ route('backend_quiz_store') }}"
                                class="rounded-lg p-2 dark:bg-neutral-700" enctype="multipart/form-data">
                                @csrf

                                <!--- IDENTIFIER HIDDEN INPUTS -->
                                <input type="hidden" name="flag" class="smallInput" value="update">
                                <input type="hidden" name="id" class="smallInput" value="{{ $singleQuiz->id }}">
                                <!--- IDENTIFIER HIDDEN INPUTS -->

                                <div>
                                    <div class="mb-5 mt-2">
                                        <label for="title" class="inputLabelMedium">Quiz Title<span
                                                class="text-red-500">*</span></label>
                                        <input type="text" name="title" class="mediumInput"
                                            placeholder="max 255-characters" value="{{ $singleQuiz?->title ?? null }}">
                                    </div>
                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label for="instruction" class="inputLabelMedium">Quiz Instructions
                                            <span class="text-sm text-gray-400 font-light"> (Max 2000 characters)</span>
                                            <span class="text-sm text-gray-400 font-light"> (Use 'Bulleted List' button
                                                to seperate them)</span>
                                        </label>
                                        <textarea name="instruction" id="ckeditor" rows="10">{!! $singleQuiz?->instruction ?? null !!}</textarea>
                                    </div>
                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label for="time" class="inputLabelMedium">Total Time
                                            <span class="text-red-500">*</span>
                                            <span class="text-gray-400 text-sm">(in minutes)</span>
                                        </label>
                                        <input type="text" name="time" class="mediumInput"
                                            value="{{ $singleQuiz?->time ?? null }}">
                                    </div>
                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label for="passing_score" class="inputLabelMedium">Passing Score
                                            <span class="text-red-500">*</span>
                                            <span class="text-gray-400 text-sm">(%)</span>
                                        </label>
                                        <input type="text" name="passing_score" class="mediumInput"
                                            value="{{ $singleQuiz?->passing_score ?? null }}">
                                    </div>
                                    <!--  -->
                                    <div class="mb-5 mt-2">
                                        <label class="inputLabelMedium text-gray-600">* Go to any <a
                                                href="{{ route('backend_all_modules') }}"
                                                class="text-blue-500 underline">Module</a> to attach a quiz. But first
                                            make sure quiz-set has questions and options created properly.</label>
                                    </div>
                                </div>

                                <button type="submit" class="editButton my-4">Update Course</button>
                            </form>
                        </div>
                    </section>
                    <!-- Form::Modify Quiz -->
                </div>
            </div>
        </div>
        <!--  -->
        <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
            id="hs-destroy-heading-one">

            <x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify A Quiz questions" />

            <div id="hs-destroy-collapse-one"
                class="hs-accordion-content {{ $ACCORDION_2_VISIBILITY }} w-full overflow-hidden transition-[height] duration-300"
                role="region" aria-labelledby="hs-destroy-heading-one">
                <div class="p-3">
                    <!-- Form::Modify Questions -->
                    <section
                        class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
                        <div class="my-5">

                            <form method="POST" action="{{ route('backend_question_store') }}"
                                class="rounded-lg p-2 dark:bg-neutral-700" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="flag" value="update">
                                <input type="hidden" name="quiz_id" value="{{ $singleQuiz->id }}">

                                <div id="questionsContainer">
                                    @foreach ($singleQuiz->quizRelationWith_questions as $qIndex => $question)
													<p class="text-gray-500 dark:neutral-200">Ques ID: {{ $question?->id ?? null }}</p>
                                        <div class="quiz-question-set p-4 border rounded-lg mb-4"
                                            data-index="{{ $qIndex }}">
                                            @include('components.questionEditBlock', [
                                                'index' => $qIndex,
                                                'question' => $question,
                                            ])
                                        </div>
                                    @endforeach
                                </div>

                                <div class="flex justify-end">
                                    <button type="button" id="addQuestionBtn"
                                        class="p-2 my-4 bg-fuchsia-900 hover:bg-fuchsia-700 text-white text-sm rounded">
                                        + Add Question
                                    </button>
                                </div>

                                <button type="submit" class="editButton my-4">Update Questions</button>
                            </form>

                        </div>
                    </section>
                    <!-- Form::Modify Questions -->
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

    <!-- SCRIPT FOR DYNAMIC QUESTION+OPTIONS -->

    <script>
        $(document).ready(function() {
            let questionIndex = {{ $singleQuiz->quizRelationWith_questions->count() }};

            // Initialize existing summernote and dropify
            $('.summernote').summernote({
                height: 150
            });
            $('.dropify').dropify();

            // Track Dropify remove events for detail images
            $(document).on('dropify.afterClear', '.detail-image-dropify', function() {
                $(this).closest('.quiz-question-set').find('.remove-detail-image-flag').val('1');
            });

            // Track Dropify remove events for explaination images
            $(document).on('dropify.afterClear', '.explaination-image-dropify', function() {
                $(this).closest('.quiz-question-set').find('.remove-explaination-image-flag').val('1');
            });

            // Reset flags when new file is selected
            $(document).on('change', '.detail-image-dropify', function() {
                if (this.files && this.files.length > 0) {
                    $(this).closest('.quiz-question-set').find('.remove-detail-image-flag').val('0');
                }
            });

            $(document).on('change', '.explaination-image-dropify', function() {
                if (this.files && this.files.length > 0) {
                    $(this).closest('.quiz-question-set').find('.remove-explaination-image-flag').val('0');
                }
            });

            // Remove entire question block
            $(document).on('click', '.removeQuestionBtn', function(e) {
                e.preventDefault(); // Prevent any default behavior
                e.stopPropagation(); // Stop event bubbling

                if ($('#questionsContainer .quiz-question-set').length <= 1) {
                    alert('At least one question is required');
                    return;
                }

                if (confirm(
                        'Are you sure you want to remove this question? This action cannot be undone.')) {
                    const $questionBlock = $(this).closest('.quiz-question-set');

                    // Destroy Summernote instances to prevent memory leaks
                    $questionBlock.find('.summernote').each(function() {
                        $(this).summernote('destroy');
                    });

                    // Remove the block
                    $questionBlock.remove();

                    // Reindex remaining questions
                    reindexQuestions();
                }
            });

            // Add new question block
            $('#addQuestionBtn').on('click', function() {
                $.ajax({
                    url: '{{ route('get_question_edit_block') }}',
                    method: 'GET',
                    data: {
                        index: questionIndex
                    },
                    success: function(html) {
                        const newBlock = $(
                            '<div class="quiz-question-set p-4 border rounded-lg mb-4" data-index="' +
                            questionIndex + '"></div>');
                        newBlock.html(html);
                        $('#questionsContainer').append(newBlock);

                        // Initialize plugins
                        newBlock.find('.summernote').summernote({
                            height: 150
                        });
                        newBlock.find('.dropify').dropify();

                        questionIndex++;
                    }
                });
            });

            // Add new option
            $(document).on('click', '.addOptionBtn', function() {
                const qIndex = $(this).data('question-index');
                const optionsContainer = $('#optionsContainer-' + qIndex);
                const optionCount = optionsContainer.children('.option-block').length;

                if (optionCount >= 5) {
                    alert('Maximum 5 options allowed');
                    return;
                }

                const newOption = $(`
						<div class="mb-4 option-block flex items-center gap-3" data-index="${optionCount}">
							<input type="radio" name="questions[${qIndex}][is_correct]" value="${optionCount}" class="w-4 h-4" required>
							<input type="text" name="questions[${qIndex}][options][${optionCount}]" class="mediumInput flex-1" 
									placeholder="Option text" required>
							<button type="button" class="removeOptionBtn bg-red-500 text-white px-3 py-1 rounded text-sm">
								Remove
							</button>
						</div>
					`);

                optionsContainer.append(newOption);
                updateOptionIndexes(optionsContainer, qIndex);
            });

            // Remove option
            $(document).on('click', '.removeOptionBtn', function() {
                const container = $(this).closest('[id^="optionsContainer-"]');
                const qIndex = container.attr('id').split('-')[1];

                if (container.children('.option-block').length <= 1) {
                    alert('At least one option is required');
                    return;
                }

                $(this).closest('.option-block').remove();
                updateOptionIndexes(container, qIndex);

                // Auto-select first option if removed was selected
                if (container.find('input[type="radio"]:checked').length === 0) {
                    container.find('input[type="radio"]:first').prop('checked', true);
                }
            });

            function updateOptionIndexes(container, qIndex) {
                container.children('.option-block').each(function(idx) {
                    $(this).attr('data-index', idx);
                    $(this).find('input[type="radio"]').val(idx);
                    $(this).find('input[type="text"]').attr('name',
                        `questions[${qIndex}][options][${idx}]`);
                });

                if (container.children('.option-block').length <= 1) {
                    container.find('.removeOptionBtn').addClass('hidden');
                } else {
                    container.find('.removeOptionBtn').removeClass('hidden');
                }
            }

            function reindexQuestions() {
                $('#questionsContainer .quiz-question-set').each(function(newIndex) {
                    $(this).attr('data-index', newIndex);

                    // Update all input names within this question block
                    $(this).find('input[name^="questions"]').each(function() {
                        const name = $(this).attr('name');
                        const newName = name.replace(/questions\[\d+\]/, `questions[${newIndex}]`);
                        $(this).attr('name', newName);
                    });

                    $(this).find('textarea[name^="questions"]').each(function() {
                        const name = $(this).attr('name');
                        const newName = name.replace(/questions\[\d+\]/, `questions[${newIndex}]`);
                        $(this).attr('name', newName);
                    });

                    // Update options container ID
                    $(this).find('[id^="optionsContainer-"]').attr('id', 'optionsContainer-' + newIndex);

                    // Update add option button data attribute
                    $(this).find('.addOptionBtn').attr('data-question-index', newIndex);
                });
            }
        });
    </script>
    <!-- SCRIPT FOR DYNAMIC QUESTION+OPTIONS -->


    <!-- ---------------- APP AREA Starts ---------------- -->

</x-app-layout>
