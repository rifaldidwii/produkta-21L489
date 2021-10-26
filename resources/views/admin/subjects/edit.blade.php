<x-app-layout>
    <!-- Title -->
    <x-title text="Menu Mapel"/>

    <!-- Page content -->
    <x-app-card>
        <!-- Card header -->
        <x-slot name="header">
            Form Ubah Data Mapel
        </x-slot>

        <!-- Card body -->
        <div class="card-body">
            <form method="POST" action="{{ route('admin.subjects.update', $subject) }}">
                @csrf
                @method('PUT')

                <x-app-input-group name="teacher_id" type="select-single" label="Guru">
                    <x-slot name="option">
                        @foreach($teachers as $teacher)
                            @if($teacher->id == $subject->teacher_id)
                                <option value="{{ $teacher->id }}" selected>{{ $teacher->name }}
                                </option>
                            @endif
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                        @endforeach
                    </x-slot>
                </x-app-input-group>

                <x-app-input-group name="name" type="select-single" label="Nama">
                    <x-slot name="option">
                        @foreach ($names as $name)
                            @if ($subject->name == $name)
                                <option value="{{ $name }}" selected>{{ $name }}</option>
                            @endif
                            <option value="{{ $name }}">{{ $name }}</option>
                        @endforeach
                    </x-slot>
                </x-app-input-group>

                <x-app-input-group name="grade" type="select-single" label="Kelas">
                    <x-slot name="option">
                        @foreach ($grades as $grade)
                            @if ($grade == $subject->grade)
                                <option value="{{ $grade }}" selected>{{ $grade }}</option>
                            @else
                                <option value="{{ $grade }}">{{ $grade }}</option>
                            @endif
                        @endforeach
                    </x-slot>
                </x-app-input-group>

                <div class="row">
                    <div class="col">
                        <x-button>Ubah</x-button>
                        <x-link class="btn-danger" :href="route('admin.subjects.index')">Batal</x-link>
                    </div>
                </div>
            </form>
        </div>
    </x-app-card>

    <x-select2>
        <script>
            $(document).ready(function () {
                $('#teacher_id').select2();
            });
        </script>
    </x-select2>
</x-app-layout>
