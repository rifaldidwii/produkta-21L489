<x-app-layout>
    <!-- Title -->
    <x-title text="Menu Jadwal"/>

    <!-- Page content -->
    <x-app-card>
        <!-- Card header -->
        <x-slot name="header">
            Form Tambah Data Jadwal
            <button id="add-column" class="btn btn-sm btn-primary float-right">pengaturan tambahan</button>
        </x-slot>

        <!-- Card body -->
        <div class="card-body">
            <form method="POST" action="{{ route('admin.classrooms.schedules.store', $classroom) }}">
                @csrf

                <input type="hidden" id="classroom_id" name="classroom_id" value="{{ $classroom->id }}">

                <x-app-input-group name="start_time" type="text" label="Tanggal dan Waktu Mulai (Format: Tanggal-Bulan-Tahun Jam:Menit:detik)"/>

                <x-app-input-group name="end_time" type="text" label="Tanggal dan Waktu Selesai (Format: Tanggal-Bulan-Tahun Jam:Menit:detik)"/>

                <x-app-input-group name="color" type="color" label="Warna Jadwal"/>

                <div id="new-column"></div>

                <div class="row">
                    <div class="col">
                        <x-button>Tambah</x-button>
                        <x-link class="btn-danger" :href="route('admin.classrooms.schedules.index', $classroom)" >Batal</x-link>
                    </div>
                </div>
            </form>
        </div>
    </x-app-card>

    <x-datetimepicker>
        <script type="text/javascript">
            $(function () {
                $('#start_time').datetimepicker({
                    format: 'DD-MM-YYYY HH:mm:00',
                    icons: {
                        time: 'bi bi-clock',
                        date: 'bi bi-calendar-date',
                        up: 'bi bi-chevron-up',
                        down: 'bi bi-chevron-down',
                        previous: 'bi bi-chevron-left',
                        next: 'bi bi-chevron-right',
                        today: 'bi bi-fullscreen',
                        clear: 'bi bi-trash',
                        close: 'bi bi-eraser'
                    }
                });
                $('#end_time').datetimepicker({
                    format: 'DD-MM-YYYY HH:mm:00',
                    icons: {
                        time: 'bi bi-clock',
                        date: 'bi bi-calendar-date',
                        up: 'bi bi-chevron-up',
                        down: 'bi bi-chevron-down',
                        previous: 'bi bi-chevron-left',
                        next: 'bi bi-chevron-right',
                        today: 'bi bi-fullscreen',
                        clear: 'bi bi-trash',
                        close: 'bi bi-eraser'
                    }
                });

                $('#add-column').click(() => {
                    $('#add-column').hide();

                    let html =
                    '<div class="row">' +
                        '<div class="col-md-12">' +
                            '<div class="form-group">' +
                                '<label class="form-control-label" for="recurrence_times">Waktu Pengulangan</label>' +
                                '<input id="recurrence_times" class="form-control " type="number" name="recurrence_times" ' + 'autocomplete="recurrence_times" value="2" onchange="">' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                    '<div class="row">' +
                        '<div class="col-md-12">' +
                            '<div class="form-group">' +
                                '<label class="form-control-label" for="recurrence_interval">Diulang Setiap ... Hari</label>' +
                                '<input id="recurrence_interval" class="form-control " type="number" name="recurrence_interval" ' + 'autocomplete="recurrence_interval" value="7" onchange="">' +
                            '</div>' +
                        '</div>' +
                    '</div>';

                    $('#new-column').append(html);
                });
            });

        </script>
    </x-datetimepicker>
</x-app-layout>
