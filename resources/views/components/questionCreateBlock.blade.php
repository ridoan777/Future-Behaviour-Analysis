<!-- Remove Question Button (only for additional questions) -->
@if($index > 0)
<div class="flex justify-end mb-3">
    <button type="button" class="removeQuestionBtn bg-red-600 text-white p-2 rounded text-xs hover:bg-red-700">
        Remove Question
    </button>
</div>
@endif

<!-- Question Title -->
<div class="mb-5 mt-2">
    <label class="inputLabelMedium">Question Title <span class="text-red-500">*</span></label>
    <input type="text" name="questions[{{ $index }}][title]" class="mediumInput" placeholder="max 255 chars" required>
    <input type="hidden" name="questions[{{ $index }}][remove_detail_image]" value="0">
    <input type="hidden" name="questions[{{ $index }}][remove_explaination_image]" value="0">
</div>

<!-- Question Image -->
<div class="mb-5 mt-2">
    <label class="inputLabelMedium">Question Image</label>
    <input type="file" name="questions[{{ $index }}][detail_image]" class="dropify" data-height="150">
</div>

<!-- Question Detail -->
<div class="mb-5 mt-2">
    <label class="inputLabelMedium">Question Detail</label>
    <textarea class="summernote" name="questions[{{ $index }}][detail]" id="detail{{ $index }}"></textarea>
</div>

<!-- Options Container -->
<div id="optionsContainer-{{ $index }}">
    <div class="mt-4 mb-4 option-block flex items-center gap-3" data-index="0">
        <input type="radio" name="questions[{{ $index }}][is_correct]" value="0" class="w-4 h-4" required checked>
        <input type="text" name="questions[{{ $index }}][options][0]" class="mediumInput flex-1" placeholder="Option text" required>
        <button type="button" class="removeOptionBtn bg-red-500 text-white px-3 py-1 rounded text-sm hidden">Remove</button>
    </div>
</div>

<!-- Add Option -->
<div class="mt-3 mb-12 flex justify-end items-center gap-4">
    <span class="text-sm text-gray-500 ml-2">(Max 5 options)</span>
    <button type="button" class="addOptionBtn bg-fuchsia-900 hover:bg-fuchsia-700 text-white p-2 text-sm rounded" data-question-index="{{ $index }}">
        + Add Option
    </button>
</div>

<!-- Explanation -->
<div class="mb-5 mt-2">
    <label class="inputLabelMedium">Answer Explanation</label>
    <textarea class="summernote" name="questions[{{ $index }}][explaination]" id="explaination{{ $index }}"></textarea>
</div>

<!-- Explanation Image -->
<div class="mb-5 mt-2">
    <label class="inputLabelMedium">Explanation Image</label>
    <input type="file" name="questions[{{ $index }}][explaination_image]" class="dropify" data-height="150">
</div>
