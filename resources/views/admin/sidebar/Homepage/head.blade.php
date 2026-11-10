<x-app-layout>

   @php
      $breadCrumbs = [
         ['label' => 'WebPages', 'url' => 'dashboard', 'icon' => 'documentLines'],
         ['label' => 'Homepage', 'url' => 'dashboard', 'icon' => 'documentLines'],
         ['label' => 'Head'],
      ];
   @endphp

   <x-breadcrumb :crumbs="$breadCrumbs" />
   <!-- ---------------- APP AREA Starts ---------------- -->

   <!-- Start Main Widgets -->
   <x-page_header_widget pageName="Homepage Head Section" />
   <!-- End Main Widgets -->


   <!-- Alert Component -->
   <x-alert-component message="Form Submission" />
   <!-- Alert Component -->

   @php
      $ACCORDION_1_VISIBILITY = 'hidden'; // hidden or ''
      $ACCORDION_2_VISIBILITY = '';
      $ACCORDION_3_VISIBILITY = 'hidden';
   @endphp

   <!---------------------------------------------------------------------------------------------- accordion -->
   <div class="hs-accordion-group">

      <x-ui_items.accordion.accordion-destroy />

      <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
         id="hs-destroy-heading-one">

         <x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify Homepage Title" />

         <div id="hs-destroy-collapse-one"
            class="hs-accordion-content w-full {{ $ACCORDION_1_VISIBILITY }} overflow-hidden transition-[height] duration-300"
            role="region" aria-labelledby="hs-destroy-heading-one">
            <div class="p-3">
               <!-- Form::Homepage-Title -->
               <section
                  class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
                  <div class="my-5">
                     <form method="POST" action="{{ route('backend.webpages_homepage_store') }}"
                        class="rounded-lg p-2 dark:bg-neutral-700">
                        @csrf

                        <!-- IDENTIFIER INPUTS -->
                        <div class="hiddenInputs">
                           <input type="hidden" name="page" value="homepage" readonly>
                           <input type="hidden" name="section" value="title" readonly>
                        </div>
                        <!--  -->
                        <div class="mb-5 mt-2 grid grid-cols-1">
                           <div>
                              <label for="order" class="inputLabelMedium">Order in page</label>
                              <input type="text" name="order_in_page" id="order" class="smallInput" value="1" readonly>
                              <label for="order" class="inputSubLabel"><span
                                    class="mx-2 text-base text-red-500">*</span>Must be at page order first</label>
                           </div>
                        </div>
                        <!-- IDENTIFIER INPUTS -->

                        <div class="homepageTitle mb-5 mt-2">
                           <label for="title" class="inputLabelMedium">Main Title <span
                                 class="text-red-500">*</span></label>
                           <textarea class="summernote" name="title"
                              id="title">{!! $homepageData->where('section', 'title')->first()?->title ?? '' !!}</textarea>
                        </div>
                        <!--  -->
                        <div class="homepageSubTitle mb-5 mt-2">
                           <label for="subTitle" class="inputLabelMedium">Sub-Title <span
                                 class="text-red-500">*</span></label>
                           <textarea class="summernote" name="subtitle"
                              id="subTitle">{!! $homepageData->where('section', 'title')->first()?->subtitle ?? '' !!}</textarea>
                        </div>
                        <!--  -->

                        <div class="homepageButtons mb-5 mt-2 grid grid-cols-1 gap-4 sm:grid-cols-2">
                           <div>
                              <label for="btn_1" class="inputLabelMedium">Left Button Text</label>
                              <input type="text" name="btn_1" id="btn_1" class="normalInput"
                                 value="{{ $homepageData->where('section', 'title')->first()?->btn_1 ?? "Start Training" }}">
                           </div>
                           <div>
                              <label for="btn_2" class="inputLabelMedium">Right Button Text</label>
                              <input type="text" name="btn_2" id="btn_2" class="normalInput"
                                 value="{{ $homepageData->where('section', 'title')->first()?->btn_2 ?? "Login" }}">
                           </div>
                        </div>


                        <button type="submit" class="editButton my-4">Submit/Update</button>
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

         <x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify Homepage Hero" />

         <div id="hs-destroy-collapse-two"
            class="hs-accordion-content w-full {{ $ACCORDION_2_VISIBILITY }} overflow-hidden transition-[height] duration-300"
            role="region" aria-labelledby="hs-destroy-heading-two">
            <div class="p-3">
               <!-- Form::Homepage-Hero -->
               <section
                  class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
                  <div class="my-5">
                     <label for="order" class="inputLabelMedium">Order in page</label>
                     <input type="text" name="order_in_page" id="order" class="smallInput" value="2" readonly disabled>

                     <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4">
                        @for ($i = 1; $i <= 4; $i++)
                           <form method="POST" action="{{ route('backend.webpages_homepage_store') }}"
                              class="rounded-lg p-2 dark:bg-neutral-700" enctype="multipart/form-data">
                              @csrf

                              <!-- IDENTIFIER INPUTS -->
                              <div>
                                 <div class="hiddenInputs">
                                    <input type="hidden" name="page" value="homepage" readonly>
                                    <input type="hidden" name="section" value="hero" readonly>
                                 </div>
                                 <!--  -->
                                 <div class="mb-5 mt-2 grid grid-cols-1">
                                    <div>
                                       <input type="hidden" name="order_in_page" id="order" class="smallInput" value="2"
                                          readonly>
                                    </div>
                                 </div>
                              </div>
                              <!-- IDENTIFIER INPUTS -->

                              <div class="w-full">
                                 <input type="hidden" name="order_in_section" value="{{ $i }}" readonly>
                                 <label for="image{{ $i }}" class="inputLabelMedium">
                                    Title Image {{ $i }} <span class="text-red-500">*</span>
                                 </label>

                                 <input type="hidden" name="remove_image" value="0">

                                 <input id="image{{ $i }}" name="images[]" type="file" class="dropify" data-height="150"
                                    @if (isset($homepageData[$i]) && $homepageData[$i]->image)
                                    data-default-file="{{ Storage::url($homepageData[$i]->image) }}" @endif />

                                 <button type="submit" class="editButton my-4">Submit</button>
                              </div>
                           </form>
                        @endfor
                     </div>
                  </div>


                  {{-- --}}
                  <form method="POST" action="{{ route('backend.webpages_homepage_store') }}"
                     class="rounded-lg p-2 dark:bg-neutral-700" enctype="multipart/form-data">
                     @csrf

                     <!-- IDENTIFIER INPUTS -->
                     <div>
                        <div class="hiddenInputs">
                           <input type="hidden" name="page" value="homepage" readonly>
                           <input type="hidden" name="section" value="hero" readonly>
                           <input type="hidden" name="order_in_section" value="5" readonly>
                        </div>
                        <!--  -->
                        <div class="mb-5 mt-2 grid grid-cols-1">
                           <div>
                              <label for="order" class="inputLabelMedium">Order in page</label>
                              <input type="text" name="order_in_page" id="order" class="smallInput" value="2" readonly>
                              <label for="order" class="inputSubLabel"><span
                                    class="mx-2 text-base text-red-500">*</span>Must be
                                 at page order second</label>
                           </div>
                        </div>
                     </div>
                     <!-- IDENTIFIER INPUTS -->

                     <div class="homepageButtons mb-5 mt-2 grid grid-cols-1 gap-4 sm:grid-cols-3">
                        <div>
                           <label for="btn_1" class="inputLabelMedium">Left Pill's Text</label>
                           <input type="text" name="btn_1" id="btn_1" class="normalInput"
                              value="{{ $homepageData->where('section', 'hero')->where('order_in_section', 5)->first()?->btn_1 ?? 'BACB Aligned' }}">
                        </div>
                        <div>
                           <label for="btn_2" class="inputLabelMedium">Middle Pill's Text</label>
                           <input type="text" name="btn_2" id="btn_2" class="normalInput"
                              value="{{ $homepageData->where('section', 'hero')->where('order_in_section', 5)->first()?->btn_2 ?? '100% Online' }}">
                        </div>
                        <div>
                           <label for="btn_3" class="inputLabelMedium">Right Pills' Text</label>
                           <input type="text" name="btn_3" id="btn_3" class="normalInput"
                              value="{{ $homepageData->where('section', 'hero')->where('order_in_section', 5)->first()?->btn_3 ?? 'Certificate Included' }}">
                        </div>
                     </div>


                     <button type="submit" class="editButton my-4">Submit</button>
                  </form>

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
         class="hs-accordion-content hidden w-full {{ $ACCORDION_3_VISIBILITY }} overflow-hidden transition-[height] duration-300"
         role="region" aria-labelledby="hs-destroy-heading-three">

         <div class="grid grid-cols-1 gap-4 p-3">
            @if (isset($homepageData) && $homepageData->where('section', 'title')->isNotEmpty())
               <!-- DISPLAY LIST -->
               <section class="displayArea">
                  <div class="mx-auto my-10 flex w-full flex-col gap-4 sm:my-16 sm:w-4/5 md:my-20 md:w-3/5">
                     @foreach ($homepageData->where('section', 'title') as $data)
                        <h1 class="md:leading-16 text-center text-2xl leading-tight sm:text-3xl md:text-4xl">
                           {!! $data->title !!}
                        </h1>
                        <p class="px-2 text-center text-sm text-gray-500 sm:text-base">{!! $data->subtitle !!}</p>
                        <div class="flex flex-wrap justify-center gap-2">
                           <button class="editButton px-4 py-2 text-sm">{!! $data->btn_1 !!}</button>
                           <button class="editButton px-4 py-2 text-sm">{!! $data->btn_2 !!}</button>
                        </div>
                     @endforeach
                  </div>
               </section>
            @endif
            <!--  -->
            @if (isset($homepageData) && $homepageData->where('section', 'hero')->isNotEmpty())
               <section class="displayArea">
                  <div class="mx-auto my-10 w-full sm:my-16 sm:w-11/12 md:my-20 md:w-4/5">
                     <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-4">
                        @foreach ($homepageData->where('section', 'hero') as $data)
                           @if ($data->image)
                              <img src="{{ Storage::url($data->image) }}" alt="{{ $data->image }}"
                                 class="h-80 w-full rounded-md object-cover">
                           @elseif($data->btn_1 || $data->btn_2 || $data->btn_3)
                              <div class="col-span-4 mt-4 flex flex-wrap justify-center gap-2">
                                 @foreach (['btn_1', 'btn_2', 'btn_3'] as $btn)
                                    @if ($data->$btn)
                                       <button class="pillEmpty px-4 py-2 text-sm">{!! $data->$btn !!}</button>
                                    @endif
                                 @endforeach
                              </div>
                           @endif
                        @endforeach
                     </div>
                  </div>
               </section>
            @endif
            <!-- DISPLAY LIST -->
            @if (!isset($homepageData) || $homepageData->isEmpty())
               <section
                  class="displayArea mx-auto my-5 w-full rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-900 dark:shadow-none">
                  <h2 class="text-center text-gray-400 dark:text-gray-100">No records have been created yet!</h2>
               </section>
            @endif
         </div>
      </div>
   </div>

   </div>


   <!---------------------------------------------------------------------------------------------- accordion -->











   <!-- ---------------- APP AREA Starts ---------------- -->

</x-app-layout>