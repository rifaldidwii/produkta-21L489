<x-app-layout>
    <!-- Title -->
    <x-title text="Menu Pembayaran">
        <div class="col-lg-6 col-5 text-right">
            <x-link class="btn-neutral" :href="route('admin.payments.create')">Tambah</x-link>
        </div>
    </x-title>

    <!-- Page content -->
    <x-app-card>
        <!-- Card header -->
        <x-slot name="header">
            Tabel Data Pembayaran
        </x-slot>

        <x-alert type="success"/>

        <x-alert type="danger"/>

        <!-- Card body -->
        <div class="table-responsive py-2">
            <table class="table table-flush" id="dataTable">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jumlah</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jumlah</th>
                        <th>Deskripsi</th>
                        <th>Status</th>
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
                            title: 'Data Pembayaran',
                            exportOptions: {
                                columns: ':not(:last-child)'
                            }
                        },
                        {
                            extend: 'pdf',
                            title: 'Data Pembayaran',
                            exportOptions: {
                                columns: ':not(:last-child)'
                            }
                        },
                        {
                            extend: 'excel',
                            title: 'Data Pembayaran',
                            exportOptions: {
                                columns: ':not(:last-child)'
                            }
                        },
                        {
                            extend: 'print',
                            title: 'Data Pembayaran',
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
                    ajax: '{{ route('admin.payments.index') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'student.name',
                            name: 'student.name'
                        },
                        {
                            data: 'amount',
                            name: 'amount'
                        },
                        {
                            data: 'description',
                            name: 'description'
                        },
                        {
                            data: 'status',
                            name: 'status'
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
