<x-app-layout>

   @php
      $breadCrumbs = [
         ['label' => 'WebPages', 'url' => 'dashboard', 'icon' => 'documentLines'],
         ['label' => 'Homepage', 'url' => 'dashboard', 'icon' => 'documentLines'],
         ['label' => 'Process'],
      ];
    @endphp

   <x-breadcrumb :crumbs="$breadCrumbs" />
   <!-- ---------------- APP AREA Starts ---------------- -->

   <!-- Start Main Widgets -->
   <x-page_header_widget pageName="Homepage: Process Section" />
   <!-- End Main Widgets -->


   <!-- Alert Component -->
   <x-alert-component message="Form Submission" />
   <!-- Alert Component -->

   @php
      $ACCORDION_1_VISIBILITY = ''; // hidden or ''
      $ACCORDION_2_VISIBILITY = 'hidden';
      $ACCORDION_3_VISIBILITY = 'hidden';
    @endphp
   <!---------------------------------------------------------------------------------------------- accordion -->
   <div class="hs-accordion-group">

      <x-ui_items.accordion.accordion-destroy />

      <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
         id="hs-destroy-heading-one">

         <x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify Process Title" />

         <div id="hs-destroy-collapse-one"
            class="hs-accordion-content w-full {{ $ACCORDION_1_VISIBILITY }} overflow-hidden transition-[height] duration-300"
            role="region" aria-labelledby="hs-destroy-heading-one">
            <div class="p-3">
               <!-- Form::Homepage-Process Title -->
               <section
                  class="displayArea my-5 p-4 rounded-lg border-none bg-white dark:bg-neutral-700 shadow-md shadow-gray-400 dark:shadow-none mx-auto">
                  <div class="my-5">
                     <form method="POST" action="{{ route('backend.webpages_homepage_store') }}"
                        class="p-2 rounded-lg dark:bg-neutral-700" enctype="multipart/form-data">
                        @csrf

                        <!-- IDENTIFIER INPUTS -->
                        <div class="hiddenInputs">
                           <input type="hidden" name="page" value="homepage" readonly>
                           <input type="hidden" name="section" value="process_head" readonly>
                           <input type="hidden" name="order_in_section" value="1" readonly>
                        </div>
                        <!--  -->
                        <div class="mt-2 mb-5 grid grid-cols-1">
                           <div>
                              <label for="order" class="inputLabelMedium">Order in page</label>
                              <input type="text" name="order_in_page" id="order" class="smallInput" value="3" readonly>
                           </div>
                        </div>
                        <!-- IDENTIFIER INPUTS -->

                        <div class="homepageTitle mt-2 mb-5">
                           <label for="title" class="inputLabelMedium">Title 1<span
                                 class="text-red-500">*</span></label>
                           <textarea class="summernote" name="title"
                              id="title">{!! $homepageData->where('section', 'process_head')->first()?->title ?? '' !!}</textarea>
                        </div>
                        <!--  -->
                        <div class="grid grid-cols-1 gap-4">
                           <div class="homepageHeroImage">
                              <label for="image" class="inputLabelMedium">
                                 Process Image <span class="text-red-500">*</span>
                              </label>
                              <input id="image" name="images[]" type="file" class="dropify" data-height="150"
                                 data-default-file="{{ $homepageData->where('section', 'process_head')->first()?->image ? Storage::url($homepageData->where('section', 'process_head')->first()->image) : '' }}">
                           </div>
                        </div>


                        <button type="submit" class="my-4 editButton">Submit/Update</button>
                     </form>
                  </div>
               </section>
               <!-- Form -->
            </div>
         </div>
      </div>
      <!--  -->
      <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
         id="hs-destroy-heading-two">

         <x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify Process Body" />

         <div id="hs-destroy-collapse-two"
            class="hs-accordion-content w-full {{ $ACCORDION_2_VISIBILITY }} overflow-hidden transition-[height] duration-300"
            role="region" aria-labelledby="hs-destroy-heading-two">
            <div class="p-3">
               <!-- Form::Homepage-Hero -->
               <section
                  class="displayArea my-5 p-4 rounded-lg border-none bg-white dark:bg-neutral-700 shadow-md shadow-gray-400 dark:shadow-none mx-auto">
                  <div class="my-5">

                     <label for="order" class="inputLabelMedium">Order in page : 3</label>
                     @for ($i = 2; $i <= 5; $i++)
                        <form method="POST" action="{{ route('backend.webpages_homepage_store') }}"
                           class="p-2 rounded-lg dark:bg-neutral-700" enctype="multipart/form-data">
                           @csrf

                           <!-- IDENTIFIER INPUTS -->
                           <div>
                              <div class="hiddenInputs">
                                 <input type="hidden" name="page" value="homepage" readonly>
                                 <input type="hidden" name="section" value="process_body" readonly>
                              </div>
                              <!--  -->
                              <div class="mt-2 mb-5 grid grid-cols-1">
                                 <div>
                                    <input type="hidden" name="order_in_section" value="{{ $i }}" readonly>
                                    <!--  -->
                                    <input type="hidden" name="order_in_page" id="order" class="smallInput" value="3"
                                       readonly>
                                    <!--  -->
                                 </div>
                              </div>
                           </div>
                           <!-- IDENTIFIER INPUTS -->

                           <div class="gap-4">

                              <div class="homepageButtons my-2 grid grid-cols-6 gap-4">
                                 <div class="col-span-2">
                                    <label for="order" class="inputLabelMedium">Title
                                       {{ $i }}</label>
                                    <input type="text" name="title" class="mediumInput"
                                       value="{{ $homepageData->where('section', 'process_body')->where('order_in_section', $i)->first()?->title ?? '' }}">
                                 </div>
                                 <!--  -->
                                 <div class="col-span-3">
                                    <label for="order" class="inputLabelMedium">Sub-title
                                       {{ $i }}</label>
                                    <input type="text" name="subtitle" class="mediumInput"
                                       value="{{ $homepageData->where('section', 'process_body')->where('order_in_section', $i)->first()?->subtitle ?? '' }}">
                                 </div>
                                 <!--  -->
                                 <div class="col-span-1 flex_xy_center">
                                    <button type="submit" class="mt-4 editButton">Submit</button>
                                 </div>
                              </div>
                           </div>

                        </form>
                     @endfor

                  </div>
               </section>
               <!-- Form -->
            </div>
         </div>
      </div>
      <!--  -->
      <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
         id="hs-destroy-heading-three">

         <x-ui_items.accordion.accordion_toggle_button toggleLabel="Display Outcome" />

         <div id="hs-destroy-collapse-three"
            class="hs-accordion-content w-full {{ $ACCORDION_3_VISIBILITY }} overflow-hidden transition-[height] duration-300"
            role="region" aria-labelledby="hs-destroy-heading-three">

            <div class="p-3 grid grid-cols-1 md:grid-cols-2 gap-4">
               <!-- DISPLAY LIST -->
               <section class="displayArea">
                  <div class="my-10 sm:my-16 md:my-20 w-full sm:w-4/5 md:w-3/5 mx-auto flex flex-col gap-4">
                     {{-- <img src="{{ Storage::url($homepageData->where('section', 'process_head')->first()?->image) ?? '' }}" alt=""> --}}
                        @php
                           $targetImg = $homepageData->where('section', 'process_head')->first()?->image;
                        @endphp
                     @if ($targetImg)
                        <img src="{{ Storage::url($targetImg) }}" alt="image" class="h-80 mx-auto">
                     @else
                        <img src="" alt="" class="h-80 mx-auto">
                     @endif
                  </div>
               </section>
               <!--  -->
               <section class="displayArea w-full">
                  <div class="my-10 sm:my-16 md:my-20 w-full mx-auto">
                     <div class="grid grid-cols-1 gap-4 px-4">
                        <h2>{!! $homepageData->where('section', 'process_head')->first()?->title ?? '' !!}</h2>
                        @foreach ($homepageData->where('section', 'process_body') as $data)
                           <h4 class="text-[#06052E]">{{ $data->title ?? '' }}</h4>
                           <p class="text-[#818181] text-sm">{{ $data->subtitle ?? '' }}</p>
                        @endforeach
                     </div>
                  </div>
               </section>
               <!-- DISPLAY LIST -->

            </div>
         </div>
      </div>

   </div>


   <!---------------------------------------------------------------------------------------------- accordion -->











   <!-- ---------------- APP AREA Starts ---------------- -->

</x-app-layout>