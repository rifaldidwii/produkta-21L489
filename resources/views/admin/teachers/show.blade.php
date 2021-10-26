<x-app-layout>
    <!-- Title -->
    <x-title text="Menu Guru"/>

    <!-- Page content -->
    <x-app-card>
        <!-- Card header -->
        <x-slot name="header">
            Detail Data Guru
            <x-link class="btn-sm btn-primary float-right" :href="route('admin.teachers.edit', $teacher)">ubah</x-link>
        </x-slot>

        <!-- Card body -->
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <a href="#">
                        <img src="{{ $teacher->user->profile_photo }}"
                            class="rounded-circle img-center img-fluid shadow shadow-lg--hover"
                            style="width: 140px;">
                    </a>
                    <div class="pt-4 text-center">
                        <h5 class="h3 title">
                            <span class="d-block mb-1">{{ $teacher->name }}</span>
                            <small class="h4 font-weight-light text-muted"></small>
                        </h5>
                        <p>{{ $teacher->user->email }}</p>
                    </div>
                </div>
                <div class="col">
                    <h4>Telepon</h4>
                    <p>{{ $teacher->phone ?? '-' }}</p>
                    <h4>Alamat</h4>
                    <p>{{ $teacher->address ?? '-' }}</p>
                    <h4>Bidang</h4>
                    <p>{{ $teacher->field ?? '-' }}</p>
                </div>
            </div>
        </div>
    </x-app-card>

    <div class="container-fluid mt-4">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="mb-0">Kelas</h3>
            </div>

            <!-- Card body -->
            <div class="table-responsive">
                <table class="table align-items-center table-flush table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Mapel</th>
                            <th>Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($teacher->classrooms as $classroom)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><b>{{ $classroom->name }}</b></td>
                                <td>{{ $classroom->subject->name }}</td>
                                <td>{{ $classroom->subject->grade }}</td>
                                <td>
                                    <x-link class="btn-sm btn-info" :href="route('admin.classrooms.show', $classroom)">detail</x-link>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
