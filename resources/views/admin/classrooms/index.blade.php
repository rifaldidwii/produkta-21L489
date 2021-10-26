<x-app-layout>
    <!-- Title -->
    <x-title text="Menu Kelas">
        <div class="col-lg-6 col-5 text-right">
            <x-link class="btn-neutral" :href="route('admin.classrooms.create')">Tambah</x-link>
        </div>
    </x-title>

    <!-- Page content -->
    <x-app-card>
        <!-- Card header -->
        <x-slot name="header">
            Tabel Data Kelas
        </x-slot>

        <x-alert type="success"/>

        <x-alert type="danger"/>

        <!-- Card body -->
        <div class="card-body">
            <select id="semester_id" name="semester_id" class="form-control" data-toggle="select">
                <option value=""> Pilih Semester </option>
                @foreach ($semesters as $semester)
                    <option value="{{ $semester->id }}"> {{ $semester->name }} - {{ $semester->academic_year }} </option>
                @endforeach
            </select>
        </div>

        <div class="table-responsive py-2">
            <table class="table table-flush" id="dataTable">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Mapel</th>
                        <th>Kelas</th>
                        <th>Guru</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Mapel</th>
                        <th>Kelas</th>
                        <th>Guru</th>
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
                                columns: [0, 1, 2, 4]
                            }
                        },
                        {
                            extend: 'csv',
                            title: 'Data Kelas',
                            exportOptions: {
                                columns: [0, 1, 2, 4]
                            }
                        },
                        {
                            extend: 'pdf',
                            title: 'Data Kelas',
                            exportOptions: {
                                columns: [0, 1, 2, 4]
                            }
                        },
                        {
                            extend: 'excel',
                            title: 'Data Kelas',
                            exportOptions: {
                                columns: [0, 1, 2, 4]
                            }
                        },
                        {
                            extend: 'print',
                            title: 'Data Kelas',
                            exportOptions: {
                                columns: [0, 1, 2, 4]
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
                        'url': '{{ route('admin.classrooms.index') }}',
                        'data': function (d) {
                            d.semester_id = $('#semester_id').val();
                        }
                    },
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
                            data: 'subject.name',
                            name: 'subject.name'
                        },
                        {
                            data: 'subject.grade',
                            name: 'subject.grade'
                        },
                        {
                            data: 'subject.teacher.name',
                            name: 'subject.teacher.name'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        }
                    ],
                    columnDefs : [{
                        render : function (data, type, row) {
                            return data + ' - ' + row['subject']['grade'];
                        }, 'targets' : 2 },
                        {
                            'visible': false,
                            'targets' : 3
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

                $('#semester_id').change(function () {
                    table.draw();
                });
            });
        </script>
    </x-datatables>
</x-app-layout>
