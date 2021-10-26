<x-app-layout>
    <!-- Title -->
    <x-title text="Menu Kelas"/>

    <!-- Page content -->
    <x-app-card class="py-0">
        <!-- Card header -->
        <x-slot name="header">
            Tabel Data Kelas
        </x-slot>

        <x-alert type="success"/>

        <!-- Card body -->
        <div class="table-responsive">
            <table class="table align-items-center table-flush table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>Nama</th>
                        <th>Mapel</th>
                        <th>Kelas</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(auth()->user()->teacher->classrooms as $classroom)
                        <tr>
                            <td>
                                <b>{{ $classroom->name }}</b>
                            </td>
                            <td>{{ $classroom->subject->name }}</td>
                            <td>{{ $classroom->subject->grade }}</td>
                            <td>
                                <x-link class="btn-sm btn-info" :href="route('teacher.classrooms.show', $classroom)">detail</x-link>
                                <x-link class="btn-sm btn-success" href="#" data-toggle="modal" data-target="#modal-send-message-{{ $classroom->id }}">kirim pesan</x-link>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-app-card>

    @foreach (auth()->user()->teacher->classrooms as $classroom)
        <div class="modal fade" id="modal-send-message-{{ $classroom->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="modal-send-message-{{ $classroom->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{ route('teacher.notifications.store', $classroom) }}" method="POST">
                        @csrf

                        <div class="modal-header align-items-center">
                            <h6 class="modal-title" id="modal-title-default">Pesan Data Kelas</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <x-app-input-group name="message" type="text" label="Pesan"></x-input-group>
                        </div>
                        <div class="modal-footer">
                            <x-button>Kirim</x-button>
                            <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>
