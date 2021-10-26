<x-app-layout>
    <!-- Title -->
    <x-title text="Menu Kelas"/>

    <!-- Page content -->
    <x-app-card>
        <!-- Card header -->
        <x-slot name="header">
            Form Tambah Data Kelas
        </x-slot>

        <!-- Card body -->
        <div class="card-body">
            <form method="POST" action="{{ route('admin.classrooms.store') }}">
                @csrf

                <x-app-input-group name="subject_id" type="select-single" label="Guru">
                    <x-slot name="option">
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}">{{ $subject->teacher->name . ' - '
                            . $subject->name . ' ' . $subject->grade }}
                            </option>
                        @endforeach
                    </x-slot>
                </x-app-input-group>

                <x-app-input-group name="name" type="text" label="Nama"/>

                <x-app-input-group name="description" type="text" label="Deskripsi"/>

                <div class="col">
                    <div class="form-group row">
                        <x-button>Tambah</x-button>
                        <x-link class="btn-danger" :href="route('admin.classrooms.index')">Batal</x-link>
                    </div>
                </div>
            </form>
        </div>
    </x-app-card>

    <x-select2>
        <script>
            $(document).ready(function () {
                $('#subject_id').select2();
            });
        </script>
    </x-select2>
</x-app-layout>
