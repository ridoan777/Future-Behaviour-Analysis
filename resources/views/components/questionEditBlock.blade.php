<!-- Remove Question Button (at the top) -->
<div class="flex justify-end mb-3">
    <button type="button" class="removeQuestionBtn bg-red-600 text-white p-2 rounded text-xs hover:bg-red-700">
        Remove Question
    </button>
</div>

<!-- Question Title -->
<div class="mb-5 mt-2">
    <label class="inputLabelMedium">Question Title <span class="text-red-500">*</span></label>
    <input type="text" name="questions[{{ $index }}][title]" class="mediumInput" placeholder="max 255 chars"
        value="{{ old('questions.' . $index . '.title', $question->title ?? '') }}" required>
    <input type="hidden" name="questions[{{ $index }}][id]" value="{{ $question->id ?? '' }}">
    <input type="hidden" name="questions[{{ $index }}][remove_detail_image]" class="remove-detail-image-flag"
        value="0">
    <input type="hidden" name="questions[{{ $index }}][remove_explaination_image]"
        class="remove-explaination-image-flag" value="0">
</div>

<!-- Question Image -->
<div class="mb-5 mt-2">
    <label class="inputLabelMedium">Question Image</label>
    <input type="file" name="questions[{{ $index }}][detail_image]" class="dropify detail-image-dropify"
        data-height="150"
        @if (isset($question->detail_image)) data-default-file="{{ Storage::url($question->detail_image) }}" @endif>
</div>

<!-- Question Detail -->
<div class="mb-5 mt-2">
    <label class="inputLabelMedium">Question Detail</label>
    <textarea class="summernote" name="questions[{{ $index }}][detail]" id="detail{{ $index }}">{{ old('questions.' . $index . '.detail', $question->detail ?? '') }}</textarea>
</div>

<!-- Options Container -->
<div id="optionsContainer-{{ $index }}">
    @if (isset($question) && $question->questionRelationWith_options->count() > 0)
        @foreach ($question->questionRelationWith_options as $oIndex => $option)
            <div class="mt-12 mb-4 option-block flex items-center gap-3" data-index="{{ $oIndex }}">
                <input type="radio" name="questions[{{ $index }}][is_correct]" value="{{ $oIndex }}"
                    class="w-4 h-4" {{ $option->is_correct ? 'checked' : '' }} required>
                <input type="text" name="questions[{{ $index }}][options][{{ $oIndex }}]"
                    class="mediumInput flex-1" placeholder="Option text"
                    value="{{ old('questions.' . $index . '.options.' . $oIndex, $option->option_text) }}" required>
                <button type="button"
                    class="removeOptionBtn bg-red-500 hover:bg-red-700 p-2 rounded-full text-sm {{ $loop->first && $loop->count == 1 ? 'hidden' : '' }}">
                    {!! \App\Helpers\IconPack::cross(['class' => 'iconPackItem w-3 h-3 text-gray-100']) !!}
                </button>
            </div>
        @endforeach
    @else
        <div class="mt-12 mb-4 option-block flex items-center gap-3" data-index="0">
            <input type="radio" name="questions[{{ $index }}][is_correct]" value="0" class="w-4 h-4"
                required checked>
            <input type="text" name="questions[{{ $index }}][options][0]" class="mediumInput flex-1"
                placeholder="Option text" required>
            <button type="button" class="removeOptionBtn bg-red-500 text-white px-3 py-1 rounded text-sm hidden">
                Remove
            </button>
        </div>
    @endif
</div>

<!-- Add Option -->
<div class="mt-3 mb-12 flex justify-end items-center gap-4">
    <span class="text-sm text-gray-500 ml-2">(Max 5 options)</span>
    <button type="button" class="addOptionBtn bg-violet-900 hover:bg-violet-700 text-white py-1 px-2 text-xs rounded"
        data-question-index="{{ $index }}">
        + Add Option
    </button>
</div>

<!-- Explanation -->
<div class="mb-5 mt-2">
    <label class="inputLabelMedium">Answer Explanation</label>
    <textarea class="summernote" name="questions[{{ $index }}][explaination]" id="explaination{{ $index }}">{{ old('questions.' . $index . '.explaination', $question->explaination ?? '') }}</textarea>
</div>

<!-- Explanation Image -->
<div class="mb-5 mt-2">
    <label class="inputLabelMedium">Explanation Image</label>
    <input type="file" name="questions[{{ $index }}][explaination_image]"
        class="dropify explaination-image-dropify" data-height="150"
        @if (isset($question->explaination_image)) data-default-file="{{ Storage::url($question->explaination_image) }}" @endif>
</div>
