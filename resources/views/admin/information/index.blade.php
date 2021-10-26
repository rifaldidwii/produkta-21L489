<x-app-layout>
    <!-- Title -->
    <x-title text="Menu Informasi"/>

    <x-app-card>
        <!-- Card header -->
        <x-slot name="header">
            Tabel Data Informasi
        </x-slot>

        <x-alert type="success"/>

        <x-alert type="danger"/>

        <!-- Card body -->
        <div class="table-responsive">
            <table class="table align-items-center table-flush table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($information as $information)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <b>{{ $information->name }}</b>
                            </td>
                            <td>
                                @if ($information->name == 'Foto')
                                    <img class="card-img-top rounded-top" style="width: 350px" src="{{ $information->description }}" alt="">
                                @else
                                    {!! $information->description !!}
                                @endif
                            </td>
                            <td>
                                <x-link class="btn-sm btn-warning" :href="route('admin.information.edit', $information)">ubah</x-link>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-app-card>
</x-app-layout>
