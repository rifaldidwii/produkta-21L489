<x-app-layout>
    <!-- Title -->
    <x-title text="Menu Kelas"/>

    <!-- Page content -->
    <x-app-card class="py-0">
        <!-- Card header -->
        <x-slot name="header">
            Tabel Data Kelas
        </x-slot>

        <!-- Card body -->
        <div class="table-responsive">
            <table class="table align-items-center table-flush table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Mapel</th>
                        <th>Guru</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($classrooms as $classroom)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <b>{{ $classroom->name }}</b>
                            </td>
                            <td>{{ $classroom->subject->name }}</td>
                            <td>{{ $classroom->subject->teacher->name }}</td>
                                @can('update-classroom', $classroom)
                                    <td>
                                        <span class="badge badge-danger">Belum terdaftar</span>
                                    </td>
                                @else
                                    <td>
                                        <span class="badge badge-info">Terdaftar</span>
                                    </td>
                                @endcan
                            <td>
                                <x-link class="btn-sm btn-info" :href="route('student.classrooms.show', $classroom)">detail</x-link>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-app-card>
</x-app-layout>
