<x-app-layout>
    @php
        $breadCrumbs = [
            ['label' => 'Users', 'url' => 'backend_all_user', 'icon' => 'userTrippleLine'],
            ['label' => 'All Users'],
        ];
    @endphp

    <x-breadcrumb :crumbs="$breadCrumbs" />


    <!-- Start Main Widgets -->
    <x-page_header_widget pageName="User Management: All Users" />
    <!-- End Main Widgets -->


    <!-- Alert Component -->
    <x-alert-component message="User List" />
    <!-- Alert Component -->

    <!-- ---------------- APP AREA Starts ---------------- -->

    <div class="p-6">

        <div class="overflow-x-auto">
            <table id="dataTableDisplay"
                class="min-w-full text-sm border border-gray-300 bg-white rounded-xl shadow-lg">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 rounded-t-xl">
                    <tr>
                        <th>SN</th>
                        <th>ID</th>
                        <th>Avatar</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
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
            // Message display function
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
                }, 5000);
            }

            // Initialize DataTable
            const table = $('#dataTableDisplay').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{ route('backend_dataTable_all_users') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                },
                columns: [{
                    data: 'SN',
                    className: 'px-3 py-2 text-center'
                },
                {
                    data: 'ID',
                    className: 'px-3 py-2 text-center'
                },
                {
                    data: 'avatar_img',
                    orderable: false,
                    searchable: false,
                    className: 'px-3 py-2 text-center'
                },
                {
                    data: 'first_name',
                    className: 'px-3 py-2 text-center'
                },
                {
                    data: 'last_name',
                    className: 'px-3 py-2 text-center'
                },
                {
                    data: 'email',
                    className: 'px-3 py-2 text-center'
                },
                {
                    data: 'phone',
                    className: 'px-3 py-2 text-center'
                },
                {
                    data: 'created_at_formatted',
                    className: 'px-3 py-2 text-center'
                },
                {
                    data: 'actions',
                    orderable: false,
                    searchable: false,
                    className: 'px-3 py-2 text-center'
                }
                ],
                pageLength: 25,
                createdRow: function (row, data, dataIndex) {
                    $(row).css('cursor', 'pointer')
                        .on('mouseenter', function () {
                            $(this).css({
                                'background-color': '#364153',
                                'color': '#fff'
                            });
                        })
                        .on('mouseleave', function () {
                            $(this).css({
                                'background-color': '',
                                'color': ''
                            });
                        });
                    if (dataIndex % 2 === 0) {
                        $(row).css('background-color', '#f9f9f9');
                    } else {
                        $(row).css('background-color', '#ffffff');
                    }
                }
            });

            // Single toggle handler - REMOVED DUPLICATE
           $(document).on('change', '.toggle-status', function (e) {
                e.stopPropagation();
                const checkbox = $(this);
                const userId = checkbox.data('id');

                $.ajax({
                    url: '/admin/user/' + userId + '/blacklist',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        if (response.success) {
                            showMessage('success', response.message);
                            table.ajax.reload(null, false);
                        } else {
                            showMessage('error', 'Something went wrong.');
                            checkbox.prop('checked', !checkbox.prop('checked'));
                        }
                    },
                    error: function () {
                        showMessage('error', 'Server error. Please try again.');
                        checkbox.prop('checked', !checkbox.prop('checked'));
                    }
                });
            });
            // $(document).on('click', '.toggleForm button', function (e) {
            //     e.preventDefault();
            //     e.stopPropagation();
            //     const form = $(this).closest('form');
            //     $.ajax({
            //         url: form.attr('action'),
            //         type: 'POST',
            //         data: form.serialize(),
            //         success: function (res) {
            //             if (window.dataTableDisplay) {
            //                 window.dataTableDisplay.ajax.reload(null, false);
            //             }
            //         },
            //         error: function () {
            //             alert('Error toggling status.');
            //         }
            //     });
            // });

            // Delete user
            $(document).on('submit', '.deleteForm', function (e) {
                e.preventDefault();
                e.stopPropagation();
                if (confirm('Are you sure you want to delete this user?')) {
                    this.submit();
                }
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



</x-app-layout>