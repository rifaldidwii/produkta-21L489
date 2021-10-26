<x-app-layout>
    <x-leaflet/>

    <!-- Title -->
    <x-title text="Menu Kelas"/>

    <!-- Page content -->
    <x-app-card>
        <!-- Card header -->
        <x-slot name="header">
            Detail Data Kelas
        </x-slot>

        <!-- Card body -->
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h4>Nama</h4>
                    <p>{{ $classroom->name }}</p>
                    <h4>Deskripsi</h4>
                    <p>{{ $classroom->description ?? '-' }}</p>
                    <h4>Mapel</h4>
                    <p>{{ $classroom->subject->name . ' ' . $classroom->subject->grade }}</p>
                    <h4>Guru</h4>
                    <p>{{ $classroom->subject->teacher->name }}</p>
                    <h4>Telepon</h4>
                    <p>{{ $classroom->subject->teacher->phone }}</p>
                    <h4>Semester</h4>
                    <p>{{ $classroom->semester->name }}</p>
                    <h4>Tahun Ajaran</h4>
                    <p>{{ $classroom->semester->academic_year }}</p>
                    @can('update-classroom', $classroom)
                        <x-link class="btn-success" href="#" data-toggle="modal" data-target="#modal-update-classroom">Ikuti Kelas</x-link>
                    @endcan
                </div>
            </div>
        </div>
    </x-app-card>

    @cannot('update-classroom', $classroom)
        <div class="container-fluid mt-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h3 class="mb-0">Presensi 1 Bulan Terakhir</h3>
                </div>

                <!-- Card body -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Waktu</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attendances as $attendance)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $attendance->formatted_created_at }}</td>
                                    <td>{{ $attendance->latitude ?? '-' }}</td>
                                    <td>{{ $attendance->longitude ?? '-' }}</td>
                                    <td>
                                        @if ($attendance->status == 'Tepat Waktu, Dalam Area')
                                            <span class="badge badge-info">{{ $attendance->status }}</span>
                                        @elseif ($attendance->status == 'Terlambat, Dalam Area')
                                            <span class="badge badge-warning">{{ $attendance->status }}</span>
                                        @else
                                            <span class="badge badge-danger">{{ $attendance->status }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($attendance->status != 'Tidak Hadir')
                                            <button class="btn btn-sm btn-info" onclick="showMarker(`{{ $attendance->latitude ?? '-' }}`, `{{ $attendance->longitude ?? '-' }}`, `{{ $attendance->formatted_created_at }}`)">detail</button>
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

                            let marker = null;

                            function showMarker(latitude, longitude, date) {
                                if (marker != null) {
                                    mymap.removeLayer(marker);
                                }

                                marker = L.marker([latitude, longitude]).addTo(mymap).bindPopup(`<b>${date}</b>`).openPopup();
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    @endcannot

    <div class="modal fade" id="modal-update-classroom" tabindex="-1" role="dialog"
        aria-labelledby="modal-update-classroom" aria-hidden="true">
        <div class="modal-dialog modal-danger modal-dialog-centered modal-" role="document">
            <div class="modal-content bg-gradient-success">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">Konfirmasi</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="py-3 text-center">
                        <i class="bi bi-bell-fill" style="font-size: 3rem;"></i>
                        <h4 class="heading mt-4">Apakah anda yakin untuk mengikuti kelas ini?</h4>
                        <p>Klik tombol "Ikuti" dibawah ini untuk masuk ke dalam kelas.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-white" href="#" onclick="event.preventDefault();
                        document.getElementById('student-classroom-update-form').submit();">Ikuti</a>
                    <form id="student-classroom-update-form" action="{{ route('student.classrooms.update', $classroom) }}" method="POST" class="d-none">
                        @csrf
                        @method('PUT')
                    </form>
                    <button type="button" class="btn btn-link text-white ml-auto" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
