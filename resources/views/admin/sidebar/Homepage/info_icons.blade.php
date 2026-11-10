<x-app-layout>

   @php
      $breadCrumbs = [
          ['label' => 'WebPages', 'url' => 'dashboard', 'icon' => 'documentLines'],
          ['label' => 'Homepage', 'url' => 'dashboard', 'icon' => 'documentLines'],
          ['label' => 'Info'],
      ];
   @endphp

   <x-breadcrumb :crumbs="$breadCrumbs" />
   <!-- ---------------- APP AREA Starts ---------------- -->

   <!-- Start Main Widgets -->
   <x-page_header_widget pageName="Homepage: 'What sets us apart' Section" />
   <!-- End Main Widgets -->


   <!-- Alert Component -->
   <x-alert-component message="Form Submission" />
   <!-- Alert Component -->

   @php
      $ORDER_IN_PAGE = 4;
      $ACCORDION_1_VISIBILITY  = 'hidden';
      $ACCORDION_2_VISIBILITY  = '';
      $ACCORDION_3_VISIBILITY  = 'hidden';
   @endphp

   <!---------------------------------------------------------------------------------------------- accordion -->
   <div class="hs-accordion-group">

      <x-ui_items.accordion.accordion-destroy />

      <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
         id="hs-destroy-heading-one">

         <x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify Info Icons Head (Left)" />

         <div id="hs-destroy-collapse-one"
            class="hs-accordion-content w-full {{ $ACCORDION_1_VISIBILITY }} overflow-hidden transition-[height] duration-300" role="region"
            aria-labelledby="hs-destroy-heading-one">
            <div class="p-3">
               <!-- Form::Homepage-Info Icons Head -->
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
                              <input type="hidden" name="section" value="info_icons_head" readonly>
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
                              <label for="subtitle" class="inputLabelMedium">Section Title (Subtitle)<span
                                    class="text-red-500">*</span></label>

                              <input type="text" name="subtitle" class="normalInput"
                                 value="{{ $infoHead?->subtitle ?? '' }}">
                           </div>
                           <!--  -->
                           <div class="mb-5 mt-2">
                              <label for="title" class="inputLabelMedium">Title<span
                                    class="text-red-500">*</span></label>
                              <input type="text" name="title" class="mediumInput"
                                 value="{{ $infoHead?->title ?? '' }}">
                           </div>
                           <!--  -->
                           <div class="grid grid-cols-1 gap-4">
                              <div class="homepageHeroImage">
                                 <label for="image" class="inputLabelMedium">
                                    Info Image <span class="text-red-500">*</span>
                                 </label>
                                 <input id="image" name="images[]" type="file" class="dropify"
                                    data-height="150" @if ($infoHead?->image) data-default-file="{{ Storage::url($infoHead?->image) }}" @endif />
                              </div>
                           </div>
                           <!--  -->
                           <div class="mb-5 mt-2">
                              <label for="btn_1" class="inputLabelMedium">Info Button's Text</label>
                              <input type="text" name="btn_1" id="btn_1" class="normalInput"
                                 value="{{ $infoHead?->btn_1 ?? '' }}">
                           </div>
                        </div>

                        <button type="submit" class="editButton my-4">Submit/Update</button>
                     </form>
                  </div>
               </section>
               <!-- Form::Homepage-Info Icons Head -->
            </div>
         </div>
      </div>
      <!--  -->
      <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
         id="hs-destroy-heading-two">

         <x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify Info Icons Body (Right)" />

         <div id="hs-destroy-collapse-two"
            class="hs-accordion-content w-full {{ $ACCORDION_2_VISIBILITY }} overflow-hidden transition-[height] duration-300" role="region"
            aria-labelledby="hs-destroy-heading-two">
            <div class="p-3">
               <!-- Form::Homepage-Info Icons Body -->
               <section
                  class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
                  <div class="my-5">

                     <label for="order" class="inputLabelMedium">Order in page : {{ $ORDER_IN_PAGE }}</label>
                     <div class="mt-12 mb-4 py-2 grid grid-cols-6 gap-4 bg-gray-100">
                         <label for="image" class="inputLabelMedium px-4 m-0 col-span-1">Info Image</label>
                         <label for="title" class="inputLabelMedium px-4 m-0 col-span-2">Title</label>
                         <label for="subtitle" class="inputLabelMedium px-4 m-0 col-span-3">Subtitle</label>
                     </div>
                     @for ($i = 1; $i <= 5; $i++)
                        <form method="POST" action="{{ route('backend.webpages_homepage_store') }}"
                           class="rounded-lg p-2 dark:bg-neutral-700" enctype="multipart/form-data">
                           @csrf

                           <!-- IDENTIFIER INPUTS -->
                           <div>
                              <div class="hiddenInputs">
                                 <input type="hidden" name="page" value="homepage" readonly>
                                 <input type="hidden" name="section" value="info_icons_body" readonly>
                              </div>
                              <!--  -->
                              <div class="mb-5 mt-2 grid grid-cols-1">
                                 <div>
                                    <input type="hidden" name="order_in_section" value="{{ $i }}"
                                       readonly>
                                    <!--  -->
                                    <input type="hidden" name="order_in_page" id="order" class="smallInput"
                                       value="{{ $ORDER_IN_PAGE }}"
                                       readonly>
                                    <!--  -->
                                 </div>
                              </div>
                           </div>
                           <!-- IDENTIFIER INPUTS -->

                           <div class="gap-4">

                              <div class="homepageButtons my-2 grid grid-cols-10 gap-2 items-center">

                                 <div class="col-span-2">
                                    {{-- <input id="image" name="images[]" type="file" class="dropify"
                                       data-height="150" @if ($infoBody[$i]?->image) data-default-file="{{ asset('storage/' . $infoBody[$i]?->image) }}" @endif /> --}}

                                    <input id="image" name="images[]" type="file" class="dropify"
                                       data-height="150"  @if (isset($infoBody[$i]) && $infoBody[$i]->image) data-default-file="{{ Storage::url($infoBody[$i]->image) }}" @endif />
                                 </div>
                                 {{--  --}}
                                 <div class="col-span-3">
                                    <input type="text" name="title" class="mediumInput"
                                       value="{{ $infoBody[$i]?->title ?? '' }}">
                                 </div>
                                 {{--  --}}
                                 <div class="col-span-4">
                                    <input type="text" name="subtitle" class="mediumInput"
                                       value="{{ $infoBody[$i]?->subtitle ?? '' }}">
                                       {{-- value="{{ $homepageData->where('section', 'info_icons_body')->where('order_in_section', $i)->first()?->subtitle ?? '' }}"> --}}
                                 </div>
                                 {{--  --}}

                                 <div class="flex_xy_center col-span-1">
                                    <button type="submit" class="editButton">Submit</button>
                                 </div>

                              </div>
                           </div>

                        </form>
                     @endfor

                  </div>
               </section>
               <!-- Form::Homepage-Info Icons Body -->
            </div>
         </div>
      </div>
      <!--  -->
      <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
         id="hs-destroy-heading-three">

         <x-ui_items.accordion.accordion_toggle_button toggleLabel="Display Outcome" />

         <div id="hs-destroy-collapse-three"
            class="hs-accordion-content w-full {{ $ACCORDION_3_VISIBILITY }}  overflow-hidden transition-[height] duration-300" role="region"
            aria-labelledby="hs-destroy-heading-three">

            <div class="p-3 grid grid-cols-1 gap-4 md:grid-cols-12">
               <!-- IMAGE -->
               <section class="col-span-5 p-4">
                  <h6 class="text-[#06052E]">
                     {{ $infoHead?->subtitle ?? '' }}</h6>

                  <h2 class="text-[#06052E]">
                     {{ $infoHead?->title ?? '' }}</h2>

                  <button
                     class="editButton my-4 rounded-full px-4 py-2 text-sm">{{ $infoHead?->btn_1 ?? '' }}</button>

                  <div class="flex items-center">
                     {{-- <img src="{{ Storage::url($infoHead?->image ?? '') }}" alt="" class="h-16 object-contain rounded-full"> --}}
                     @if ($infoHead?->image)
                        <img src="{{ Storage::url($infoHead->image) }}" alt="{{ $infoHead?->title }}" class="h-80 mx-auto">
                     @else
                           <img src="" alt="" class="h-80 mx-auto">
                     @endif

                     <span class="mx-2 text-sm">{!! $infoHead?->detail ?? '' !!}</span>
                  </div>
               </section>

               <section class="col-span-7 p-8 grid grid-flow-col grid-rows-3 gap-12">
                  @foreach ($infoBody as $data)
                     <div>
                        {{-- <img src="{{ Storage::url($data->image) }}" alt=""> --}}
                        @if ($data?->image)
                           <img src="{{ Storage::url($data->image) }}" alt="{{ $data?->title }}" class="h-80 mx-auto">
                        @else
                              <img src="" alt="" class="h-80 mx-auto">
                        @endif
                        <h4 class="text-[#06052E]">{{ $data->title ?? '' }}</h4>
                        <p class="text-sm text-[#818181]">{{ $data->subtitle ?? '' }}</p>
                     </div>
                  @endforeach
               </section>

            </div>

         </div>
      </div>

   </div>

   <!---------------------------------------------------------------------------------------------- accordion -->











   <!-- ---------------- APP AREA Starts ---------------- -->

</x-app-layout>
