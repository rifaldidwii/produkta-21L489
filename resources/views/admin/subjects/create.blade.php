<x-app-layout>
    <!-- Title -->
    <x-title text="Menu Mapel"/>

    <!-- Page content -->
    <x-app-card>
        <!-- Card header -->
        <x-slot name="header">
            Form Tambah Data Mapel
            <button id="add-column" class="btn btn-sm btn-primary float-right">tambah kolom</button>
        </x-slot>

        <!-- Card body -->
        <div class="card-body">
            <form method="POST" action="{{ route('admin.subjects.store') }}">
                @csrf

                <input type="hidden" id="count" name="count" value="1">

                <x-app-input-group name="teacher_id" type="select-single" label="Guru">
                    <x-slot name="option">
                        @foreach($teachers as $teacher)
                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                        @endforeach
                    </x-slot>
                </x-app-input-group>

                <x-app-input-group name="name[]" type="select-single" label="Nama">
                    <x-slot name="option">
                        @foreach ($names as $name)
                            <option value="{{ $name }}">{{ $name }}</option>
                        @endforeach
                    </x-slot>
                </x-app-input-group>

                <x-app-input-group name="grade[]" type="select-single" label="Kelas">
                    <x-slot name="option">
                        @foreach ($grades as $grade)
                            <option value="{{ $grade }}">{{ $grade }}</option>
                        @endforeach
                    </x-slot>
                </x-app-input-group>

                <div id="new-column"></div>

                <div class="row">
                    <div class="col">
                        <x-button>Tambah</x-button>
                        <x-link class="btn-danger" :href="route('admin.subjects.index')">Batal</x-link>
                    </div>
                </div>
            </form>
        </div>
    </x-app-card>

    <x-select2>
        <script>
            $(document).ready(() => {
                $('#teacher_id').select2();

                let count = 1;

                $('#add-column').click(() => {
                    count++;

                    let html = '<hr class="mt-2 mb-4">' +
                    '<div class="row">' +
                        '<div class="col-md-12">' +
                            '<div class="form-group">' +
                                '<label class="form-control-label" for="name-' + count + '">Nama</label>' +
                                '<select class="form-control" id="name-' + count + '" name="name[]">' +
                                    @foreach ($names as $name)
                                        '<option value="{{ $name }}">{{ $name }}</option>' +
                                    @endforeach
                                '</select>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                    '<div class="row">' +
                        '<div class="col-md-12">' +
                            '<div class="form-group">' +
                                '<label class="form-control-label" for="grade-' + count + '">Kelas</label>' +
                                '<select class="form-control" id="grade-' + count + '" name="grade[]">' +
                                    @foreach ($grades as $grade)
                                        '<option value="{{ $grade }}">{{ $grade }}</option>' +
                                    @endforeach
                                '</select>' +
                            '</div>' +
                        '</div>' +
                    '</div>';

                    $('#new-column').append(html);

                    $('#count').val(count);
                });
            });


        </script>
    </x-select2>
</x-app-layout>
