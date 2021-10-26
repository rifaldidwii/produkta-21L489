<x-app-layout>
    <!-- Title -->
    <x-title text="Menu Jadwal"/>

    <!-- Page content -->
    <x-app-card>
        <!-- Card header -->
        <x-slot name="header">
            Form Ubah Data Jadwal
        </x-slot>

        <!-- Card body -->
        <div class="card-body">
            <form method="POST" action="{{ route('admin.schedules.update', $schedule) }}">
                @csrf
                @method('PUT')

                <x-app-input-group name="start_time" type="text" label="Tanggal dan Waktu Mulai (Format: Tanggal-Bulan-Tahun Jam:Menit:detik)" value="{{ Carbon\Carbon::parse($schedule->start_time)->format('d-m-Y H:i:s') }}"/>

                <x-app-input-group name="end_time" type="text" label="Tanggal dan Waktu Selesai (Format: Tanggal-Bulan-Tahun Jam:Menit:detik)" value="{{ Carbon\Carbon::parse($schedule->end_time)->format('d-m-Y H:i:s') }}"/>

                <div class="row">
                    <div class="col">
                        <x-button>Ubah</x-button>
                        <x-button name="recurring" value="true">Ubah Jadwal Setelahnya</x-button>
                        <x-link class="btn-danger" :href="route('admin.classrooms.schedules.index', $schedule->classroom_id)">Batal</x-link>
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
                        time: "bi bi-clock",
                        date: "bi bi-calendar-date",
                        up: "bi bi-chevron-up",
                        down: "bi bi-chevron-down",
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
                        time: "bi bi-clock",
                        date: "bi bi-calendar-date",
                        up: "bi bi-chevron-up",
                        down: "bi bi-chevron-down",
                        previous: 'bi bi-chevron-left',
                        next: 'bi bi-chevron-right',
                        today: 'bi bi-fullscreen',
                        clear: 'bi bi-trash',
                        close: 'bi bi-eraser'
                    }
                });
            });
        </script>
    </x-datetimepicker>
</x-app-layout>
