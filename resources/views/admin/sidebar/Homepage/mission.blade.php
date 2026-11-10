<x-app-layout>

   @php
      $breadCrumbs = [
          ['label' => 'WebPages', 'url' => 'dashboard', 'icon' => 'documentLines'],
          ['label' => 'Homepage', 'url' => 'dashboard', 'icon' => 'documentLines'],
          ['label' => 'Mission'],
      ];
   @endphp

   <x-breadcrumb :crumbs="$breadCrumbs" />
   <!-- ---------------- APP AREA Starts ---------------- -->

   <!-- Start Main Widgets -->
   <x-page_header_widget pageName="Homepage: 'Mission' Section" />
   <!-- End Main Widgets -->


   <!-- Alert Component -->
   <x-alert-component message="Form Submission" />
   <!-- Alert Component -->

   @php
      $ORDER_IN_PAGE = 8;
      $ACCORDION_1_VISIBILITY = ''; // hidden or ''
      $ACCORDION_2_VISIBILITY = 'hidden';
      $ACCORDION_3_VISIBILITY = '';
   @endphp

   <!---------------------------------------------------------------------------------------------- accordion -->
   <div class="hs-accordion-group">

      <x-ui_items.accordion.accordion-destroy />

      <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
         id="hs-destroy-heading-one">

         <x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify Mission Head" />

         <div id="hs-destroy-collapse-one"
            class="hs-accordion-content w-full {{ $ACCORDION_1_VISIBILITY }} overflow-hidden transition-[height] duration-300"
            role="region" aria-labelledby="hs-destroy-heading-one">
            <div class="p-3">
               <!-- Form::Homepage-mission Head -->
               <section
                  class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
                  <div class="my-5">
                     <form method="POST" action="{{ route('backend.webpages_homepage_store') }}"
                        class="rounded-lg p-2 dark:bg-neutral-700" enctype="multipart/form-data">
                        @csrf

                        <!-- IDENTIFIER INPUTS -->
                        <div>
                           <div class="hiddenInputs">
                              <input type="hidden" name="page" value="homepage" readonly>
                              <input type="hidden" name="section" value="mission_head" readonly>
                              <input type="hidden" name="order_in_section" value="1" readonly>
                           </div>
                           <!--  -->
                           <div class="mb-5 mt-2 grid grid-cols-1">
                              <div>
                                 <label for="order" class="inputLabelMedium">Order in page</label>
                                 <input type="text" name="order_in_page" id="order" class="smallInput"
                                    value="{{ $ORDER_IN_PAGE }}" readonly>
                              </div>
                           </div>
                        </div>
                        <!-- IDENTIFIER INPUTS -->

                        <div>
                           <div class="mb-5 mt-2">
                              <label for="title" class="inputLabelMedium">Title<span
                                    class="text-red-500">*</span></label>
                              <textarea class="summernote" name="title" id="title">{!! $infoHead?->title ?? '' !!}</textarea>
                           </div>
                           <!--  -->
                           <div class="mb-5 mt-2">
                              <label for="detail" class="inputLabelMedium">Mission detail<span
                                    class="text-red-500">*</span></label>
                              <textarea class="summernote" name="detail" id="detail">{!! $infoHead?->details ?? '' !!}</textarea>
                           </div>
                           <!--  -->
                           <div class="mb-5 mt-2">
                              <label for="detail" class="inputLabelMedium">Image<span
                                    class="text-red-500">*</span></label>
                              <input id="image" name="images[]" type="file" class="dropify"
                                 data-height="150" @if ($infoHead?->image) data-default-file="{{ Storage::url($infoHead?->image) }}" @endif />
                           </div>
                           <!--  -->

                        </div>

                        <button type="submit" class="editButton my-4">Submit/Update</button>
                     </form>
                  </div>
               </section>
               <!-- Form::Homepage-mission Head -->
            </div>
         </div>
      </div>
      <!--  -->
      <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
         id="hs-destroy-heading-three">

         <x-ui_items.accordion.accordion_toggle_button toggleLabel="Display Outcome" />

         <div id="hs-destroy-collapse-three"
            class="hs-accordion-content w-full {{ $ACCORDION_3_VISIBILITY }}  overflow-hidden transition-[height] duration-300"
            role="region" aria-labelledby="hs-destroy-heading-three">

            <div class="p-3 grid grid-cols-1 gap-4">
               <section class="px-4 py-12 grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div class="col-span-1">
                     {{-- <img src="{{ Storage::url($infoHead?->image) }}" alt="{{ $infoHead?->image }}" class="h-80 mx-auto"> --}}
                     @if ($infoHead?->image)
                        <img src="{{ Storage::url($infoHead->image) }}" alt="{{ $infoHead?->title }}" class="h-80 mx-auto">
                     @else
                           <img src="" alt="" class="h-80 mx-auto">
                     @endif
                  </div>
                  {{--  --}}
                  <div class="col-span-1 pr-4">
                     <h2 class="my-4 text-[#06052E]">{!! $infoHead?->title ?? '' !!}</h2>
                     <p class="text-gray-300">{{ $infoHead?->subtitle ?? '' }}</p>
                     <p class="my-4">{!! $infoHead?->details ?? '' !!}</p>
                  </div>
               </section>

            </div>

         </div>
      </div>

   </div>

   <!---------------------------------------------------------------------------------------------- accordion -->











   <!-- ---------------- APP AREA Starts ---------------- -->

</x-app-layout>
