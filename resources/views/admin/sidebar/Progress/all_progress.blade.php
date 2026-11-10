<x-app-layout>
	@php
		$breadCrumbs = [
			['label' => 'Progress', 'url' => 'backend_all_user', 'icon' => 'hourglassHalf'],
			['label' => 'All Progression'],
		];
	@endphp

	<x-breadcrumb :crumbs="$breadCrumbs" />


	<!-- Start Main Widgets -->
	<x-page_header_widget pageName="User Progressions" />
	<!-- End Main Widgets -->


	<!-- Alert Component -->
	<x-alert-component message="User List" />
	<!-- Alert Component -->

	<!-- ---------------- APP AREA Starts ---------------- -->

	<div class="p-6">

		<div class="overflow-x-auto">
			<table id="dataTableDisplay" class="min-w-full text-sm border border-gray-300 bg-white rounded-xl shadow-lg">
					<thead class="text-xs text-gray-700 uppercase bg-gray-100 rounded-t-xl">
						<tr>
							<th>SN</th>
							<th>ID</th>
							<th class="min-w-20 max-w-26"></th>>UID</th>
							<th class="min-w-26 max-w-48">User</th>
							<th class="min-w-26 max-w-48">Course</th>
							<th class="min-w-56 max-w-80">Progress</th>
							<th>Created At</th>
							{{-- <th>Action</th> --}}
						</tr>
					</thead>
					<tbody></tbody>
			</table>
		</div>
	</div>


	<!-- ---------------- SCRIPT FOR DATA-TABLE ---------------- -->
	<script>
		$(function() {
			const table = $('#dataTableDisplay').DataTable({
					processing: true,
					serverSide: true,
					responsive: true,
					ajax: {
						url: '{{ route('backend_dataTable_all_results') }}',
						type: 'POST',
						headers: {
							'X-CSRF-TOKEN': '{{ csrf_token() }}'
						}
					},
					columns:  [
						{ data: 'SN', className: 'px-3 py-2 text-center' },
						{ data: 'id', className: 'px-3 py-2 text-center' },
						{ data: 'uid', className: 'px-3 py-2 text-center' },
						{ data: 'user_name', className: 'px-3 py-2 text-center' },
						{ data: 'course_title', className: 'px-3 py-2 text-center' },
						{ data: 'progress', className: 'px-3 py-2 text-center' },
						{ data: 'created_at_formatted', className: 'px-3 py-2 text-center' },
						// { data: 'actions', orderable: false, searchable: false, className: 'px-3 py-2 text-center no-row-click' }
					],
					pageLength: 25,
					createdRow: function(row, data) {
                    $(row)
                        .css('cursor', 'pointer')
                        .on('mouseenter', function() {
                            $(this).css({
                                'background-color': '#364153',
                                'color': '#fff'
                            });
                        })
                        .on('mouseleave', function() {
                            $(this).css({
                                'background-color': '',
                                'color': ''
                            });
                        })
                        .on('click', function(e) {
                            const $clickedCell = $(e.target).closest('td');
                            if ($clickedCell.hasClass('no-row-click')) {
                                return;
                            }

                            if ($(e.target).is('button, a, input, select, textarea')) {
                                return;
                            }

                            const $interactiveParent = $(e.target).closest('button, a');
                            if ($interactiveParent.length && $(row).find($interactiveParent)
                                .length) {
                                return;
                            }

                            if (data.view_url) {
                                window.location.href = data.view_url;
                            }
                        });
                }
            });

            // Confirmation for delete
            $(document).on('click', '.deleteButton', function(e) {
                e.stopPropagation(); // prevent triggering row click
                if (!confirm('Are you sure you want to delete this subscriber?')) e.preventDefault();
            });
		});
	</script>
	<!-- ---------------- SCRIPT FOR DATA-TABLE ---------------- -->

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
