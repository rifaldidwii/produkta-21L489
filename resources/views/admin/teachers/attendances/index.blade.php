<x-app-layout>
    <!-- Title -->
    <x-title text="Menu Presensi Guru"/>

    <!-- Page content -->
    <x-app-card>
        <!-- Card header -->
        <x-slot name="header">
            Tabel Data Presensi {{ $teacher->name }}
        </x-slot>

        <!-- Card body -->
        <div class="card-body">
            <select id="days" name="days" class="form-control" data-toggle="select">
                <option value=""> Pilih Rentang Waktu </option>
                <option value="7"> 7 Hari Terakhir </option>
                <option value="14"> 14 Hari Terakhir </option>
                <option value="21"> 21 Hari Terakhir </option>
                <option value="30"> 30 Hari Terakhir </option>
            </select>
        </div>

        <div class="table-responsive py-2">
            <table class="table table-flush" id="dataTable">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Waktu Presensi</th>
                        <th>Kelas</th>
                        <th>Mapel</th>
                        <th>Kelas</th>
                        <th>Koordinat</th>
                        <th>Longitude</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Waktu Presensi</th>
                        <th>Kelas</th>
                        <th>Mapel</th>
                        <th>Kelas</th>
                        <th>Koordinat</th>
                        <th>Longitude</th>
                        <th>Status</th>
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

                let table = $('#dataTable').DataTable({
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
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'csv',
                            title: 'Data Presensi  {{ $teacher->name }}',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'pdf',
                            title: 'Data Presensi {{ $teacher->name }}',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'excel',
                            title: 'Data Presensi  {{ $teacher->name }}',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'print',
                            title: 'Data Presensi  {{ $teacher->name }}',
                            exportOptions: {
                                columns: ':visible'
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
                    ajax: {
                        'url': '{{ route('admin.teachers.attendances.index', $teacher) }}',
                        'data': function (d) {
                            d.days = $('#days').val();
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'created_at',
                            name: 'created_at'
                        },
                        {
                            data: 'schedule.classroom.name',
                            name: 'schedule.classroom.name'
                        },
                        {
                            data: 'schedule.classroom.subject.name',
                            name: 'schedule.classroom.subject.name'
                        },
                        {
                            data: 'schedule.classroom.subject.grade',
                            name: 'schedule.classroom.subject.grade'
                        },
                        {
                            data: 'latitude',
                            name: 'latitude'
                        },
                        {
                            data: 'longitude',
                            name: 'longitude'
                        },
                        {
                            data: 'status',
                            name: 'status'
                        }
                    ],
                    columnDefs : [{
                        render : function (data, type, row) {
                            return data + ' - ' + row['schedule']['classroom']['subject']['name'] + ' ' + row['schedule']['classroom']['subject']['grade'];
                        }, 'targets' : 2 },
                        {
                        render : function (data, type, row) {
                            return data + ', ' + row['longitude'];
                        }, 'targets' : 5 },
                        {
                            'visible': false,
                            'targets' : 3
                        },
                        {
                            'visible': false,
                            'targets' : 4
                        },
                        {
                            'visible': false,
                            'targets' : 6
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

                $('#days').change(function () {
                    table.draw();
                });
            });
        </script>
    </x-datatables>
</x-app-layout>
