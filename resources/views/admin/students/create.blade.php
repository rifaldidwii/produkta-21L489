<x-app-layout>
    <!-- Title -->
    <x-title text="Menu Siswa"/>

    <!-- Page content -->
    <x-app-card>
        <!-- Card header -->
        <x-slot name="header">
            Form Tambah Data Siswa
        </x-slot>

        <!-- Card body -->
        <div class="card-body">
            <form method="POST" action="{{ route('admin.students.store') }}" enctype="multipart/form-data">
                @csrf

                <x-app-input-group name="name" type="text" label="Nama"/>

                <x-app-input-group name="username" type="text" label="Nama Panggilan"/>

                <x-app-input-group name="email" type="email" label="Email"/>

                <x-app-input-group name="password" type="password" label="Password (Opsional, Default: sehatmulia)"/>

                <x-app-input-group name="profile_photo" type="file" label="Foto (Opsional)"/>

                <x-app-input-group name="birthplace" type="text" label="Tempat Lahir"/>

                <x-app-input-group name="birthdate" type="datepicker" label="Tanggal Lahir"/>

                <x-app-input-group name="phone" type="text" label="Telepon"/>

                <x-app-input-group name="address" type="text" label="Alamat"/>

                <x-app-input-group name="grade" type="select-single" label="Kelas">
                    <x-slot name="option">
                        @foreach ($grades as $grade)
                            <option value="{{ $grade }}">{{ $grade }}</option>
                        @endforeach
                    </x-slot>
                </x-app-input-group>

                <x-app-input-group name="school" type="text" label="Asal Sekolah"/>

                <x-app-input-group name="classrooms" type="select-multiple" label="Kelas">
                    <x-slot name="option">

                    </x-slot>
                </x-app-input-group>

                <x-app-input-group name="parent_name" type="text" label="Nama Orang Tua"/>

                <x-app-input-group name="parent_job" type="text" label="Pekerjaan Orang Tua"/>

                <x-app-input-group name="parent_phone" type="text" label="No Telepon Orang Tua"/>

                <div class="row">
                    <div class="col">
                        <x-button>Tambah</x-button>
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
                $('#classrooms').select2({
                    theme: 'classic'
                });

                $("#grade").change(function () {
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
