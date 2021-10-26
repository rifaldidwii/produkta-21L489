<x-app-layout>
    <!-- Title -->
    <x-title text="Menu Siswa"/>

    <!-- Page content -->
    <x-app-card>
        <!-- Card header -->
        <x-slot name="header">
            Detail Data Siswa
        </x-slot>

        <!-- Card body -->
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <a href="#">
                        <img src="{{ $student->user->profile_photo }}"
                            class="rounded-circle img-center img-fluid shadow shadow-lg--hover"
                            style="width: 140px;">
                    </a>
                    <div class="pt-4 text-center">
                        <h5 class="h3 title">
                            <span class="d-block mb-1">{{ $student->name }}</span>
                            <small class="h4 font-weight-light text-muted"></small>
                        </h5>
                        <p>{{ $student->user->email }}</p>
                    </div>
                </div>
                <div class="col">
                    <h4>Telepon</h4>
                    <p>{{ $student->phone ?? '-' }}</p>
                    <h4>Alamat</h4>
                    <p>{{ $student->address ?? '-' }}</p>
                    <h4>Kelas</h4>
                    <p>{{ $student->grade ?? '-' }}</p>
                    <h4>Asal Sekolah</h4>
                    <p>{{ $student->school ?? '-' }}</p>
                    <h4>Nama Orang Tua</h4>
                    <p>{{ $student->parent_name ?? '-' }}</p>
                    <h4>Pekerjaan Orang Tua</h4>
                    <p>{{ $student->parent_job ?? '-' }}</p>
                    <h4>No Telepon Orang Tua</h4>
                    <p>{{ $student->parent_phone ?? '-' }}</p>
                </div>
            </div>
        </div>

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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </x-app-card>
</x-app-layout>
