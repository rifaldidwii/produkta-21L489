<x-app-layout>
    <!-- Title -->
    <x-title text="Menu Pembayaran"/>

    <!-- Page content -->
    <x-app-card>
        <!-- Card header -->
        <x-slot name="header">
            Form Tambah Data Pembayaran

            <button id="add-column" class="btn btn-sm btn-primary float-right">generate data</button>
        </x-slot>

        <!-- Card body -->
        <div class="card-body">
            <form method="POST" action="{{ route('admin.payments.store') }}">
                @csrf

                <div id="new-column"></div>

                <div id="old-column">
                    <x-app-input-group name="student_id" type="select-single" label="Siswa">
                        <x-slot name="option">
                            @foreach($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }}</option>
                            @endforeach
                        </x-slot>
                    </x-app-input-group>
                </div>

                <x-app-input-group name="amount" type="number" label="Jumlah"/>

                <x-app-input-group name="description" type="text" label="Deskripsi"/>

                <x-app-input-group name="status" type="select-single" label="Status">
                    <x-slot name="option">
                        <option value="Belum Dibayar">Belum Dibayar</option>
                        <option value="Lunas">Lunas</option>
                    </x-slot>
                </x-app-input-group>

                <div class="row">
                    <div class="col">
                        <x-button>Tambah</x-button>
                        <x-link class="btn-danger" :href="route('admin.payments.index')">Batal</x-link>
                    </div>
                </div>
            </form>
        </div>
    </x-app-card>

    <x-select2>
        <script>
            $(document).ready(function () {
                $('#student_id').select2();

                $('#add-column').click(() => {
                    $('#add-column').hide();

                    $('#old-column').remove();

                    let html =
                    '<div class="row">' +
                        '<div class="col-md-12">' +
                            '<div class="form-group">' +
                                '<label class="form-control-label" for="grade">Kelas</label>' +
                                '<select class="form-control" id="grade" name="grade">' +
                                    @foreach ($grades as $grade)
                                        '<option value="{{ $grade }}">{{ $grade }}</option>' +
                                    @endforeach
                                '</select>' +
                            '</div>' +
                        '</div>' +
                    '</div>';

                    $('#new-column').append(html);
                });
            });
        </script>
    </x-select2>
</x-app-layout>
