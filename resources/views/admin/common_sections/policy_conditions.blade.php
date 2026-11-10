<x-app-layout>

   @php
      $breadCrumbs = [
         ['label' => 'WebPages', 'url' => 'dashboard', 'icon' => 'documentLines'],
         ['label' => 'Common Sections', 'url' => 'dashboard', 'icon' => 'globe'],
         ['label' => 'Policy & Conditions'],
      ];

      $ACCORDION_1_VISIBILITY = '';
      $ACCORDION_2_VISIBILITY = '';
   @endphp

   <x-breadcrumb :crumbs="$breadCrumbs" />
   <x-page_header_widget pageName="Common Section: Policy & Conditions" />
   <x-alert-component message="Form Submission" />

   <div class="hs-accordion-group">
      <x-ui_items.accordion.accordion-destroy />

      <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
         id="hs-destroy-heading-one">

         <x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify Privacy Policy" />

         <div id="hs-destroy-collapse-one"
            class="hs-accordion-content w-full {{ $ACCORDION_1_VISIBILITY }} overflow-hidden transition-[height] duration-300"
            role="region" aria-labelledby="hs-destroy-heading-one">
            <div class="p-3">
               <section
                  class="displayArea my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none mx-auto">
                  <div class="my-5">
                     <form method="POST" action="{{ route('backend.common_section_store') }}"
                        class="rounded-lg p-2 dark:bg-neutral-700">
                        @csrf

                        <div class="hiddenInputs">
                           <input type="hidden" name="type" value="policy_condition" readonly>
                           <input type="hidden" name="section" value="policy" readonly>
                           <input type="hidden" name="order_in_section" value="1" readonly>
                        </div>

                        <div>
                           <div class="mb-5 mt-2">
                              <label class="inputLabelMedium">Title</label>
                              <input type="text" name="title" class="mediumInput"
                                 value="{{ $policy?->title ?? 'Privacy Policy' }}" readonly>
                           </div>

                           <div class="mb-5 mt-2">
                              <label for="policy_detail" class="inputLabelMedium">Details<span class="text-red-500">*</span></label>
                              <textarea class="summernote" name="detail" id="policy_detail">{!! $policy?->detail ?? '' !!}</textarea>
                           </div>
                        </div>

                        <button type="submit" class="editButton my-4">Submit/Update</button>
                     </form>
                  </div>
               </section>
            </div>
         </div>
      </div>

      <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
         id="hs-destroy-heading-two">

         <x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify Terms & Conditions" />

         <div id="hs-destroy-collapse-two"
            class="hs-accordion-content w-full {{ $ACCORDION_2_VISIBILITY }} overflow-hidden transition-[height] duration-300"
            role="region" aria-labelledby="hs-destroy-heading-two">
            <div class="p-3">
               <section
                  class="displayArea my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none mx-auto">
                  <div class="my-5">
                     <form method="POST" action="{{ route('backend.common_section_store') }}"
                        class="rounded-lg p-2 dark:bg-neutral-700">
                        @csrf

                        <div class="hiddenInputs">
                           <input type="hidden" name="type" value="policy_condition" readonly>
                           <input type="hidden" name="section" value="condition" readonly>
                           <input type="hidden" name="order_in_section" value="1" readonly>
                        </div>

                        <div>
                           <div class="mb-5 mt-2">
                              <label class="inputLabelMedium">Title</label>
                              <input type="text" name="title" class="mediumInput"
                                 value="{{ $condition?->title ?? 'Terms and Conditions' }}" readonly>
                           </div>

                           <div class="mb-5 mt-2">
                              <label for="condition_detail" class="inputLabelMedium">Details<span class="text-red-500">*</span></label>
                              <textarea class="summernote" name="detail" id="condition_detail">{!! $condition?->detail ?? '' !!}</textarea>
                           </div>
                        </div>

                        <button type="submit" class="editButton my-4">Submit/Update</button>
                     </form>
                  </div>
               </section>
            </div>
         </div>
      </div>
   </div>

</x-app-layout>
