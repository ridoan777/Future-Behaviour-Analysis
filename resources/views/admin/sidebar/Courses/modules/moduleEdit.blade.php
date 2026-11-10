<x-app-layout>

   @php
      $breadCrumbs = [
         ['label' => 'Course Management', 'url' => 'backend_courses_create', 'icon' => 'documentLines'],
         ['label' => 'All Modules', 'url' => 'backend_all_modules', 'icon' => 'cubic'],
         ['label' => 'Modify Module', 'icon' => 'cubicSingle'],
      ];
   @endphp

   <x-breadcrumb :crumbs="$breadCrumbs" />
   <!-- ---------------- APP AREA Starts ---------------- -->

   <!-- Start Main Widgets -->
   <x-page_header_widget pageName="Module: {{ Str::limit($singleModule->title, 60) }}" />
   <!-- End Main Widgets -->


   <!-- Alert Component -->
   <x-alert-component message="Form Submission" />
   <!-- Alert Component -->

   @php
      $ORDER_IN_PAGE = 1;
      $ACCORDION_1_VISIBILITY = ''; // hidden or ''
      $ACCORDION_2_VISIBILITY = 'hidden';
   @endphp

   <!---------------------------------------------------------------------------------------------- accordion -->
   <div class="hs-accordion-group">

      <x-ui_items.accordion.accordion-destroy />

      <div class="hs-accordion-to-destroy hs-accordion hs-accordion-active:border-gray-200 PrelineAccordionItemParent"
         id="hs-destroy-heading-two">

         <x-ui_items.accordion.accordion_toggle_button toggleLabel="Modify This Module" />

         <div id="hs-destroy-collapse-two"
            class="hs-accordion-content {{ $ACCORDION_1_VISIBILITY }} w-full overflow-hidden transition-[height] duration-300"
            role="region" aria-labelledby="hs-destroy-heading-two">
            <div class="p-3">
               <!-- Form::Create Course -->
               <section
                  class="displayArea mx-auto my-5 rounded-lg border-none bg-white p-4 shadow-md shadow-gray-400 dark:bg-neutral-700 dark:shadow-none">
                  <div class="my-5">

                     <form method="POST" action="{{ route('backend_module_store', $singleModule?->id) }}"
                        class="rounded-lg p-2 dark:bg-neutral-700" enctype="multipart/form-data">
                        @csrf

                        <!--- IDENTIFIER HIDDEN INPUTS -->
                        <input type="hidden" name="flag" class="smallInput" value="update">
                        <input type="hidden" name="id" class="smallInput" value="{{ $singleModule?->id ?? null }}">
                        <input type="hidden" name="remove_image" id="remove_image" value="0">
                        <!--- IDENTIFIER HIDDEN INPUTS -->

                        <div>
                           {{-- --}}
                           <div class="mb-5 mt-2">
                              <label for="title" class="inputLabelMedium">Course Name<spanclass="text-red-500">*</spanclass=></label>
                              <select id="courses" name="course_id"
                                 class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                 <option value="">Choose a course</option>
                                 @foreach($allCourses as $course)
                                    <option value="{{ $course->id }}" {{ $singleModule->course_id == $course->id ? 'selected' : '' }}>
                                       ID:{{ $course?->id }} | {{ $course?->title }}
                                    </option>
                                 @endforeach
                              </select>
                           </div>

                           {{-- --}}
                           <div class="mb-5 mt-2">
                              <label for="title" class="inputLabelMedium">Module's Title<span
                                    class="text-red-500">*</span></label>
                              <input type="text" name="title" class="mediumInput"
                                 value="{{ $singleModule?->title ?? null }}" placeholder="max 255-characters">
                           </div>
                           <!--  -->
                           <div class="mb-5 mt-2">
                              <label for="bio" class="inputLabelMedium">Bio<span
                                    class="text-sm text-gray-300 font-light"> (Max 2000 characters)</span></label>
                              <textarea class="summernote" name="description"
                                 id="bio">{!! $singleModule?->description ?? null !!}</textarea>
                           </div>
                           <!--  -->
                           <div class="mb-5 mt-2">
                              <label for="quiz_eligible" class="inputLabelMedium">Lessons need to Eligible for Quiz<span
                                    class="text-red-500">*</span></label>
                              <input type="text" name="quiz_eligible" class="normalInput"
                                 value="{{ $singleModule?->quiz_eligible ?? null }}" placeholder="max 255-characters">
                           </div>
                           <!--  -->
                           <div class="mb-5 mt-2">
                              <label for="title" class="inputLabelMedium">Attach Quiz<spanclass="text-red-500">*</spanclass=></label>
                              <select id="quiz" name="quiz_id"
                                 class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                 <option value="">No Quiz/Detach a Quiz</option>
                                 @foreach($allQuizzes as $quiz)
                                    <option value="{{ $quiz->id }}" {{ $singleModule->quiz_id == $quiz->id ? 'selected' : '' }}>
                                       {{ $quiz->title }}
                                    </option>
                                 @endforeach
                              </select>
                           </div>
                           <!--  -->
                           <div class="mb-5 mt-2">
                              <label for="quiz_eligible" class="inputLabelMedium">Active Status</label>
                              <select id="courses" name="status"
                                 class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                 <option value="1" {{ $singleModule->status == 1 ? 'selected' : '' }}> Active</option>
                                 <option value="0" {{ $singleModule->status == 0 ? 'selected' : '' }}> Inactive</option>
                              </select>
                           </div>
                           {{-- --}}

                        </div>

                        <button type="submit" class="showButton my-4">Update Module</button>
                     </form>

                  </div>
               </section>
               <!-- Form::Create Course -->
            </div>
         </div>
      </div>
      <!--  -->

   </div>

   <!---------------------------------------------------------------------------------------------- accordion -->



   {{-- Script for tweaking remove_image = 1 --}}
   <script>
      $(document).ready(function () {
         const drEvent = $('.dropify').dropify();

         drEvent.on('dropify.afterClear', function (event, element) {
            $('#remove_image').val(1);
         });

         drEvent.on('change', function () {
            $('#remove_image').val(0);
         });
      });
   </script>

   {{-- Script for tweaking remove_image = 1 --}}







   <!-- ---------------- APP AREA Starts ---------------- -->

</x-app-layout>