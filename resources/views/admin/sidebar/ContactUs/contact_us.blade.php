<x-app-layout>

   @php
      $breadCrumbs = [
          ['label' => 'WebPages', 'url' => 'dashboard', 'icon' => 'documentLines'],
          ['label' => 'Contact Us', 'icon' => 'phone'],
      ];
   @endphp

   <x-breadcrumb :crumbs="$breadCrumbs" />
   <!-- ---------------- APP AREA Starts ---------------- -->

   <!-- Start Main Widgets -->
   <x-page_header_widget pageName="Contact Us: All Sections" />
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
      $ACCORDION_6_VISIBILITY = '';
   @endphp

   <!---------------------------------------------------------------------------------------------- accordion -->
   <div class="hs-accordion-group">

      <x-ui_items.accordion.accordion-destroy />

      <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
         id="hs-destroy-heading-one">

         <x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify 'Official Contct Details'" />

         <div id="hs-destroy-collapse-one"
            class="hs-accordion-content {{ $ACCORDION_1_VISIBILITY }} w-full overflow-hidden transition-[height] duration-300"
            role="region"
            aria-labelledby="hs-destroy-heading-one">
            <div class="p-3">
               <!-- Form::About-Info Icons Head -->
               <section
                  class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
                  <div class="my-5">
                     <form method="POST" action="{{ route('backend_webpages_contact_store') }}"
                        class="rounded-lg p-2 dark:bg-neutral-700" enctype="multipart/form-data">
                        @csrf

                        <!-- IDENTIFIER INPUTS -->
                        <div>
                           <div class="hiddenInputs">
                              <input type="hidden" name="page" value="contact_us" readonly>
                              <input type="hidden" name="section" value="contact_admin" readonly>
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
                              <label for="title" class="inputLabelMedium">Section Title<span
                                    class="text-red-500">*</span></label>
                              <input type="text" name="title" class="mediumInput"
                                 value="{{ $contactusData?->title ?? '' }}">
                           </div>
                           <!--  -->
                           <div class="mb-5 mt-2">
                              <label for="title" class="inputLabelMedium">Section Subtitle<span
                                    class="text-red-500">*</span></label>
                              <textarea class="summernote" name="subtitle">{{ $contactusData->subtitle ?? '' }}</textarea>
                           </div>
                           <!--  -->

                           <hr class="my-10 border-none h-0.5 bg-gray-400">

                           <!--  -->
                           <div class="mb-5 mt-2">
                              <label for="title" class="inputLabelnormal">Office Phone<span
                                    class="text-red-500">*</span></label>
                              <input type="text" name="phone" class="mediumInput"
                                 value="{{ $contactusData?->phone ?? '' }}">
                           </div>
                           <!--  -->
                           <div class="mb-5 mt-2">
                              <label for="title" class="inputLabelnormal">Office Email<span
                                    class="text-red-500">*</span></label>
                              <input type="text" name="email" class="mediumInput"
                                 value="{{ $contactusData?->email ?? '' }}">
                           </div>
                           <!--  -->
                           <div class="mb-5 mt-2">
                              <label for="title" class="inputLabelnormal">Office Address<span
                                    class="text-red-500">*</span></label>
                              <input type="text" name="address" class="mediumInput"
                                 value="{{ $contactusData?->address ?? '' }}">
                           </div>
                           <!--  -->
                           <div class="gap-4">
                              <div class="homepageHeroImage">
                                 <label class="inputLabelMedium">Image Left (Larger)</label>
                                 <input type="hidden" name="remove_image" value="0">

                                 <input type="file" name="image" class="dropify" data-height="150"
                                    @if ($contactusData?->image) data-default-file="{{ Storage::url( $contactusData->image) }}" @endif />
                              </div>
                           </div>
                           <!--  -->

                        </div>

                        <button type="submit" class="editButton my-4">Submit/Update</button>
                     </form>
                  </div>
               </section>
               <!-- Form::About-Info Icons Head -->
            </div>
         </div>
      </div>
      <!--  -->

   </div>

   <!---------------------------------------------------------------------------------------------- accordion -->



   {{-- Script for video (promo) to start video always at 50% --}}
   <script>
      $('.dropify').on('dropify.afterClear', function(event, element) {
         $(element.element).closest('form').find('input[name="remove_image"]').val(1);
      });
   </script>

   {{-- Script for video (promo) to start video always at 50% --}}







   <!-- ---------------- APP AREA Starts ---------------- -->

</x-app-layout>
