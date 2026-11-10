<x-app-layout>
   @php
      $breadCrumbs = [
         ['label' => 'Forms', 'icon' => 'form'],
         ['label' => 'Contact Us'],
      ];
   @endphp


   <x-breadcrumb :crumbs="$breadCrumbs" />

   <!-- Start Main Widgets -->
   <x-page_header_widget pageName="Contact Form Leads" />
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
                  <th class="px-3 py-2">SN</th>
                  <th class="px-3 py-2">DB ID</th>
                  <th class="px-3 py-2">Type</th>
                  <th class="px-3 py-2">Name</th>
                  <th class="px-3 py-2">Email</th>
                  <th class="px-3 py-2">Phone</th>
                  <th class="px-3 py-2">Description</th>
                  <th class="px-3 py-2">registered</th>
                  <th class="px-3 py-2">Created At</th>
                  <th class="px-3 py-2">Actions</th>
               </tr>
            </thead>
            <tbody></tbody>
         </table>
      </div>

   </div>


   <script>
      $(function () {

         function showMessage(type, message) {
            const colors = {
               success: ['green-400', 'green-700'],
               error: ['red-400', 'red-700'],
               info: ['blue-400', 'blue-700']
            };
            const [borderColor, textColor] = colors[type] || colors.info;
            const alertDiv = $(`
         <div class="border border-${borderColor} text-${textColor} px-4 py-3 rounded relative my-2 transition-opacity duration-1000" role="alert">
            <strong class="font-bold">${type.charAt(0).toUpperCase() + type.slice(1)}!</strong>
            <span class="block sm:inline ml-2">${message}</span>
         </div>
      `);
            $('#messageArea').append(alertDiv);
            setTimeout(() => {
               alertDiv.addClass('opacity-0');
               setTimeout(() => alertDiv.remove(), 1000);
            }, 4000);
         }

         const table = $('#dataTableDisplay').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
               url: '{{ route('backend.dataTable_contact_us') }}',
               type: 'POST',
               headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            },
            columns: [
               { data: 'SN', className: 'px-3 py-2 text-center' },
               { data: 'id', className: 'px-3 py-2 text-center' },
               { data: 'section', className: 'px-3 py-2 text-center' },
               { data: 'name', className: 'px-3 py-2 text-center' },
               { data: 'email', className: 'px-3 py-2 text-center' },
               { data: 'phone', className: 'px-3 py-2 text-center' },
               { data: 'description', className: 'px-3 py-2 text-center' },
               { data: 'registered', className: 'px-3 py-2 text-center' },
               { data: 'created_at_formatted', className: 'px-3 py-2 text-center' },
               { data: 'actions', orderable: false, searchable: false, className: 'px-3 py-2 text-center' }
            ],
            pageLength: 25,
            createdRow: function (row, data, dataIndex) {
               $(row).css('cursor', 'pointer')
                  .on('mouseenter', function () {
                     $(this).css({ 'background-color': '#364153', 'color': '#fff' });
                  })
                  .on('mouseleave', function () {
                     $(this).css({ 'background-color': '', 'color': '' });
                  })
                  .on('click', function (e) {
                     // Prevent triggering on delete button click
                     if (!$(e.target).closest('.deleteForm').length) {
                        window.location.href = '/admin/forms/contact-us/' + data.id + '/edit';
                     }
                  });
            }
         });

         // Delete confirmation (inline confirm + AJAX)
         $(document).on('submit', '.deleteForm', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const form = this;
            if (confirm('Are you sure you want to delete this contact entry?')) {
               $.ajax({
                  url: form.action,
                  type: 'POST',
                  data: $(form).serialize(),
                  success: function () {
                     showMessage('success', 'Contact entry deleted successfully.');
                     table.ajax.reload(null, false);
                  },
                  error: function () {
                     showMessage('error', 'Failed to delete contact entry. Please try again.');
                  }
               });
            }
         });

      });
   </script>

   <style>
      table thead th {
         text-align: center !important;
      }

      #dataTableDisplay tbody tr:nth-child(even) {
         background-color: #e5e7eb;
         /* bg-gray-200 */
      }

      #dataTableDisplay tbody tr:nth-child(odd) {
         background-color: #f3f4f6;
         /* bg-gray-100 */
      }
   </style>

</x-app-layout>