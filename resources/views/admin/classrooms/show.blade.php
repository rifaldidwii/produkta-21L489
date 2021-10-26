<x-app-layout>
    <!-- Title -->
    <x-title text="Menu Kelas"/>

    <!-- Page content -->
    <x-app-card>
        <!-- Card header -->
        <x-slot name="header">
            Detail Data Kelas
            <x-link class="btn-sm btn-primary float-right" :href="route('admin.classrooms.edit', $classroom)">ubah</x-link>
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
                    <h4>Semester</h4>
                    <p>{{ $classroom->semester->name }}</p>
                    <h4>Tahun Ajaran</h4>
                    <p>{{ $classroom->semester->academic_year }}</p>
                </div>
            </div>
        </div>
    </x-app-card>

    <div class="container-fluid mt-4">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="mb-0">Siswa
                    <x-link class="btn-sm btn-primary float-right" href="#" data-toggle="modal" data-target="#modal-select-student">tambah</x-link>
                </h3>
            </div>

            <!-- Card body -->
            <div class="table-responsive">
                <table class="table align-items-center table-flush table-striped">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Sekolah</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($classroom->students as $student)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->school }}</td>
                                <td>{{ $student->phone }}</td>
                                <td>{{ $student->address }}</td>
                                <td>
                                    <x-link class="btn-sm btn-info" :href="route('admin.students.show', $student)">detail</x-link>
                                    <x-link class="btn-sm btn-danger" href="#" data-toggle="modal" data-target="#modal-delete-{{ $student->id }}">hapus</x-link>

                                    <x-modal-delete :id="$student->id" :name="$student->name" :action="route('admin.classrooms.students.destroy', [$classroom, $student])"/>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-modal-select-student :classroom="$classroom" :students="$students"/>

    <x-datatables>
        <script>
            $(function () {
                $('#dataTable').DataTable({
                    language: {
                        paginate: {
                            previous: '<i class="bi bi-chevron-left">',
                            next: '<i class="bi bi-chevron-right">'
                        }
                    },
                })
            })
        </script>
    </x-datatables>
</x-app-layout>
