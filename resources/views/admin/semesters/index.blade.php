<x-app-layout>
    <!-- Title -->
    <x-title text="Menu Semester">
        <div class="col-lg-6 col-5 text-right">
            <x-link class="btn-neutral" :href="route('admin.semesters.create')">Tambah</x-link>
        </div>
    </x-title>
    <!-- Page content -->
    <x-app-card>
        <!-- Card header -->
        <x-slot name="header">
            Tabel Data Semester
        </x-slot>

        <x-alert type="success"/>

        <x-alert type="danger"/>

        <!-- Card body -->
        <div class="table-responsive py-2">
            <table class="table table-flush" id="dataTable">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Semester</th>
                        <th>Tahun Ajaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Semester</th>
                        <th>Tahun Ajaran</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
                <tbody>
                </tbody>
            </table>
        </div>
    </x-app-card>

    <x-datatables>
        <script>
            $(function () {
                $('#dataTable tfoot th').not(':first-child').not(':last-child').each(function () {
                    const title = $(this).text();
                    $(this).html('<input type="text" placeholder="Cari ' + title + '" />');
                });

                $('#dataTable').DataTable({
                    dom: 'lBfrtip',
                    processing: true,
                    serverSide: true,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    buttons: [{
                            extend: 'copy',
                            exportOptions: {
                                columns: ':not(:last-child)'
                            }
                        },
                        {
                            extend: 'csv',
                            title: 'Data Semester',
                            exportOptions: {
                                columns: ':not(:last-child)'
                            }
                        },
                        {
                            extend: 'pdf',
                            title: 'Data Semester',
                            exportOptions: {
                                columns: ':not(:last-child)'
                            }
                        },
                        {
                            extend: 'excel',
                            title: 'Data Semester',
                            exportOptions: {
                                columns: ':not(:last-child)'
                            }
                        },
                        {
                            extend: 'print',
                            title: 'Data Semester',
                            exportOptions: {
                                columns: ':not(:last-child)'
                            }
                        },
                        {
                            extend: 'colvis'
                        }
                    ],
                    language: {
                        paginate: {
                            previous: '<i class="bi bi-chevron-left">',
                            next: '<i class="bi bi-chevron-right">'
                        }
                    },
                    ajax: '{{ route('admin.semesters.index') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'academic_year',
                            name: 'academic_year'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        }
                    ],
                    initComplete: function () {
                        $('.dt-button').addClass('btn btn-sm btn-default').removeClass('dt-button');

                        this.api().columns().every( function () {
                            let that = this;

                            $('input', this.footer()).on('keyup change clear', function () {
                                if (that.search() !== this.value) {
                                    that.search(this.value).draw();
                                }
                            });
                        });
                    }
                });
            });
        </script>
    </x-datatables>
</x-app-layout>
