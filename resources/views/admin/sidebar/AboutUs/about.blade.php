<x-app-layout>

   @php
      $breadCrumbs = [
         ['label' => 'WebPages', 'url' => 'dashboard', 'icon' => 'documentLines'],
         //  ['label' => 'About Us', 'url' => 'dashboard', 'icon' => 'documentLines'],
         ['label' => 'About us'],
      ];
   @endphp

   <x-breadcrumb :crumbs="$breadCrumbs" />
   <!-- ---------------- APP AREA Starts ---------------- -->

   <!-- Start Main Widgets -->
   <x-page_header_widget pageName="About Us: All Sections" />
   <!-- End Main Widgets -->


   <!-- Alert Component -->
   <x-alert-component message="Form Submission" />
   <!-- Alert Component -->

   @php
      $ORDER_IN_PAGE = 1;
      $ACCORDION_1_VISIBILITY = ''; // hidden or ''
      $ACCORDION_2_VISIBILITY = 'hidden';
      $ACCORDION_3_VISIBILITY = 'hidden';
      $ACCORDION_4_VISIBILITY = 'hidden';
      $ACCORDION_5_VISIBILITY = 'hidden';
   @endphp

   <!---------------------------------------------------------------------------------------------- accordion -->
   <div class="hs-accordion-group">

      <x-ui_items.accordion.accordion-destroy />

      <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
         id="hs-destroy-heading-one">

         <x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify 'About Our Program'" />

         <div id="hs-destroy-collapse-one"
            class="hs-accordion-content {{ $ACCORDION_1_VISIBILITY }} w-full overflow-hidden transition-[height] duration-300"
            role="region"
            aria-labelledby="hs-destroy-heading-one">
            <div class="p-3">
               <!-- Form::About-Info Icons Head -->
               <section
                  class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
                  <div class="my-5">
                     <form method="POST" action="{{ route('backend_webpages_about_us_store') }}"
                        class="rounded-lg p-2 dark:bg-neutral-700" enctype="multipart/form-data">
                        @csrf

                        <!-- IDENTIFIER INPUTS -->
                        <div>
                           <div class="hiddenInputs">
                              <input type="hidden" name="page" value="about" readonly>
                              <input type="hidden" name="section" value="program_info" readonly>
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
                              <input type="text" name="title" class="mediumInput"
                                 value="{{ $programInfo?->title ?? '' }}">
                           </div>
                           <div class="mb-5 mt-2">
                              <label for="detail" class="inputLabelMedium">Detail<span
                                    class="text-red-500">*</span></label>
                              <textarea class="summernote" name="detail" id="detail">{{ $programInfo->detail ?? '' }}</textarea>
                           </div>
                           <!--  -->
                           <div class="grid grid-cols-2 gap-4">
                              <div class="homepageHeroImage">
                                 <label class="inputLabelMedium">Image Left (Larger)</label>
                                 <input type="file" name="file_1" class="dropify" data-height="150"
                                    @if ($programInfo?->file_1) data-default-file="{{ Storage::url( $programInfo->file_1) }}" @endif />
                              </div>
                              <div class="homepageHeroImage">
                                 <label class="inputLabelMedium">Image Right (Smaller)</label>
                                 <input type="file" name="file_2" class="dropify" data-height="150"
                                    @if ($programInfo?->file_2) data-default-file="{{ Storage::url( $programInfo->file_2) }}" @endif />
                              </div>
                           </div>

                           <!--  -->

                           <div class="mb-5 mt-2">
                              <label for="button" class="inputLabelMedium">Info Button's Text</label>
                              <input type="text" name="button" id="button" class="normalInput"
                                 value="{{ $programInfo?->button ?? '' }}">
                           </div>
                        </div>

                        <button type="submit" class="editButton my-4">Submit/Update</button>
                     </form>

                     <hr class="my-8 border-gray-200">

                     <div class="mb-4">
                        <label for="order" class="inputLabelMedium">Counter Widgets</label>
                     </div>

                     @for ($i = 2; $i <= 4; $i++)
                        @php
                           $counterItem = $programCounters->firstWhere('order_in_section', $i);
                        @endphp

                        <form method="POST" action="{{ route('backend_webpages_about_us_store') }}"
                           class="rounded-lg p-2 dark:bg-neutral-700" enctype="multipart/form-data">
                           @csrf

                           <div class="hiddenInputs">
                              <input type="hidden" name="page" value="about" readonly>
                              <input type="hidden" name="section" value="program_info" readonly>
                              <input type="hidden" name="order_in_page" value="1" readonly>
                              <input type="hidden" name="order_in_section" value="{{ $i }}" readonly>
                           </div>

                           <div class="grid grid-cols-9 gap-2">
                              <div class="col-span-3 mb-5 mt-2">
                                 <span class="inputLabelMedium">Counter {{ $i - 1 }} Number 
                                    <span class="text-sm text-gray-400">(use any string value)</span>
                                       <span class="text-red-500">*</span></label>
                                 <input type="text" name="title" class="mediumInput"
                                    value="{{ $counterItem?->title ?? '' }}" placeholder="2.6k/300 people">
                              </div>

                              <div class="col-span-5 mb-5 mt-2">
                                 <label class="inputLabelMedium">Counter {{ $i - 1 }} Label<span
                                       class="text-red-500">*</span></label>
                                 <input type="text" name="detail" class="normalInput"
                                    value="{{ $counterItem?->detail ?? '' }}" placeholder="Successfully Trained/Learners Enrolled">
                              </div>

                              <div class="col-span-1 flex_xy_center">
                                 <button type="submit" class="editButton my-4">Submit</button>
                              </div>
                           </div>

                           @if ($i < 4)
                              <hr class="text-gray-300">
                           @endif
                        </form>
                     @endfor
                  </div>
               </section>
               <!-- Form::About-Info Icons Head -->
            </div>
         </div>
      </div>
      <!--  -->
      <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
         id="hs-destroy-heading-two">

         @php
            $ORDER_IN_PAGE = 2;
         @endphp

         <x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify 'Watch & Learn'" />

         <div id="hs-destroy-collapse-two"
            class="hs-accordion-content {{ $ACCORDION_2_VISIBILITY }} w-full overflow-hidden transition-[height] duration-300"
            role="region"
            aria-labelledby="hs-destroy-heading-two">
            <div class="p-3">
               <!-- Form::About-Promo -->
               <section
                  class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
                  <div class="my-5">
                     <form method="POST" action="{{ route('backend_webpages_about_us_store') }}"
                        class="rounded-lg p-2 dark:bg-neutral-700" enctype="multipart/form-data">
                        @csrf

                        <!-- IDENTIFIER INPUTS -->
                        <div>
                           <div class="hiddenInputs">
                              <input type="hidden" name="page" value="about" readonly>
                              <input type="hidden" name="section" value="watch_n_learn" readonly>
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
                              <input type="text" name="title" class="mediumInput"
                                 value="{{ $promo?->title ?? '' }}">
                           </div>
                           <div class="mb-5 mt-2">
                              <label for="detail" class="inputLabelMedium">Detail<span
                                    class="text-red-500">*</span></label>
                              <textarea class="summernote" name="detail" id="detail">{{ $promo?->detail ?? '' }}</textarea>
                           </div>
                           <!--  -->
                           <div class="gap-4">
                              <label class="inputLabelMedium">Demo/Promo Video</label>
                              <input type="file" name="file_1" class="dropify" data-height="150"
                                 @if ($promo?->file_1) data-default-file="{{ Storage::url( $promo->file_1) }}" @endif />
                           </div>
                           <div class="mb-5 mt-2">
                              @if (!empty($promo->file_1))
                                 <div
                                    class="relative overflow-hidden rounded-2xl border border-gray-200 bg-gray-50 shadow-lg">
                                    <video class="h-auto w-full rounded-2xl" id="promoVideo" controls>
                                       <source src="{{ Storage::url( $promo?->file_1) }}" type="video/mp4">
                                       @if($promo?->file_1_webm)
                                          <source src="{{ Storage::url( $promo?->file_1_webm) }}" type="video/webm">
                                       @endif
                                       @if($promo?->file_1_ogg)
                                          <source src="{{ Storage::url( $promo?->file_1_ogg) }}" type="video/ogg">
                                       @endif
                                       Your browser does not support the video tag.
                                    </video>


                                 </div>

                                 <script>
                                    document.addEventListener("DOMContentLoaded", function() {
                                       const video = document.getElementById("promoVideo");
                                       if (video) {
                                          video.volume = 0.0; // 50% volume
                                       }
                                       document.getElementById("promoVideo").volume

                                    });
                                 </script>
                              @else
                                 <div
                                    class="w-full rounded-lg border bg-gray-200 p-2 text-center font-semibold text-gray-500">
                                    <span>No Files Uploaded</span>
                                 </div>
                              @endif
                           </div>


                        </div>

                        <button type="submit" class="editButton my-4">Submit/Update</button>
                     </form>
                  </div>
               </section>
               <!-- Form::About-Promo -->
            </div>
         </div>
      </div>
      <!--  -->
      <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
         id="hs-destroy-heading-two">

         @php
            $ORDER_IN_PAGE = 3;
         @endphp

         <x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify 'Career Changes Lives' Header Section" />

         <div id="hs-destroy-collapse-two"
            class="hs-accordion-content {{ $ACCORDION_3_VISIBILITY }} w-full overflow-hidden transition-[height] duration-300"
            role="region"
            aria-labelledby="hs-destroy-heading-two">
            <div class="p-3">
               <!-- Form::About-Promo -->
               <section
                  class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
                  <div class="my-5">
                     <form method="POST" action="{{ route('backend_webpages_about_us_store') }}"
                        class="rounded-lg p-2 dark:bg-neutral-700" enctype="multipart/form-data">
                        @csrf

                        <!-- IDENTIFIER INPUTS -->
                        <div>
                           <div class="hiddenInputs">
                              <input type="hidden" name="page" value="about" readonly>
                              <input type="hidden" name="section" value="career_steps" readonly>
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
                           <input type="hidden" name="order_in_section" value="1" readonly>

                           <div class="mb-5 mt-2">
                              <label for="title" class="inputLabelMedium">Title<span
                                    class="text-red-500">*</span></label>
                              <input type="text" name="title" class="mediumInput"
                                 value="{{ $careerChanges->where('order_in_section', '1')->first()?->title ?? '' }}">
                           </div>
                           <!--  -->
                           <div class="mb-5 mt-2">
                              <label for="detail" class="inputLabelMedium">Description<span
                                    class="text-red-500">*</span></label>
                              <textarea class="summernote" name="detail" id="detail">{{ $careerChanges->where('order_in_section', '1')->first()?->detail ?? '' }}</textarea>
                           </div>
                        </div>

                        <button type="submit" class="editButton my-4">Submit/Update</button>
                     </form>
                  </div>
               </section>
               <!-- Form::About-Promo -->
            </div>
         </div>
      </div>
      <!--  -->
      <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
         id="hs-destroy-heading-two">

         @php
            $ORDER_IN_PAGE = 3;
         @endphp

         <x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify 'Career Changes Lives' Body Section" />

         <div id="hs-destroy-collapse-two"
            class="hs-accordion-content {{ $ACCORDION_4_VISIBILITY }} w-full overflow-hidden transition-[height] duration-300"
            role="region"
            aria-labelledby="hs-destroy-heading-two">
            <div class="p-3">
               <!-- Form::About-Promo -->
               <section
                  class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
                  <div class="my-5">

                     <label for="order" class="inputLabelMedium">Order in page</label>
                     <input type="text" name="order_in_page" id="order" class="smallInput"
                        value="{{ $ORDER_IN_PAGE }}" readonly disabled>

                     @for ($i = 2; $i <= 4; $i++)
                        <form method="POST" action="{{ route('backend_webpages_about_us_store') }}"
                           class="rounded-lg p-2 dark:bg-neutral-700" enctype="multipart/form-data">
                           @csrf

                           <!-- IDENTIFIER INPUTS -->
                           <div>
                              <div class="hiddenInputs">
                                 <input type="hidden" name="page" value="about" readonly>
                                 <input type="hidden" name="section" value="career_steps" readonly>
                              </div>
                              <!--  -->
                              <div class="mb-5 mt-2 grid grid-cols-1">
                                 <div>
                                    <input type="text" name="order_in_page" id="order"
                                       class="smallInput hidden" value="{{ $ORDER_IN_PAGE }}" readonly>
                                    <input type="hidden" name="order_in_section" value="{{ $i }}"
                                       readonly>
                                 </div>
                              </div>
                           </div>
                           <!-- IDENTIFIER INPUTS -->


                           <div class="grid grid-cols-9 gap-2">

                              <div class="col-span-4 mb-5 mt-2 flex flex-col justify-center">
                                 <label for="title" class="inputLabelMedium">Title {{ $i - 1 }}<span
                                       class="text-red-500">*</span></label>
                                 <textarea class="summernote" name="title" id="title">{!! $careerChanges->where('order_in_section', $i)->first()?->title ?? '' !!}</textarea>
                              </div>
                              <!--  -->
                              <div class="col-span-4 mb-5 mt-2">
                                 <label for="detail" class="inputLabelMedium">Description<span
                                       class="text-red-500">*</span></label>
                                 <textarea class="summernote" name="detail" id="detail">{!! $careerChanges->where('order_in_section', $i)->first()?->detail ?? '' !!}</textarea>
                              </div>
                              {{--  --}}
                              <div class="cols-span-1 flex_xy_center">
                                 <button type="submit" class="editButton my-4">Submit/Update</button>
                              </div>
                           </div>
                           <hr class="text-gray-300">
                        </form>
                     @endfor
                  </div>
               </section>
               <!-- Form::About-Promo -->
            </div>
         </div>
      </div>
      <!--  -->
      <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
         id="hs-destroy-heading-two">

         @php
            $ORDER_IN_PAGE = 4;
         @endphp

         <x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify 'Commitment Cards' Section" />

         <div id="hs-destroy-collapse-two"
            class="hs-accordion-content {{ $ACCORDION_5_VISIBILITY }} w-full overflow-hidden transition-[height] duration-300"
            role="region"
            aria-labelledby="hs-destroy-heading-two">
            <div class="p-3">
               <!-- Form::About-Promo -->
               <section
                  class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
                  <div class="my-5">

                     <label for="order" class="inputLabelMedium">Order in page</label>
                     <input type="text" name="order_in_page" id="order" class="smallInput"
                        value="{{ $ORDER_IN_PAGE }}" readonly disabled>

                     @for ($i = 1; $i <= 4; $i++)
                        <form method="POST" action="{{ route('backend_webpages_about_us_store') }}"
                           class="rounded-lg p-2 dark:bg-neutral-700" enctype="multipart/form-data">
                           @csrf

                           <!-- IDENTIFIER INPUTS -->
                           <div>
                              <div class="hiddenInputs">
                                 <input type="hidden" name="page" value="about" readonly>
                                 <input type="hidden" name="section" value="cards" readonly>
                              </div>
                              <!--  -->
                              <div class="mb-5 mt-2 grid grid-cols-1">
                                 <div>
                                    <input type="text" name="order_in_page" id="order"
                                       class="smallInput hidden" value="{{ $ORDER_IN_PAGE }}" readonly>
                                    <input type="hidden" name="order_in_section" value="{{ $i }}"
                                       readonly>
                                 </div>
                              </div>
                           </div>
                           <!-- IDENTIFIER INPUTS -->


                           <div class="grid grid-cols-9 gap-2">

                              <div class="col-span-4 mb-5 mt-2 flex flex-col justify-center">
                                 <label for="title"
                                    class="inputLabelMedium">{{ $i == 1 ? 'Header Title' : 'Card Title : ' . ($i - 1) }}<span
                                       class="text-red-500">*</span></label>
                                 <textarea class="summernote" name="title" id="title">{!! $cards->where('order_in_section', $i)->first()?->title ?? '' !!}</textarea>
                              </div>
                              <!--  -->
                              <div class="col-span-4 mb-5 mt-2">
                                 <label for="detail"
                                    class="inputLabelMedium">{{ $i == 1 ? 'Header Description' : 'Description' }}<span
                                       class="text-red-500">*</span></label>
                                 <textarea class="summernote" name="detail" id="detail">{!! $cards->where('order_in_section', $i)->first()?->detail ?? '' !!}</textarea>
                              </div>
                              {{--  --}}
                              <div class="cols-span-1 flex_xy_center">
                                 <button type="submit" class="editButton my-4">Submit/Update</button>
                              </div>
                           </div>
                           <hr class="text-gray-300">
                        </form>
                     @endfor
                  </div>
               </section>
               <!-- Form::About-Promo -->
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







   <!-- ---------------- APP AREA Starts ---------------- -->

</x-app-layout>
