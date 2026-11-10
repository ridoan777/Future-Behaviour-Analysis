<x-app-layout>
    @php
        $breadCrumbs = [
            ['label' => 'Users', 'url' => 'backend_subscription_all_subscribers', 'icon' => 'userTrippleLine'],
            ['label' => 'All Subscribers'],
        ];
    @endphp

    <x-breadcrumb :crumbs="$breadCrumbs" />


    <!-- Start Main Widgets -->
    <x-page_header_widget pageName="Subscription: All Subscribers" />
    <!-- End Main Widgets -->


    <!-- Alert Component -->
    <x-alert-component message="Subscribers List" />
    <!-- Alert Component -->

    <!-- ---------------- APP AREA Starts ---------------- -->

    <div class="p-6">

        <div class="overflow-x-auto">
            <table id="dataTableDisplay"
                class="min-w-full text-sm border border-gray-300 bg-white rounded-xl shadow-lg">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 rounded-t-xl">
                    <tr>
                        <th>SN</th>
                        <th>DB ID</th>
                        <th class="min-w-40">User</th>
                        <th class="min-w-26 max-w-52">Tier</th>
                        <th class="min-w-26 max-w-52">Course</th>
                        <th>Paid Amount</th>
                        <th>Duration</th>
                        <th>Status Note</th>
                        <th>Ends In</th>
                        <th>Created At</th>
                        <th>Blacklist | Delete</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    {{-- --------- SCRIPT FOR ALL DATA-TABLE --------- --}}
	<script>
		$(function () {
			const table = $('#dataTableDisplay').DataTable({
					scrollX: true,
					processing: true,
					serverSide: true,
					responsive: true,
					ajax: {
						url: '{{ route('backend_dataTable_all_subscribers') }}',
						type: 'POST',
						headers: {
							'X-CSRF-TOKEN': '{{ csrf_token() }}'
						}
					},
					columns: [
						{ data: 'SN', className: 'px-3 py-2 text-center' },
						{ data: 'id', className: 'px-3 py-2 text-center' },
						{ data: 'user_name', className: 'px-3 py-2 text-center' },
						{ data: 'tier_title', className: 'px-3 py-2 text-center' },
						{ data: 'course_title', className: 'px-3 py-2 text-center' },
						{ data: 'paid_amount', className: 'px-3 py-2 text-center' },
						{ data: 'duration', className: 'px-3 py-2 text-center' },
						{ data: 'status_note', className: 'px-3 py-2 text-center' },
						{ data: 'ends_in', className: 'px-3 py-2 text-center' },
						{ data: 'created_at_formatted', className: 'px-3 py-2 text-center' },
						{ data: 'actions', orderable: false, searchable: false, className: 'px-3 py-2 text-center' }
					],
					pageLength: 25,

					createdRow: function (row, data) {
						$(row)
							.css('cursor', 'pointer')
							.on('mouseenter', function () {
									$(this).css({ 'background-color': '#364153', 'color': '#fff' });
							})
							.on('mouseleave', function () {
									$(this).css({ 'background-color': '', 'color': '' });
							})
							.on('click', function (e) {
								const $clickedCell = $(e.target).closest('td');
								if ($clickedCell.hasClass('no-row-click')) {
									return;
								}

								if ($(e.target).is('button, a, input, select, textarea')) {
									return;
								}

								const $interactiveParent = $(e.target).closest('button, a');
								if ($interactiveParent.length && $(row).find($interactiveParent).length) {
									return;
								}

								if (data.view_url) {
									window.location.href = data.view_url;
								}
							});
					}
			});

			// Confirmation for delete
			$(document).on('click', '.deleteButton', function (e) {
					e.stopPropagation(); // prevent triggering row click
					if (!confirm('Are you sure you want to delete this subscriber?')) e.preventDefault();
			});
		});
	</script>
    {{-- --------- SCRIPT FOR ALL DATA-TABLE --------- --}}

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
	<!-- ---------------- APP AREA Starts ---------------- -->
</x-app-layout>