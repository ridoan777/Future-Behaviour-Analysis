<x-app-layout>

   @php
      $breadCrumbs = [
          ['label' => 'WebPages', 'url' => 'dashboard', 'icon' => 'documentLines'],
          ['label' => 'Common Sections', 'url' => 'dashboard', 'icon' => 'globe'],
          ['label' => 'Footer'],
      ];
   @endphp

   <x-breadcrumb :crumbs="$breadCrumbs" />
   <!-- ---------------- APP AREA Starts ---------------- -->

   <!-- Start Main Widgets -->
   <x-page_header_widget pageName="Common Section: Footer" />
   <!-- End Main Widgets -->


   <!-- Alert Component -->
   <x-alert-component message="Form Submission" />
   <!-- Alert Component -->

   @php
      $ACCORDION_1_VISIBILITY = 'hidden';
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

         <x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify Footer Details" />

         <div id="hs-destroy-collapse-one"
            class="hs-accordion-content w-full  {{ $ACCORDION_1_VISIBILITY }} overflow-hidden transition-[height] duration-300"
            role="region"
            aria-labelledby="hs-destroy-heading-one">
            <div class="p-3">
               <!-- Form::Common Section-Footer Details -->
               <section
                  class="displayArea my-5 p-4 rounded-lg border-none bg-white dark:bg-neutral-700 shadow-md shadow-gray-400 dark:shadow-none mx-auto">
                  <div class="my-5">
                     <form method="POST" action="{{ route('backend.common_section_store') }}"
                        class="p-2 rounded-lg dark:bg-neutral-700" enctype="multipart/form-data">
                        @csrf

                        <!-- IDENTIFIER INPUTS -->
                        <div class="hiddenInputs">
                           <input type="hidden" name="type" value="footer" readonly>
                           <input type="hidden" name="section" value="footer_detail" readonly>
                           <input type="hidden" name="order_in_section" value="1" readonly>
                        </div>
                        <!-- IDENTIFIER INPUTS -->


                        <!-- CONTENT INPUTS -->
                        <div>
                           <div class="mt-2 mb-5">
                              <label for="image" class="inputLabelMedium">
                                 Footer Image <span class="text-red-500">*</span>
                              </label>
                              {{-- <input id="image" name="images[]" type="file" class="dropify" data-height="150" /> --}}

                              <input type="file" name="images[]" class="dropify" data-height="150"
                                 @if ($infoHead?->image) data-default-file="{{ Storage::url( $infoHead->image) }}" @endif />
                           </div>
                           {{--  --}}
                           <div class="mt-2 mb-5">
                              <label for="title" class="inputLabelMedium">Title<span
                                    class="text-red-500">*</span></label>
                              <textarea class="summernote" name="title" id="title">{!! $infoHead?->title ?? '' !!}</textarea>
                           </div>
                           {{--  --}}
                           <div class="mt-2 mb-5">
                              <label for="detail" class="inputLabelMedium">Details<span
                                    class="text-red-500">*</span></label>
                              <textarea class="summernote" name="detail" id="detail">{!! $infoHead?->detail ?? '' !!}</textarea>
                           </div>
                        </div>
                        <!-- CONTENT INPUTS -->

                        <button type="submit" class="my-4 editButton">Submit/Update</button>
                     </form>
                  </div>
               </section>
               <!-- Form::Common Section-Footer Details -->
            </div>
         </div>
      </div>
      <!-- ------------------ -->
      <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
         id="hs-destroy-heading-two">

         <x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify Social Links" />

         <div id="hs-destroy-collapse-two"
            class="hs-accordion-content w-full  {{ $ACCORDION_2_VISIBILITY }} overflow-hidden transition-[height] duration-300"
            role="region"
            aria-labelledby="hs-destroy-heading-two">
            <div class="p-3">
               <!-- Form::Common Section-Hero -->
               <section
                  class="displayArea my-5 p-4 rounded-lg border-none bg-white dark:bg-neutral-700 shadow-md shadow-gray-400 dark:shadow-none mx-auto">
                  <div class="my-5">

                     @php
                        $socialMedia = ['Facebook', 'X', 'LinkedIn', 'Instagram'];
                     @endphp

                     @foreach ($socialMedia as $index => $item)
                        <form method="POST" action="{{ route('backend.common_section_store') }}"
                           class="p-2 rounded-lg dark:bg-neutral-700" enctype="multipart/form-data">
                           @csrf

                           <!-- IDENTIFIER INPUTS -->
                           <div>
                              <input type="hidden" name="type" value="footer">
                              <input type="hidden" name="section" value="footer_social">
                              <input type="hidden" name="order_in_section" value="{{ $index + 1 }}">
                              <input type="hidden" name="title" value="{{ $item }}">
                           </div>
                           <!-- IDENTIFIER INPUTS -->

                           <!-- CONTENT INPUTS -->
                           <div class="mt-2 mb-5 flex_xy_center gap-4">
                              <label class="w-16 md:w-32 inputLabelMedium">{{ $item }}</label>
                              <input name="btn_url" type="url" class="normalInput" value="{{ $social[$index+1]?->btn_url ?? '' }}"/>
                              <button type="submit" class="editButton">Save</button>
                           </div>
                           <!-- CONTENT INPUTS -->

                        </form>
                     @endforeach


                  </div>
               </section>
               <!-- Form -->
            </div>
         </div>
      </div>
      <!-- ------------------ -->
      <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
         id="hs-destroy-heading-three">

         <x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify Contact" />

         <div id="hs-destroy-collapse-three"
            class="hs-accordion-content w-full  {{ $ACCORDION_3_VISIBILITY }} overflow-hidden transition-[height] duration-300"
            role="region"
            aria-labelledby="hs-destroy-heading-three">
            <div class="p-3">
               <!-- Form::Common Section-Hero -->
               <section
                  class="displayArea my-5 p-4 rounded-lg border-none bg-white dark:bg-neutral-700 shadow-md shadow-gray-400 dark:shadow-none mx-auto">
                  <div class="my-5">

                     @php
                        $socialMedia = ['Phone', 'Email', 'Address', 'Other'];
                     @endphp

                     @foreach ($socialMedia as $index => $item)
                        <form method="POST" action="{{ route('backend.common_section_store') }}"
                           class="p-2 rounded-lg dark:bg-neutral-700" enctype="multipart/form-data">
                           @csrf

                           <!-- IDENTIFIER INPUTS -->
                           <div>
                              <input type="hidden" name="type" value="footer">
                              <input type="hidden" name="section" value="contact">
                              <input type="hidden" name="order_in_section" value="{{ $index + 1 }}">
                              <input type="hidden" name="title" value="{{ $item }}">
                           </div>
                           <!-- IDENTIFIER INPUTS -->

                           <!-- CONTENT INPUTS -->
                           <div class="mt-2 mb-5 flex_xy_center gap-4">
                              <label class="w-16 md:w-32 inputLabelMedium">{{ $item }}</label>
                              <input name="title" type="hidden" class="normalInput" value="{{ $item }}"/>
                              <input name="subtitle" type="text" class="normalInput" value="{{ $contact[$index+1]->subtitle ?? '' }}"/>
                              <button type="submit" class="editButton">Save</button>
                           </div>
                           <!-- CONTENT INPUTS -->

                        </form>
                     @endforeach


                  </div>
               </section>
               <!-- Form -->
            </div>
         </div>
      </div>
      <!-- ------------------ -->
      <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
         id="hs-destroy-heading-four">

         <x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify Quick Access Button" />

         <div id="hs-destroy-collapse-four"
            class="hs-accordion-content w-full  {{ $ACCORDION_4_VISIBILITY }} overflow-hidden transition-[height] duration-300"
            role="region"
            aria-labelledby="hs-destroy-heading-four">
            <div class="p-3">
               <!-- Form::Common Section-Hero -->
               <section
                  class="displayArea my-5 p-4 rounded-lg border-none bg-white dark:bg-neutral-700 shadow-md shadow-gray-400 dark:shadow-none mx-auto">
                  <div class="my-5">

                     @for ($i = 1; $i <= 4; $i++)
                        <form method="POST" action="{{ route('backend.common_section_store') }}"
                           class="p-2 rounded-lg dark:bg-neutral-700" enctype="multipart/form-data">
                           @csrf

                           <!-- IDENTIFIER INPUTS -->
                           <div>
                              <input type="hidden" name="type" value="footer">
                              <input type="hidden" name="section" value="quick_access">
                              <input type="hidden" name="order_in_section" value="{{ $i }}">
                           </div>
                           <!-- IDENTIFIER INPUTS -->

                           <!-- CONTENT INPUTS -->
                           <div class="mt-2 mb-5 flex_xy_center gap-4">
                              <input name="title" type="text" class="normalInput w-1/3" value="{{ $quick_access[$i]->title ?? '' }}"/>
                              <input name="btn_url" type="url" class="normalInput" value="{{ $quick_access[$i]->btn_url ?? '' }}"/>
                              <button type="submit" class="editButton">Save</button>
                           </div>
                           <!-- CONTENT INPUTS -->

                        </form>
                     @endfor


                  </div>
               </section>
               <!-- Form -->
            </div>
         </div>
      </div>
      <!-- ------------------ -->
      <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
         id="hs-destroy-heading-five">

         <x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify Subscription Text" />

         <div id="hs-destroy-collapse-five"
            class="hs-accordion-content w-full  {{ $ACCORDION_5_VISIBILITY }} overflow-hidden transition-[height] duration-300"
            role="region"
            aria-labelledby="hs-destroy-heading-five">
            <div class="p-3">
               <!-- Form::Common Section-Hero -->
               <section
                  class="displayArea my-5 p-4 rounded-lg border-none bg-white dark:bg-neutral-700 shadow-md shadow-gray-400 dark:shadow-none mx-auto">
                  <div class="my-5">

                        <form method="POST" action="{{ route('backend.common_section_store') }}"
                           class="p-2 rounded-lg dark:bg-neutral-700" enctype="multipart/form-data">
                           @csrf

                           <!-- IDENTIFIER INPUTS -->
                           <div>
                              <input type="hidden" name="type" value="footer">
                              <input type="hidden" name="section" value="subscribe_email">
                              <input type="hidden" name="order_in_section" value="1">
                           </div>
                           <!-- IDENTIFIER INPUTS -->

                           <!-- CONTENT INPUTS -->
                           <div class="mt-2 mb-5 flex_xy_center gap-4">
                              <input name="detail" type="text" class="mediumInput" value="{{ $subscribe_email->detail ?? '' }}"/>
                              <button type="submit" class="editButton">Save</button>
                           </div>
                           <!-- CONTENT INPUTS -->

                        </form>

                  </div>
               </section>
               <!-- Form -->
            </div>
         </div>
      </div>
      <!-- ------------------ -->
      <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
         id="hs-destroy-heading-five">

         <x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify Copyright Text" />

         <div id="hs-destroy-collapse-five"
            class="hs-accordion-content w-full  {{ $ACCORDION_6_VISIBILITY }} overflow-hidden transition-[height] duration-300"
            role="region"
            aria-labelledby="hs-destroy-heading-five">
            <div class="p-3">
               <!-- Form::Common Section-Hero -->
               <section
                  class="displayArea my-5 p-4 rounded-lg border-none bg-white dark:bg-neutral-700 shadow-md shadow-gray-400 dark:shadow-none mx-auto">
                  <div class="my-5">

                        <form method="POST" action="{{ route('backend.common_section_store') }}"
                           class="p-2 rounded-lg dark:bg-neutral-700" enctype="multipart/form-data">
                           @csrf

                           <!-- IDENTIFIER INPUTS -->
                           <div>
                              <input type="hidden" name="type" value="footer">
                              <input type="hidden" name="section" value="copyright_text">
                              <input type="hidden" name="order_in_section" value="1">
                           </div>
                           <!-- IDENTIFIER INPUTS -->

                           <!-- CONTENT INPUTS -->
                           <div class="mt-2 mb-5 flex_xy_center gap-4">
                              <input name="detail" type="text" class="mediumInput" value="{{ $copyright_text->detail ?? '' }}"/>
                              <button type="submit" class="editButton">Save</button>
                           </div>
                           <!-- CONTENT INPUTS -->

                        </form>

                  </div>
               </section>
               <!-- Form -->
            </div>
         </div>
      </div>
      <!-- ------------------ -->

   </div>

   <!---------------------------------------------------------------------------------------------- accordion -->

   <!-- ---------------- APP AREA Starts ---------------- -->

</x-app-layout>
