<x-app-layout>
    <!-- Title -->
    <x-title text="Menu Kelas"/>

    <!-- Page content -->
    <x-app-card>
        <!-- Card header -->
        <x-slot name="header">
            Form Ubah Data Kelas
        </x-slot>

        <!-- Card body -->
        <div class="card-body">
            <form method="POST" action="{{ route('admin.classrooms.update', $classroom) }}">
                @csrf
                @method('PUT')

                <x-app-input-group name="subject_id" type="select-single" label="Guru">
                    <x-slot name="option">
                        @foreach($subjects as $subject)
                            @if($classroom->subject_id == $subject->id)
                                <option
                                    value="{{ $subject->id }}" selected>{{ $subject->teacher->name . ' - '
                                        . $subject->name . ' ' . $subject->grade }}
                                </option>
                            @endif
                            <option
                                value="{{ $subject->id }}">{{ $subject->teacher->name . ' - '
                                    . $subject->name . ' ' . $subject->grade }}
                            </option>
                        @endforeach
                    </x-slot>
                </x-app-input-group>

                <x-app-input-group name="name" type="text" label="Nama" value="{{ $classroom->name }}"/>

                <x-app-input-group name="description" type="text" label="Deskripsi" value="{{ $classroom->description }}"/>

                <div class="row">
                    <div class="col">
                        <x-button>Ubah</x-button>
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
