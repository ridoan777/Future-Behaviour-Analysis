<x-app-layout>
   @php
      $breadCrumbs = [
         ['label' => 'Course Management', 'url' => 'backend_courses_create', 'icon' => 'documentLines'],
         ['label' => 'Lists', 'icon' => 'list'],
         ['label' => 'Modules', 'url' => 'backend_all_modules', 'icon' => 'documentLines'],
         ['label' => 'Lessons', 'url' => 'backend_all_lessons', 'icon' => 'documentLines'],
      ];
   @endphp


   <x-breadcrumb :crumbs="$breadCrumbs" />

   <!-- Start Main Widgets -->
   <x-page_header_widget pageName="List: All Courses" />
   <!-- End Main Widgets -->


   <!-- Alert Component -->
   <x-alert-component message="Form Submission" />
   <!-- Alert Component -->

   <!-- ---------------- APP AREA Starts ---------------- -->

   <div class="p-6">

      <div class="overflow-x-auto">
         <table id="dataTableDisplay" class="min-w-full text-sm border border-gray-300 bg-white rounded-xl shadow-lg">
            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400 rounded-t-xl">
               <tr>
                  <th class="px-3 py-2 text-center">SN</th>
                  <th class="px-3 py-2 text-center">Course ID</th>
                  <th class="px-3 py-2 text-center">Title</th>
                  <th class="px-3 py-2 text-center">Description</th>
                  <th class="px-3 py-2 text-center">Banner</th>
                  <th class="px-3 py-2 text-center">Modules</th>
                  <th class="px-3 py-2 text-center">Lessons</th>
                  <th class="px-3 py-2 text-center">Video Length</th>
                  <th class="px-3 py-2 text-center">Statistics</th>
                  <th class="px-3 py-2 text-center">Status</th>
                  <th class="!w-32 px-3 py-2">Created At</th>
                  <th class="px-3 py-2">Actions</th>
               </tr>
            </thead>
            <tbody></tbody>
         </table>

      </div>

   </div>


   <script>
      $(function () {
         const table = $('#dataTableDisplay').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
               url: '{{ route('backend_dataTable_courses') }}',
               type: 'POST',
               headers: {
                  'X-CSRF-TOKEN': '{{ csrf_token() }}'
               }
            },
            columns: [
               { data: 'SN', className: 'px-3 py-2 text-center' },
               { data: 'id', className: 'px-3 py-2 text-center' },
               { data: 'title', className: 'px-3 py-2 text-center' },
               {
                  data: 'description',
                  className: 'px-3 py-2 text-center',
                  render: function (data, type) {
                     if (type === 'display' && data) {
                        return data.length > 90 ? data.substr(0, 90) + '...' : data;
                     }
                     return data;
                  }
               },
               { data: 'banner_image_tag', orderable: false, searchable: false, className: 'px-3 py-2 text-center' },
               { data: 'total_modules', className: 'px-3 py-2 text-center' },
               { data: 'total_lessons', className: 'px-3 py-2 text-center' },
               { data: 'total_video_length', className: 'px-3 py-2 text-center' },
               { data: 'statistics', className: 'px-3 py-2 text-center' },
               { data: 'status', className: 'px-3 py-2 text-center' },
               { data: 'created_at_formatted', className: 'px-3 py-2 text-xs text-center' },
               { data: 'actions', orderable: false, searchable: false, className: 'px-3 py-2 text-center' }
            ],
            pageLength: 25,
            createdRow: function (row, data) {
               $(row).attr('data-href', data.row_link)
                  .css('cursor', 'pointer')
                  .on('mouseenter', function () {
                     $(this).css({
                        'background-color': '#364153',
                        'color': '#fff',
                        'cursor': 'pointer'
                     });
                  })
                  .on('mouseleave', function () {
                     $(this).css({
                        'background-color': '',
                        'color': '',
                     });
                  });
            }
         });

         $('#dataTableDisplay tbody').on('click', 'tr', function (e) {
            if ($(e.target).closest('.deleteForm, .deleteButton, .showButton').length) return; // CHANGE: block bubbling for edit/delete
            const url = $(this).data('href');
            if (url) window.location.href = url;
         });

         // delete confirmation
         $(document).on('submit', '.deleteForm', function (e) {
            e.stopPropagation(); // CHANGE: prevent bubbling to row
            if (!confirm('Are you sure you want to delete this record?')) {
               e.preventDefault();
            }
         });

         $(document).on('click', '.showButton', function (e) {
            e.stopPropagation();
         });
      });

   </script>

   <style>
      table thead th {
         text-align: center !important;
      }

      #dataTableDisplay tbody tr:nth-child(even) {
         background-color: #f3f4f6; /* bg-gray-100 */
      }

      #dataTableDisplay tbody tr:nth-child(odd) {
         background-color: #e5e7eb; /* bg-gray-200 */
      }
   </style>

</x-app-layout>