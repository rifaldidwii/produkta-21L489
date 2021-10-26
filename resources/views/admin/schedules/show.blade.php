<x-app-layout>
    <x-leaflet/>

    <!-- Title -->
    <x-title text="Menu Jadwal"/>

    <!-- Page content -->
    <x-app-card>
        <!-- Card header -->
        <x-slot name="header">
            Detail Data Jadwal
        </x-slot>

        <!-- Card body -->
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h4>Nama Kelas</h4>
                    <p>{{ $schedule->classroom->name }}</p>
                    <h4>Mapel</h4>
                    <p>{{ $schedule->classroom->subject->name . ' ' . $schedule->classroom->subject->grade }}</p>
                    <h4>Guru</h4>
                    <p>{{ $schedule->classroom->subject->teacher->name }}</p>
                    <h4>Jam Mulai</h4>
                    <p>{{ $schedule->formatted_start_time }}</p>
                    <h4>Jam Selesai</h4>
                    <p>{{ $schedule->formatted_end_time }}</p>
                </div>
                <div class="col">
                    <h4>Siswa</h4>
                    <ul class="list-group">
                        @foreach($schedule->classroom->students as $student)
                            <p>{{ $student->name }}</p>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </x-app-card>

    @if ($schedule->attendances_count > 1)
        <div class="container-fluid mt-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="mb-0">Presensi</h3>
                </div>

                <!-- Card body -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Keterangan</th>
                                <th>Waktu</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedule->attendances as $attendance)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $attendance->attendanceable->name }}</td>
                                    <td>{{ ($attendance->attendanceable instanceof \App\Models\Teacher) ? 'Guru' : 'Siswa' }}</td>
                                    <td>{{ $attendance->formatted_created_at }}</td>
                                    <td>{{ $attendance->latitude ?? '-' }}</td>
                                    <td>{{ $attendance->longitude ?? '-' }}</td>
                                    <td>
                                        @if ($attendance->status == 'Tepat Waktu, Dalam Area')
                                            <span class="badge badge-success">{{ $attendance->status }}</span>
                                        @elseif ($attendance->status == 'Terlambat, Dalam Area')
                                            <span class="badge badge-warning">{{ $attendance->status }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ $attendance->status }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="container-fluid mt-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="mb-0">Peta</h3>
                </div>

                <!-- Card body -->
                <div class="row">
                    <div class="col-md-12">
                        <div id="mapid" class="mt-2"></div>
                        <script>
                            let baseLatitude = -8.164520231642912;
                            let baseLongitude = 112.21858851023774;

                            let attendanceLatitude = {{ $schedule->attendances->first()->latitude ?? '' }};
                            let attendanceLongitude = {{ $schedule->attendances->first()->longitude ?? '' }};

                            const mymap = L.map('mapid').setView([baseLatitude, baseLongitude], 16);
                            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
                                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                                maxZoom: 18,
                                id: 'mapbox/streets-v11',
                                tileSize: 512,
                                zoomOffset: -1,
                                accessToken: 'pk.eyJ1IjoiZHdpLXJpZmFsZGk0MTI5OSIsImEiOiJja2JsdDRnd2MxYzh4Mnhsc25ndXZwcjQyIn0.vYl2V9F_D-qdVwc0IMg6zA'
                            }).addTo(mymap);

                            L.circle([baseLatitude, baseLongitude], 500).addTo(mymap);

                            L.marker([baseLatitude, baseLongitude]).addTo(mymap).bindPopup("<b>LKP Ar Risalah</b>").openPopup();

                            L.marker([attendanceLatitude, attendanceLongitude]).addTo(mymap).bindPopup("<b>Lokasi Presensi</b>").openPopup();
                        </script>
                    </div>
                </div>
            </div>
        </div>
    @endif
</x-app-layout>
