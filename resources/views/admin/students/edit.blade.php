<x-app-layout>
    <!-- Title -->
    <x-title text="Menu Siswa"/>

    <!-- Page content -->
    <x-app-card>
        <!-- Card header -->
        <x-slot name="header">
            Form Ubah Data Siswa
        </x-slot>

        <!-- Card body -->
        <div class="card-body">
            <form method="POST" action="{{ route('admin.students.update', $student) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <x-app-input-group name="name" type="text" label="Nama" value="{{ $student->name }}"/>

                <x-app-input-group name="name" type="text" label="Nama Panggilan" value="{{ $student->user->username }}"/>

                <x-app-input-group name="email" type="email" label="Email" value="{{ $student->user->email }}"/>

                <x-app-input-group name="password" type="password" label="Password (Opsional)"/>

                <div class="row">
                    <div class="col-md-12">
                        <img id="preview" src="{{ $student->user->profile_photo }}"
                            class="rounded-circle img-left img-fluid shadow shadow-lg--hover mb-4"
                            style="width: 140px;">
                    </div>
                </div>

                <x-app-input-group name="profile_photo" type="file" label="Foto (Opsional)"/>

                <x-app-input-group name="birthplace" type="text" label="Tempat Lahir" value="{{ $student->birthplace }}"/>

                <x-app-input-group name="birthdate" type="datepicker" label="Tanggal Lahir" value="{{ $student->birthdate }}"/>

                <x-app-input-group name="phone" type="text" label="Telepon" value="{{ $student->phone }}"/>

                <x-app-input-group name="address" type="text" label="Alamat" value="{{ $student->address }}"/>

                <x-app-input-group name="grade" type="select-single" label="Kelas">
                    <x-slot name="option">
                        @foreach ($grades as $grade)
                            @if ($grade == $student->grade)
                                <option value="{{ $grade }}" selected>{{ $grade }}</option>
                            @else
                                <option value="{{ $grade }}">{{ $grade }}</option>
                            @endif
                        @endforeach
                    </x-slot>
                </x-app-input-group>

                <x-app-input-group name="school" type="text" label="Asal Sekolah" value="{{ $student->school }}"/>

                <x-app-input-group name="classrooms" type="select-multiple" label="Kelas">
                    <x-slot name="option">
                        @foreach($classrooms as $classroom)
                            <option value="{{ $classroom->id }}">{{ $classroom->name . ' - '. $classroom->subject->name . ' : '.  $classroom->subject->teacher->name}}</option>
                        @endforeach
                    </x-slot>
                </x-app-input-group>

                <x-app-input-group name="parent_name" type="text" label="Nama Orang Tua" value="{{ $student->parent_name }}"/>

                <x-app-input-group name="parent_job" type="text" label="Pekerjaan Orang Tua" value="{{ $student->parent_job }}"/>

                <x-app-input-group name="parent_phone" type="text" label="No Telepon Orang Tua" value="{{ $student->parent_phone }}"/>

                <div class="row">
                    <div class="col">
                        <x-button>Ubah</x-button>
                        <x-link class="btn-danger" :href="route('admin.students.index')">Batal</x-link>
                    </div>
                </div>
            </form>
        </div>
    </x-app-card>

    <x-datepicker/>

    <x-select2>
        <script>
            $(document).ready(function () {
                classrooms = {!! json_encode($student->classrooms->pluck('id')) !!};

                $('#classrooms').val(classrooms);
                $('#classrooms').select2({
                    theme: 'classic'
                });

                $("#grade").change(function () {
                    $("#classrooms").empty().trigger('change')
                    $.ajax({
                        url: "{{ route('admin.students.create') }}?grade=" + $(this).val(),
                        method: 'GET',
                        success: function(data) {
                            $('#classrooms').html(data.html);
                        }
                    });
                });
            });
        </script>
    </x-select2>
</x-app-layout>
